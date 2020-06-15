#!/usr/bin/python3

# Traceback handler for python
import cgi
import cgitb
from posts_lib import printHead, printErrorPage, readAllPosts, printTags

try:
        # FieldStorage-Instanz erzeugen
        form = cgi.FieldStorage(encoding='utf8')

        # Parameter access
        tag = int(form.getvalue('tag'))
        all_posts = readAllPosts()

        printHead("#" + tag)

# Error-Handling ...
except: 
    printTags(all_posts)
