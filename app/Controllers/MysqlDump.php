<?php

    
    include_once('../../vendor/ifsnop/mysqldump-php/src/Ifsnop/Mysqldump/Mysqldump.php');

    $dump = new Ifsnop\Mysqldump\Mysqldump('mysql:host=localhost;dbname=coviar','root', '');
    $dump->start('../../public/assets/backup/dump.sql');
    // $dump->start('storage/work/dump.sql');