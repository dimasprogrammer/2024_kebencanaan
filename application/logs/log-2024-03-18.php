<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-03-18 09:36:23 --> Severity: error --> Exception: Too few arguments to function Model_nilai_indikator::deleteDataIndikatorFile(), 0 passed in D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\manajemen_data\controllers\Inovasi.php on line 509 and exactly 1 expected D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\manajemen_data\models\Model_nilai_indikator.php 302
ERROR - 2024-03-18 09:38:12 --> 404 Page Not Found: /index
ERROR - 2024-03-18 09:38:13 --> 404 Page Not Found: /index
ERROR - 2024-03-18 09:38:14 --> 404 Page Not Found: /index
ERROR - 2024-03-18 09:38:14 --> 404 Page Not Found: /index
ERROR - 2024-03-18 09:38:22 --> Severity: error --> Exception: Too few arguments to function Model_nilai_indikator::deleteDataIndikatorFile(), 0 passed in D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\manajemen_data\controllers\Inovasi.php on line 509 and exactly 1 expected D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\manajemen_data\models\Model_nilai_indikator.php 302
ERROR - 2024-03-18 09:40:11 --> Severity: Warning --> pg_query(): Query failed: ERROR:  invalid input syntax for type integer: &quot;&quot;
LINE 4: AND &quot;parent_id&quot; = ''
                          ^ D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-03-18 09:40:11 --> Query error: ERROR:  invalid input syntax for type integer: ""
LINE 4: AND "parent_id" = ''
                          ^ - Invalid query: SELECT COUNT(*) AS "numrows"
FROM "xi_sa_menu"
WHERE "order_menu" = '6'
AND "parent_id" = ''
ERROR - 2024-03-18 09:40:45 --> Severity: Warning --> pg_query(): Query failed: ERROR:  invalid input syntax for type integer: &quot;&quot;
LINE 4: AND &quot;parent_id&quot; = ''
                          ^ D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-03-18 09:40:45 --> Query error: ERROR:  invalid input syntax for type integer: ""
LINE 4: AND "parent_id" = ''
                          ^ - Invalid query: SELECT COUNT(*) AS "numrows"
FROM "xi_sa_menu"
WHERE "order_menu" = '6'
AND "parent_id" = ''
ERROR - 2024-03-18 10:26:29 --> Severity: Warning --> Undefined variable $token_inovasi D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\manajemen_verifikator\views\inovasi\vpage.php 50
ERROR - 2024-03-18 10:26:29 --> Severity: Warning --> Trying to access array offset on value of type null D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\manajemen_verifikator\views\inovasi\vpage.php 50
ERROR - 2024-03-18 10:26:29 --> Severity: Warning --> Undefined variable $list_indikator D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\manajemen_verifikator\views\inovasi\vpage.php 52
ERROR - 2024-03-18 10:26:29 --> Severity: Warning --> foreach() argument must be of type array|object, null given D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\manajemen_verifikator\views\inovasi\vpage.php 52
ERROR - 2024-03-18 10:30:06 --> Severity: Warning --> pg_query(): Query failed: ERROR:  syntax error at or near &quot;&quot;a&quot;&quot;
LINE 6: &quot;a&quot;.&quot;nama_inovasi,&quot; &quot;a&quot;.&quot;waktu_uji_coba&quot; LIKE '%Inisiatif%' ...
                            ^ D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-03-18 10:30:06 --> Query error: ERROR:  syntax error at or near ""a""
LINE 6: "a"."nama_inovasi," "a"."waktu_uji_coba" LIKE '%Inisiatif%' ...
                            ^ - Invalid query: SELECT "a"."id_inovasi", "a"."token", "a"."nama_inovasi", "a"."waktu_uji_coba", "a"."waktu_penerapan", "a"."id_tahapan_inovasi", "a"."status_inovasi", "a"."status_permohonan", "b"."nm_urusan_utama", "c"."opd_id_name"
FROM "ms_inovasi" "a"
INNER JOIN "cx_urusan_utama" "b" ON "a"."id_urusan_utama" = "b"."id_urusan_utama"
INNER JOIN "xi_sa_users" "c" ON "a"."create_by" = "c"."token"
WHERE   (
"a"."nama_inovasi," "a"."waktu_uji_coba" LIKE '%Inisiatif%' ESCAPE '!'
 )
ORDER BY "id_inovasi" ASC
 LIMIT 10
ERROR - 2024-03-18 10:30:13 --> Severity: Warning --> pg_query(): Query failed: ERROR:  syntax error at or near &quot;&quot;a&quot;&quot;
LINE 6: &quot;a&quot;.&quot;nama_inovasi,&quot; &quot;a&quot;.&quot;waktu_uji_coba&quot; LIKE '%1%' ESCAPE '...
                            ^ D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-03-18 10:30:13 --> Query error: ERROR:  syntax error at or near ""a""
LINE 6: "a"."nama_inovasi," "a"."waktu_uji_coba" LIKE '%1%' ESCAPE '...
                            ^ - Invalid query: SELECT "a"."id_inovasi", "a"."token", "a"."nama_inovasi", "a"."waktu_uji_coba", "a"."waktu_penerapan", "a"."id_tahapan_inovasi", "a"."status_inovasi", "a"."status_permohonan", "b"."nm_urusan_utama", "c"."opd_id_name"
FROM "ms_inovasi" "a"
INNER JOIN "cx_urusan_utama" "b" ON "a"."id_urusan_utama" = "b"."id_urusan_utama"
INNER JOIN "xi_sa_users" "c" ON "a"."create_by" = "c"."token"
WHERE   (
"a"."nama_inovasi," "a"."waktu_uji_coba" LIKE '%1%' ESCAPE '!'
 )
ORDER BY "id_inovasi" ASC
 LIMIT 10
ERROR - 2024-03-18 10:30:15 --> Severity: Warning --> pg_query(): Query failed: ERROR:  syntax error at or near &quot;&quot;a&quot;&quot;
LINE 6: &quot;a&quot;.&quot;nama_inovasi,&quot; &quot;a&quot;.&quot;waktu_uji_coba&quot; LIKE '%14%' ESCAPE ...
                            ^ D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-03-18 10:30:15 --> Query error: ERROR:  syntax error at or near ""a""
LINE 6: "a"."nama_inovasi," "a"."waktu_uji_coba" LIKE '%14%' ESCAPE ...
                            ^ - Invalid query: SELECT "a"."id_inovasi", "a"."token", "a"."nama_inovasi", "a"."waktu_uji_coba", "a"."waktu_penerapan", "a"."id_tahapan_inovasi", "a"."status_inovasi", "a"."status_permohonan", "b"."nm_urusan_utama", "c"."opd_id_name"
FROM "ms_inovasi" "a"
INNER JOIN "cx_urusan_utama" "b" ON "a"."id_urusan_utama" = "b"."id_urusan_utama"
INNER JOIN "xi_sa_users" "c" ON "a"."create_by" = "c"."token"
WHERE   (
"a"."nama_inovasi," "a"."waktu_uji_coba" LIKE '%14%' ESCAPE '!'
 )
ORDER BY "id_inovasi" ASC
 LIMIT 10
ERROR - 2024-03-18 10:30:24 --> Severity: Warning --> pg_query(): Query failed: ERROR:  syntax error at or near &quot;&quot;a&quot;&quot;
LINE 6: &quot;a&quot;.&quot;nama_inovasi,&quot; &quot;a&quot;.&quot;waktu_uji_coba&quot; LIKE '%1%' ESCAPE '...
                            ^ D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-03-18 10:30:24 --> Query error: ERROR:  syntax error at or near ""a""
LINE 6: "a"."nama_inovasi," "a"."waktu_uji_coba" LIKE '%1%' ESCAPE '...
                            ^ - Invalid query: SELECT "a"."id_inovasi", "a"."token", "a"."nama_inovasi", "a"."waktu_uji_coba", "a"."waktu_penerapan", "a"."id_tahapan_inovasi", "a"."status_inovasi", "a"."status_permohonan", "b"."nm_urusan_utama", "c"."opd_id_name"
FROM "ms_inovasi" "a"
INNER JOIN "cx_urusan_utama" "b" ON "a"."id_urusan_utama" = "b"."id_urusan_utama"
INNER JOIN "xi_sa_users" "c" ON "a"."create_by" = "c"."token"
WHERE   (
"a"."nama_inovasi," "a"."waktu_uji_coba" LIKE '%1%' ESCAPE '!'
 )
ORDER BY "id_inovasi" ASC
 LIMIT 10
ERROR - 2024-03-18 10:30:29 --> Severity: Warning --> pg_query(): Query failed: ERROR:  syntax error at or near &quot;&quot;a&quot;&quot;
LINE 6: &quot;a&quot;.&quot;nama_inovasi,&quot; &quot;a&quot;.&quot;waktu_uji_coba&quot; LIKE '%P%' ESCAPE '...
                            ^ D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-03-18 10:30:29 --> Query error: ERROR:  syntax error at or near ""a""
LINE 6: "a"."nama_inovasi," "a"."waktu_uji_coba" LIKE '%P%' ESCAPE '...
                            ^ - Invalid query: SELECT "a"."id_inovasi", "a"."token", "a"."nama_inovasi", "a"."waktu_uji_coba", "a"."waktu_penerapan", "a"."id_tahapan_inovasi", "a"."status_inovasi", "a"."status_permohonan", "b"."nm_urusan_utama", "c"."opd_id_name"
FROM "ms_inovasi" "a"
INNER JOIN "cx_urusan_utama" "b" ON "a"."id_urusan_utama" = "b"."id_urusan_utama"
INNER JOIN "xi_sa_users" "c" ON "a"."create_by" = "c"."token"
WHERE   (
"a"."nama_inovasi," "a"."waktu_uji_coba" LIKE '%P%' ESCAPE '!'
 )
ORDER BY "id_inovasi" ASC
 LIMIT 10
ERROR - 2024-03-18 10:55:30 --> 404 Page Not Found: /index
ERROR - 2024-03-18 10:55:31 --> 404 Page Not Found: /index
ERROR - 2024-03-18 11:41:18 --> 404 Page Not Found: /index
ERROR - 2024-03-18 11:41:19 --> 404 Page Not Found: /index
ERROR - 2024-03-18 11:41:20 --> 404 Page Not Found: /index
ERROR - 2024-03-18 11:41:20 --> 404 Page Not Found: /index
ERROR - 2024-03-18 11:42:56 --> 404 Page Not Found: /index
ERROR - 2024-03-18 11:42:56 --> 404 Page Not Found: /index
ERROR - 2024-03-18 11:44:27 --> 404 Page Not Found: /index
ERROR - 2024-03-18 11:44:27 --> 404 Page Not Found: /index
ERROR - 2024-03-18 11:44:36 --> 404 Page Not Found: /index
ERROR - 2024-03-18 11:44:36 --> 404 Page Not Found: /index
ERROR - 2024-03-18 11:45:03 --> 404 Page Not Found: /index
ERROR - 2024-03-18 11:45:04 --> 404 Page Not Found: /index
ERROR - 2024-03-18 11:48:02 --> 404 Page Not Found: /index
ERROR - 2024-03-18 11:48:02 --> 404 Page Not Found: /index
ERROR - 2024-03-18 11:56:26 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column &quot;status_inovasi&quot; of relation &quot;ms_permohonan&quot; does not exist
LINE 1: ...instansi&quot;, &quot;no_hp&quot;, &quot;email&quot;, &quot;status_permohonan&quot;, &quot;status_in...
                                                             ^ D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-03-18 11:56:26 --> Query error: ERROR:  column "status_inovasi" of relation "ms_permohonan" does not exist
LINE 1: ...instansi", "no_hp", "email", "status_permohonan", "status_in...
                                                             ^ - Invalid query: INSERT INTO "ms_permohonan" ("token", "nama_lengkap", "jabatan", "instansi", "no_hp", "email", "status_permohonan", "status_inovasi", "create_by", "create_date", "create_ip", "mod_by", "mod_date", "mod_ip") VALUES ('F6485E8F6F934D7CB655A71D7413B601', 'Dimas DR', 'Penjabat (PJ)a', 'Dinas Komunikasi, Informatika dan Statistik Provinsi Sumatera Barat', '0282222333333', 'michael@gmail.com', '1', 1, '86515646A0B41A233182D192F4BB3492', '2024-03-18 11:56:26', '::1', '86515646A0B41A233182D192F4BB3492', '2024-03-18 11:56:26', '::1')
ERROR - 2024-03-18 12:03:03 --> Severity: Warning --> Trying to access array offset on value of type null D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\manajemen_verifikator\models\Model_inovasi.php 389
ERROR - 2024-03-18 12:03:03 --> Severity: Warning --> Trying to access array offset on value of type null D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\manajemen_verifikator\models\Model_inovasi.php 390
ERROR - 2024-03-18 12:03:03 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\manajemen_verifikator\models\Model_inovasi.php 390
ERROR - 2024-03-18 12:03:03 --> Severity: Warning --> Trying to access array offset on value of type null D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\manajemen_verifikator\models\Model_inovasi.php 391
ERROR - 2024-03-18 12:03:03 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\manajemen_verifikator\models\Model_inovasi.php 391
ERROR - 2024-03-18 12:03:23 --> Severity: Warning --> Trying to access array offset on value of type null D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\manajemen_data\models\Model_inovasi.php 387
ERROR - 2024-03-18 12:03:23 --> Severity: Warning --> Trying to access array offset on value of type null D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\manajemen_data\models\Model_inovasi.php 388
ERROR - 2024-03-18 12:03:23 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\manajemen_data\models\Model_inovasi.php 388
ERROR - 2024-03-18 12:03:23 --> Severity: Warning --> Trying to access array offset on value of type null D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\manajemen_data\models\Model_inovasi.php 389
ERROR - 2024-03-18 12:03:23 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\manajemen_data\models\Model_inovasi.php 389
ERROR - 2024-03-18 12:04:34 --> 404 Page Not Found: /index
ERROR - 2024-03-18 12:04:35 --> 404 Page Not Found: /index
ERROR - 2024-03-18 12:04:36 --> 404 Page Not Found: /index
ERROR - 2024-03-18 12:04:36 --> 404 Page Not Found: /index
ERROR - 2024-03-18 12:04:41 --> Severity: Warning --> Trying to access array offset on value of type null D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\manajemen_data\models\Model_inovasi.php 387
ERROR - 2024-03-18 12:04:41 --> Severity: Warning --> Trying to access array offset on value of type null D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\manajemen_data\models\Model_inovasi.php 388
ERROR - 2024-03-18 12:04:41 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\manajemen_data\models\Model_inovasi.php 388
ERROR - 2024-03-18 12:04:41 --> Severity: Warning --> Trying to access array offset on value of type null D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\manajemen_data\models\Model_inovasi.php 389
ERROR - 2024-03-18 12:04:41 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\manajemen_data\models\Model_inovasi.php 389
ERROR - 2024-03-18 12:05:29 --> 404 Page Not Found: /index
ERROR - 2024-03-18 12:05:29 --> 404 Page Not Found: /index
ERROR - 2024-03-18 12:06:02 --> 404 Page Not Found: /index
ERROR - 2024-03-18 12:06:02 --> 404 Page Not Found: /index
ERROR - 2024-03-18 12:06:22 --> 404 Page Not Found: /index
ERROR - 2024-03-18 12:06:24 --> 404 Page Not Found: /index
ERROR - 2024-03-18 12:06:24 --> 404 Page Not Found: /index
ERROR - 2024-03-18 12:06:25 --> 404 Page Not Found: /index
ERROR - 2024-03-18 12:06:30 --> Severity: Warning --> Trying to access array offset on value of type null D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\manajemen_data\models\Model_inovasi.php 387
ERROR - 2024-03-18 12:06:30 --> Severity: Warning --> Trying to access array offset on value of type null D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\manajemen_data\models\Model_inovasi.php 388
ERROR - 2024-03-18 12:06:30 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\manajemen_data\models\Model_inovasi.php 388
ERROR - 2024-03-18 12:06:30 --> Severity: Warning --> Trying to access array offset on value of type null D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\manajemen_data\models\Model_inovasi.php 389
ERROR - 2024-03-18 12:06:30 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\manajemen_data\models\Model_inovasi.php 389
ERROR - 2024-03-18 12:09:56 --> 404 Page Not Found: /index
ERROR - 2024-03-18 12:09:56 --> 404 Page Not Found: /index
ERROR - 2024-03-18 12:10:24 --> 404 Page Not Found: /index
ERROR - 2024-03-18 12:10:24 --> 404 Page Not Found: /index
ERROR - 2024-03-18 12:10:40 --> 404 Page Not Found: /index
ERROR - 2024-03-18 12:10:40 --> 404 Page Not Found: /index
ERROR - 2024-03-18 12:11:33 --> 404 Page Not Found: /index
ERROR - 2024-03-18 12:11:33 --> 404 Page Not Found: /index
ERROR - 2024-03-18 12:12:19 --> 404 Page Not Found: /index
ERROR - 2024-03-18 12:12:19 --> 404 Page Not Found: /index
ERROR - 2024-03-18 12:13:32 --> 404 Page Not Found: /index
ERROR - 2024-03-18 12:13:32 --> 404 Page Not Found: /index
ERROR - 2024-03-18 12:13:36 --> 404 Page Not Found: /index
ERROR - 2024-03-18 12:13:36 --> 404 Page Not Found: /index
ERROR - 2024-03-18 12:13:51 --> 404 Page Not Found: /index
ERROR - 2024-03-18 12:13:51 --> 404 Page Not Found: /index
ERROR - 2024-03-18 12:14:34 --> 404 Page Not Found: /index
ERROR - 2024-03-18 12:14:34 --> 404 Page Not Found: /index
ERROR - 2024-03-18 12:27:13 --> Severity: Warning --> Trying to access array offset on value of type null D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\manajemen_data\models\Model_inovasi.php 387
ERROR - 2024-03-18 12:27:13 --> Severity: Warning --> Trying to access array offset on value of type null D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\manajemen_data\models\Model_inovasi.php 388
ERROR - 2024-03-18 12:27:13 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\manajemen_data\models\Model_inovasi.php 388
ERROR - 2024-03-18 12:27:13 --> Severity: Warning --> Trying to access array offset on value of type null D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\manajemen_data\models\Model_inovasi.php 389
ERROR - 2024-03-18 12:27:13 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\manajemen_data\models\Model_inovasi.php 389
ERROR - 2024-03-18 12:27:31 --> 404 Page Not Found: /index
ERROR - 2024-03-18 12:27:31 --> 404 Page Not Found: /index
ERROR - 2024-03-18 12:28:40 --> 404 Page Not Found: /index
ERROR - 2024-03-18 12:28:40 --> 404 Page Not Found: /index
ERROR - 2024-03-18 12:28:42 --> 404 Page Not Found: /index
ERROR - 2024-03-18 12:28:42 --> 404 Page Not Found: /index
ERROR - 2024-03-18 12:28:53 --> 404 Page Not Found: /index
ERROR - 2024-03-18 12:28:53 --> 404 Page Not Found: /index
ERROR - 2024-03-18 13:41:19 --> 404 Page Not Found: /index
ERROR - 2024-03-18 13:41:19 --> 404 Page Not Found: /index
ERROR - 2024-03-18 13:41:24 --> Severity: Warning --> Trying to access array offset on value of type null D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\manajemen_data\models\Model_inovasi.php 387
ERROR - 2024-03-18 13:41:24 --> Severity: Warning --> Trying to access array offset on value of type null D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\manajemen_data\models\Model_inovasi.php 388
ERROR - 2024-03-18 13:41:24 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\manajemen_data\models\Model_inovasi.php 388
ERROR - 2024-03-18 13:41:24 --> Severity: Warning --> Trying to access array offset on value of type null D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\manajemen_data\models\Model_inovasi.php 389
ERROR - 2024-03-18 13:41:24 --> Severity: 8192 --> strtotime(): Passing null to parameter #1 ($datetime) of type string is deprecated D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\manajemen_data\models\Model_inovasi.php 389
ERROR - 2024-03-18 13:43:45 --> 404 Page Not Found: /index
ERROR - 2024-03-18 13:43:45 --> 404 Page Not Found: /index
ERROR - 2024-03-18 13:44:03 --> 404 Page Not Found: /index
ERROR - 2024-03-18 13:44:03 --> 404 Page Not Found: /index
ERROR - 2024-03-18 13:46:27 --> 404 Page Not Found: /index
ERROR - 2024-03-18 13:46:27 --> 404 Page Not Found: /index
ERROR - 2024-03-18 14:16:09 --> 404 Page Not Found: /index
ERROR - 2024-03-18 14:16:11 --> 404 Page Not Found: /index
ERROR - 2024-03-18 14:16:12 --> 404 Page Not Found: /index
ERROR - 2024-03-18 14:16:12 --> 404 Page Not Found: /index
ERROR - 2024-03-18 14:18:09 --> 404 Page Not Found: /index
ERROR - 2024-03-18 14:18:09 --> 404 Page Not Found: /index
ERROR - 2024-03-18 14:18:10 --> 404 Page Not Found: /index
ERROR - 2024-03-18 14:18:10 --> 404 Page Not Found: /index
ERROR - 2024-03-18 14:34:58 --> 404 Page Not Found: /index
ERROR - 2024-03-18 14:34:58 --> 404 Page Not Found: /index
ERROR - 2024-03-18 14:38:16 --> 404 Page Not Found: /index
ERROR - 2024-03-18 14:38:16 --> 404 Page Not Found: /index
ERROR - 2024-03-18 15:13:44 --> Severity: error --> Exception: Call to undefined function status_inovasi() D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\manajemen_verifikator\views\inovasi\vpage.php 280
ERROR - 2024-03-18 15:13:46 --> Severity: error --> Exception: Call to undefined function status_inovasi() D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\manajemen_verifikator\views\inovasi\vpage.php 280
ERROR - 2024-03-18 15:13:49 --> Severity: error --> Exception: Call to undefined function status_inovasi() D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\manajemen_verifikator\views\inovasi\vpage.php 280
ERROR - 2024-03-18 15:13:52 --> Severity: error --> Exception: Call to undefined function status_inovasi() D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\manajemen_verifikator\views\inovasi\vpage.php 280
ERROR - 2024-03-18 15:19:08 --> 404 Page Not Found: /index
ERROR - 2024-03-18 15:19:08 --> 404 Page Not Found: /index
ERROR - 2024-03-18 15:20:11 --> 404 Page Not Found: /index
ERROR - 2024-03-18 15:20:11 --> 404 Page Not Found: /index
ERROR - 2024-03-18 15:21:15 --> 404 Page Not Found: /index
ERROR - 2024-03-18 15:21:16 --> 404 Page Not Found: /index
ERROR - 2024-03-18 15:21:47 --> 404 Page Not Found: /index
ERROR - 2024-03-18 15:21:47 --> 404 Page Not Found: /index
