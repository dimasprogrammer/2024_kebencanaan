<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-01-05 09:26:19 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column u.unit_id does not exist
LINE 1: ...el_akses&quot;, &quot;la&quot;.&quot;level_akses&quot;, &quot;la&quot;.&quot;nick_level&quot;, &quot;u&quot;.&quot;unit_...
                                                             ^ F:\Data\Project_8.1\enggine-php8-ci-postgresql\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-01-05 09:26:19 --> Query error: ERROR:  column u.unit_id does not exist
LINE 1: ...el_akses", "la"."level_akses", "la"."nick_level", "u"."unit_...
                                                             ^ - Invalid query: SELECT "u"."id_users", "u"."token", "u"."username", "u"."email", "u"."fullname", "u"."foto_profile", "up"."id_group", "g"."nama_group", "g"."id_level_akses", "la"."level_akses", "la"."nick_level", "u"."unit_id", "u"."unit_id_name"
FROM "xi_sa_users" "u"
INNER JOIN "xi_sa_users_privileges" "up" ON "u"."id_users" = "up"."id_users"
INNER JOIN "xi_sa_group" "g" ON "up"."id_group" = "g"."id_group"
INNER JOIN "xi_sa_level_akses" "la" ON "g"."id_level_akses" = "la"."id_level_akses"
WHERE "u"."username" = 'yeviki'
AND "u"."id_status" = 1
AND "u"."blokir" = 0
AND "up"."id_status" = 1
AND "g"."id_status" = 1
AND "g"."id_group" = 1
ORDER BY "u"."id_users"
 LIMIT 1
ERROR - 2024-01-05 09:26:21 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column u.unit_id does not exist
LINE 1: ...el_akses&quot;, &quot;la&quot;.&quot;level_akses&quot;, &quot;la&quot;.&quot;nick_level&quot;, &quot;u&quot;.&quot;unit_...
                                                             ^ F:\Data\Project_8.1\enggine-php8-ci-postgresql\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-01-05 09:26:21 --> Query error: ERROR:  column u.unit_id does not exist
LINE 1: ...el_akses", "la"."level_akses", "la"."nick_level", "u"."unit_...
                                                             ^ - Invalid query: SELECT "u"."id_users", "u"."token", "u"."username", "u"."email", "u"."fullname", "u"."foto_profile", "up"."id_group", "g"."nama_group", "g"."id_level_akses", "la"."level_akses", "la"."nick_level", "u"."unit_id", "u"."unit_id_name"
FROM "xi_sa_users" "u"
INNER JOIN "xi_sa_users_privileges" "up" ON "u"."id_users" = "up"."id_users"
INNER JOIN "xi_sa_group" "g" ON "up"."id_group" = "g"."id_group"
INNER JOIN "xi_sa_level_akses" "la" ON "g"."id_level_akses" = "la"."id_level_akses"
WHERE "u"."username" = 'yeviki'
AND "u"."id_status" = 1
AND "u"."blokir" = 0
AND "up"."id_status" = 1
AND "g"."id_status" = 1
AND "g"."id_group" = 1
ORDER BY "u"."id_users"
 LIMIT 1
ERROR - 2024-01-05 09:26:26 --> 404 Page Not Found: /index
ERROR - 2024-01-05 09:26:31 --> 404 Page Not Found: /index
ERROR - 2024-01-05 09:26:36 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column u.unit_id does not exist
LINE 1: ...el_akses&quot;, &quot;la&quot;.&quot;level_akses&quot;, &quot;la&quot;.&quot;nick_level&quot;, &quot;u&quot;.&quot;unit_...
                                                             ^ F:\Data\Project_8.1\enggine-php8-ci-postgresql\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-01-05 09:26:36 --> Query error: ERROR:  column u.unit_id does not exist
LINE 1: ...el_akses", "la"."level_akses", "la"."nick_level", "u"."unit_...
                                                             ^ - Invalid query: SELECT "u"."id_users", "u"."token", "u"."username", "u"."email", "u"."fullname", "u"."foto_profile", "up"."id_group", "g"."nama_group", "g"."id_level_akses", "la"."level_akses", "la"."nick_level", "u"."unit_id", "u"."unit_id_name"
FROM "xi_sa_users" "u"
INNER JOIN "xi_sa_users_privileges" "up" ON "u"."id_users" = "up"."id_users"
INNER JOIN "xi_sa_group" "g" ON "up"."id_group" = "g"."id_group"
INNER JOIN "xi_sa_level_akses" "la" ON "g"."id_level_akses" = "la"."id_level_akses"
WHERE "u"."username" = 'yeviki'
AND "u"."id_status" = 1
AND "u"."blokir" = 0
AND "up"."id_status" = 1
AND "g"."id_status" = 1
AND "g"."id_group" = 1
ORDER BY "u"."id_users"
 LIMIT 1
ERROR - 2024-01-05 09:27:52 --> 404 Page Not Found: /index
ERROR - 2024-01-05 09:28:04 --> 404 Page Not Found: /index
ERROR - 2024-01-05 09:28:09 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column u.unit_id does not exist
LINE 1: ...el_akses&quot;, &quot;la&quot;.&quot;level_akses&quot;, &quot;la&quot;.&quot;nick_level&quot;, &quot;u&quot;.&quot;unit_...
                                                             ^ F:\Data\Project_8.1\enggine-php8-ci-postgresql\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-01-05 09:28:09 --> Query error: ERROR:  column u.unit_id does not exist
LINE 1: ...el_akses", "la"."level_akses", "la"."nick_level", "u"."unit_...
                                                             ^ - Invalid query: SELECT "u"."id_users", "u"."token", "u"."username", "u"."email", "u"."fullname", "u"."foto_profile", "up"."id_group", "g"."nama_group", "g"."id_level_akses", "la"."level_akses", "la"."nick_level", "u"."unit_id", "u"."unit_id_name"
FROM "xi_sa_users" "u"
INNER JOIN "xi_sa_users_privileges" "up" ON "u"."id_users" = "up"."id_users"
INNER JOIN "xi_sa_group" "g" ON "up"."id_group" = "g"."id_group"
INNER JOIN "xi_sa_level_akses" "la" ON "g"."id_level_akses" = "la"."id_level_akses"
WHERE "u"."username" = 'yeviki'
AND "u"."id_status" = 1
AND "u"."blokir" = 0
AND "up"."id_status" = 1
AND "g"."id_status" = 1
AND "g"."id_group" = 1
ORDER BY "u"."id_users"
 LIMIT 1
ERROR - 2024-01-05 09:29:58 --> 404 Page Not Found: /index
ERROR - 2024-01-05 09:30:03 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column u.unit_id does not exist
LINE 1: ...el_akses&quot;, &quot;la&quot;.&quot;level_akses&quot;, &quot;la&quot;.&quot;nick_level&quot;, &quot;u&quot;.&quot;unit_...
                                                             ^ F:\Data\Project_8.1\enggine-php8-ci-postgresql\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-01-05 09:30:03 --> Query error: ERROR:  column u.unit_id does not exist
LINE 1: ...el_akses", "la"."level_akses", "la"."nick_level", "u"."unit_...
                                                             ^ - Invalid query: SELECT "u"."id_users", "u"."token", "u"."username", "u"."email", "u"."fullname", "u"."foto_profile", "up"."id_group", "g"."nama_group", "g"."id_level_akses", "la"."level_akses", "la"."nick_level", "u"."unit_id", "u"."unit_id_name"
FROM "xi_sa_users" "u"
INNER JOIN "xi_sa_users_privileges" "up" ON "u"."id_users" = "up"."id_users"
INNER JOIN "xi_sa_group" "g" ON "up"."id_group" = "g"."id_group"
INNER JOIN "xi_sa_level_akses" "la" ON "g"."id_level_akses" = "la"."id_level_akses"
WHERE "u"."username" = 'yeviki'
AND "u"."id_status" = 1
AND "u"."blokir" = 0
AND "up"."id_status" = 1
AND "g"."id_status" = 1
AND "g"."id_group" = 1
ORDER BY "u"."id_users"
 LIMIT 1
ERROR - 2024-01-05 09:30:07 --> 404 Page Not Found: /index
ERROR - 2024-01-05 09:30:41 --> 404 Page Not Found: /index
ERROR - 2024-01-05 09:30:46 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column u.unit_id does not exist
LINE 1: ...el_akses&quot;, &quot;la&quot;.&quot;level_akses&quot;, &quot;la&quot;.&quot;nick_level&quot;, &quot;u&quot;.&quot;unit_...
                                                             ^ F:\Data\Project_8.1\enggine-php8-ci-postgresql\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-01-05 09:30:46 --> Query error: ERROR:  column u.unit_id does not exist
LINE 1: ...el_akses", "la"."level_akses", "la"."nick_level", "u"."unit_...
                                                             ^ - Invalid query: SELECT "u"."id_users", "u"."token", "u"."username", "u"."email", "u"."fullname", "u"."foto_profile", "up"."id_group", "g"."nama_group", "g"."id_level_akses", "la"."level_akses", "la"."nick_level", "u"."unit_id", "u"."unit_id_name"
FROM "xi_sa_users" "u"
INNER JOIN "xi_sa_users_privileges" "up" ON "u"."id_users" = "up"."id_users"
INNER JOIN "xi_sa_group" "g" ON "up"."id_group" = "g"."id_group"
INNER JOIN "xi_sa_level_akses" "la" ON "g"."id_level_akses" = "la"."id_level_akses"
WHERE "u"."username" = 'yeviki'
AND "u"."id_status" = 1
AND "u"."blokir" = 0
AND "up"."id_status" = 1
AND "g"."id_status" = 1
AND "g"."id_group" = 1
ORDER BY "u"."id_users"
 LIMIT 1
ERROR - 2024-01-05 09:31:16 --> 404 Page Not Found: /index
ERROR - 2024-01-05 09:31:17 --> 404 Page Not Found: /index
ERROR - 2024-01-05 09:31:22 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column u.unit_id does not exist
LINE 1: ...el_akses&quot;, &quot;la&quot;.&quot;level_akses&quot;, &quot;la&quot;.&quot;nick_level&quot;, &quot;u&quot;.&quot;unit_...
                                                             ^ F:\Data\Project_8.1\enggine-php8-ci-postgresql\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-01-05 09:31:22 --> Query error: ERROR:  column u.unit_id does not exist
LINE 1: ...el_akses", "la"."level_akses", "la"."nick_level", "u"."unit_...
                                                             ^ - Invalid query: SELECT "u"."id_users", "u"."token", "u"."username", "u"."email", "u"."fullname", "u"."foto_profile", "up"."id_group", "g"."nama_group", "g"."id_level_akses", "la"."level_akses", "la"."nick_level", "u"."unit_id", "u"."unit_id_name"
FROM "xi_sa_users" "u"
INNER JOIN "xi_sa_users_privileges" "up" ON "u"."id_users" = "up"."id_users"
INNER JOIN "xi_sa_group" "g" ON "up"."id_group" = "g"."id_group"
INNER JOIN "xi_sa_level_akses" "la" ON "g"."id_level_akses" = "la"."id_level_akses"
WHERE "u"."username" = 'yeviki'
AND "u"."id_status" = 1
AND "u"."blokir" = 0
AND "up"."id_status" = 1
AND "g"."id_status" = 1
AND "g"."id_group" = 1
ORDER BY "u"."id_users"
 LIMIT 1
ERROR - 2024-01-05 09:33:37 --> 404 Page Not Found: /index
ERROR - 2024-01-05 09:33:42 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column u.unit_id does not exist
LINE 1: ...el_akses&quot;, &quot;la&quot;.&quot;level_akses&quot;, &quot;la&quot;.&quot;nick_level&quot;, &quot;u&quot;.&quot;unit_...
                                                             ^ F:\Data\Project_8.1\enggine-php8-ci-postgresql\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-01-05 09:33:42 --> Query error: ERROR:  column u.unit_id does not exist
LINE 1: ...el_akses", "la"."level_akses", "la"."nick_level", "u"."unit_...
                                                             ^ - Invalid query: SELECT "u"."id_users", "u"."token", "u"."username", "u"."email", "u"."fullname", "u"."foto_profile", "up"."id_group", "g"."nama_group", "g"."id_level_akses", "la"."level_akses", "la"."nick_level", "u"."unit_id", "u"."unit_id_name"
FROM "xi_sa_users" "u"
INNER JOIN "xi_sa_users_privileges" "up" ON "u"."id_users" = "up"."id_users"
INNER JOIN "xi_sa_group" "g" ON "up"."id_group" = "g"."id_group"
INNER JOIN "xi_sa_level_akses" "la" ON "g"."id_level_akses" = "la"."id_level_akses"
WHERE "u"."username" = 'yeviki'
AND "u"."id_status" = 1
AND "u"."blokir" = 0
AND "up"."id_status" = 1
AND "g"."id_status" = 1
AND "g"."id_group" = 1
ORDER BY "u"."id_users"
 LIMIT 1
ERROR - 2024-01-05 09:37:07 --> 404 Page Not Found: /index
ERROR - 2024-01-05 09:37:31 --> 404 Page Not Found: /index
ERROR - 2024-01-05 09:37:57 --> 404 Page Not Found: /index
ERROR - 2024-01-05 09:37:58 --> 404 Page Not Found: /index
ERROR - 2024-01-05 09:37:59 --> 404 Page Not Found: /index
ERROR - 2024-01-05 09:38:50 --> 404 Page Not Found: /index
ERROR - 2024-01-05 09:39:24 --> 404 Page Not Found: /index
ERROR - 2024-01-05 09:39:51 --> 404 Page Not Found: /index
ERROR - 2024-01-05 09:41:56 --> 404 Page Not Found: /index
ERROR - 2024-01-05 09:41:56 --> 404 Page Not Found: /index
ERROR - 2024-01-05 09:43:43 --> 404 Page Not Found: /index
ERROR - 2024-01-05 09:44:32 --> 404 Page Not Found: /index
ERROR - 2024-01-05 09:45:18 --> 404 Page Not Found: /index
ERROR - 2024-01-05 09:45:20 --> 404 Page Not Found: /index
ERROR - 2024-01-05 09:45:42 --> 404 Page Not Found: /index
ERROR - 2024-01-05 09:45:43 --> 404 Page Not Found: /index
ERROR - 2024-01-05 09:45:50 --> 404 Page Not Found: /index
ERROR - 2024-01-05 09:46:13 --> 404 Page Not Found: /index
ERROR - 2024-01-05 09:47:16 --> 404 Page Not Found: /index
ERROR - 2024-01-05 09:47:17 --> 404 Page Not Found: /index
ERROR - 2024-01-05 09:47:18 --> 404 Page Not Found: /index
ERROR - 2024-01-05 09:47:19 --> 404 Page Not Found: /index
ERROR - 2024-01-05 09:47:19 --> 404 Page Not Found: /index
ERROR - 2024-01-05 09:47:20 --> 404 Page Not Found: /index
ERROR - 2024-01-05 09:47:20 --> 404 Page Not Found: /index
ERROR - 2024-01-05 09:47:32 --> 404 Page Not Found: /index
ERROR - 2024-01-05 09:47:33 --> 404 Page Not Found: /index
ERROR - 2024-01-05 09:47:34 --> 404 Page Not Found: /index
ERROR - 2024-01-05 10:59:40 --> 404 Page Not Found: /index
ERROR - 2024-01-05 10:59:48 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column u.unit_id does not exist
LINE 1: ...el_akses&quot;, &quot;la&quot;.&quot;level_akses&quot;, &quot;la&quot;.&quot;nick_level&quot;, &quot;u&quot;.&quot;unit_...
                                                             ^ F:\Data\Project_8.1\enggine-php8-ci-postgresql\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-01-05 10:59:48 --> Query error: ERROR:  column u.unit_id does not exist
LINE 1: ...el_akses", "la"."level_akses", "la"."nick_level", "u"."unit_...
                                                             ^ - Invalid query: SELECT "u"."id_users", "u"."token", "u"."username", "u"."email", "u"."fullname", "u"."foto_profile", "up"."id_group", "g"."nama_group", "g"."id_level_akses", "la"."level_akses", "la"."nick_level", "u"."unit_id", "u"."unit_id_name"
FROM "xi_sa_users" "u"
INNER JOIN "xi_sa_users_privileges" "up" ON "u"."id_users" = "up"."id_users"
INNER JOIN "xi_sa_group" "g" ON "up"."id_group" = "g"."id_group"
INNER JOIN "xi_sa_level_akses" "la" ON "g"."id_level_akses" = "la"."id_level_akses"
WHERE "u"."username" = 'yeviki'
AND "u"."id_status" = 1
AND "u"."blokir" = 0
AND "up"."id_status" = 1
AND "g"."id_status" = 1
AND "g"."id_group" = 1
ORDER BY "u"."id_users"
 LIMIT 1
ERROR - 2024-01-05 11:00:27 --> 404 Page Not Found: /index
ERROR - 2024-01-05 11:00:31 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column u.unit_id_name does not exist
LINE 1: ...el_akses&quot;, &quot;la&quot;.&quot;level_akses&quot;, &quot;la&quot;.&quot;nick_level&quot;, &quot;u&quot;.&quot;unit_...
                                                             ^ F:\Data\Project_8.1\enggine-php8-ci-postgresql\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-01-05 11:00:31 --> Query error: ERROR:  column u.unit_id_name does not exist
LINE 1: ...el_akses", "la"."level_akses", "la"."nick_level", "u"."unit_...
                                                             ^ - Invalid query: SELECT "u"."id_users", "u"."token", "u"."username", "u"."email", "u"."fullname", "u"."foto_profile", "up"."id_group", "g"."nama_group", "g"."id_level_akses", "la"."level_akses", "la"."nick_level", "u"."unit_id_name"
FROM "xi_sa_users" "u"
INNER JOIN "xi_sa_users_privileges" "up" ON "u"."id_users" = "up"."id_users"
INNER JOIN "xi_sa_group" "g" ON "up"."id_group" = "g"."id_group"
INNER JOIN "xi_sa_level_akses" "la" ON "g"."id_level_akses" = "la"."id_level_akses"
WHERE "u"."username" = 'yeviki'
AND "u"."id_status" = 1
AND "u"."blokir" = 0
AND "up"."id_status" = 1
AND "g"."id_status" = 1
AND "g"."id_group" = 1
ORDER BY "u"."id_users"
 LIMIT 1
ERROR - 2024-01-05 11:02:17 --> 404 Page Not Found: /index
ERROR - 2024-01-05 11:02:22 --> 404 Page Not Found: /index
ERROR - 2024-01-05 11:02:22 --> 404 Page Not Found: /index
ERROR - 2024-01-05 11:03:26 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column &quot;unit_id&quot; does not exist
LINE 1: SELECT &quot;unit_id&quot;, &quot;email&quot;, &quot;fullname&quot;, &quot;foto_profile&quot;
               ^ F:\Data\Project_8.1\enggine-php8-ci-postgresql\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-01-05 11:03:26 --> Query error: ERROR:  column "unit_id" does not exist
LINE 1: SELECT "unit_id", "email", "fullname", "foto_profile"
               ^ - Invalid query: SELECT "unit_id", "email", "fullname", "foto_profile"
FROM "xi_sa_users"
WHERE "username" = 'yeviki'
AND "token" = '4A3729CA5A1593D72E67FF0FE31185D1'
AND "id_status" = 1
AND "blokir" = 0
ERROR - 2024-01-05 11:04:16 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column &quot;unit_id&quot; does not exist
LINE 1: SELECT &quot;unit_id&quot;, &quot;email&quot;, &quot;fullname&quot;, &quot;foto_profile&quot;
               ^ F:\Data\Project_8.1\enggine-php8-ci-postgresql\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-01-05 11:04:16 --> Query error: ERROR:  column "unit_id" does not exist
LINE 1: SELECT "unit_id", "email", "fullname", "foto_profile"
               ^ - Invalid query: SELECT "unit_id", "email", "fullname", "foto_profile"
FROM "xi_sa_users"
WHERE "username" = 'yeviki'
AND "token" = '4A3729CA5A1593D72E67FF0FE31185D1'
AND "id_status" = 1
AND "blokir" = 0
ERROR - 2024-01-05 11:04:17 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column &quot;unit_id&quot; does not exist
LINE 1: SELECT &quot;unit_id&quot;, &quot;email&quot;, &quot;fullname&quot;, &quot;foto_profile&quot;
               ^ F:\Data\Project_8.1\enggine-php8-ci-postgresql\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-01-05 11:04:17 --> Query error: ERROR:  column "unit_id" does not exist
LINE 1: SELECT "unit_id", "email", "fullname", "foto_profile"
               ^ - Invalid query: SELECT "unit_id", "email", "fullname", "foto_profile"
FROM "xi_sa_users"
WHERE "username" = 'yeviki'
AND "token" = '4A3729CA5A1593D72E67FF0FE31185D1'
AND "id_status" = 1
AND "blokir" = 0
ERROR - 2024-01-05 11:04:17 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column &quot;unit_id&quot; does not exist
LINE 1: SELECT &quot;unit_id&quot;, &quot;email&quot;, &quot;fullname&quot;, &quot;foto_profile&quot;
               ^ F:\Data\Project_8.1\enggine-php8-ci-postgresql\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-01-05 11:04:17 --> Query error: ERROR:  column "unit_id" does not exist
LINE 1: SELECT "unit_id", "email", "fullname", "foto_profile"
               ^ - Invalid query: SELECT "unit_id", "email", "fullname", "foto_profile"
FROM "xi_sa_users"
WHERE "username" = 'yeviki'
AND "token" = '4A3729CA5A1593D72E67FF0FE31185D1'
AND "id_status" = 1
AND "blokir" = 0
ERROR - 2024-01-05 11:04:18 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column &quot;unit_id&quot; does not exist
LINE 1: SELECT &quot;unit_id&quot;, &quot;email&quot;, &quot;fullname&quot;, &quot;foto_profile&quot;
               ^ F:\Data\Project_8.1\enggine-php8-ci-postgresql\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-01-05 11:04:18 --> Query error: ERROR:  column "unit_id" does not exist
LINE 1: SELECT "unit_id", "email", "fullname", "foto_profile"
               ^ - Invalid query: SELECT "unit_id", "email", "fullname", "foto_profile"
FROM "xi_sa_users"
WHERE "username" = 'yeviki'
AND "token" = '4A3729CA5A1593D72E67FF0FE31185D1'
AND "id_status" = 1
AND "blokir" = 0
ERROR - 2024-01-05 11:04:18 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column &quot;unit_id&quot; does not exist
LINE 1: SELECT &quot;unit_id&quot;, &quot;email&quot;, &quot;fullname&quot;, &quot;foto_profile&quot;
               ^ F:\Data\Project_8.1\enggine-php8-ci-postgresql\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-01-05 11:04:18 --> Query error: ERROR:  column "unit_id" does not exist
LINE 1: SELECT "unit_id", "email", "fullname", "foto_profile"
               ^ - Invalid query: SELECT "unit_id", "email", "fullname", "foto_profile"
FROM "xi_sa_users"
WHERE "username" = 'yeviki'
AND "token" = '4A3729CA5A1593D72E67FF0FE31185D1'
AND "id_status" = 1
AND "blokir" = 0
ERROR - 2024-01-05 11:04:18 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column &quot;unit_id&quot; does not exist
LINE 1: SELECT &quot;unit_id&quot;, &quot;email&quot;, &quot;fullname&quot;, &quot;foto_profile&quot;
               ^ F:\Data\Project_8.1\enggine-php8-ci-postgresql\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-01-05 11:04:18 --> Query error: ERROR:  column "unit_id" does not exist
LINE 1: SELECT "unit_id", "email", "fullname", "foto_profile"
               ^ - Invalid query: SELECT "unit_id", "email", "fullname", "foto_profile"
FROM "xi_sa_users"
WHERE "username" = 'yeviki'
AND "token" = '4A3729CA5A1593D72E67FF0FE31185D1'
AND "id_status" = 1
AND "blokir" = 0
ERROR - 2024-01-05 11:04:41 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column a.unit_id does not exist
LINE 1: SELECT &quot;a&quot;.&quot;id_users&quot;, &quot;a&quot;.&quot;token&quot;, &quot;a&quot;.&quot;unit_id&quot;, &quot;a&quot;.&quot;user...
                                            ^ F:\Data\Project_8.1\enggine-php8-ci-postgresql\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-01-05 11:04:41 --> Query error: ERROR:  column a.unit_id does not exist
LINE 1: SELECT "a"."id_users", "a"."token", "a"."unit_id", "a"."user...
                                            ^ - Invalid query: SELECT "a"."id_users", "a"."token", "a"."unit_id", "a"."username", "a"."email", "a"."fullname", "a"."foto_profile", "a"."blokir", "a"."id_status", (CASE
                               WHEN d.pass_plain IS NULL THEN '-'
                               ELSE d.pass_plain
                           END) AS pass_plain, string_agg(c.nama_group, ', ') AS group_user
FROM "xi_sa_users" "a"
LEFT JOIN "xi_sa_users_privileges" "b" ON "a"."id_users" = "b"."id_users"
LEFT JOIN "xi_sa_group" "c" ON "b"."id_group" = "c"."id_group"
LEFT JOIN "xi_sa_users_default_pass" "d" ON "a"."id_users" = "d"."id_users"
WHERE "b"."id_status" = 1
GROUP BY "a"."id_users", "d"."pass_plain"
ORDER BY "a"."id_users" ASC
 LIMIT 10
ERROR - 2024-01-05 11:04:44 --> 404 Page Not Found: /index
ERROR - 2024-01-05 11:04:44 --> 404 Page Not Found: /index
ERROR - 2024-01-05 11:04:45 --> 404 Page Not Found: /index
ERROR - 2024-01-05 11:04:45 --> 404 Page Not Found: /index
ERROR - 2024-01-05 11:04:45 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column a.unit_id does not exist
LINE 1: SELECT &quot;a&quot;.&quot;id_users&quot;, &quot;a&quot;.&quot;token&quot;, &quot;a&quot;.&quot;unit_id&quot;, &quot;a&quot;.&quot;user...
                                            ^ F:\Data\Project_8.1\enggine-php8-ci-postgresql\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-01-05 11:04:45 --> Query error: ERROR:  column a.unit_id does not exist
LINE 1: SELECT "a"."id_users", "a"."token", "a"."unit_id", "a"."user...
                                            ^ - Invalid query: SELECT "a"."id_users", "a"."token", "a"."unit_id", "a"."username", "a"."email", "a"."fullname", "a"."foto_profile", "a"."blokir", "a"."id_status", (CASE
                               WHEN d.pass_plain IS NULL THEN '-'
                               ELSE d.pass_plain
                           END) AS pass_plain, string_agg(c.nama_group, ', ') AS group_user
FROM "xi_sa_users" "a"
LEFT JOIN "xi_sa_users_privileges" "b" ON "a"."id_users" = "b"."id_users"
LEFT JOIN "xi_sa_group" "c" ON "b"."id_group" = "c"."id_group"
LEFT JOIN "xi_sa_users_default_pass" "d" ON "a"."id_users" = "d"."id_users"
WHERE "b"."id_status" = 1
GROUP BY "a"."id_users", "d"."pass_plain"
ORDER BY "a"."id_users" ASC
 LIMIT 10
ERROR - 2024-01-05 11:08:09 --> 404 Page Not Found: /index
ERROR - 2024-01-05 11:08:09 --> 404 Page Not Found: /index
ERROR - 2024-01-05 11:08:16 --> 404 Page Not Found: /index
ERROR - 2024-01-05 11:08:16 --> 404 Page Not Found: /index
ERROR - 2024-01-05 11:09:03 --> 404 Page Not Found: /index
ERROR - 2024-01-05 11:09:03 --> 404 Page Not Found: /index
ERROR - 2024-01-05 11:09:08 --> Severity: Warning --> foreach() argument must be of type array|object, null given F:\Data\Project_8.1\enggine-php8-ci-postgresql\application\helpers\asset_helper.php 132
ERROR - 2024-01-05 11:09:08 --> Severity: error --> Exception: array_multisort(): Argument #3 must be an array or a sort flag F:\Data\Project_8.1\enggine-php8-ci-postgresql\application\helpers\asset_helper.php 136
ERROR - 2024-01-05 11:09:14 --> 404 Page Not Found: /index
ERROR - 2024-01-05 11:09:14 --> 404 Page Not Found: /index
ERROR - 2024-01-05 11:09:20 --> 404 Page Not Found: /index
ERROR - 2024-01-05 11:09:20 --> 404 Page Not Found: /index
ERROR - 2024-01-05 11:09:22 --> 404 Page Not Found: /index
ERROR - 2024-01-05 11:09:22 --> 404 Page Not Found: /index
ERROR - 2024-01-05 11:09:28 --> 404 Page Not Found: /index
ERROR - 2024-01-05 11:09:28 --> 404 Page Not Found: /index
ERROR - 2024-01-05 11:09:56 --> 404 Page Not Found: /index
ERROR - 2024-01-05 11:09:57 --> 404 Page Not Found: /index
ERROR - 2024-01-05 11:09:57 --> 404 Page Not Found: /index
ERROR - 2024-01-05 11:10:00 --> 404 Page Not Found: /index
ERROR - 2024-01-05 11:10:00 --> 404 Page Not Found: /index
ERROR - 2024-01-05 11:10:04 --> 404 Page Not Found: /index
ERROR - 2024-01-05 11:10:04 --> 404 Page Not Found: /index
ERROR - 2024-01-05 11:10:48 --> 404 Page Not Found: /index
ERROR - 2024-01-05 11:10:48 --> 404 Page Not Found: /index
ERROR - 2024-01-05 11:10:51 --> 404 Page Not Found: /index
ERROR - 2024-01-05 11:10:51 --> 404 Page Not Found: /index
ERROR - 2024-01-05 11:11:26 --> 404 Page Not Found: /index
ERROR - 2024-01-05 11:11:26 --> 404 Page Not Found: /index
ERROR - 2024-01-05 11:11:33 --> 404 Page Not Found: /index
ERROR - 2024-01-05 11:11:33 --> 404 Page Not Found: /index
ERROR - 2024-01-05 11:21:42 --> 404 Page Not Found: /index
ERROR - 2024-01-05 11:21:42 --> 404 Page Not Found: /index
