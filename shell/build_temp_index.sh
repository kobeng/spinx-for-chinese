#!/bin/bash
log_path="/home/logs/sphinx-for-chinese/create_temp_index.log"
sphinx_bin_path="/usr/local/sphinx-for-chinese/bin"
index_conf_path="/home/sphinx-for-chinese/distributed"



function create_temp_index()
{
    echo "-------------------------------------------------------------------" >> $log_path
    echo "Start:" >> $log_path
    echo `date -d today +"%Y-%m-%d %H:%M:%S"` >> $log_path
    echo "" >> $log_path

    result=`$sphinx_bin_path/indexer -c $index_conf_path/9410.conf --rotate --all`
    echo "$result" >> $log_path
    
    #之前是打算temp合并到daily索引中，现在由temp代替daily
    #result=`$sphinx_bin_path/indexer -c $index_conf_path/9410.conf --rotate --merge $1 $2`
    #echo "$result" >> $log_path

    echo "" >> $log_path
    echo "End:" >> $log_path
    echo `date -d today +"%Y-%m-%d %H:%M:%S"` >> $log_path
    echo "-------------------------------------------------------------------" >> $log_path
    echo " "  >> $log_path
    echo " "  >> $log_path
    echo " "  >> $log_path
    sleep 3
}

create_temp_index;


