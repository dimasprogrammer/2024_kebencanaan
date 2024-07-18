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
