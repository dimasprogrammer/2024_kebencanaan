<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-02-02 09:41:45 --> Severity: error --> Exception: Call to undefined method Model_bentuk_inovasi::getDataJenisbentuk_inovasi() D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\master\controllers\Bentuk_inovasi.php 43
ERROR - 2024-02-02 09:42:06 --> Severity: Warning --> pg_query(): Query failed: ERROR:  relation &quot;xi_sa_jenis_bentuk_inovasi&quot; does not exist
LINE 2: FROM &quot;xi_sa_jenis_bentuk_inovasi&quot;
             ^ D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-02-02 09:42:06 --> Query error: ERROR:  relation "xi_sa_jenis_bentuk_inovasi" does not exist
LINE 2: FROM "xi_sa_jenis_bentuk_inovasi"
             ^ - Invalid query: SELECT *
FROM "xi_sa_jenis_bentuk_inovasi"
WHERE "id_status" = 1
ORDER BY "id_bentuk_inovasi" ASC
ERROR - 2024-02-02 09:42:55 --> Severity: Warning --> pg_query(): Query failed: ERROR:  relation &quot;xi_sa_jenis_bentuk_inovasi&quot; does not exist
LINE 2: FROM &quot;xi_sa_jenis_bentuk_inovasi&quot;
             ^ D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-02-02 09:42:55 --> Query error: ERROR:  relation "xi_sa_jenis_bentuk_inovasi" does not exist
LINE 2: FROM "xi_sa_jenis_bentuk_inovasi"
             ^ - Invalid query: SELECT *
FROM "xi_sa_jenis_bentuk_inovasi"
WHERE "id_status" = 1
ORDER BY "id_bentuk_inovasi" ASC
ERROR - 2024-02-02 09:43:49 --> 404 Page Not Found: ../modules/manajemen/controllers//index
ERROR - 2024-02-02 09:48:36 --> 404 Page Not Found: ../modules/manajemen/controllers//index
ERROR - 2024-02-02 09:50:04 --> 404 Page Not Found: ../modules/manajemen/controllers//index
ERROR - 2024-02-02 09:51:57 --> 404 Page Not Found: ../modules/manajemen/controllers//index
ERROR - 2024-02-02 09:52:01 --> 404 Page Not Found: /index
ERROR - 2024-02-02 09:52:02 --> 404 Page Not Found: /index
ERROR - 2024-02-02 09:52:03 --> 404 Page Not Found: /index
ERROR - 2024-02-02 09:52:03 --> 404 Page Not Found: /index
ERROR - 2024-02-02 09:52:03 --> 404 Page Not Found: ../modules/manajemen/controllers//index
ERROR - 2024-02-02 09:52:44 --> 404 Page Not Found: /index
ERROR - 2024-02-02 09:52:45 --> 404 Page Not Found: /index
ERROR - 2024-02-02 09:52:45 --> 404 Page Not Found: ../modules/manajemen/controllers//index
ERROR - 2024-02-02 09:53:09 --> 404 Page Not Found: ../modules/manajemen/controllers//index
ERROR - 2024-02-02 09:53:12 --> 404 Page Not Found: /index
ERROR - 2024-02-02 09:53:13 --> 404 Page Not Found: /index
ERROR - 2024-02-02 09:53:15 --> 404 Page Not Found: /index
ERROR - 2024-02-02 09:53:15 --> 404 Page Not Found: /index
ERROR - 2024-02-02 09:53:15 --> 404 Page Not Found: ../modules/manajemen/controllers//index
ERROR - 2024-02-02 09:53:19 --> 404 Page Not Found: /index
ERROR - 2024-02-02 09:53:19 --> 404 Page Not Found: /index
ERROR - 2024-02-02 09:53:19 --> 404 Page Not Found: ../modules/manajemen/controllers//index
ERROR - 2024-02-02 09:53:27 --> 404 Page Not Found: /index
ERROR - 2024-02-02 09:53:27 --> 404 Page Not Found: /index
ERROR - 2024-02-02 09:53:27 --> 404 Page Not Found: ../modules/manajemen/controllers//index
ERROR - 2024-02-02 10:01:38 --> 404 Page Not Found: /index
ERROR - 2024-02-02 10:01:38 --> 404 Page Not Found: /index
ERROR - 2024-02-02 10:01:38 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column a.nm_inovasi does not exist
LINE 1: SELECT &quot;a&quot;.&quot;id_bentuk_inovasi&quot;, &quot;a&quot;.&quot;nm_inovasi&quot;, &quot;a&quot;.&quot;deskr...
                                        ^ D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-02-02 10:01:38 --> Query error: ERROR:  column a.nm_inovasi does not exist
LINE 1: SELECT "a"."id_bentuk_inovasi", "a"."nm_inovasi", "a"."deskr...
                                        ^ - Invalid query: SELECT "a"."id_bentuk_inovasi", "a"."nm_inovasi", "a"."deskripsi", "a"."id_status"
FROM "cx_bentuk_inovasi" "a"
ORDER BY "a"."id_bentuk_inovasi" ASC
 LIMIT 10
ERROR - 2024-02-02 10:02:20 --> 404 Page Not Found: /index
ERROR - 2024-02-02 10:02:20 --> 404 Page Not Found: /index
ERROR - 2024-02-02 13:47:53 --> Severity: error --> Exception: count(): Argument #1 ($value) must be of type Countable|array, null given D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\auth\models\Model_auth_signin.php 182
ERROR - 2024-02-02 13:59:53 --> 404 Page Not Found: /index
ERROR - 2024-02-02 13:59:53 --> 404 Page Not Found: /index
ERROR - 2024-02-02 13:59:55 --> 404 Page Not Found: /index
ERROR - 2024-02-02 13:59:55 --> 404 Page Not Found: /index
ERROR - 2024-02-02 14:00:27 --> 404 Page Not Found: /index
ERROR - 2024-02-02 14:00:27 --> 404 Page Not Found: /index
ERROR - 2024-02-02 14:00:31 --> Severity: Warning --> pg_query(): Query failed: ERROR:  duplicate key value violates unique constraint &quot;wil_regency_copy1_pkey1&quot;
DETAIL:  Key (id_bentuk_inovasi)=(1) already exists. D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-02-02 14:00:31 --> Query error: ERROR:  duplicate key value violates unique constraint "wil_regency_copy1_pkey1"
DETAIL:  Key (id_bentuk_inovasi)=(1) already exists. - Invalid query: INSERT INTO "cx_bentuk_inovasi" ("nm_bentuk", "deskripsi", "create_by", "create_date", "create_ip", "mod_by", "mod_date", "mod_ip", "id_status") VALUES ('asdfasd', 'asdfa', 'michael', '2024-02-02 14:00:31', '::1', 'michael', '2024-02-02 14:00:31', '::1', '1')
ERROR - 2024-02-02 14:01:05 --> 404 Page Not Found: /index
ERROR - 2024-02-02 14:01:05 --> 404 Page Not Found: /index
ERROR - 2024-02-02 14:01:09 --> Severity: Warning --> pg_query(): Query failed: ERROR:  duplicate key value violates unique constraint &quot;wil_regency_copy1_pkey1&quot;
DETAIL:  Key (id_bentuk_inovasi)=(2) already exists. D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-02-02 14:01:09 --> Query error: ERROR:  duplicate key value violates unique constraint "wil_regency_copy1_pkey1"
DETAIL:  Key (id_bentuk_inovasi)=(2) already exists. - Invalid query: INSERT INTO "cx_bentuk_inovasi" ("nm_bentuk", "deskripsi", "create_by", "create_date", "create_ip", "mod_by", "mod_date", "mod_ip", "id_status") VALUES ('asdfasd', 'asdad', 'michael', '2024-02-02 14:01:09', '::1', 'michael', '2024-02-02 14:01:09', '::1', '1')
ERROR - 2024-02-02 14:02:10 --> 404 Page Not Found: /index
ERROR - 2024-02-02 14:02:10 --> 404 Page Not Found: /index
ERROR - 2024-02-02 14:04:03 --> 404 Page Not Found: /index
ERROR - 2024-02-02 14:04:03 --> 404 Page Not Found: /index
ERROR - 2024-02-02 14:05:26 --> 404 Page Not Found: /index
ERROR - 2024-02-02 14:05:26 --> 404 Page Not Found: /index
ERROR - 2024-02-02 14:05:43 --> 404 Page Not Found: /index
ERROR - 2024-02-02 14:05:44 --> 404 Page Not Found: /index
ERROR - 2024-02-02 14:06:36 --> 404 Page Not Found: /index
ERROR - 2024-02-02 14:06:36 --> 404 Page Not Found: /index
ERROR - 2024-02-02 14:06:46 --> Severity: error --> Exception: Call to undefined method Model_bentuk_inovasi::updateDataBentukInovasi() D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\master\controllers\Bentuk_inovasi.php 134
ERROR - 2024-02-02 14:06:53 --> 404 Page Not Found: /index
ERROR - 2024-02-02 14:06:53 --> 404 Page Not Found: /index
ERROR - 2024-02-02 14:06:56 --> 404 Page Not Found: /index
ERROR - 2024-02-02 14:06:56 --> 404 Page Not Found: /index
ERROR - 2024-02-02 14:07:14 --> Severity: error --> Exception: Call to undefined method Model_bentuk_inovasi::updateDataBentukInovasi() D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\master\controllers\Bentuk_inovasi.php 134
ERROR - 2024-02-02 14:07:30 --> 404 Page Not Found: /index
ERROR - 2024-02-02 14:07:30 --> 404 Page Not Found: /index
ERROR - 2024-02-02 14:18:26 --> 404 Page Not Found: /index
ERROR - 2024-02-02 14:18:26 --> 404 Page Not Found: /index
ERROR - 2024-02-02 14:18:28 --> 404 Page Not Found: /index
ERROR - 2024-02-02 14:18:28 --> 404 Page Not Found: /index
ERROR - 2024-02-02 14:19:01 --> 404 Page Not Found: /index
ERROR - 2024-02-02 14:19:01 --> 404 Page Not Found: /index
ERROR - 2024-02-02 14:19:27 --> Severity: Warning --> pg_query(): Query failed: ERROR:  invalid input syntax for type smallint: &quot;&quot;
LINE 1: ...:19:27', '::1', 'michael', '2024-02-02 14:19:27', '::1', '')
                                                                    ^ D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-02-02 14:19:27 --> Query error: ERROR:  invalid input syntax for type smallint: ""
LINE 1: ...:19:27', '::1', 'michael', '2024-02-02 14:19:27', '::1', '')
                                                                    ^ - Invalid query: INSERT INTO "cx_tematik" ("nm_tematik", "deskripsi", "create_by", "create_date", "create_ip", "mod_by", "mod_date", "mod_ip", "id_status") VALUES ('dfasdf', 'asdfasd', 'michael', '2024-02-02 14:19:27', '::1', 'michael', '2024-02-02 14:19:27', '::1', '')
ERROR - 2024-02-02 14:19:53 --> 404 Page Not Found: /index
ERROR - 2024-02-02 14:19:53 --> 404 Page Not Found: /index
ERROR - 2024-02-02 14:19:56 --> Severity: Warning --> pg_query(): Query failed: ERROR:  invalid input syntax for type smallint: &quot;&quot;
LINE 1: ...:19:56', '::1', 'michael', '2024-02-02 14:19:56', '::1', '')
                                                                    ^ D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-02-02 14:19:56 --> Query error: ERROR:  invalid input syntax for type smallint: ""
LINE 1: ...:19:56', '::1', 'michael', '2024-02-02 14:19:56', '::1', '')
                                                                    ^ - Invalid query: INSERT INTO "cx_tematik" ("nm_tematik", "deskripsi", "create_by", "create_date", "create_ip", "mod_by", "mod_date", "mod_ip", "id_status") VALUES ('adsf', 'sadfasd', 'michael', '2024-02-02 14:19:56', '::1', 'michael', '2024-02-02 14:19:56', '::1', '')
ERROR - 2024-02-02 14:21:26 --> 404 Page Not Found: /index
ERROR - 2024-02-02 14:21:26 --> 404 Page Not Found: /index
ERROR - 2024-02-02 14:21:30 --> Severity: Warning --> pg_query(): Query failed: ERROR:  invalid input syntax for type smallint: &quot;&quot;
LINE 1: ...:21:30', '::1', 'michael', '2024-02-02 14:21:30', '::1', '')
                                                                    ^ D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-02-02 14:21:30 --> Query error: ERROR:  invalid input syntax for type smallint: ""
LINE 1: ...:21:30', '::1', 'michael', '2024-02-02 14:21:30', '::1', '')
                                                                    ^ - Invalid query: INSERT INTO "cx_tematik" ("nm_tematik", "deskripsi", "create_by", "create_date", "create_ip", "mod_by", "mod_date", "mod_ip", "id_status") VALUES ('adsfasd', 'fasdfasd', 'michael', '2024-02-02 14:21:30', '::1', 'michael', '2024-02-02 14:21:30', '::1', '')
ERROR - 2024-02-02 14:49:54 --> 404 Page Not Found: /index
ERROR - 2024-02-02 14:49:55 --> 404 Page Not Found: /index
ERROR - 2024-02-02 14:49:59 --> Severity: Warning --> pg_query(): Query failed: ERROR:  invalid input syntax for type smallint: &quot;&quot;
LINE 1: ...:49:59', '::1', 'michael', '2024-02-02 14:49:59', '::1', '')
                                                                    ^ D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-02-02 14:49:59 --> Query error: ERROR:  invalid input syntax for type smallint: ""
LINE 1: ...:49:59', '::1', 'michael', '2024-02-02 14:49:59', '::1', '')
                                                                    ^ - Invalid query: INSERT INTO "cx_tematik" ("nm_tematik", "deskripsi", "create_by", "create_date", "create_ip", "mod_by", "mod_date", "mod_ip", "id_status") VALUES ('fdgsdf', 'sdfgsdf', 'michael', '2024-02-02 14:49:59', '::1', 'michael', '2024-02-02 14:49:59', '::1', '')
ERROR - 2024-02-02 14:52:05 --> 404 Page Not Found: /index
ERROR - 2024-02-02 14:52:05 --> 404 Page Not Found: /index
ERROR - 2024-02-02 14:52:37 --> 404 Page Not Found: /index
ERROR - 2024-02-02 14:52:37 --> 404 Page Not Found: /index
ERROR - 2024-02-02 14:53:33 --> 404 Page Not Found: /index
ERROR - 2024-02-02 14:53:33 --> 404 Page Not Found: /index
ERROR - 2024-02-02 14:53:36 --> Severity: Warning --> pg_query(): Query failed: ERROR:  invalid input syntax for type smallint: &quot;&quot;
LINE 1: ...:53:36', '::1', 'michael', '2024-02-02 14:53:36', '::1', '')
                                                                    ^ D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-02-02 14:53:36 --> Query error: ERROR:  invalid input syntax for type smallint: ""
LINE 1: ...:53:36', '::1', 'michael', '2024-02-02 14:53:36', '::1', '')
                                                                    ^ - Invalid query: INSERT INTO "cx_tematik" ("nm_tematik", "deskripsi", "create_by", "create_date", "create_ip", "mod_by", "mod_date", "mod_ip", "id_status") VALUES ('asdfasd', 'asdfasd', 'michael', '2024-02-02 14:53:36', '::1', 'michael', '2024-02-02 14:53:36', '::1', '')
ERROR - 2024-02-02 14:54:23 --> 404 Page Not Found: /index
ERROR - 2024-02-02 14:54:23 --> 404 Page Not Found: /index
ERROR - 2024-02-02 14:54:27 --> Severity: Warning --> pg_query(): Query failed: ERROR:  invalid input syntax for type smallint: &quot;&quot;
LINE 1: ...:54:27', '::1', 'michael', '2024-02-02 14:54:27', '::1', '')
                                                                    ^ D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-02-02 14:54:27 --> Query error: ERROR:  invalid input syntax for type smallint: ""
LINE 1: ...:54:27', '::1', 'michael', '2024-02-02 14:54:27', '::1', '')
                                                                    ^ - Invalid query: INSERT INTO "cx_tematik" ("nm_tematik", "deskripsi", "create_by", "create_date", "create_ip", "mod_by", "mod_date", "mod_ip", "id_status") VALUES ('adfasd', 'fasd', 'michael', '2024-02-02 14:54:27', '::1', 'michael', '2024-02-02 14:54:27', '::1', '')
ERROR - 2024-02-02 15:13:21 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:13:21 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:13:24 --> Severity: Warning --> pg_query(): Query failed: ERROR:  invalid input syntax for type smallint: &quot;&quot;
LINE 1: ...:13:24', '::1', 'michael', '2024-02-02 15:13:24', '::1', '')
                                                                    ^ D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-02-02 15:13:24 --> Query error: ERROR:  invalid input syntax for type smallint: ""
LINE 1: ...:13:24', '::1', 'michael', '2024-02-02 15:13:24', '::1', '')
                                                                    ^ - Invalid query: INSERT INTO "cx_tematik" ("nm_tematik", "deskripsi", "create_by", "create_date", "create_ip", "mod_by", "mod_date", "mod_ip", "id_status") VALUES ('adfas', 'dfasd', 'michael', '2024-02-02 15:13:24', '::1', 'michael', '2024-02-02 15:13:24', '::1', '')
ERROR - 2024-02-02 15:14:01 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:14:01 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:17:48 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:17:48 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:18:07 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:18:07 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:18:10 --> Severity: Warning --> pg_query(): Query failed: ERROR:  invalid input syntax for type integer: &quot;&quot;
LINE 1: ...:18:10', '::1', 'michael', '2024-02-02 15:18:10', '::1', '')
                                                                    ^ D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-02-02 15:18:10 --> Query error: ERROR:  invalid input syntax for type integer: ""
LINE 1: ...:18:10', '::1', 'michael', '2024-02-02 15:18:10', '::1', '')
                                                                    ^ - Invalid query: INSERT INTO "cx_tematik" ("nm_tematik", "deskripsi", "create_by", "create_date", "create_ip", "mod_by", "mod_date", "mod_ip", "id_status") VALUES ('dddd', 'dddd', 'michael', '2024-02-02 15:18:10', '::1', 'michael', '2024-02-02 15:18:10', '::1', '')
ERROR - 2024-02-02 15:19:15 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:19:16 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:19:22 --> Severity: Warning --> pg_query(): Query failed: ERROR:  invalid input syntax for type integer: &quot;&quot;
LINE 1: ...:19:22', '::1', 'michael', '2024-02-02 15:19:22', '::1', '')
                                                                    ^ D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-02-02 15:19:22 --> Query error: ERROR:  invalid input syntax for type integer: ""
LINE 1: ...:19:22', '::1', 'michael', '2024-02-02 15:19:22', '::1', '')
                                                                    ^ - Invalid query: INSERT INTO "cx_tematik" ("nm_tematik", "deskripsi", "create_by", "create_date", "create_ip", "mod_by", "mod_date", "mod_ip", "id_status") VALUES ('adsf', 'asdfasd', 'michael', '2024-02-02 15:19:22', '::1', 'michael', '2024-02-02 15:19:22', '::1', '')
ERROR - 2024-02-02 15:19:44 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:19:44 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:19:47 --> Severity: Warning --> pg_query(): Query failed: ERROR:  invalid input syntax for type integer: &quot;&quot;
LINE 1: ...:19:47', '::1', 'michael', '2024-02-02 15:19:47', '::1', '')
                                                                    ^ D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-02-02 15:19:47 --> Query error: ERROR:  invalid input syntax for type integer: ""
LINE 1: ...:19:47', '::1', 'michael', '2024-02-02 15:19:47', '::1', '')
                                                                    ^ - Invalid query: INSERT INTO "cx_tematik" ("nm_tematik", "deskripsi", "create_by", "create_date", "create_ip", "mod_by", "mod_date", "mod_ip", "id_status") VALUES ('adsfasd', 'fasdfasd', 'michael', '2024-02-02 15:19:47', '::1', 'michael', '2024-02-02 15:19:47', '::1', '')
ERROR - 2024-02-02 15:22:21 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:22:21 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:22:25 --> Severity: Warning --> pg_query(): Query failed: ERROR:  invalid input syntax for type integer: &quot;&quot;
LINE 1: ...:22:25', '::1', 'michael', '2024-02-02 15:22:25', '::1', '')
                                                                    ^ D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-02-02 15:22:25 --> Query error: ERROR:  invalid input syntax for type integer: ""
LINE 1: ...:22:25', '::1', 'michael', '2024-02-02 15:22:25', '::1', '')
                                                                    ^ - Invalid query: INSERT INTO "cx_tematik" ("nm_tematik", "deskripsi", "create_by", "create_date", "create_ip", "mod_by", "mod_date", "mod_ip", "id_status") VALUES ('adfasd', 'asdfasd', 'michael', '2024-02-02 15:22:25', '::1', 'michael', '2024-02-02 15:22:25', '::1', '')
ERROR - 2024-02-02 15:23:34 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:23:34 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:23:42 --> Severity: Warning --> pg_query(): Query failed: ERROR:  invalid input syntax for type integer: &quot;&quot;
LINE 1: ...:23:42', '::1', 'michael', '2024-02-02 15:23:42', '::1', '')
                                                                    ^ D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-02-02 15:23:42 --> Query error: ERROR:  invalid input syntax for type integer: ""
LINE 1: ...:23:42', '::1', 'michael', '2024-02-02 15:23:42', '::1', '')
                                                                    ^ - Invalid query: INSERT INTO "cx_tematik" ("nm_tematik", "deskripsi", "create_by", "create_date", "create_ip", "mod_by", "mod_date", "mod_ip", "id_status") VALUES ('adfasdasdfas', 'asdfasd', 'michael', '2024-02-02 15:23:42', '::1', 'michael', '2024-02-02 15:23:42', '::1', '')
ERROR - 2024-02-02 15:24:19 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:24:19 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:24:22 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:24:22 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:24:25 --> Severity: Warning --> pg_query(): Query failed: ERROR:  invalid input syntax for type integer: &quot;&quot;
LINE 1: ...:24:25', '::1', 'michael', '2024-02-02 15:24:25', '::1', '')
                                                                    ^ D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-02-02 15:24:25 --> Query error: ERROR:  invalid input syntax for type integer: ""
LINE 1: ...:24:25', '::1', 'michael', '2024-02-02 15:24:25', '::1', '')
                                                                    ^ - Invalid query: INSERT INTO "cx_tematik" ("nm_tematik", "deskripsi", "create_by", "create_date", "create_ip", "mod_by", "mod_date", "mod_ip", "id_status") VALUES ('adfasd', 'asdfasd', 'michael', '2024-02-02 15:24:25', '::1', 'michael', '2024-02-02 15:24:25', '::1', '')
ERROR - 2024-02-02 15:24:40 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:24:40 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:24:43 --> Severity: Warning --> pg_query(): Query failed: ERROR:  invalid input syntax for type integer: &quot;&quot;
LINE 1: ...:24:43', '::1', 'michael', '2024-02-02 15:24:43', '::1', '')
                                                                    ^ D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-02-02 15:24:43 --> Query error: ERROR:  invalid input syntax for type integer: ""
LINE 1: ...:24:43', '::1', 'michael', '2024-02-02 15:24:43', '::1', '')
                                                                    ^ - Invalid query: INSERT INTO "cx_tematik" ("nm_tematik", "deskripsi", "create_by", "create_date", "create_ip", "mod_by", "mod_date", "mod_ip", "id_status") VALUES ('adfasd', 'asdfasd', 'michael', '2024-02-02 15:24:43', '::1', 'michael', '2024-02-02 15:24:43', '::1', '')
ERROR - 2024-02-02 15:27:08 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:27:08 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:27:11 --> Severity: Warning --> pg_query(): Query failed: ERROR:  invalid input syntax for type smallint: &quot;&quot;
LINE 1: ...:27:11', '::1', 'michael', '2024-02-02 15:27:11', '::1', '')
                                                                    ^ D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-02-02 15:27:11 --> Query error: ERROR:  invalid input syntax for type smallint: ""
LINE 1: ...:27:11', '::1', 'michael', '2024-02-02 15:27:11', '::1', '')
                                                                    ^ - Invalid query: INSERT INTO "cx_tematik" ("nm_tematik", "deskripsi", "create_by", "create_date", "create_ip", "mod_by", "mod_date", "mod_ip", "id_status") VALUES ('adfasd', 'asdfasd', 'michael', '2024-02-02 15:27:11', '::1', 'michael', '2024-02-02 15:27:11', '::1', '')
ERROR - 2024-02-02 15:27:48 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:27:48 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:27:51 --> Severity: Warning --> pg_query(): Query failed: ERROR:  invalid input syntax for type smallint: &quot;&quot;
LINE 1: ...:27:51', '::1', 'michael', '2024-02-02 15:27:51', '::1', '')
                                                                    ^ D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-02-02 15:27:51 --> Query error: ERROR:  invalid input syntax for type smallint: ""
LINE 1: ...:27:51', '::1', 'michael', '2024-02-02 15:27:51', '::1', '')
                                                                    ^ - Invalid query: INSERT INTO "cx_tematik" ("nm_tematik", "deskripsi", "create_by", "create_date", "create_ip", "mod_by", "mod_date", "mod_ip", "id_status") VALUES ('adfasd', 'asdfasd', 'michael', '2024-02-02 15:27:51', '::1', 'michael', '2024-02-02 15:27:51', '::1', '')
ERROR - 2024-02-02 15:28:00 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:28:00 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:28:03 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:28:04 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:28:04 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:28:07 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:28:07 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:28:24 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:28:24 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:28:56 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:28:56 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:29:15 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:29:15 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:29:59 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:29:59 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:30:33 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:30:33 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:30:35 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column &quot;id_inovasi&quot; does not exist
LINE 3: WHERE &quot;id_inovasi&quot; = 6
              ^ D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-02-02 15:30:35 --> Query error: ERROR:  column "id_inovasi" does not exist
LINE 3: WHERE "id_inovasi" = 6
              ^ - Invalid query: SELECT COUNT(*) AS "numrows"
FROM "xi_sa_rules"
WHERE "id_inovasi" = 6
ERROR - 2024-02-02 15:30:37 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:30:37 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:30:48 --> Severity: Warning --> pg_query(): Query failed: ERROR:  invalid input syntax for type smallint: &quot;&quot;
LINE 1: ...:30:48', '::1', 'michael', '2024-02-02 15:30:48', '::1', '')
                                                                    ^ D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-02-02 15:30:48 --> Query error: ERROR:  invalid input syntax for type smallint: ""
LINE 1: ...:30:48', '::1', 'michael', '2024-02-02 15:30:48', '::1', '')
                                                                    ^ - Invalid query: INSERT INTO "cx_bentuk_inovasi" ("nm_bentuk", "deskripsi", "create_by", "create_date", "create_ip", "mod_by", "mod_date", "mod_ip", "id_status") VALUES ('adfasd', 'adsfasd', 'michael', '2024-02-02 15:30:48', '::1', 'michael', '2024-02-02 15:30:48', '::1', '')
ERROR - 2024-02-02 15:31:22 --> Severity: Warning --> pg_query(): Query failed: ERROR:  invalid input syntax for type smallint: &quot;&quot;
LINE 1: ...:31:22', '::1', 'michael', '2024-02-02 15:31:22', '::1', '')
                                                                    ^ D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-02-02 15:31:22 --> Query error: ERROR:  invalid input syntax for type smallint: ""
LINE 1: ...:31:22', '::1', 'michael', '2024-02-02 15:31:22', '::1', '')
                                                                    ^ - Invalid query: INSERT INTO "cx_bentuk_inovasi" ("nm_bentuk", "deskripsi", "create_by", "create_date", "create_ip", "mod_by", "mod_date", "mod_ip", "id_status") VALUES ('ddd', 'ddd', 'michael', '2024-02-02 15:31:22', '::1', 'michael', '2024-02-02 15:31:22', '::1', '')
ERROR - 2024-02-02 15:31:25 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:31:25 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:31:26 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:31:26 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:31:30 --> Severity: Warning --> pg_query(): Query failed: ERROR:  invalid input syntax for type smallint: &quot;&quot;
LINE 1: ...:31:30', '::1', 'michael', '2024-02-02 15:31:30', '::1', '')
                                                                    ^ D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-02-02 15:31:30 --> Query error: ERROR:  invalid input syntax for type smallint: ""
LINE 1: ...:31:30', '::1', 'michael', '2024-02-02 15:31:30', '::1', '')
                                                                    ^ - Invalid query: INSERT INTO "cx_bentuk_inovasi" ("nm_bentuk", "deskripsi", "create_by", "create_date", "create_ip", "mod_by", "mod_date", "mod_ip", "id_status") VALUES ('dd', 'ddd', 'michael', '2024-02-02 15:31:30', '::1', 'michael', '2024-02-02 15:31:30', '::1', '')
ERROR - 2024-02-02 15:32:07 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:32:07 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:32:10 --> Severity: Warning --> pg_query(): Query failed: ERROR:  invalid input syntax for type smallint: &quot;&quot;
LINE 1: ...:32:10', '::1', 'michael', '2024-02-02 15:32:10', '::1', '')
                                                                    ^ D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-02-02 15:32:10 --> Query error: ERROR:  invalid input syntax for type smallint: ""
LINE 1: ...:32:10', '::1', 'michael', '2024-02-02 15:32:10', '::1', '')
                                                                    ^ - Invalid query: INSERT INTO "cx_bentuk_inovasi" ("nm_bentuk", "deskripsi", "create_by", "create_date", "create_ip", "mod_by", "mod_date", "mod_ip", "id_status") VALUES ('adf', 'adsfasd', 'michael', '2024-02-02 15:32:10', '::1', 'michael', '2024-02-02 15:32:10', '::1', '')
ERROR - 2024-02-02 15:59:30 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:59:30 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:59:35 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:59:35 --> 404 Page Not Found: /index
ERROR - 2024-02-02 15:59:36 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column a.id_status does not exist
LINE 1: ....&quot;id_tematik&quot;, &quot;a&quot;.&quot;nm_tematik&quot;, &quot;a&quot;.&quot;deskripsi&quot;, &quot;a&quot;.&quot;id_st...
                                                             ^ D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-02-02 15:59:36 --> Query error: ERROR:  column a.id_status does not exist
LINE 1: ...."id_tematik", "a"."nm_tematik", "a"."deskripsi", "a"."id_st...
                                                             ^ - Invalid query: SELECT "a"."id_tematik", "a"."nm_tematik", "a"."deskripsi", "a"."id_status"
FROM "cx_tematik" "a"
ORDER BY "a"."id_tematik" ASC
 LIMIT 10
ERROR - 2024-02-02 16:00:34 --> 404 Page Not Found: /index
ERROR - 2024-02-02 16:00:34 --> 404 Page Not Found: /index
ERROR - 2024-02-02 16:00:39 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column &quot;create_by&quot; of relation &quot;cx_tematik&quot; does not exist
LINE 1: ...ERT INTO &quot;cx_tematik&quot; (&quot;nm_tematik&quot;, &quot;deskripsi&quot;, &quot;create_by...
                                                             ^ D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-02-02 16:00:39 --> Query error: ERROR:  column "create_by" of relation "cx_tematik" does not exist
LINE 1: ...ERT INTO "cx_tematik" ("nm_tematik", "deskripsi", "create_by...
                                                             ^ - Invalid query: INSERT INTO "cx_tematik" ("nm_tematik", "deskripsi", "create_by", "create_date", "create_ip", "mod_by", "mod_date", "mod_ip", "id_status") VALUES ('adfasd', 'asdfasd', 'michael', '2024-02-02 16:00:39', '::1', 'michael', '2024-02-02 16:00:39', '::1', '')
ERROR - 2024-02-02 16:00:58 --> 404 Page Not Found: /index
ERROR - 2024-02-02 16:00:58 --> 404 Page Not Found: /index
ERROR - 2024-02-02 16:01:01 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column &quot;create_by&quot; of relation &quot;cx_tematik&quot; does not exist
LINE 1: ...ERT INTO &quot;cx_tematik&quot; (&quot;nm_tematik&quot;, &quot;deskripsi&quot;, &quot;create_by...
                                                             ^ D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-02-02 16:01:01 --> Query error: ERROR:  column "create_by" of relation "cx_tematik" does not exist
LINE 1: ...ERT INTO "cx_tematik" ("nm_tematik", "deskripsi", "create_by...
                                                             ^ - Invalid query: INSERT INTO "cx_tematik" ("nm_tematik", "deskripsi", "create_by", "create_date", "create_ip", "mod_by", "mod_date", "mod_ip", "id_status") VALUES ('asdfasd', 'fasfasdf', 'michael', '2024-02-02 16:01:01', '::1', 'michael', '2024-02-02 16:01:01', '::1', '')
ERROR - 2024-02-02 16:01:49 --> 404 Page Not Found: /index
ERROR - 2024-02-02 16:01:49 --> 404 Page Not Found: /index
ERROR - 2024-02-02 16:01:52 --> Severity: Warning --> pg_query(): Query failed: ERROR:  invalid input syntax for type integer: &quot;&quot;
LINE 1: ...k&quot;, &quot;deskripsi&quot;, &quot;id_status&quot;) VALUES ('asdf', 'asdfasd', '')
                                                                    ^ D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-02-02 16:01:52 --> Query error: ERROR:  invalid input syntax for type integer: ""
LINE 1: ...k", "deskripsi", "id_status") VALUES ('asdf', 'asdfasd', '')
                                                                    ^ - Invalid query: INSERT INTO "cx_tematik" ("nm_tematik", "deskripsi", "id_status") VALUES ('asdf', 'asdfasd', '')
ERROR - 2024-02-02 16:34:18 --> 404 Page Not Found: /index
ERROR - 2024-02-02 16:34:18 --> 404 Page Not Found: /index
ERROR - 2024-02-02 16:34:27 --> Severity: Warning --> pg_query(): Query failed: ERROR:  invalid input syntax for type integer: &quot;&quot;
LINE 1: ...ik&quot;, &quot;deskripsi&quot;, &quot;id_status&quot;) VALUES ('adfasd', 'dfsd', '')
                                                                    ^ D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-02-02 16:34:27 --> Query error: ERROR:  invalid input syntax for type integer: ""
LINE 1: ...ik", "deskripsi", "id_status") VALUES ('adfasd', 'dfsd', '')
                                                                    ^ - Invalid query: INSERT INTO "cx_tematik" ("nm_tematik", "deskripsi", "id_status") VALUES ('adfasd', 'dfsd', '')
ERROR - 2024-02-02 16:35:37 --> 404 Page Not Found: /index
ERROR - 2024-02-02 16:35:37 --> 404 Page Not Found: /index
ERROR - 2024-02-02 16:35:42 --> Severity: Warning --> pg_query(): Query failed: ERROR:  invalid input syntax for type smallint: &quot;&quot;
LINE 1: ...k&quot;, &quot;deskripsi&quot;, &quot;id_status&quot;) VALUES ('adfas', 'dfasdf', '')
                                                                    ^ D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-02-02 16:35:42 --> Query error: ERROR:  invalid input syntax for type smallint: ""
LINE 1: ...k", "deskripsi", "id_status") VALUES ('adfas', 'dfasdf', '')
                                                                    ^ - Invalid query: INSERT INTO "cx_tematik" ("nm_tematik", "deskripsi", "id_status") VALUES ('adfas', 'dfasdf', '')
ERROR - 2024-02-02 16:37:36 --> 404 Page Not Found: /index
ERROR - 2024-02-02 16:37:36 --> 404 Page Not Found: /index
ERROR - 2024-02-02 16:37:41 --> Severity: Warning --> pg_query(): Query failed: ERROR:  invalid input syntax for type smallint: &quot;&quot;
LINE 1: ..., &quot;deskripsi&quot;, &quot;id_status&quot;) VALUES ('adfasd', 'sdfgsdf', '')
                                                                    ^ D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-02-02 16:37:41 --> Query error: ERROR:  invalid input syntax for type smallint: ""
LINE 1: ..., "deskripsi", "id_status") VALUES ('adfasd', 'sdfgsdf', '')
                                                                    ^ - Invalid query: INSERT INTO "cx_tematik" ("nm_tematik", "deskripsi", "id_status") VALUES ('adfasd', 'sdfgsdf', '')
ERROR - 2024-02-02 16:38:17 --> 404 Page Not Found: /index
ERROR - 2024-02-02 16:38:17 --> 404 Page Not Found: /index
ERROR - 2024-02-02 16:38:21 --> Severity: Warning --> pg_query(): Query failed: ERROR:  invalid input syntax for type integer: &quot;&quot;
LINE 1: ...ik&quot;, &quot;deskripsi&quot;, &quot;id_status&quot;) VALUES ('adsf', 'adfasd', '')
                                                                    ^ D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-02-02 16:38:21 --> Query error: ERROR:  invalid input syntax for type integer: ""
LINE 1: ...ik", "deskripsi", "id_status") VALUES ('adsf', 'adfasd', '')
                                                                    ^ - Invalid query: INSERT INTO "cx_tematik" ("nm_tematik", "deskripsi", "id_status") VALUES ('adsf', 'adfasd', '')
ERROR - 2024-02-02 16:40:42 --> 404 Page Not Found: /index
ERROR - 2024-02-02 16:40:42 --> 404 Page Not Found: /index
ERROR - 2024-02-02 16:41:19 --> 404 Page Not Found: /index
ERROR - 2024-02-02 16:41:19 --> 404 Page Not Found: /index
ERROR - 2024-02-02 16:41:49 --> 404 Page Not Found: /index
ERROR - 2024-02-02 16:41:49 --> 404 Page Not Found: /index
ERROR - 2024-02-02 16:42:28 --> 404 Page Not Found: /index
ERROR - 2024-02-02 16:42:28 --> 404 Page Not Found: /index
ERROR - 2024-02-02 16:43:25 --> 404 Page Not Found: /index
ERROR - 2024-02-02 16:43:25 --> 404 Page Not Found: /index
ERROR - 2024-02-02 16:44:04 --> 404 Page Not Found: /index
ERROR - 2024-02-02 16:44:04 --> 404 Page Not Found: /index
