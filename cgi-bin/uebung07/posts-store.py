#!/usr/bin/python3

# Traceback handler for python
import cgi
import cgitb
from posts_lib import printHead, create_post, redirect, printErrorPage

cgitb.enable()

try:
    # Access to form data
    form = cgi.FieldStorage(encoding='utf8')
    title = form.getfirst('title')
    content = form.getfirst('content')
    tags = form.getfirst('tags')

    assert title is not None
    assert content is not None
    assert tags is not None

    # Task erstellen und speichern
    create_post(title, content, tags)

    # Weiterleitung auf Übersichtsseite
    redirect("posts-show.py")

# Error-Handling ...
except Exception as e:
    printErrorPage("Fehler", "Fehler beim Hinzufügen!", e)
