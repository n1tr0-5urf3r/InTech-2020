#!/usr/bin/python3
# coding=utf-8

import cgi

from tasks_lib import enc_print
from tasks_lib import create_task, write_task, redirect, print_exception_page

try:
    # Zugriff auf Formulardaten
    form = cgi.FieldStorage(encoding='utf8')
    title = form.getfirst('title')

    assert title is not None

    # Task erstellen und speichern
    task = create_task(title)
    write_task(task["timestamp"], task)

    # Weiterleitung auf Übersichtsseite
    redirect("tasks-show.py")


# Rudimentäres Error-Handling ...
except Exception as e:
    print_exception_page("Fehler", "Fehler beim Hinzufügen!", e)
