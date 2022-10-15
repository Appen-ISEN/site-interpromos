/*******************************************************************************
Creation Date:  2022-10-13
Author:         Maxence Laurent <nano0@duck.com>
Author:         Youn Mélois <youn@melois.dev>
Description:    Creates the database tables and relations.
Usage:          psql -U postgres -d interpromos -a -f data.sql
                https://stackoverflow.com/a/23992045/12619942
*******************************************************************************/

DELETE FROM sports;
DELETE FROM users;

-- Populate sports table
ALTER SEQUENCE sports_id_seq RESTART;
INSERT INTO sports ("name") VALUES
('Basket'),
('Hand'),
('Bad'),
('Volley'),
('Futsal');

-- Populate users table
ALTER SEQUENCE users_id_seq RESTART;
INSERT INTO users ("name", "email", "password_hash") VALUES
('Appen', 'appenisen@proton.me', '$2y$10$5xFOYw3o0c5Py.mNpOHSl.WiNdWRvxbNPLEhr.9/wZzo7.LL0OEl6');
