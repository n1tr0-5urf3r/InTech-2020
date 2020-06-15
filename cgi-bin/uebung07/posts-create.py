#!/usr/bin/python3

# Traceback handler for python
import cgi
import cgitb
cgitb.enable()

def buildForms():
    print("Content-type: text/html\n")

    print("""
        <!DOCTYPE html>
        <html lang="de">
        <head>
        <meta charset="utf-8">
        <title>New Post</title>
        </head>
        <body>
        <form action="/posts-store.py" method="POST">
            <label for="title">Title: </label><br>
            <input type="text" id="title" name="title"><br>
            <label for="content">Content:</label><br>
            <input type="text" id="content" name="content">
            <label for="tags">Tags:</label><br>
            <input type="text" id="tags" name="tags">
            <input type="submit" value="Save">
        </form>
        </body>
        </html>
    """)

buildForms()
