#!/bin/bash
log_path="/home/logs/sphinx-for-chinese/create_delta_index.log"
sphinx_bin_path="/usr/local/sphinx-for-chinese/bin"
index_conf_path="/home/sphinx-for-chinese/etc/distributed"



function create_merge_delta()
{
    echo "-------------------------------------------------------------------" >> $log_path
    echo "Start:" >> $log_path
    echo `date -d today +"%Y-%m-%d %H:%M:%S"` >> $log_path
    echo "" >> $log_path

    result=`$sphinx_bin_path/indexer -c $index_conf_path/9410.conf --rotate $2`
    echo "$result" >> $log_path
    result=`$sphinx_bin_path/indexer -c $index_conf_path/9410.conf --rotate --merge $1 $2`
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

create_merge_delta biz72_news_daily biz72_news_temp;
create_merge_delta biz72_product_daily biz72_product_temp;
create_merge_delta biz72_company_daily biz72_company_temp; 
create_merge_delta biz72_price_daily biz72_price_temp; 


