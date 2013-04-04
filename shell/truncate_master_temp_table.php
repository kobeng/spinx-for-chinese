<?php
//这个文件被build_main_index.sh调用
//调用方式为： php truncate_master_temp_table.php biz72_product.conf
//输出清空对应索引的temp表的shell命令，然后被shell执行

$indexName = substr($argv[1],0,-5);
include '../config/config.php';
$mysql_info= $$indexName;

echo "mysql -h {$mysql_info['mysql_db_host']} -P {$mysql_info['mysql_db_port']} 
            -u {$mysql_info['mysql_db_user']} -p{$mysql_info['mysql_db_password']} 
            -e \"use {$mysql_info['mysql_db_name']};truncate {$mysql_info['table']}_temp;truncate {$mysql_info['table']}_data_temp; \"";