<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-07-09 08:29:15 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column u.email does not exist
LINE 1: ...LECT &quot;u&quot;.&quot;id_users&quot;, &quot;u&quot;.&quot;token&quot;, &quot;u&quot;.&quot;username&quot;, &quot;u&quot;.&quot;email...
                                                             ^ D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-07-09 08:29:15 --> Query error: ERROR:  column u.email does not exist
LINE 1: ...LECT "u"."id_users", "u"."token", "u"."username", "u"."email...
                                                             ^ - Invalid query: SELECT "u"."id_users", "u"."token", "u"."username", "u"."email", "u"."fullname", "u"."foto_profile", "up"."id_group", "g"."nama_group", "g"."id_level_akses", "la"."level_akses", "la"."nick_level"
FROM "xi_sa_users" "u"
INNER JOIN "xi_sa_users_privileges" "up" ON "u"."id_users" = "up"."id_users"
INNER JOIN "xi_sa_group" "g" ON "up"."id_group" = "g"."id_group"
INNER JOIN "xi_sa_level_akses" "la" ON "g"."id_level_akses" = "la"."id_level_akses"
WHERE "u"."username" = 'michael'
AND "u"."id_status" = 1
AND "u"."blokir" = 0
AND "up"."id_status" = 1
AND "g"."id_status" = 1
AND "g"."id_group" = 1
ORDER BY "u"."id_users"
 LIMIT 1
ERROR - 2024-07-09 08:29:43 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column u.email does not exist
LINE 1: ...LECT &quot;u&quot;.&quot;id_users&quot;, &quot;u&quot;.&quot;token&quot;, &quot;u&quot;.&quot;username&quot;, &quot;u&quot;.&quot;email...
                                                             ^ D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-07-09 08:29:43 --> Query error: ERROR:  column u.email does not exist
LINE 1: ...LECT "u"."id_users", "u"."token", "u"."username", "u"."email...
                                                             ^ - Invalid query: SELECT "u"."id_users", "u"."token", "u"."username", "u"."email", "u"."fullname", "u"."foto_profile", "up"."id_group", "g"."nama_group", "g"."id_level_akses", "la"."level_akses", "la"."nick_level"
FROM "xi_sa_users" "u"
INNER JOIN "xi_sa_users_privileges" "up" ON "u"."id_users" = "up"."id_users"
INNER JOIN "xi_sa_group" "g" ON "up"."id_group" = "g"."id_group"
INNER JOIN "xi_sa_level_akses" "la" ON "g"."id_level_akses" = "la"."id_level_akses"
WHERE "u"."username" = 'michael'
AND "u"."id_status" = 1
AND "u"."blokir" = 0
AND "up"."id_status" = 1
AND "g"."id_status" = 1
AND "g"."id_group" = 1
ORDER BY "u"."id_users"
 LIMIT 1
ERROR - 2024-07-09 08:29:46 --> 404 Page Not Found: /index
ERROR - 2024-07-09 08:29:49 --> 404 Page Not Found: /index
ERROR - 2024-07-09 08:29:59 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column u.email does not exist
LINE 1: ...LECT &quot;u&quot;.&quot;id_users&quot;, &quot;u&quot;.&quot;token&quot;, &quot;u&quot;.&quot;username&quot;, &quot;u&quot;.&quot;email...
                                                             ^ D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-07-09 08:29:59 --> Query error: ERROR:  column u.email does not exist
LINE 1: ...LECT "u"."id_users", "u"."token", "u"."username", "u"."email...
                                                             ^ - Invalid query: SELECT "u"."id_users", "u"."token", "u"."username", "u"."email", "u"."fullname", "u"."foto_profile", "up"."id_group", "g"."nama_group", "g"."id_level_akses", "la"."level_akses", "la"."nick_level"
FROM "xi_sa_users" "u"
INNER JOIN "xi_sa_users_privileges" "up" ON "u"."id_users" = "up"."id_users"
INNER JOIN "xi_sa_group" "g" ON "up"."id_group" = "g"."id_group"
INNER JOIN "xi_sa_level_akses" "la" ON "g"."id_level_akses" = "la"."id_level_akses"
WHERE "u"."username" = 'michael'
AND "u"."id_status" = 1
AND "u"."blokir" = 0
AND "up"."id_status" = 1
AND "g"."id_status" = 1
AND "g"."id_group" = 1
ORDER BY "u"."id_users"
 LIMIT 1
ERROR - 2024-07-09 08:30:50 --> 404 Page Not Found: /index
ERROR - 2024-07-09 08:30:55 --> 404 Page Not Found: /index
ERROR - 2024-07-09 08:30:56 --> 404 Page Not Found: /index
ERROR - 2024-07-09 08:31:55 --> 404 Page Not Found: /index
ERROR - 2024-07-09 08:31:55 --> 404 Page Not Found: /index
ERROR - 2024-07-09 08:31:58 --> 404 Page Not Found: /index
ERROR - 2024-07-09 08:31:58 --> 404 Page Not Found: /index
ERROR - 2024-07-09 08:32:23 --> 404 Page Not Found: /index
ERROR - 2024-07-09 08:32:23 --> 404 Page Not Found: /index
ERROR - 2024-07-09 08:32:32 --> 404 Page Not Found: /index
ERROR - 2024-07-09 08:32:33 --> 404 Page Not Found: /index
ERROR - 2024-07-09 08:34:24 --> 404 Page Not Found: /index
ERROR - 2024-07-09 08:34:24 --> 404 Page Not Found: /index
ERROR - 2024-07-09 08:35:04 --> 404 Page Not Found: /index
ERROR - 2024-07-09 08:35:04 --> 404 Page Not Found: /index
ERROR - 2024-07-09 08:35:42 --> 404 Page Not Found: /index
ERROR - 2024-07-09 08:35:42 --> 404 Page Not Found: /index
ERROR - 2024-07-09 08:36:03 --> 404 Page Not Found: /index
ERROR - 2024-07-09 08:36:03 --> 404 Page Not Found: /index
ERROR - 2024-07-09 08:36:23 --> 404 Page Not Found: /index
ERROR - 2024-07-09 08:36:23 --> 404 Page Not Found: /index
ERROR - 2024-07-09 08:38:21 --> 404 Page Not Found: /index
ERROR - 2024-07-09 08:38:21 --> 404 Page Not Found: /index
ERROR - 2024-07-09 08:40:24 --> 404 Page Not Found: /index
ERROR - 2024-07-09 08:40:24 --> 404 Page Not Found: /index
ERROR - 2024-07-09 08:43:09 --> 404 Page Not Found: /index
ERROR - 2024-07-09 08:43:09 --> 404 Page Not Found: /index
ERROR - 2024-07-09 08:43:24 --> 404 Page Not Found: /index
ERROR - 2024-07-09 08:43:24 --> 404 Page Not Found: /index
ERROR - 2024-07-09 08:44:18 --> 404 Page Not Found: /index
ERROR - 2024-07-09 08:44:20 --> 404 Page Not Found: /index
ERROR - 2024-07-09 08:44:35 --> 404 Page Not Found: /index
ERROR - 2024-07-09 08:44:35 --> 404 Page Not Found: /index
ERROR - 2024-07-09 08:45:00 --> 404 Page Not Found: /index
ERROR - 2024-07-09 08:45:00 --> 404 Page Not Found: /index
ERROR - 2024-07-09 08:45:45 --> 404 Page Not Found: /index
ERROR - 2024-07-09 08:45:46 --> 404 Page Not Found: /index
ERROR - 2024-07-09 08:45:59 --> 404 Page Not Found: /index
ERROR - 2024-07-09 08:45:59 --> 404 Page Not Found: /index
ERROR - 2024-07-09 08:46:36 --> 404 Page Not Found: /index
ERROR - 2024-07-09 08:46:36 --> 404 Page Not Found: /index
ERROR - 2024-07-09 08:47:06 --> 404 Page Not Found: /index
ERROR - 2024-07-09 08:47:06 --> 404 Page Not Found: /index
ERROR - 2024-07-09 08:47:44 --> 404 Page Not Found: /index
ERROR - 2024-07-09 08:47:45 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:15:26 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:15:26 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:16:59 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:16:59 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:17:25 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:17:25 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:18:10 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:18:11 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:18:52 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:18:53 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:19:10 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:19:10 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:19:19 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:19:20 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:19:43 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:19:44 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:21:49 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:21:49 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:22:05 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:22:06 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:23:11 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:23:11 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:24:26 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:24:26 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:24:56 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:24:57 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:25:56 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:25:56 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:26:07 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:26:07 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:27:20 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:27:20 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:28:52 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:28:52 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:29:22 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:29:22 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:29:51 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:29:51 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:30:21 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:30:22 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:31:33 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:31:33 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:31:34 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:31:34 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:32:15 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:32:15 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:32:34 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:32:34 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:32:52 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:32:53 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:33:44 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:33:44 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:34:15 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:34:15 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:34:35 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:34:35 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:35:30 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:35:30 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:37:13 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:37:14 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:37:58 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:37:58 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:40:21 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:40:21 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:40:23 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column a.id_instansi does not exist
LINE 5: ...OIN &quot;cx_instansi_prov&quot; &quot;d&quot; ON &quot;d&quot;.&quot;id_instansi&quot; = &quot;a&quot;.&quot;id_in...
                                                             ^
HINT:  Perhaps you meant to reference the column &quot;c.id_instansi&quot; or the column &quot;d.id_instansi&quot;. D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-07-09 09:40:23 --> Query error: ERROR:  column a.id_instansi does not exist
LINE 5: ...OIN "cx_instansi_prov" "d" ON "d"."id_instansi" = "a"."id_in...
                                                             ^
HINT:  Perhaps you meant to reference the column "c.id_instansi" or the column "d.id_instansi". - Invalid query: SELECT "a"."id_bencana_detail", "a"."token_bencana", "a"."token_bencana_detail", "a"."id_users_penerima", "c"."fullname"
FROM "ms_bencana_detail" "a"
INNER JOIN "ms_bencana" "b" ON "b"."token_bencana" = "a"."token_bencana"
INNER JOIN "xi_sa_users" "c" ON "c"."id_users" = "a"."id_users_penerima"
INNER JOIN "cx_instansi_prov" "d" ON "d"."id_instansi" = "a"."id_instansi"
INNER JOIN "wil_regency" "e" ON "e"."id_regency" = "a"."id_regency"
WHERE "a"."token_bencana" = '80FEECC314F646F3B4F10DD4C8B71065'
ERROR - 2024-07-09 09:40:56 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:40:56 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:40:58 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column a.id_instansi does not exist
LINE 5: ...OIN &quot;cx_instansi_prov&quot; &quot;d&quot; ON &quot;d&quot;.&quot;id_instansi&quot; = &quot;a&quot;.&quot;id_in...
                                                             ^
HINT:  Perhaps you meant to reference the column &quot;c.id_instansi&quot; or the column &quot;d.id_instansi&quot;. D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-07-09 09:40:58 --> Query error: ERROR:  column a.id_instansi does not exist
LINE 5: ...OIN "cx_instansi_prov" "d" ON "d"."id_instansi" = "a"."id_in...
                                                             ^
HINT:  Perhaps you meant to reference the column "c.id_instansi" or the column "d.id_instansi". - Invalid query: SELECT "a"."id_bencana_detail", "a"."token_bencana", "a"."token_bencana_detail", "a"."id_users_penerima", "c"."fullname"
FROM "ms_bencana_detail" "a"
INNER JOIN "ms_bencana" "b" ON "b"."token_bencana" = "a"."token_bencana"
INNER JOIN "xi_sa_users" "c" ON "c"."id_users" = "a"."id_users_penerima"
INNER JOIN "cx_instansi_prov" "d" ON "d"."id_instansi" = "a"."id_instansi"
INNER JOIN "wil_regency" "e" ON "e"."id_regency" = "a"."id_regency"
WHERE "a"."token_bencana" = '80FEECC314F646F3B4F10DD4C8B71065'
ERROR - 2024-07-09 09:41:40 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:41:40 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:42:00 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:42:00 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:42:18 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:42:18 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:42:28 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:42:28 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:42:36 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:42:36 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:43:29 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:43:29 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:43:39 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:43:39 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:44:17 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:44:18 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:46:29 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:46:29 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:46:46 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:46:46 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:48:52 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:48:52 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:49:52 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:49:52 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:49:54 --> Severity: Warning --> pg_query(): Query failed: ERROR:  function strtolower(character varying) does not exist
LINE 1: ...detail&quot;, &quot;a&quot;.&quot;id_users_penerima&quot;, &quot;c&quot;.&quot;fullname&quot;, strtolower...
                                                             ^
HINT:  No function matches the given name and argument types. You might need to add explicit type casts. D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-07-09 09:49:54 --> Query error: ERROR:  function strtolower(character varying) does not exist
LINE 1: ...detail", "a"."id_users_penerima", "c"."fullname", strtolower...
                                                             ^
HINT:  No function matches the given name and argument types. You might need to add explicit type casts. - Invalid query: SELECT "a"."id_bencana_detail", "a"."token_bencana", "a"."token_bencana_detail", "a"."id_users_penerima", "c"."fullname", strtolower(d.nm_instansi), "e"."nm_regency"
FROM "ms_bencana_detail" "a"
INNER JOIN "ms_bencana" "b" ON "b"."token_bencana" = "a"."token_bencana"
INNER JOIN "xi_sa_users" "c" ON "c"."id_users" = "a"."id_users_penerima"
INNER JOIN "cx_instansi_prov" "d" ON "d"."id_instansi" = "c"."id_instansi"
INNER JOIN "wil_regency" "e" ON "e"."id_regency" = "c"."id_regency"
WHERE "a"."token_bencana" = 'C341A245BD184AB4BB7BCD6256F52F16'
ERROR - 2024-07-09 09:50:15 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:50:15 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:50:56 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:50:58 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:53:13 --> 404 Page Not Found: /index
ERROR - 2024-07-09 09:53:13 --> 404 Page Not Found: /index
ERROR - 2024-07-09 11:36:59 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column a.id_bencana_detail does not exist
LINE 1: SELECT &quot;a&quot;.&quot;id_bencana_detail&quot;, &quot;a&quot;.&quot;token_bencana&quot;, &quot;a&quot;.&quot;to...
               ^ D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-07-09 11:36:59 --> Query error: ERROR:  column a.id_bencana_detail does not exist
LINE 1: SELECT "a"."id_bencana_detail", "a"."token_bencana", "a"."to...
               ^ - Invalid query: SELECT "a"."id_bencana_detail", "a"."token_bencana", "a"."token_bencana_share", "a"."id_users_penerima", "c"."fullname", "d"."nm_instansi", "e"."nm_regency"
FROM "ms_bencana_share" "a"
INNER JOIN "ms_bencana" "b" ON "b"."token_bencana" = "a"."token_bencana"
INNER JOIN "xi_sa_users" "c" ON "c"."id_users" = "a"."id_users_penerima"
INNER JOIN "cx_instansi_prov" "d" ON "d"."id_instansi" = "c"."id_instansi"
INNER JOIN "wil_regency" "e" ON "e"."id_regency" = "c"."id_regency"
WHERE "a"."token_bencana" = '80FEECC314F646F3B4F10DD4C8B71065'
ERROR - 2024-07-09 12:25:16 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column a.id_bencana_detail does not exist
LINE 1: SELECT &quot;a&quot;.&quot;id_bencana_detail&quot;, &quot;a&quot;.&quot;token_bencana&quot;, &quot;a&quot;.&quot;to...
               ^ D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-07-09 12:25:16 --> Query error: ERROR:  column a.id_bencana_detail does not exist
LINE 1: SELECT "a"."id_bencana_detail", "a"."token_bencana", "a"."to...
               ^ - Invalid query: SELECT "a"."id_bencana_detail", "a"."token_bencana", "a"."token_bencana_share", "a"."id_users_penerima", "c"."fullname", "d"."nm_instansi", "e"."nm_regency"
FROM "ms_bencana_share" "a"
INNER JOIN "ms_bencana" "b" ON "b"."token_bencana" = "a"."token_bencana"
INNER JOIN "xi_sa_users" "c" ON "c"."id_users" = "a"."id_users_penerima"
INNER JOIN "cx_instansi_prov" "d" ON "d"."id_instansi" = "c"."id_instansi"
INNER JOIN "wil_regency" "e" ON "e"."id_regency" = "c"."id_regency"
WHERE "a"."token_bencana" = '80FEECC314F646F3B4F10DD4C8B71065'
ERROR - 2024-07-09 12:25:30 --> 404 Page Not Found: /index
ERROR - 2024-07-09 12:25:31 --> 404 Page Not Found: /index
ERROR - 2024-07-09 12:25:36 --> 404 Page Not Found: /index
ERROR - 2024-07-09 12:25:39 --> 404 Page Not Found: /index
ERROR - 2024-07-09 12:25:41 --> 404 Page Not Found: /index
ERROR - 2024-07-09 12:25:41 --> 404 Page Not Found: /index
ERROR - 2024-07-09 12:25:45 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column a.id_bencana_detail does not exist
LINE 1: SELECT &quot;a&quot;.&quot;id_bencana_detail&quot;, &quot;a&quot;.&quot;token_bencana&quot;, &quot;a&quot;.&quot;to...
               ^ D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-07-09 12:25:45 --> Query error: ERROR:  column a.id_bencana_detail does not exist
LINE 1: SELECT "a"."id_bencana_detail", "a"."token_bencana", "a"."to...
               ^ - Invalid query: SELECT "a"."id_bencana_detail", "a"."token_bencana", "a"."token_bencana_share", "a"."id_users_penerima", "c"."fullname", "d"."nm_instansi", "e"."nm_regency"
FROM "ms_bencana_share" "a"
INNER JOIN "ms_bencana" "b" ON "b"."token_bencana" = "a"."token_bencana"
INNER JOIN "xi_sa_users" "c" ON "c"."id_users" = "a"."id_users_penerima"
INNER JOIN "cx_instansi_prov" "d" ON "d"."id_instansi" = "c"."id_instansi"
INNER JOIN "wil_regency" "e" ON "e"."id_regency" = "c"."id_regency"
WHERE "a"."token_bencana" = '80FEECC314F646F3B4F10DD4C8B71065'
ERROR - 2024-07-09 12:26:41 --> 404 Page Not Found: /index
ERROR - 2024-07-09 12:26:44 --> 404 Page Not Found: /index
ERROR - 2024-07-09 12:35:45 --> 404 Page Not Found: /index
ERROR - 2024-07-09 12:35:45 --> 404 Page Not Found: /index
ERROR - 2024-07-09 12:35:49 --> 404 Page Not Found: /index
ERROR - 2024-07-09 12:35:49 --> 404 Page Not Found: /index
ERROR - 2024-07-09 12:36:27 --> 404 Page Not Found: /index
ERROR - 2024-07-09 12:36:27 --> 404 Page Not Found: /index
ERROR - 2024-07-09 12:39:23 --> 404 Page Not Found: /index
ERROR - 2024-07-09 12:39:23 --> 404 Page Not Found: /index
ERROR - 2024-07-09 12:40:30 --> 404 Page Not Found: /index
ERROR - 2024-07-09 12:40:30 --> 404 Page Not Found: /index
ERROR - 2024-07-09 12:40:33 --> 404 Page Not Found: /index
ERROR - 2024-07-09 12:40:33 --> 404 Page Not Found: /index
ERROR - 2024-07-09 12:41:12 --> 404 Page Not Found: /index
ERROR - 2024-07-09 12:41:12 --> 404 Page Not Found: /index
ERROR - 2024-07-09 12:41:26 --> 404 Page Not Found: /index
ERROR - 2024-07-09 12:41:26 --> 404 Page Not Found: /index
ERROR - 2024-07-09 12:41:39 --> 404 Page Not Found: /index
ERROR - 2024-07-09 12:41:39 --> 404 Page Not Found: /index
ERROR - 2024-07-09 13:00:02 --> 404 Page Not Found: /index
ERROR - 2024-07-09 13:00:03 --> 404 Page Not Found: /index
ERROR - 2024-07-09 13:06:38 --> 404 Page Not Found: ../modules/manajemen_data/controllers/Bencana/details
ERROR - 2024-07-09 13:08:39 --> 404 Page Not Found: ../modules/manajemen_data/controllers/Bencana/details
ERROR - 2024-07-09 13:08:43 --> 404 Page Not Found: /index
ERROR - 2024-07-09 13:08:43 --> 404 Page Not Found: /index
ERROR - 2024-07-09 13:08:46 --> 404 Page Not Found: /index
ERROR - 2024-07-09 13:08:46 --> 404 Page Not Found: /index
ERROR - 2024-07-09 13:08:49 --> 404 Page Not Found: ../modules/manajemen_data/controllers/Bencana/details
ERROR - 2024-07-09 13:09:05 --> 404 Page Not Found: /index
ERROR - 2024-07-09 13:09:05 --> 404 Page Not Found: /index
ERROR - 2024-07-09 13:10:15 --> 404 Page Not Found: /index
ERROR - 2024-07-09 13:10:15 --> 404 Page Not Found: /index
ERROR - 2024-07-09 13:10:49 --> 404 Page Not Found: /index
ERROR - 2024-07-09 13:10:49 --> 404 Page Not Found: /index
ERROR - 2024-07-09 13:11:02 --> 404 Page Not Found: /index
ERROR - 2024-07-09 13:11:02 --> 404 Page Not Found: /index
ERROR - 2024-07-09 13:11:44 --> 404 Page Not Found: /index
ERROR - 2024-07-09 13:11:44 --> 404 Page Not Found: /index
ERROR - 2024-07-09 13:11:48 --> Severity: error --> Exception: Call to undefined method Model_bencana::getDataBencanaDetail() D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\modules\manajemen_data\controllers\Bencana.php 169
ERROR - 2024-07-09 13:31:15 --> Severity: error --> Exception: Call to undefined method Model_bencana::getDataBencanaDetail() D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\modules\manajemen_data\controllers\Bencana.php 169
ERROR - 2024-07-09 14:01:49 --> Severity: error --> Exception: Call to undefined method Model_bencana::getDataBencanaDetail() D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\modules\manajemen_data\controllers\Bencana.php 169
ERROR - 2024-07-09 14:03:28 --> Severity: error --> Exception: Call to undefined method Model_bencana::getDataBencanaDetail() D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\modules\manajemen_data\controllers\Bencana.php 169
ERROR - 2024-07-09 14:05:07 --> Severity: error --> Exception: Call to undefined method Model_bencana::getDataBencanaDetail() D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\modules\manajemen_data\controllers\Bencana.php 169
ERROR - 2024-07-09 14:06:08 --> Severity: error --> Exception: Call to undefined method Model_bencana::getDataBencanaDetail() D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\modules\manajemen_data\controllers\Bencana.php 169
ERROR - 2024-07-09 14:06:46 --> 404 Page Not Found: /index
ERROR - 2024-07-09 14:06:46 --> 404 Page Not Found: /index
ERROR - 2024-07-09 14:06:50 --> 404 Page Not Found: /index
ERROR - 2024-07-09 14:06:50 --> 404 Page Not Found: /index
ERROR - 2024-07-09 14:06:56 --> Severity: error --> Exception: Call to undefined method Model_bencana::getDataBencanaDetail() D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\modules\manajemen_data\controllers\Bencana.php 169
ERROR - 2024-07-09 14:07:14 --> 404 Page Not Found: /index
ERROR - 2024-07-09 14:07:14 --> 404 Page Not Found: /index
ERROR - 2024-07-09 14:09:36 --> 404 Page Not Found: /index
ERROR - 2024-07-09 14:09:37 --> 404 Page Not Found: /index
ERROR - 2024-07-09 14:09:38 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column a.id_bencana_detail does not exist
LINE 1: SELECT &quot;a&quot;.&quot;id_bencana_detail&quot;, &quot;a&quot;.&quot;token_bencana&quot;, &quot;a&quot;.&quot;to...
               ^ D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-07-09 14:09:38 --> Query error: ERROR:  column a.id_bencana_detail does not exist
LINE 1: SELECT "a"."id_bencana_detail", "a"."token_bencana", "a"."to...
               ^ - Invalid query: SELECT "a"."id_bencana_detail", "a"."token_bencana", "a"."token_bencana_share", "a"."id_users_penerima"
FROM "ms_bencana_share" "a"
INNER JOIN "ms_bencana" "b" ON "b"."token_bencana" = "a"."token_bencana"
WHERE "a"."token_bencana_share" = 'C341A245BD184AB4BB7BCD6256F52F16'
ERROR - 2024-07-09 14:10:08 --> 404 Page Not Found: /index
ERROR - 2024-07-09 14:10:08 --> 404 Page Not Found: /index
ERROR - 2024-07-09 14:10:10 --> Severity: error --> Exception: Call to undefined method Model_bencana::getDataBencanaShare() D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\modules\manajemen_data\controllers\Bencana.php 124
ERROR - 2024-07-09 14:10:17 --> 404 Page Not Found: /index
ERROR - 2024-07-09 14:10:17 --> 404 Page Not Found: /index
ERROR - 2024-07-09 14:10:18 --> Severity: error --> Exception: Call to undefined method Model_bencana::getDataBencanaShare() D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\modules\manajemen_data\controllers\Bencana.php 124
ERROR - 2024-07-09 14:10:38 --> 404 Page Not Found: /index
ERROR - 2024-07-09 14:10:38 --> 404 Page Not Found: /index
ERROR - 2024-07-09 14:10:39 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column a.id_bencana_detail does not exist
LINE 1: SELECT &quot;a&quot;.&quot;id_bencana_detail&quot;, &quot;a&quot;.&quot;token_bencana&quot;, &quot;a&quot;.&quot;to...
               ^ D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-07-09 14:10:39 --> Query error: ERROR:  column a.id_bencana_detail does not exist
LINE 1: SELECT "a"."id_bencana_detail", "a"."token_bencana", "a"."to...
               ^ - Invalid query: SELECT "a"."id_bencana_detail", "a"."token_bencana", "a"."token_bencana_share", "a"."id_users_penerima", "c"."fullname", "d"."nm_instansi", "e"."nm_regency"
FROM "ms_bencana_share" "a"
INNER JOIN "ms_bencana" "b" ON "b"."token_bencana" = "a"."token_bencana"
INNER JOIN "xi_sa_users" "c" ON "c"."id_users" = "a"."id_users_penerima"
INNER JOIN "cx_instansi_prov" "d" ON "d"."id_instansi" = "c"."id_instansi"
INNER JOIN "wil_regency" "e" ON "e"."id_regency" = "c"."id_regency"
WHERE "a"."token_bencana" = '80FEECC314F646F3B4F10DD4C8B71065'
ERROR - 2024-07-09 14:10:59 --> 404 Page Not Found: /index
ERROR - 2024-07-09 14:11:00 --> 404 Page Not Found: /index
ERROR - 2024-07-09 14:11:01 --> Severity: error --> Exception: Call to undefined method Model_bencana::getDataBencanaShare() D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\modules\manajemen_data\controllers\Bencana.php 124
ERROR - 2024-07-09 14:11:13 --> 404 Page Not Found: /index
ERROR - 2024-07-09 14:11:13 --> 404 Page Not Found: /index
ERROR - 2024-07-09 14:11:14 --> Severity: error --> Exception: Call to undefined method Model_bencana::getDataBencanaShare() D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\modules\manajemen_data\controllers\Bencana.php 124
ERROR - 2024-07-09 14:11:30 --> 404 Page Not Found: /index
ERROR - 2024-07-09 14:11:31 --> 404 Page Not Found: /index
ERROR - 2024-07-09 14:11:32 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column a.id_bencana_detail does not exist
LINE 1: SELECT &quot;a&quot;.&quot;id_bencana_detail&quot;, &quot;a&quot;.&quot;token_bencana&quot;, &quot;a&quot;.&quot;to...
               ^ D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-07-09 14:11:32 --> Query error: ERROR:  column a.id_bencana_detail does not exist
LINE 1: SELECT "a"."id_bencana_detail", "a"."token_bencana", "a"."to...
               ^ - Invalid query: SELECT "a"."id_bencana_detail", "a"."token_bencana", "a"."token_bencana_share", "a"."id_users_penerima", "c"."fullname", "d"."nm_instansi", "e"."nm_regency"
FROM "ms_bencana_share" "a"
INNER JOIN "ms_bencana" "b" ON "b"."token_bencana" = "a"."token_bencana"
INNER JOIN "xi_sa_users" "c" ON "c"."id_users" = "a"."id_users_penerima"
INNER JOIN "cx_instansi_prov" "d" ON "d"."id_instansi" = "c"."id_instansi"
INNER JOIN "wil_regency" "e" ON "e"."id_regency" = "c"."id_regency"
WHERE "a"."token_bencana" = 'C341A245BD184AB4BB7BCD6256F52F16'
ERROR - 2024-07-09 14:11:49 --> 404 Page Not Found: /index
ERROR - 2024-07-09 14:11:49 --> 404 Page Not Found: /index
ERROR - 2024-07-09 14:12:16 --> 404 Page Not Found: /index
ERROR - 2024-07-09 14:12:16 --> 404 Page Not Found: /index
ERROR - 2024-07-09 14:12:20 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column a.id_bencana_detail does not exist
LINE 1: SELECT &quot;a&quot;.&quot;id_bencana_detail&quot;, &quot;a&quot;.&quot;token_bencana&quot;, &quot;a&quot;.&quot;to...
               ^ D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-07-09 14:12:20 --> Query error: ERROR:  column a.id_bencana_detail does not exist
LINE 1: SELECT "a"."id_bencana_detail", "a"."token_bencana", "a"."to...
               ^ - Invalid query: SELECT "a"."id_bencana_detail", "a"."token_bencana", "a"."token_bencana_share", "a"."id_users_penerima"
FROM "ms_bencana_share" "a"
INNER JOIN "ms_bencana" "b" ON "b"."token_bencana" = "a"."token_bencana"
WHERE "a"."token_bencana_share" = '6AC47A6E196545DCA4B2BD9C1E16CF9D'
ERROR - 2024-07-09 14:12:34 --> 404 Page Not Found: /index
ERROR - 2024-07-09 14:12:34 --> 404 Page Not Found: /index
