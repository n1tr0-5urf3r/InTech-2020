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

        if tag is None:
            # display all tags
            pass
        else:
            printHead("#" + tag)
            printTags(all_posts)


# Error-Handling ...
except Exception as e:
    printErrorPage("Fehler", "Fehler beim Hinzufügen!", e)

