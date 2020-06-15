#!/usr/bin/python3
# coding=utf-8


from tasks_lib import read_all_tasks, get_done_tasks, get_open_tasks
from tasks_lib import print_header, print_tasks, print_footer, print_form, print_navigation
import cgi

form = cgi.FieldStorage(encoding='utf8')

# Welchen Zustand sollen die angezeigten Tasks haben? Default-Wert: all
state = form.getfirst('state', 'all')

all_tasks = read_all_tasks()

# Filtere die Tasks nach dem entsprechenden Zustand
if state == "open":
    tasks = get_open_tasks(all_tasks)
    prefix = "offene"
elif state == "done":
    tasks = get_done_tasks(all_tasks)
    prefix = "erledigte"
else:
    tasks = all_tasks
    prefix = ""

# Ab hier:Ausgabe des HTML-Codes
print_header("{} {} Aufgaben".format(len(tasks), prefix))
print_navigation()
print_tasks(tasks)
print_form()
print_footer()
