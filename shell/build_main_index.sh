#!/bin/bash
log_path="/home/logs/sphinx-for-chinese/create_main_index.log"
sphinx_bin_path="/usr/local/sphinx-for-chinese/bin"
index_conf_path="/home/sphinx-for-chinese/distributed"

#清空mysql(master)相关索引的temp表
cd $index_conf_path/9400/
for file in *
do
    result=`php $index_conf_path/../shell/truncate_master_temp_table.php $file`;
    eval $result;
done

function create_main_index()
{
    echo "-------------------------------------------------------------------" >> $log_path
    echo "Start:" >> $log_path
    echo `date -d today +"%Y-%m-%d %H:%M:%S"` >> $log_path
    echo "" >> $log_path

    result=`$sphinx_bin_path/indexer -c $index_conf_path/$1.conf --rotate --all`
    echo "$result" >> $log_path
    
    
    echo "" >> $log_path
    echo "End:" >> $log_path
    echo `date -d today +"%Y-%m-%d %H:%M:%S"` >> $log_path
    echo "-------------------------------------------------------------------" >> $log_path
    echo " "  >> $log_path
    echo " "  >> $log_path
    echo " "  >> $log_path
    sleep 3
}


#建立主索引
cd $index_conf_path/main_index/
for file in *
do
    if [ -d $file ]; then
        create_main_index $files
    fi
done


