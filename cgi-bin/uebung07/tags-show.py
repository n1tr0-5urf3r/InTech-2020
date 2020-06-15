#!/usr/bin/python3

# Traceback handler for python
import cgi
import cgitb
from posts_lib import printHead, printErrorPage, readAllPosts, printTags, printPosts

all_posts = readAllPosts()

try:
        # FieldStorage-Instanz erzeugen
        form = cgi.FieldStorage(encoding='utf8')

        # Parameter access
        tag = int(form.getvalue('tag'))

        printHead("#" + tag)
        printPosts(all_posts, tagFilter=tag)

# Error-Handling ...
except: 

    printTags(all_posts)
