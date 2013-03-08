#!/bin/bash
#建立主索引
cd /home/sphinx-for-chinese/etc/distributed/main_index/
for file in *
do
    if [ -d $file ]; then
        sudo /usr/local/sphinx-for-chinese/bin/indexer -c /home/sphinx-for-chinese/etc/distributed/$file.conf --rotate --all
    fi
done

#建立daily索引
#会清空主库(mysql-3301)相关的索引的temp表
sudo /usr/local/sphinx-for-chinese/bin/indexer -c /home/sphinx-for-chinese/etc/distributed/9410.conf --all --rotate