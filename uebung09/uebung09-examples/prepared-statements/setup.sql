DROP TABLE IF EXISTS t;

CREATE TABLE t (
  string_column TEXT NOT NULL,
  integer_colum INT  NOT NULL
);

INSERT INTO t
VALUES
  ("Erster String", 98765),
  ("Zweiter String", 87654),
  ("Dritter String", 76543);

