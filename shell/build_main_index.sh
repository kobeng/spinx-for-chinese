#!/bin/bash
spinx_distributed_system_path="/home/sphinx-for-chinese/distributed";

#清空mysql(master)相关索引的temp表
cd $spinx_distributed_system_path/9400/
for file in *
do
    result=`php $spinx_distributed_system_path/../shell/truncate_master_temp_table.php $file`;
    eval $result;
done

#建立主索引
cd $spinx_distributed_system_path/main_index/
for file in *
do
    if [ -d $file ]; then
        sudo /usr/local/sphinx-for-chinese/bin/indexer -c $spinx_distributed_system_path/$file.conf --rotate --all
    fi
done


cd ~
