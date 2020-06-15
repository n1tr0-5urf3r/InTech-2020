#!/usr/bin/python3

# Traceback handler for python
import cgi
import cgitb
cgitb.enable()

def printHead(title: String):
        print("""
        Content-type: text/html\n

        <!DOCTYPE html>
        <html lang="de">
        <head>
        <meta charset="utf-8">
        <title>{}}</title>
        </head>
        """).format(title)

    