#!/usr/bin/python3

# Traceback handler for python
import cgi
import cgitb
from posts_lib import printHead, printErrorPage, readAllPosts, printTags, printPosts

all_posts = readAllPosts()

# FieldStorage-Instanz erzeugen
form = cgi.FieldStorage(encoding='utf8')

# Parameter access
tag = form.getvalue('tag')

if tag is None:
    printHead("Tags")
    print("<h2>Tags</h2>")
    printTags(all_posts)
else:
    printHead("#" + tag)
    print("<h2>#{}</h2>".format(tag))
    printPosts(all_posts, tagFilter=tag)
