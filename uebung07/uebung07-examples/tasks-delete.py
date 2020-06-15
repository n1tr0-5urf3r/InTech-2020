#!/usr/bin/python3
# coding=utf-8

import cgi

from tasks_lib import enc_print
from tasks_lib import delete_task, redirect, print_header, print_footer, print_exception_page

try:
    # Zugriff auf die Formulardaten
    form = cgi.FieldStorage(encoding='utf8')
    filename = form.getfirst('timestamp')

    assert filename is not None

    # Task löschen
    delete_task(filename)

    # Weiterleitung auf Übersichtsseite
    redirect("tasks-show.py")

# Rudimentäres Error-Handling ...
except Exception as e:
    print_exception_page("Fehler", "Fehler beim Löschen!", e)
