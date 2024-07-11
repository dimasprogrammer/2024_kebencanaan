<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-07-03 09:59:38 --> Severity: Warning --> Undefined property: CI::$mmod D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\third_party\MX\Controller.php 59
ERROR - 2024-07-03 09:59:38 --> Severity: error --> Exception: Call to a member function getDataUserAll() on null D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\modules\manajemen_data\controllers\Bencana.php 86
ERROR - 2024-07-03 10:07:30 --> Severity: Warning --> pg_query(): Query failed: ERROR:  relation &quot;wa_province&quot; does not exist
LINE 2: FROM &quot;wa_province&quot;
             ^ D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-07-03 10:07:30 --> Query error: ERROR:  relation "wa_province" does not exist
LINE 2: FROM "wa_province"
             ^ - Invalid query: SELECT *
FROM "wa_province"
WHERE "id" = '13'
ORDER BY "id" ASC
ERROR - 2024-07-03 10:08:10 --> Severity: Warning --> pg_query(): Query failed: ERROR:  relation &quot;wa_regency&quot; does not exist
LINE 2: FROM &quot;wa_regency&quot;
             ^ D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-07-03 10:08:10 --> Query error: ERROR:  relation "wa_regency" does not exist
LINE 2: FROM "wa_regency"
             ^ - Invalid query: SELECT *
FROM "wa_regency"
WHERE "province_id" = '13'
ORDER BY "id" ASC
ERROR - 2024-07-03 10:08:32 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column &quot;province_id&quot; does not exist
LINE 3: WHERE &quot;province_id&quot; = '13'
              ^ D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-07-03 10:08:32 --> Query error: ERROR:  column "province_id" does not exist
LINE 3: WHERE "province_id" = '13'
              ^ - Invalid query: SELECT *
FROM "wa_regency"
WHERE "province_id" = '13'
ORDER BY "id" ASC
ERROR - 2024-07-03 11:37:53 --> Severity: error --> Exception: Call to undefined method Model_users::getDataWilayah() D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\modules\manajemen\controllers\Users.php 56
ERROR - 2024-07-03 11:38:18 --> Severity: Warning --> pg_query(): Query failed: ERROR:  operator does not exist: character varying = integer
LINE 3: WHERE &quot;kode&quot; = 13
                     ^
HINT:  No operator matches the given name and argument types. You might need to add explicit type casts. D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-07-03 11:38:18 --> Query error: ERROR:  operator does not exist: character varying = integer
LINE 3: WHERE "kode" = 13
                     ^
HINT:  No operator matches the given name and argument types. You might need to add explicit type casts. - Invalid query: SELECT *
FROM "wilayah"
WHERE "kode" = 13
ORDER BY "kode" ASC
ERROR - 2024-07-03 11:40:20 --> Severity: Warning --> pg_query(): Query failed: ERROR:  operator does not exist: character varying = integer
LINE 3: WHERE &quot;kode&quot; = 13
                     ^
HINT:  No operator matches the given name and argument types. You might need to add explicit type casts. D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-07-03 11:40:20 --> Query error: ERROR:  operator does not exist: character varying = integer
LINE 3: WHERE "kode" = 13
                     ^
HINT:  No operator matches the given name and argument types. You might need to add explicit type casts. - Invalid query: SELECT *
FROM "wilayah"
WHERE "kode" = 13
ORDER BY "kode" ASC
