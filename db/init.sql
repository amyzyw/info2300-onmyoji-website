--ENTRY--

--create entry table--
CREATE TABLE `entry` (
    `id`    INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    `name`  TEXT NOT NULL,
    `atk` INTEGER NOT NULL,
    `hp` INTEGER NOT NULL,
    `def` INTEGER NOT NULL,
    `spd` INTEGER NOT NULL,
    `rating` REAL NOT NULL,
    `file_name` TEXT NOT NULL,
    `file_ext` TEXT NOT NULL,
    `source` TEXT
);

--insert into entry--
INSERT INTO `entry` (name, atk, hp, def, spd, rating, file_name, file_ext, source) VALUES ('Itsumade', 3270, 10026, 397, 110, 8.3, 'itsumade.png', 'png', 'https://en.onmyojigame.com/shikigami/286.html');
INSERT INTO `entry` (name, atk, hp, def, spd, rating, file_name, file_ext, source) VALUES ('Youko', 3040, 10579, 418, 115, 6.4, 'youko.png', 'png', 'https://en.onmyojigame.com/shikigami/254.html');
INSERT INTO `entry` (name, atk, hp, def, spd, rating, file_name, file_ext, source) VALUES ('Tamamonomae', 3350, 12532, 353, 110, 8.3, 'tamamonomae.png', 'png', 'https://onmyojiguide.com/blazing-tamamonomae/');
INSERT INTO `entry` (name, atk, hp, def, spd, rating, file_name, file_ext, source) VALUES ('Yamausagi', 894, 10709, 432, 115, 9.5, 'yamausagi.png', 'png', 'https://en.onmyojigame.com/shikigami/237.html');
INSERT INTO `entry` (name, atk, hp, def, spd, rating, file_name, file_ext, source) VALUES ('Kaguya', 2332, 13785, 406, 108, 8.6, 'kaguya.png', 'png', 'https://en.onmyojigame.com/shikigami/280.html');
INSERT INTO `entry` (name, atk, hp, def, spd, rating, file_name, file_ext, source) VALUES ('Parasite', 2412, 10254,397, 100, 7.1, 'parasite.png', 'png', 'https://onmyojiguide.com/shikigami-list/parasite-ghost/');
INSERT INTO `entry` (name, atk, hp, def, spd, rating, file_name, file_ext, source) VALUES ('Divine Miketsu', 3002, 12636, 450, 119, 7.9, 'divine-miketsu.png', 'png', 'https://onmyojiguide.com/shikigami-divine-miketsu/');
INSERT INTO `entry` (name, atk, hp, def, spd, rating, file_name, file_ext, source) VALUES ('Enma', 2457, 12253, 456, 127, 6, 'enma.png', 'png', 'https://en.onmyojigame.com/shikigami/255.html');
INSERT INTO `entry` (name, atk, hp, def, spd, rating, file_name, file_ext, source) VALUES ('Zashiki', 2326, 12598, 413, 102, 9.2, 'zashiki.png', 'png', 'https://en.onmyojigame.com/shikigami/205.html');
INSERT INTO `entry` (name, atk, hp, def, spd, rating, file_name, file_ext, source) VALUES ('Latern Boy', 2412, 10254, 397, 100, 5.6, 'latern-boy.png', 'png', 'https://en.onmyojigame.com/shikigami/245.html');
INSERT INTO `entry` (name, atk, hp, def, spd, rating, file_name, file_ext, source) VALUES ('Kusa', 2680, 11393, 441, 103, 8.3, 'kusa.png', 'png', 'https://en.onmyojigame.com/shikigami/238.html');
INSERT INTO `entry` (name, atk, hp, def, spd, rating, file_name, file_ext, source) VALUES ('Ebisu', 2358, 12874, 437, 107, 7, 'ebisu.png', 'png', 'https://en.onmyojigame.com/shikigami/268.html');


--TAGS--

--create tags table--
CREATE TABLE `tags` (
    `id`    INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    `tag_name`  TEXT NOT NULL
);
--insert into tags--
INSERT INTO `tags` (tag_name) VALUES ('AOE');
INSERT INTO `tags` (tag_name) VALUES ('ST');
INSERT INTO `tags` (tag_name) VALUES ('Support');
INSERT INTO `tags` (tag_name) VALUES ('Healer');
INSERT INTO `tags` (tag_name) VALUES ('DPS');
INSERT INTO `tags` (tag_name) VALUES ('CC');
INSERT INTO `tags` (tag_name) VALUES ('Control');
INSERT INTO `tags` (tag_name) VALUES ('SP');
INSERT INTO `tags` (tag_name) VALUES ('SSR');
INSERT INTO `tags` (tag_name) VALUES ('SR');
INSERT INTO `tags` (tag_name) VALUES ('R');
INSERT INTO `tags` (tag_name) VALUES ('N');


--ENTRY_TAGS--

--create entry_tags table--
CREATE TABLE `entry_tags` (
    `id`    INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    `shikimagi_id` INTEGER NOT NULL,
    `tag_id` INTEGER NOT NULL,
    FOREIGN KEY(`shikimagi_id`) REFERENCES entry('id'),
    FOREIGN KEY(`tag_id`) REFERENCES tags('id')
);
--insert into entry_tags--
INSERT INTO `entry_tags` (shikimagi_id, tag_id) VALUES (1, 1);
INSERT INTO `entry_tags` (shikimagi_id, tag_id) VALUES (1, 5);
INSERT INTO `entry_tags` (shikimagi_id, tag_id) VALUES (1, 10);
INSERT INTO `entry_tags` (shikimagi_id, tag_id) VALUES (2, 2);
INSERT INTO `entry_tags` (shikimagi_id, tag_id) VALUES (2, 5);
INSERT INTO `entry_tags` (shikimagi_id, tag_id) VALUES (2, 10);
INSERT INTO `entry_tags` (shikimagi_id, tag_id) VALUES (3, 5);
INSERT INTO `entry_tags` (shikimagi_id, tag_id) VALUES (3, 8);
INSERT INTO `entry_tags` (shikimagi_id, tag_id) VALUES (4, 3);
INSERT INTO `entry_tags` (shikimagi_id, tag_id) VALUES (4, 11);
INSERT INTO `entry_tags` (shikimagi_id, tag_id) VALUES (5, 3);
INSERT INTO `entry_tags` (shikimagi_id, tag_id) VALUES (5, 9);
INSERT INTO `entry_tags` (shikimagi_id, tag_id) VALUES (6, 2);
INSERT INTO `entry_tags` (shikimagi_id, tag_id) VALUES (6, 5);
INSERT INTO `entry_tags` (shikimagi_id, tag_id) VALUES (6, 12);
INSERT INTO `entry_tags` (shikimagi_id, tag_id) VALUES (7, 5);
INSERT INTO `entry_tags` (shikimagi_id, tag_id) VALUES (7, 7);
INSERT INTO `entry_tags` (shikimagi_id, tag_id) VALUES (7, 8);
INSERT INTO `entry_tags` (shikimagi_id, tag_id) VALUES (8, 6);
INSERT INTO `entry_tags` (shikimagi_id, tag_id) VALUES (8, 7);
INSERT INTO `entry_tags` (shikimagi_id, tag_id) VALUES (8, 9);
INSERT INTO `entry_tags` (shikimagi_id, tag_id) VALUES (9, 3);
INSERT INTO `entry_tags` (shikimagi_id, tag_id) VALUES (9, 11);
INSERT INTO `entry_tags` (shikimagi_id, tag_id) VALUES (10, 5);
INSERT INTO `entry_tags` (shikimagi_id, tag_id) VALUES (10, 12);
INSERT INTO `entry_tags` (shikimagi_id, tag_id) VALUES  (11, 4);
INSERT INTO `entry_tags` (shikimagi_id, tag_id) VALUES  (11, 11);
INSERT INTO `entry_tags` (shikimagi_id, tag_id) VALUES  (12, 4);
INSERT INTO `entry_tags` (shikimagi_id, tag_id) VALUES  (12, 10);

--USERS--

--create user table--
CREATE TABLE users (
  id INTEGER NOT NULL UNIQUE,
  name TEXT NOT NULL,
  username TEXT NOT NULL UNIQUE,
  password TEXT NOT NULL,
  PRIMARY KEY(id AUTOINCREMENT)
);

INSERT INTO `users` (id, name, username, password)
VALUES
  (
    1,
    'Kevin',
    'kevin',
    '$2y$10$QtCybkpkzh7x5VN11APHned4J8fu78.eFXlyAMmahuAaNcbwZ7FH.' -- monkey
  );


--SESSIONS--

--create sessions table--
CREATE TABLE sessions (
  id INTEGER NOT NULL UNIQUE,
  user_id INTEGER NOT NULL,
  session TEXT NOT NULL UNIQUE,
  last_login TEXT NOT NULL,
  PRIMARY KEY(id AUTOINCREMENT) FOREIGN KEY(user_id) REFERENCES users(id)
);
