<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-05-29 09:13:19 --> Severity: Warning --> Undefined property: CI::$mhome D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\third_party\MX\Controller.php 59
ERROR - 2024-05-29 09:13:19 --> Severity: error --> Exception: Call to a member function getInovasiYangDilaporkan() on null D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\home\controllers\Home.php 32
ERROR - 2024-05-29 09:13:34 --> Severity: Warning --> Undefined property: CI::$Mhome D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\third_party\MX\Controller.php 59
ERROR - 2024-05-29 09:13:34 --> Severity: error --> Exception: Call to a member function getInovasiYangDilaporkan() on null D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\home\controllers\Home.php 32
ERROR - 2024-05-29 09:13:36 --> Severity: Warning --> Undefined property: CI::$Mhome D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\third_party\MX\Controller.php 59
ERROR - 2024-05-29 09:13:36 --> Severity: error --> Exception: Call to a member function getInovasiYangDilaporkan() on null D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\home\controllers\Home.php 32
ERROR - 2024-05-29 09:16:10 --> Severity: Warning --> pg_query(): Query failed: ERROR:  table name &quot;b&quot; specified more than once D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-05-29 09:16:10 --> Query error: ERROR:  table name "b" specified more than once - Invalid query: SELECT "a"."id_menu", "a"."title_menu", (
                            CASE
                                    a.is_parent 
                                    WHEN 'Y' THEN
                                    a.url_menu 
                            ELSE
                                case lower(C.url_module)
                                    when lower(d.url_kontrol) then 
                                        case lower(e.url_fungsi)
                                            when 'index' then lower(C.url_module)
                                        else
                                            CONCAT(lower(C.url_module ), '/', lower(e.url_fungsi))
                                        END
                                else
                                        case lower(e.url_fungsi)
                                            when 'index' then CONCAT(lower(C.url_module), '/', lower(d.url_kontrol))
                                        else
                                            CONCAT(lower(C.url_module), '/', lower(d.url_kontrol), '/', lower(e.url_fungsi))
                                        END
                                end
                                
                            END 
                                ) AS url_menu, "a"."icon_menu", "a"."order_menu", "a"."id_rules", "a"."parent_id", "a"."is_parent"
FROM "xi_sa_menu" "a"
INNER JOIN "xi_sa_users" "b" ON "a"."create_by" = "b"."token"
LEFT JOIN "xi_sa_rules" "b" ON "b"."id_rules" = "a"."id_rules"
LEFT JOIN "xi_sa_module" "c" ON "c"."id_module" = "b"."id_module"
LEFT JOIN "xi_sa_kontrol" "d" ON "d"."id_kontrol" = "b"."id_kontrol"
LEFT JOIN "xi_sa_fungsi" "e" ON "e"."id_fungsi" = "b"."id_fungsi"
LEFT JOIN "xi_sa_group_privileges" "f" ON "f"."id_rules" = "b"."id_rules"
LEFT JOIN "xi_sa_group" "g" ON "g"."id_group" = "f"."id_group"
WHERE "a"."create_by" = '86515646A0B41A233182D192F4BB3492'
AND "a"."id_status" = 1
AND "b"."id_status" = 1
AND "c"."id_status" = 1
AND "d"."id_status" = 1
AND "e"."id_status" = 1
AND "f"."id_status" = 1
AND "g"."id_status" = 1
AND "g"."id_group" = '6'
ORDER BY "a"."id_menu" ASC, "a"."order_menu" ASC
ERROR - 2024-05-29 09:18:01 --> Severity: Warning --> file_get_contents(http://simpeg.bkd.sumbarprov.go.id/webapi/instansi/unit-kerja/utama/token/XBnKaywRCrj05m-XXX-v6DXuZ3FFkUgiw45): Failed to open stream: A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\manajemen\models\Model_users.php 376
ERROR - 2024-05-29 09:18:01 --> Severity: Warning --> Trying to access array offset on value of type null D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\manajemen\models\Model_users.php 379
ERROR - 2024-05-29 09:18:01 --> Severity: Warning --> foreach() argument must be of type array|object, null given D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\helpers\asset_helper.php 132
ERROR - 2024-05-29 09:18:01 --> Severity: error --> Exception: array_multisort(): Argument #3 must be an array or a sort flag D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\helpers\asset_helper.php 136
ERROR - 2024-05-29 09:28:17 --> Severity: Warning --> Undefined property: CI::$mindi D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\third_party\MX\Controller.php 59
ERROR - 2024-05-29 09:28:17 --> Severity: error --> Exception: Call to a member function getTotalBobotByIdInovasi() on null D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\home\controllers\Home.php 34
ERROR - 2024-05-29 09:28:33 --> Severity: error --> Exception: Unable to locate the model you have specified: Model_nilai_indikator D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\core\Loader.php 349
ERROR - 2024-05-29 09:28:49 --> Severity: error --> Exception: Unable to locate the model you have specified: Model_nilai_indikator D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\core\Loader.php 349
ERROR - 2024-05-29 09:28:50 --> Severity: error --> Exception: Unable to locate the model you have specified: Model_nilai_indikator D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\core\Loader.php 349
ERROR - 2024-05-29 09:29:56 --> Severity: error --> Exception: Too few arguments to function Mhome::getTotalBobotByIdInovasi(), 0 passed in D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\home\controllers\Home.php on line 34 and exactly 1 expected D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\home\models\Mhome.php 64
ERROR - 2024-05-29 09:30:07 --> Severity: error --> Exception: Too few arguments to function Mhome::getTotalBobotByIdInovasi(), 0 passed in D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\home\controllers\Home.php on line 34 and exactly 1 expected D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\home\models\Mhome.php 64
ERROR - 2024-05-29 09:30:39 --> Severity: error --> Exception: Call to undefined method Mhome::getTotalBobotByIdInovasi() D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\home\controllers\Home.php 34
ERROR - 2024-05-29 09:39:35 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column a.status_permohonan does not exist
LINE 4: WHERE &quot;a&quot;.&quot;status_permohonan&quot; = 1
              ^ D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-05-29 09:39:35 --> Query error: ERROR:  column a.status_permohonan does not exist
LINE 4: WHERE "a"."status_permohonan" = 1
              ^ - Invalid query: SELECT count(a.nilai_parameter) as total_parameter
FROM "ms_indikator_nilai" "a"
INNER JOIN "xi_sa_users" "b" ON "a"."create_by" = "b"."token"
WHERE "a"."status_permohonan" = 1
AND "a"."create_by" = '6F2F30DB98068AE993308CA4F11E20D2'
ERROR - 2024-05-29 09:39:40 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column a.status_permohonan does not exist
LINE 4: WHERE &quot;a&quot;.&quot;status_permohonan&quot; = 1
              ^ D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-05-29 09:39:40 --> Query error: ERROR:  column a.status_permohonan does not exist
LINE 4: WHERE "a"."status_permohonan" = 1
              ^ - Invalid query: SELECT count(a.nilai_parameter) as total_parameter
FROM "ms_indikator_nilai" "a"
INNER JOIN "xi_sa_users" "b" ON "a"."create_by" = "b"."token"
WHERE "a"."status_permohonan" = 1
ERROR - 2024-05-29 13:57:03 --> Severity: error --> Exception: count(): Argument #1 ($value) must be of type Countable|array, null given D:\APPLICATION\PHP\PHP8\2024\2024_kioonline\application\modules\auth\models\Model_auth_signin.php 182
ERROR - 2024-05-29 14:13:14 --> Could not find the language line "form_validation_custom_min_length"
ERROR - 2024-05-29 14:14:06 --> Could not find the language line "form_validation_custom_min_length"
ERROR - 2024-05-29 14:21:18 --> Could not find the language line "form_validation_custom_min_length"
ERROR - 2024-05-29 14:22:18 --> Could not find the language line "form_validation_custom_min_length"
ERROR - 2024-05-29 14:22:28 --> Could not find the language line "form_validation_custom_min_length"
