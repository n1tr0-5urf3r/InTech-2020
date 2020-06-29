DROP TABLE IF EXISTS questions;
CREATE TABLE questions (
  id       INT  NOT NULL AUTO_INCREMENT,
  question TEXT NOT NULL, -- Frage
  answer0  TEXT NOT NULL, -- Antwortmöglichkeit 0
  answer1  TEXT NOT NULL, -- Antwortmöglichkeit 1
  answer2  TEXT NOT NULL, -- Antwortmöglichkeit 2
  solution INT  NOT NULL, -- Korrekte Antwort (0, 1 oder 2)
  PRIMARY KEY (id)
);

INSERT INTO questions (question, answer0, answer1, answer2, solution) VALUES
  ("Wie schwer darf ein Golfball maximal sein?", "45,93g", "46,93g", "47,93g", 0),
  ("Wann wurde die Eberhard Karls Universität Tübingen gegründet?", "1476", "1477", "1478", 1),
  ("Was ist Kreiling Mesa?", "Insel", "Asteroid", "Tafelberg", 2),
  ("Was erfand Christel Hamann?", "Rechenmaschinen", "Zahnbürsten", "Autoradios", 0),
  ("Wie heißt der zweitgrößte Ortsteil von Brensbach?", "Nieder-Kainsbach", "Wersau", "Höllerbach", 1),
  ("Welche Linie verkehrt durch den U-Bahnhof Sully – Morland", "Linie 5", "Linie 6", "Linie 7", 2),
  ("Was ist (15550) Sydney?", "Asteroid", "Schiff", "Chemisches Element", 0),
  ("Wer war 1916 Torschützenkönig der Copa América?", "Ángel Romano", "Isabelino Gradín", "Julio Francia", 1),
  ("In welcher Stadt steht das denkmalgeschützte Gebäude 'Haus Weingarten 1'?", "Magdeburg", "Regensburg", "Quedlinburg",
   2),
  ("In welcher walisischen Grafschaft liegt Carew Castle?", "Pembrokeshire", "Monmouthshire", "Carmarthenshire", 0),
  ("Für die Nationalmannschaft welchen Landes spielt der Fußballer Sebastián Gómez?", "Uruguay", "Andorra", "San Marino", 1),
  ("In welcher Disziplin ist Robin Johannes Geueke aktiv?", "Skispringen", "Biathlon", "Rennrodeln",
   2),
  ("In welcher Stadt war Jakob Wortmann (* 31. Januar 1732) Bürgermeister?", "Elberfeld", "Barmen", "Ronsdorf", 0),
  ("Wann regierte der indo-griechische König Apollodotos II.?", "100 bis 85 v. Chr.", "80 bis 65 v. Chr.",
   "60 bis 45 v. Chr.", 1),
  ("Wo liegt das 'Landschaftsschutzgebiet Ortsnahe Freiflächen zwischen Klause und Mosebolle'?", "Arnsberg", "Brilon",
   "Meschede", 2),
  ("Wann wurde das Eisenwerk Franz Weeren aufgelöst?", "November 1983 ", "November 1984", "November 1985", 0),
  ("Wie viele Einwohner besitzt die französische Gemeinde Couture-d’Argenson (Stand 1. Januar 2015)?", "272", "372",
   "472", 1),
  ("In welchem Land wurde der Maler und Grafiker Ferdinand von Wright geboren?", "Schweden", "Norwegen", "Finnland", 2),
  ("Wie viele Meter beträgt die Passhöhe des Col de Vars?", "2108 m", "2208 m", "2308 m", 0),
  ("Welche Frau gewann den  New-York-City-Marathon 2000?", "Margaret Okayo", "Ljudmila Petrowa", "Franca Fiacconi", 1),
  ("Wie heißt der Vater von Gyges (griechisch Γύγης), dem sagenumwobenen König des kleinasiatischen Lydien?", "Alyattes", "Kroisos", "Daskylos", 2);