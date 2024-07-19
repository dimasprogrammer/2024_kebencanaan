<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-07-18 09:09:15 --> Severity: error --> Exception: Call to undefined method Model_bencana_daerah::addDataDetailBencanaShare() D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\modules\manajemen_data\controllers\Bencana_daerah.php 89
ERROR - 2024-07-18 09:10:54 --> Severity: Warning --> pg_query(): Query failed: ERROR:  relation &quot;ms_bencana_share&quot; does not exist
LINE 2: FROM &quot;ms_bencana_share&quot; &quot;a&quot;
             ^ D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-07-18 09:10:54 --> Query error: ERROR:  relation "ms_bencana_share" does not exist
LINE 2: FROM "ms_bencana_share" "a"
             ^ - Invalid query: SELECT "a"."id_bencana_share", "a"."token_bencana", "a"."token_bencana_detail", "a"."id_regency_penerima"
FROM "ms_bencana_share" "a"
INNER JOIN "ms_bencana" "b" ON "b"."token_bencana" = "a"."token_bencana"
WHERE "a"."token_bencana_detail" = 'DEFAABB1E0B242BDA827FBB4AAA0D362'
ERROR - 2024-07-18 09:11:14 --> Severity: error --> Exception: count(): Argument #1 ($value) must be of type Countable|array, null given D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\modules\manajemen_data\controllers\Bencana_daerah.php 92
ERROR - 2024-07-18 09:12:10 --> Severity: Warning --> pg_query(): Query failed: ERROR:  missing FROM-clause entry for table &quot;a&quot;
LINE 3: ...ER JOIN &quot;ms_bencana&quot; &quot;b&quot; ON &quot;b&quot;.&quot;token_bencana&quot; = &quot;a&quot;.&quot;token...
                                                             ^ D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-07-18 09:12:10 --> Query error: ERROR:  missing FROM-clause entry for table "a"
LINE 3: ...ER JOIN "ms_bencana" "b" ON "b"."token_bencana" = "a"."token...
                                                             ^ - Invalid query: SELECT "a"."id_bencana_detail", "a"."token_bencana", "a"."token_bencana_detail", "a"."id_regency_penerima"
FROM "ms_bencana_detail" "aSS"
INNER JOIN "ms_bencana" "b" ON "b"."token_bencana" = "a"."token_bencana"
WHERE "a"."token_bencana_detail" = 'DEFAABB1E0B242BDA827FBB4AAA0D362'
ERROR - 2024-07-18 09:13:33 --> Severity: error --> Exception: count(): Argument #1 ($value) must be of type Countable|array, null given D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\modules\manajemen_data\controllers\Bencana_daerah.php 92
ERROR - 2024-07-18 09:13:36 --> Severity: error --> Exception: count(): Argument #1 ($value) must be of type Countable|array, null given D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\modules\manajemen_data\controllers\Bencana_daerah.php 92
ERROR - 2024-07-18 10:02:59 --> 404 Page Not Found: /index
ERROR - 2024-07-18 10:02:59 --> 404 Page Not Found: /index
ERROR - 2024-07-18 10:50:20 --> Severity: error --> Exception: Call to undefined method Model_master::getDataKorbanBencana() D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\modules\manajemen_data\controllers\Bencana_daerah.php 103
ERROR - 2024-07-18 10:50:30 --> Severity: error --> Exception: Too few arguments to function Model_bencana_daerah::getDataKorbanBencana(), 0 passed in D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\modules\manajemen_data\controllers\Bencana_daerah.php on line 103 and exactly 1 expected D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\modules\manajemen_data\models\Model_bencana_daerah.php 91
ERROR - 2024-07-18 10:51:08 --> Severity: error --> Exception: Too few arguments to function Model_bencana_daerah::getDataKorbanBencana(), 0 passed in D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\modules\manajemen_data\controllers\Bencana_daerah.php on line 103 and exactly 1 expected D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\modules\manajemen_data\models\Model_bencana_daerah.php 91
ERROR - 2024-07-18 10:51:16 --> Severity: error --> Exception: Too few arguments to function Model_bencana_daerah::getDataKorbanBencana(), 0 passed in D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\modules\manajemen_data\controllers\Bencana_daerah.php on line 103 and exactly 1 expected D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\modules\manajemen_data\models\Model_bencana_daerah.php 91
ERROR - 2024-07-18 10:51:19 --> Severity: error --> Exception: Too few arguments to function Model_bencana_daerah::getDataKorbanBencana(), 0 passed in D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\modules\manajemen_data\controllers\Bencana_daerah.php on line 103 and exactly 1 expected D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\modules\manajemen_data\models\Model_bencana_daerah.php 91
ERROR - 2024-07-18 10:51:24 --> Severity: error --> Exception: Too few arguments to function Model_bencana_daerah::getDataKorbanBencana(), 0 passed in D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\modules\manajemen_data\controllers\Bencana_daerah.php on line 103 and exactly 1 expected D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\modules\manajemen_data\models\Model_bencana_daerah.php 91
ERROR - 2024-07-18 10:51:57 --> Severity: Warning --> pg_query(): Query failed: ERROR:  missing FROM-clause entry for table &quot;a&quot;
LINE 3: ...ncana_detail&quot; &quot;b&quot; ON &quot;b&quot;.&quot;token_bencana_detail&quot; = &quot;a&quot;.&quot;token...
                                                             ^ D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-07-18 10:51:57 --> Query error: ERROR:  missing FROM-clause entry for table "a"
LINE 3: ...ncana_detail" "b" ON "b"."token_bencana_detail" = "a"."token...
                                                             ^ - Invalid query: SELECT "a"."id" as "id_korban_bencana", "a"."token_bencana_detail", "a"."id_regency_penerima", "c"."nm_kondisi", "d"."nm_jiwa"
FROM "ms_korban_bencana" "aSSS"
INNER JOIN "ms_bencana_detail" "b" ON "b"."token_bencana_detail" = "a"."token_bencana_detail"
INNER JOIN "cx_korban_kondisi" "c" ON "c"."id" = "a"."id_kondisi_korban"
INNER JOIN "cx_korban_jiwa" "d" ON "d"."id" = "a"."id_korban_jiwa"
ORDER BY "a"."id_bencana_detail" DESC
ERROR - 2024-07-18 10:52:01 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column a.id_regency_penerima does not exist
LINE 1: ... &quot;id_korban_bencana&quot;, &quot;a&quot;.&quot;token_bencana_detail&quot;, &quot;a&quot;.&quot;id_re...
                                                             ^
HINT:  Perhaps you meant to reference the column &quot;b.id_regency_penerima&quot;. D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-07-18 10:52:01 --> Query error: ERROR:  column a.id_regency_penerima does not exist
LINE 1: ... "id_korban_bencana", "a"."token_bencana_detail", "a"."id_re...
                                                             ^
HINT:  Perhaps you meant to reference the column "b.id_regency_penerima". - Invalid query: SELECT "a"."id" as "id_korban_bencana", "a"."token_bencana_detail", "a"."id_regency_penerima", "c"."nm_kondisi", "d"."nm_jiwa"
FROM "ms_korban_bencana" "a"
INNER JOIN "ms_bencana_detail" "b" ON "b"."token_bencana_detail" = "a"."token_bencana_detail"
INNER JOIN "cx_korban_kondisi" "c" ON "c"."id" = "a"."id_kondisi_korban"
INNER JOIN "cx_korban_jiwa" "d" ON "d"."id" = "a"."id_korban_jiwa"
ORDER BY "a"."id_bencana_detail" DESC
ERROR - 2024-07-18 10:52:10 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column a.id_bencana_detail does not exist
LINE 6: ORDER BY &quot;a&quot;.&quot;id_bencana_detail&quot; DESC
                 ^
HINT:  Perhaps you meant to reference the column &quot;b.id_bencana_detail&quot;. D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-07-18 10:52:10 --> Query error: ERROR:  column a.id_bencana_detail does not exist
LINE 6: ORDER BY "a"."id_bencana_detail" DESC
                 ^
HINT:  Perhaps you meant to reference the column "b.id_bencana_detail". - Invalid query: SELECT "a"."id" as "id_korban_bencana", "a"."token_bencana_detail", "c"."nm_kondisi", "d"."nm_jiwa"
FROM "ms_korban_bencana" "a"
INNER JOIN "ms_bencana_detail" "b" ON "b"."token_bencana_detail" = "a"."token_bencana_detail"
INNER JOIN "cx_korban_kondisi" "c" ON "c"."id" = "a"."id_kondisi_korban"
INNER JOIN "cx_korban_jiwa" "d" ON "d"."id" = "a"."id_korban_jiwa"
ORDER BY "a"."id_bencana_detail" DESC
ERROR - 2024-07-18 10:52:24 --> Severity: Warning --> Undefined variable $token_inovasi D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\modules\manajemen_data\views\bencana_daerah\vdetail.php 60
ERROR - 2024-07-18 10:52:24 --> Severity: Warning --> Trying to access array offset on value of type null D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\modules\manajemen_data\views\bencana_daerah\vdetail.php 60
ERROR - 2024-07-18 11:03:26 --> Severity: Warning --> Attempt to read property "nm_kondisi" on array D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\modules\manajemen_data\views\bencana_daerah\vdetail.php 66
ERROR - 2024-07-18 11:05:35 --> Severity: Warning --> Attempt to read property "jumlah_korban" on array D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\modules\manajemen_data\views\bencana_daerah\vdetail.php 67
ERROR - 2024-07-18 11:31:51 --> Severity: Warning --> Undefined variable $kondisi_korba D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\modules\manajemen_data\views\bencana_daerah\vdetail.php 63
ERROR - 2024-07-18 11:31:51 --> Severity: Warning --> foreach() argument must be of type array|object, null given D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\modules\manajemen_data\views\bencana_daerah\vdetail.php 63
ERROR - 2024-07-18 11:32:02 --> Severity: Warning --> Undefined variable $data_master_korban D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\modules\manajemen_data\views\bencana_daerah\vdetail.php 66
ERROR - 2024-07-18 11:32:02 --> Severity: error --> Exception: count(): Argument #1 ($value) must be of type Countable|array, null given D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\modules\manajemen_data\views\bencana_daerah\vdetail.php 66
ERROR - 2024-07-18 11:32:27 --> Severity: Warning --> Array to string conversion D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\modules\manajemen_data\views\bencana_daerah\vdetail.php 69
ERROR - 2024-07-18 11:32:27 --> Severity: Warning --> Undefined variable $Array D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\modules\manajemen_data\views\bencana_daerah\vdetail.php 69
ERROR - 2024-07-18 11:32:27 --> Severity: Warning --> Trying to access array offset on value of type null D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\modules\manajemen_data\views\bencana_daerah\vdetail.php 69
ERROR - 2024-07-18 11:32:27 --> Severity: Warning --> Trying to access array offset on value of type null D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\modules\manajemen_data\views\bencana_daerah\vdetail.php 69
ERROR - 2024-07-18 14:02:48 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column a.nm_sarana does not exist
LINE 1: SELECT &quot;a&quot;.&quot;id&quot; as &quot;id_jenis_sarana&quot;, &quot;a&quot;.&quot;nm_sarana&quot;
                                              ^ D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-07-18 14:02:48 --> Query error: ERROR:  column a.nm_sarana does not exist
LINE 1: SELECT "a"."id" as "id_jenis_sarana", "a"."nm_sarana"
                                              ^ - Invalid query: SELECT "a"."id" as "id_jenis_sarana", "a"."nm_sarana"
FROM "cx_jenis_sarana" "a"
ORDER BY "a"."id" ASC
ERROR - 2024-07-18 15:05:55 --> Severity: error --> Exception: Call to undefined method Model_bencana_daerah::getDataJenisKerusakan() D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\modules\manajemen_data\controllers\Bencana_daerah.php 106
ERROR - 2024-07-18 15:13:44 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column a.nm_jenis_ternak does not exist
LINE 1: SELECT &quot;a&quot;.&quot;id&quot; as &quot;id_jenis_ternak&quot;, &quot;a&quot;.&quot;nm_jenis_ternak&quot;
                                              ^ D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-07-18 15:13:44 --> Query error: ERROR:  column a.nm_jenis_ternak does not exist
LINE 1: SELECT "a"."id" as "id_jenis_ternak", "a"."nm_jenis_ternak"
                                              ^ - Invalid query: SELECT "a"."id" as "id_jenis_ternak", "a"."nm_jenis_ternak"
FROM "cx_jenis_ternak" "a"
ORDER BY "a"."id" ASC
ERROR - 2024-07-18 15:26:52 --> Severity: Warning --> Undefined property: stdClass::$nm_jenis_sumber D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\modules\manajemen_data\views\bencana_daerah\vdetail.php 247
ERROR - 2024-07-18 15:30:51 --> Severity: Warning --> Undefined property: stdClass::$nm_jenis_sumber D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\modules\manajemen_data\views\bencana_daerah\vdetail.php 250
ERROR - 2024-07-18 15:30:51 --> Severity: Warning --> Undefined property: stdClass::$nm_jenis_sumber D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\modules\manajemen_data\views\bencana_daerah\vdetail.php 250
ERROR - 2024-07-18 15:31:26 --> Severity: Warning --> Undefined property: stdClass::$nm_jenis_sumber D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\modules\manajemen_data\views\bencana_daerah\vdetail.php 250
ERROR - 2024-07-18 15:31:26 --> Severity: Warning --> Undefined property: stdClass::$nm_jenis_sumber D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\application\modules\manajemen_data\views\bencana_daerah\vdetail.php 250
