<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-07-01 15:10:08 --> Severity: Warning --> pg_query(): Query failed: ERROR:  relation &quot;ms_inovasi&quot; does not exist
LINE 2: FROM &quot;ms_inovasi&quot; &quot;a&quot;
             ^ D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-07-01 15:10:08 --> Query error: ERROR:  relation "ms_inovasi" does not exist
LINE 2: FROM "ms_inovasi" "a"
             ^ - Invalid query: SELECT count(a.id_inovasi) as total_inovasi
FROM "ms_inovasi" "a"
INNER JOIN "xi_sa_users" "b" ON "a"."create_by" = "b"."token"
ERROR - 2024-07-01 15:45:24 --> Severity: Warning --> pg_query(): Query failed: ERROR:  relation &quot;ms_inovasi&quot; does not exist
LINE 2: FROM &quot;ms_inovasi&quot; &quot;a&quot;
             ^ D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-07-01 15:45:24 --> Query error: ERROR:  relation "ms_inovasi" does not exist
LINE 2: FROM "ms_inovasi" "a"
             ^ - Invalid query: SELECT count(a.id_inovasi) as total_inovasi
FROM "ms_inovasi" "a"
INNER JOIN "xi_sa_users" "b" ON "a"."create_by" = "b"."token"
ERROR - 2024-07-01 15:59:18 --> Severity: Warning --> pg_query(): Query failed: ERROR:  relation &quot;xi_sa_kontrol&quot; does not exist
LINE 5: INNER JOIN &quot;xi_sa_kontrol&quot; &quot;d&quot; ON &quot;b&quot;.&quot;id_kontrol&quot; = &quot;d&quot;.&quot;id...
                   ^ D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-07-01 15:59:18 --> Query error: ERROR:  relation "xi_sa_kontrol" does not exist
LINE 5: INNER JOIN "xi_sa_kontrol" "d" ON "b"."id_kontrol" = "d"."id...
                   ^ - Invalid query: SELECT "a"."id_rules", "b"."id_module", "b"."id_kontrol", "b"."id_fungsi", "c"."nama_module", "c"."url_module", "d"."nama_kontrol", "d"."url_kontrol", "e"."nama_fungsi", "e"."url_fungsi"
FROM "xi_sa_group_privileges" "a"
INNER JOIN "xi_sa_rules" "b" ON "a"."id_rules" = "b"."id_rules"
INNER JOIN "xi_sa_module" "c" ON "b"."id_module" = "c"."id_module"
INNER JOIN "xi_sa_kontrol" "d" ON "b"."id_kontrol" = "d"."id_kontrol"
INNER JOIN "xi_sa_fungsi" "e" ON "b"."id_fungsi" = "e"."id_fungsi"
WHERE "a"."id_group" = 1
AND "a"."id_status" = 1
AND "b"."id_status" = 1
AND "c"."id_status" = 1
AND "d"."id_status" = 1
AND "e"."id_status" = 1
ORDER BY "b"."id_rules" ASC
ERROR - 2024-07-01 16:00:10 --> Severity: Warning --> pg_query(): Query failed: ERROR:  relation &quot;xi_sa_kontrol&quot; does not exist
LINE 5: INNER JOIN &quot;xi_sa_kontrol&quot; &quot;d&quot; ON &quot;b&quot;.&quot;id_kontrol&quot; = &quot;d&quot;.&quot;id...
                   ^ D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-07-01 16:00:10 --> Query error: ERROR:  relation "xi_sa_kontrol" does not exist
LINE 5: INNER JOIN "xi_sa_kontrol" "d" ON "b"."id_kontrol" = "d"."id...
                   ^ - Invalid query: SELECT "a"."id_rules", "b"."id_module", "b"."id_kontrol", "b"."id_fungsi", "c"."nama_module", "c"."url_module", "d"."nama_kontrol", "d"."url_kontrol", "e"."nama_fungsi", "e"."url_fungsi"
FROM "xi_sa_group_privileges" "a"
INNER JOIN "xi_sa_rules" "b" ON "a"."id_rules" = "b"."id_rules"
INNER JOIN "xi_sa_module" "c" ON "b"."id_module" = "c"."id_module"
INNER JOIN "xi_sa_kontrol" "d" ON "b"."id_kontrol" = "d"."id_kontrol"
INNER JOIN "xi_sa_fungsi" "e" ON "b"."id_fungsi" = "e"."id_fungsi"
WHERE "a"."id_group" = 1
AND "a"."id_status" = 1
AND "b"."id_status" = 1
AND "c"."id_status" = 1
AND "d"."id_status" = 1
AND "e"."id_status" = 1
ORDER BY "b"."id_rules" ASC
ERROR - 2024-07-01 16:00:11 --> Severity: Warning --> pg_query(): Query failed: ERROR:  relation &quot;xi_sa_kontrol&quot; does not exist
LINE 5: INNER JOIN &quot;xi_sa_kontrol&quot; &quot;d&quot; ON &quot;b&quot;.&quot;id_kontrol&quot; = &quot;d&quot;.&quot;id...
                   ^ D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-07-01 16:00:11 --> Query error: ERROR:  relation "xi_sa_kontrol" does not exist
LINE 5: INNER JOIN "xi_sa_kontrol" "d" ON "b"."id_kontrol" = "d"."id...
                   ^ - Invalid query: SELECT "a"."id_rules", "b"."id_module", "b"."id_kontrol", "b"."id_fungsi", "c"."nama_module", "c"."url_module", "d"."nama_kontrol", "d"."url_kontrol", "e"."nama_fungsi", "e"."url_fungsi"
FROM "xi_sa_group_privileges" "a"
INNER JOIN "xi_sa_rules" "b" ON "a"."id_rules" = "b"."id_rules"
INNER JOIN "xi_sa_module" "c" ON "b"."id_module" = "c"."id_module"
INNER JOIN "xi_sa_kontrol" "d" ON "b"."id_kontrol" = "d"."id_kontrol"
INNER JOIN "xi_sa_fungsi" "e" ON "b"."id_fungsi" = "e"."id_fungsi"
WHERE "a"."id_group" = 1
AND "a"."id_status" = 1
AND "b"."id_status" = 1
AND "c"."id_status" = 1
AND "d"."id_status" = 1
AND "e"."id_status" = 1
ORDER BY "b"."id_rules" ASC
ERROR - 2024-07-01 16:01:51 --> Severity: Warning --> pg_query(): Query failed: ERROR:  relation &quot;xi_sa_kontrol&quot; does not exist
LINE 5: INNER JOIN &quot;xi_sa_kontrol&quot; &quot;d&quot; ON &quot;b&quot;.&quot;id_kontrol&quot; = &quot;d&quot;.&quot;id...
                   ^ D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-07-01 16:01:51 --> Query error: ERROR:  relation "xi_sa_kontrol" does not exist
LINE 5: INNER JOIN "xi_sa_kontrol" "d" ON "b"."id_kontrol" = "d"."id...
                   ^ - Invalid query: SELECT "a"."id_rules", "b"."id_module", "b"."id_kontrol", "b"."id_fungsi", "c"."nama_module", "c"."url_module", "d"."nama_kontrol", "d"."url_kontrol", "e"."nama_fungsi", "e"."url_fungsi"
FROM "xi_sa_group_privileges" "a"
INNER JOIN "xi_sa_rules" "b" ON "a"."id_rules" = "b"."id_rules"
INNER JOIN "xi_sa_module" "c" ON "b"."id_module" = "c"."id_module"
INNER JOIN "xi_sa_kontrol" "d" ON "b"."id_kontrol" = "d"."id_kontrol"
INNER JOIN "xi_sa_fungsi" "e" ON "b"."id_fungsi" = "e"."id_fungsi"
WHERE "a"."id_group" = 1
AND "a"."id_status" = 1
AND "b"."id_status" = 1
AND "c"."id_status" = 1
AND "d"."id_status" = 1
AND "e"."id_status" = 1
ORDER BY "b"."id_rules" ASC
ERROR - 2024-07-01 16:01:54 --> Severity: Warning --> pg_query(): Query failed: ERROR:  relation &quot;xi_sa_kontrol&quot; does not exist
LINE 5: INNER JOIN &quot;xi_sa_kontrol&quot; &quot;d&quot; ON &quot;b&quot;.&quot;id_kontrol&quot; = &quot;d&quot;.&quot;id...
                   ^ D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-07-01 16:01:54 --> Query error: ERROR:  relation "xi_sa_kontrol" does not exist
LINE 5: INNER JOIN "xi_sa_kontrol" "d" ON "b"."id_kontrol" = "d"."id...
                   ^ - Invalid query: SELECT "a"."id_rules", "b"."id_module", "b"."id_kontrol", "b"."id_fungsi", "c"."nama_module", "c"."url_module", "d"."nama_kontrol", "d"."url_kontrol", "e"."nama_fungsi", "e"."url_fungsi"
FROM "xi_sa_group_privileges" "a"
INNER JOIN "xi_sa_rules" "b" ON "a"."id_rules" = "b"."id_rules"
INNER JOIN "xi_sa_module" "c" ON "b"."id_module" = "c"."id_module"
INNER JOIN "xi_sa_kontrol" "d" ON "b"."id_kontrol" = "d"."id_kontrol"
INNER JOIN "xi_sa_fungsi" "e" ON "b"."id_fungsi" = "e"."id_fungsi"
WHERE "a"."id_group" = 1
AND "a"."id_status" = 1
AND "b"."id_status" = 1
AND "c"."id_status" = 1
AND "d"."id_status" = 1
AND "e"."id_status" = 1
ORDER BY "b"."id_rules" ASC
ERROR - 2024-07-01 16:01:55 --> Severity: Warning --> pg_query(): Query failed: ERROR:  relation &quot;xi_sa_kontrol&quot; does not exist
LINE 5: INNER JOIN &quot;xi_sa_kontrol&quot; &quot;d&quot; ON &quot;b&quot;.&quot;id_kontrol&quot; = &quot;d&quot;.&quot;id...
                   ^ D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-07-01 16:01:55 --> Query error: ERROR:  relation "xi_sa_kontrol" does not exist
LINE 5: INNER JOIN "xi_sa_kontrol" "d" ON "b"."id_kontrol" = "d"."id...
                   ^ - Invalid query: SELECT "a"."id_rules", "b"."id_module", "b"."id_kontrol", "b"."id_fungsi", "c"."nama_module", "c"."url_module", "d"."nama_kontrol", "d"."url_kontrol", "e"."nama_fungsi", "e"."url_fungsi"
FROM "xi_sa_group_privileges" "a"
INNER JOIN "xi_sa_rules" "b" ON "a"."id_rules" = "b"."id_rules"
INNER JOIN "xi_sa_module" "c" ON "b"."id_module" = "c"."id_module"
INNER JOIN "xi_sa_kontrol" "d" ON "b"."id_kontrol" = "d"."id_kontrol"
INNER JOIN "xi_sa_fungsi" "e" ON "b"."id_fungsi" = "e"."id_fungsi"
WHERE "a"."id_group" = 1
AND "a"."id_status" = 1
AND "b"."id_status" = 1
AND "c"."id_status" = 1
AND "d"."id_status" = 1
AND "e"."id_status" = 1
ORDER BY "b"."id_rules" ASC
ERROR - 2024-07-01 16:18:51 --> 404 Page Not Found: /index
ERROR - 2024-07-01 16:18:51 --> 404 Page Not Found: /index
ERROR - 2024-07-01 16:27:13 --> 404 Page Not Found: ../modules/manajemen_data/controllers//index
