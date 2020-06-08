#!/usr/bin/python3

import random

to_guess = random.randint(0,99)
won = False
tries = 0

print("*********************************")
print("Willkommen zum lustigen Zahlenraten ...")
print("*********************************")
while not won:
    guess = int(input("Bitte Zahl zwischen 0 und 99 eingeben: "))
    if guess > to_guess:
        print("Die zu erratende Zahl ist kleiner!")
        tries += 1
    elif guess < to_guess:
        print("Die zu erratende Zahl ist groesser!")
        tries += 1
    else:
        print("Glueckwunsch, Zahl erraten. Anzahl Versuche: " + str(tries+1))
        won = True
        