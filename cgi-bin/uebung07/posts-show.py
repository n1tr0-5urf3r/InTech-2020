#!/usr/bin/python3

# Traceback handler for python
import cgi
import cgitb
from posts_lib import readAllPosts, printHead, printPosts

all_posts = readAllPosts()

# Output
printHead("Mein Blog")
printPosts(all_posts)
