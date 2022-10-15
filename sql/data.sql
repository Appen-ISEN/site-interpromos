DELETE FROM sports;

ALTER SEQUENCE sports_id_seq RESTART;
INSERT INTO sports ("name") values
('Basket'),
('Hand'),
('Bad'),
('Volley'),
('Futsal');