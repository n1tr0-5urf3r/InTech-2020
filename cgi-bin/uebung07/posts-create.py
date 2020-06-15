#!/usr/bin/python3

# Traceback handler for python
import cgi
import cgitb
from posts_lib import printHead

cgitb.enable()

def buildForms():
        printHead("New Post")

        print("""
        <body>
        <form action="posts-store.py" method="POST">
            <label for="title">Title: </label><br>
            <input type="text" id="title" name="title"><br>
            <label for="content">Content:</label><br>
            <textarea cols="40" rows="5" name="content"></textarea><br>
            <label for="tags">Tags:</label><br>
            <input type="text" id="tags" name="tags">
            <input type="submit" value="Save">
        </form>
        </body>
        </html>
    """)
    #TODO text area field

buildForms()
