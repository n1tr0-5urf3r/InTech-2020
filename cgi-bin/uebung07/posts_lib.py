# Traceback handler for python
import cgi
import cgitb
import json
import time
from os import listdir
from os.path import isfile, join

cgitb.enable()

POSTS_PATH = "posts/"

def printHead(title):
        print("""Content-type: text/html\n
        <!DOCTYPE html>
        <html lang="de">
        <head>
        <meta charset="utf-8">
        <title>{}</title></head>""".format(title))


# Liefert die aktuelle Uhrzeit im Format Jahr-Monat-Tag-Stunde-Minute-Sekunde
def get_timestamp():
    return time.strftime("%Y-%m-%d-%H-%M-%S")

# Writes post as json ecnoded file
def write_post(filename, post):
    # Speichere das Dictionary JSON-codiert
    with open(join(POSTS_PATH, filename), 'w') as outfile:
        json.dump(post, outfile)

# Liest den json-codiert gespeicherten Task mit Dateiname filename ein
def read_post(filename):
    # Öffne den JSON-codierten Task
    with open(join(POSTS_PATH, filename), 'r') as json_file:
        # Decodiere die JSON-Datei in ein Dictionary
        return json.load(json_file)


def create_post(title, content, tags):
    timestamp = get_timestamp()

    post = {
        "title": title,
        "published": timestamp,
        # TODO fix tags
        "tags": tags,
        "content": content
    }
    # Write json file
    write_post(timestamp, post)
    return post


# Creates HTTP-Redirect
def redirect(location):
    print("Status: 303 See Other")
    print("Location: {}".format(location))
    print()

def printErrorPage(title, message, exception):
    printHead(title)
    print("<body><p>{}</p>".format(message))
    # Exception ausgeben
    print(repr(exception))
    print("</body></html>")
