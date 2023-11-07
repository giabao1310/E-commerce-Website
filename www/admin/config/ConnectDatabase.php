<?php
    require 'Config.php';
    $connect_sql = new mysqli(db_host, db_uid, db_pass, db_name);
    
    if ($connect_sql -> connect_errno) {
        exit('Cannot connect to db');
    }

    $connect_sql->set_charset("utf8");
?>