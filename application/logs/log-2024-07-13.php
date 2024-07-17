<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-07-13 14:13:20 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column a.jam_bencana does not exist
LINE 1: ...cana&quot;, &quot;a&quot;.&quot;nama_bencana&quot;, &quot;a&quot;.&quot;tanggal_bencana&quot;, &quot;a&quot;.&quot;jam_b...
                                                             ^
HINT:  Perhaps you meant to reference the column &quot;a.nama_bencana&quot;. D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-07-13 14:13:21 --> Query error: ERROR:  column a.jam_bencana does not exist
LINE 1: ...cana", "a"."nama_bencana", "a"."tanggal_bencana", "a"."jam_b...
                                                             ^
HINT:  Perhaps you meant to reference the column "a.nama_bencana". - Invalid query: SELECT "a"."id_bencana", "a"."token_bencana", "a"."nama_bencana", "a"."tanggal_bencana", "a"."jam_bencana", "a"."id_status", "b"."nm_bencana"
FROM "ms_bencana" "a"
INNER JOIN "cx_jenis_bencana" "b" ON "a"."id_jenis_bencana" = "b"."id_jenis_bencana"
ORDER BY "a"."id_bencana" DESC
 LIMIT 10
ERROR - 2024-07-13 15:06:32 --> 404 Page Not Found: /index
ERROR - 2024-07-13 15:06:32 --> 404 Page Not Found: /index
ERROR - 2024-07-13 15:06:34 --> 404 Page Not Found: /index
ERROR - 2024-07-13 15:06:34 --> 404 Page Not Found: /index
ERROR - 2024-07-13 15:07:44 --> Severity: Warning --> pg_query(): Query failed: ERROR:  invalid input syntax for type integer: &quot;&quot;
LINE 1: ... '1', '-0.7170251619355735', '100.3884887660388', '', '1', '...
                                                             ^ D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-07-13 15:07:44 --> Query error: ERROR:  invalid input syntax for type integer: ""
LINE 1: ... '1', '-0.7170251619355735', '100.3884887660388', '', '1', '...
                                                             ^ - Invalid query: INSERT INTO "ms_bencana" ("token_bencana", "nama_bencana", "tanggal_bencana", "id_jenis_bencana", "penyebab_bencana", "kategori_bencana", "jumlah_kejadian", "kategori_tanggap", "latitude", "longitude", "nama_file", "id_status", "create_by", "create_date", "create_ip", "mod_by", "mod_date", "mod_ip") VALUES ('66DDC2A24DE74C21890C05A2A9B23A4F', 'aaaaa', '2024-07-13', '1', 'testing', '1', '1', '1', '-0.7170251619355735', '100.3884887660388', '', '1', '8', '2024-07-13 15:07:44', '::1', '8', '2024-07-13 15:07:44', '::1')
ERROR - 2024-07-13 15:09:23 --> 404 Page Not Found: /index
ERROR - 2024-07-13 15:09:23 --> 404 Page Not Found: /index
ERROR - 2024-07-13 15:09:45 --> Severity: Warning --> pg_query(): Query failed: ERROR:  invalid input syntax for type integer: &quot;Iusto cumque lorem q&quot;
LINE 1: ..., '2024-07-13', '7', 'Aliquid quidem labor', '1', 'Iusto cum...
                                                             ^ D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-07-13 15:09:45 --> Query error: ERROR:  invalid input syntax for type integer: "Iusto cumque lorem q"
LINE 1: ..., '2024-07-13', '7', 'Aliquid quidem labor', '1', 'Iusto cum...
                                                             ^ - Invalid query: INSERT INTO "ms_bencana" ("token_bencana", "nama_bencana", "tanggal_bencana", "id_jenis_bencana", "penyebab_bencana", "kategori_bencana", "jumlah_kejadian", "kategori_tanggap", "latitude", "longitude", "nama_file", "id_status", "create_by", "create_date", "create_ip", "mod_by", "mod_date", "mod_ip") VALUES ('046FFA12ACDF40D1A7FA5039EDED3B56', 'Sunt ut magnam quis', '2024-07-13', '7', 'Aliquid quidem labor', '1', 'Iusto cumque lorem q', '2', '', '', '', '0', '8', '2024-07-13 15:09:44', '::1', '8', '2024-07-13 15:09:44', '::1')
ERROR - 2024-07-13 15:10:58 --> 404 Page Not Found: /index
ERROR - 2024-07-13 15:10:58 --> 404 Page Not Found: /index
ERROR - 2024-07-13 15:11:09 --> Severity: Warning --> pg_query(): Query failed: ERROR:  invalid input syntax for type integer: &quot;Perferendis in sit v&quot;
LINE 1: ..., '2024-07-13', '6', 'Eos in cillum fugiat', '2', 'Perferend...
                                                             ^ D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-07-13 15:11:09 --> Query error: ERROR:  invalid input syntax for type integer: "Perferendis in sit v"
LINE 1: ..., '2024-07-13', '6', 'Eos in cillum fugiat', '2', 'Perferend...
                                                             ^ - Invalid query: INSERT INTO "ms_bencana" ("token_bencana", "nama_bencana", "tanggal_bencana", "id_jenis_bencana", "penyebab_bencana", "kategori_bencana", "jumlah_kejadian", "kategori_tanggap", "latitude", "longitude", "nama_file", "id_status", "create_by", "create_date", "create_ip", "mod_by", "mod_date", "mod_ip") VALUES ('4618D99542B64235A2FC7544A97EBD2E', 'Proident ipsa reru', '2024-07-13', '6', 'Eos in cillum fugiat', '2', 'Perferendis in sit v', '2', '', '', '', '0', '8', '2024-07-13 15:11:09', '::1', '8', '2024-07-13 15:11:09', '::1')
ERROR - 2024-07-13 15:11:41 --> 404 Page Not Found: /index
ERROR - 2024-07-13 15:11:41 --> 404 Page Not Found: /index
ERROR - 2024-07-13 15:12:24 --> 404 Page Not Found: /index
ERROR - 2024-07-13 15:12:24 --> 404 Page Not Found: /index
ERROR - 2024-07-13 15:13:12 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column a.jam_bencana does not exist
LINE 1: ...cana&quot;, &quot;a&quot;.&quot;nama_bencana&quot;, &quot;a&quot;.&quot;tanggal_bencana&quot;, &quot;a&quot;.&quot;jam_b...
                                                             ^
HINT:  Perhaps you meant to reference the column &quot;a.nama_bencana&quot;. D:\APPLICATION\PHP\PHP8\2024\2024_kebencanaan\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-07-13 15:13:12 --> Query error: ERROR:  column a.jam_bencana does not exist
LINE 1: ...cana", "a"."nama_bencana", "a"."tanggal_bencana", "a"."jam_b...
                                                             ^
HINT:  Perhaps you meant to reference the column "a.nama_bencana". - Invalid query: SELECT "a"."id_bencana", "a"."token_bencana", "a"."id_jenis_bencana", "a"."nama_bencana", "a"."tanggal_bencana", "a"."jam_bencana", "a"."penyebab_bencana", "a"."kategori_bencana", "a"."jumlah_kejadian", "a"."kategori_tanggap", "a"."latitude", "a"."longitude", "a"."id_status", "a"."create_date", "a"."nama_file", "b"."nm_bencana" as "jenis_bencana"
FROM "ms_bencana" "a"
INNER JOIN "cx_jenis_bencana" "b" ON "a"."id_jenis_bencana" = "b"."id_jenis_bencana"
WHERE "token_bencana" = 'FCE095F05C574AE494FDDC9BC54A7047'
