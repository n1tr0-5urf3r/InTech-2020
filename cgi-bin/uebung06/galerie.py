#!/usr/bin/python3

import random

def randomMod3():
    found = False
    while not found:
        rng = random.randint(3,21)
        if rng % 3 == 0:
            found = True # not necessary
            return rng
        
def printHTML():
    amountImgs = randomMod3()
    print("<!DOCTYPE html>")
    print('<html lang="de">')
    print('<head>')
    print('<meta charset="UTF-8">')
    print('<title>CGI Galerie</title>')
    print('<style>')
    print('body {background-color: black;}')
    print('.bilder {column-count: 3;}')
    print('</style>')

    print('<body>')
    print('<div class="bilder">')
    for i in range(amountImgs):
        print('<img src="https://picsum.photos/800/600/?random=' + str(i) +'">')
    print('</div>')
    print('</body>')

printHTML()
