# coding=utf-8
import datetime
import json
import os
import sys
import time
from os import listdir
from os.path import isfile, join


# -------------------------------------------------------------------------------------
# Hilfsfunktionen
# -------------------------------------------------------------------------------------

# enc_print zur Behebung des UTF-Problems mit dem Übungsserver
def enc_print(string='', encoding='utf8'):
    sys.stdout.buffer.write(string.encode(encoding) + b'\n')


# Erzeugt einen HTTP-Redirect
def redirect(location):
    print("Status: 303 See Other")
    print("Location: {}".format(location))
    print()


# Liefert die aktuelle Uhrzeit im Format Jahr-Monat-Tag-Stunde-Minute-Sekunde
def get_timestamp():
    return time.strftime("%Y-%m-%d-%H-%M-%S")


# Konvertiert einene Timestamp im Format Jahr-Monat-Tag-Stunde-Minute-Sekunde in die Form Tag.Monat.Jahr
def readable_timestamp(timestamp):
    return datetime.datetime.strptime(timestamp, "%Y-%m-%d-%H-%M-%S").strftime("%d.%m.%Y")


# -------------------------------------------------------------------------------------
# Layout-Funktionen
# -------------------------------------------------------------------------------------

# Gibt den Header der Seite mit optionalem Titel aus
def print_header(title=""):
    enc_print("Content-type: text/html\n")

    enc_print("""
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>{}</title>
    <link rel="stylesheet" href="style.css">
</head>
<body> 
    <h1>{}</h1>
    """.format(title, title))


# Gibt den Footer aus
def print_footer():
    enc_print("""
</body>
</html>
    """)


def print_navigation():
    enc_print("""
        <p>
        <a href="tasks-show.py">Alle Aufgaben anzeigen</a> -
        <a href="tasks-show.py?state=open">Offene Aufgaben anzeigen</a> - 
        <a href="tasks-show.py?state=done">Bereits erledigte Aufgaben anzeigen</a>
    </p>    
    """)


# Gibt alle Tasks in einer Tabelle aus
def print_tasks(tasks):
    if len(tasks) == 0:
        enc_print("Noch keine Aufgaben vorhanden ...")
    else:
        enc_print("<table>")

        for t in tasks:
            # Symbol für "Haken" und "Kreuz" in Abhängigkeit davon, ob der Task erledigt wurde
            symbol = "&#10007;" if t["state"] == "done" else "&#10003;"

            # Tabellenzeile ausgeben
            enc_print("""<tr>
            <td class="{}">{} <span style='font-size: x-small'>({})</span></td>
            <td class="min"><form action="tasks-update.py" method="post"><button name="timestamp" value="{}">{}</button></form></td>
            <td class="min"><form action="tasks-delete.py" method="post"><button name="timestamp" value="{}">&#128465;</button> </form></td>
            </tr>""".format(t["state"],
                            t["title"],
                            readable_timestamp(t["timestamp"]),
                            t["timestamp"],
                            symbol,
                            t["timestamp"]))

        enc_print("</table>")


# Gibt das Formular zum Anlegen eines Tasks aus
def print_form():
    enc_print("""
    <form action="tasks-store.py" method="post" style="margin-top: 2em">

        <label for="title">Neue Aufgabe hinzufügen:</label>
        <input type="text" name="title" id="title" required>

        <button>Speichern</button>

    </form>
    """)


def print_exception_page(title, message, exception):
    print_header(title)
    enc_print("<p>{}</p>".format(message))

    # Exception ausgeben
    enc_print(repr(exception))

    print_footer()


# -------------------------------------------------------------------------------------
# IO-Funktionen
# -------------------------------------------------------------------------------------

TASKS_PATH = "tasks/"


# Speichert den Task task json-codiert unter dem Namen filename
def write_task(filename, task):
    # Speichere das Dictionary JSON-codiert
    with open(join(TASKS_PATH, filename), 'w') as outfile:
        json.dump(task, outfile)


# Liest den json-codiert gespeicherten Task mit Dateiname filename ein
def read_task(filename):
    # Öffne den JSON-codierten Task
    with open(join(TASKS_PATH, filename), 'r') as json_file:
        # Decodiere die JSON-Datei in ein Dictionary
        return json.load(json_file)


# Liefert alle gespeicherten Tasks
def read_all_tasks():
    # Liefert alle Dateien im Ordner tasks_path
    file_names = [f for f in listdir(TASKS_PATH) if isfile(join(TASKS_PATH, f))]

    # Liest alle vorher bestimmten Tasks ein
    tasks = [read_task(f) for f in file_names]

    # Sortiert die Tasks aufsteigend nach title (mit reverse=TRUE absteigend)
    sorted_tasks = sorted(tasks, key=lambda t: t["title"], reverse=False)

    return sorted_tasks


# Löscht den Task mit Dateiname filename
def delete_task(filename):
    os.remove(join(TASKS_PATH, filename))


# -------------------------------------------------------------------------------------
# Task-Funktionen
# -------------------------------------------------------------------------------------


# Erstellt einen neuen Task mit dem Titel title, dem aktuellen timestamp und dem state open
def create_task(title):
    # Rufe die aktuelle Uhrzeit ab
    timestamp = get_timestamp()

    # Erstelle den Task als Dictionary
    task = {
        "title": title,
        "timestamp": timestamp,
        "state": "open"
    }

    return task


# Flippt den Zustand des Tasks zwischen done und open
def flip_task_state(task):
    if task['state'] == 'done':
        task['state'] = 'open'
    else:
        task['state'] = 'done'

    return task


# Filtert all_tasks nach allen Tasks state == open
def get_open_tasks(all_tasks):
    open_tasks = [t for t in all_tasks if t["state"] == "open"]

    return open_tasks


# Filtert all_tasks nach allen Tasks state == done
def get_done_tasks(all_tasks):
    open_tasks = [t for t in all_tasks if t["state"] == "done"]

    return open_tasks
