DELETE FROM sports;
DELETE FROM users;

ALTER SEQUENCE sports_id_seq RESTART;
INSERT INTO sports ("name") values
('Basket'),
('Hand'),
('Bad'),
('Volley'),
('Futsal');

-- Populate users table
ALTER SEQUENCE users_id_seq RESTART;
INSERT INTO users ("name", "email", "password_hash") VALUES
('Appen', 'appenisen@proton.me', '$2y$10$5xFOYw3o0c5Py.mNpOHSl.WiNdWRvxbNPLEhr.9/wZzo7.LL0OEl6');
