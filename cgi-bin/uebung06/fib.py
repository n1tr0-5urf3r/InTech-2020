#!/usr/bin/python3

import cgi

def fib(n):
    if n == 1 or n == 2:
        return 1
    else:
        return fib(n - 1) + fib(n - 2)

def printHTML():
    print("Content-type: text/html\n")
    print("""
    <!DOCTYPE html>
    <html lang="de">
    <head>
        <meta charset="utf-8">
        <title>Fibonacci</title>
    </head>
    <body>
    """)
    try:
        # FieldStorage-Instanz erzeugen
        form = cgi.FieldStorage(encoding='utf8')

        # Parameter access
        n = int(form.getvalue('n'))

        fibN = fib(n)

        print('<h1>Fibonacci</h1>')
        print('Die {}-te Fibonacci Zahl lautet {}'.format(n, fibN))
        
    except:
        print("<h1>Fehler</h1><p>Bei der Abarbeitung ist ein Fehler aufgetreten. Wurde ein Parameter n uebergeben?</p>")

    print("""
    </body>
    </html>
    """)
