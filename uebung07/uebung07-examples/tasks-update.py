#!/usr/bin/python3
# coding=utf-8

import cgi

from tasks_lib import enc_print
from tasks_lib import flip_task_state, read_task, write_task, redirect, print_exception_page

try:
    # Zugriff auf Formulardaten
    form = cgi.FieldStorage(encoding='utf8')
    filename = form.getfirst('timestamp')

    assert filename is not None

    # Zustand des Tasks ändern und speichern
    task = flip_task_state(read_task(filename))
    write_task(filename, task)

    # Weiterleitung auf Übersichtsseite
    redirect("tasks-show.py")

# Rudimentäres Error-Handling ...
except Exception as e:
    print_exception_page("Fehler", "Fehler beim Ändern!", e)
