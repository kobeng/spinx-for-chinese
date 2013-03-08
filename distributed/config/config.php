<?php
$globals = array(
    "count_ports" => 6, //一共有多少个sphinx端口做负载均衡
    "index_path" => "/home/sphinx-for-chinese/data",
    "log_path" => "/home/logs/sphinx-for-chinese",
    "searchd_listen_address" => "192.168.0.112",
    "mpm" => "threads"
);

$biz72_news = array(
    "sphinx_db_host" => "192.168.0.111",
    "sphinx_db_port" => "3322",
    "sphinx_db_user" => "sphinx",
    "sphinx_db_password" => "sphinx",
    "sphinx_db_name" => "biz72_news",
    
    //建立daily索引，从主库去生成，这样为了可以清空主库的相关索引temp表的数据
    "mysql_db_host" => "192.168.0.112",
    "mysql_db_port" => "3301",
    "mysql_db_user" => "sphinx",
    "mysql_db_password" => "sphinx",
    "mysql_db_name" => "biz72_news",
    
    "table" => "news_info",
    "field" => "id",
    "limit" => 400000,
    "limit_add" => 100000, //如果文档总量已经超过 （$limit * $globals["count_ports"]），那么把这个值叠加到$limit 重新计算每个索引的分布式文档量
    "sphinx_distributed" => array(
        "192.168.0.112:9410:biz72_news_daily" ,
        "192.168.0.112:9411:biz72_news_1" ,
        "192.168.0.112:9412:biz72_news_2" ,
        "192.168.0.112:9413:biz72_news_3" ,
        "192.168.0.112:9414:biz72_news_4" ,
        "192.168.0.112:9415:biz72_news_5" ,
        "192.168.0.112:9416:biz72_news_6"),
    
    "search_config_sql" => "
    sql_query = SELECT id,title,keyword,kind_name,\
        tag_id,clk_times,com_id,pub_time,update_time,status,\
        root_tag_id,pro_tag_id,mem_level,\
        LEFT(tag_id,3)*1 as r_tag_id,\
        LEFT(tag_id,6)*1 as c_tag_id,\
        LEFT(pro_tag_id,3)*1 as r_pro_tag_id,\
        LEFT(pro_tag_id,6)*1 as c_pro_tag_id,\
        (img IS NOT NULL AND img != '') AS isimg,\
        (`desc` IS NOT NULL AND CHAR_LENGTH(`desc`) >50) AS isdesc\
        FROM news_info WHERE id>=\$start AND id<=\$end      
        
    sql_range_step  = 2000
",
    "search_config_att" => "
    sql_attr_bigint = tag_id
            
    sql_attr_uint = clk_times
    sql_attr_uint = com_id
    sql_attr_uint = pub_time
    sql_attr_uint = update_time
    sql_attr_uint = r_tag_id
    sql_attr_uint = c_tag_id
    sql_attr_uint = status
    sql_attr_uint = root_tag_id
    sql_attr_uint = pro_tag_id
    sql_attr_uint = mem_level
    sql_attr_uint = r_pro_tag_id
    sql_attr_uint = c_pro_tag_id

    sql_attr_bool = isimg
    sql_attr_bool = isdesc
"
);

$biz72_product = array(
    "sphinx_db_host" => "192.168.0.111",
    "sphinx_db_port" => "3322",
    "sphinx_db_user" => "sphinx",
    "sphinx_db_password" => "sphinx",
    "sphinx_db_name" => "biz72_product",
    
    //建立daily索引，从主库去生成，这样为了可以清空主库的相关索引temp表的数据
    "mysql_db_host" => "192.168.0.112",
    "mysql_db_port" => "3301",
    "mysql_db_user" => "sphinx",
    "mysql_db_password" => "sphinx",
    "mysql_db_name" => "biz72_product",
    
    "table" => "pro_info",
    "field" => "id",
    "limit" => 1500000,
    "limit_add" => 100000, //如果文档总量已经超过 （$limit * $globals["count_ports"]），那么把这个值叠加到$limit 重新计算每个索引的分布式文档量
    "sphinx_distributed" => array(
        "192.168.0.112:9410:biz72_product_daily" ,
        "192.168.0.112:9411:biz72_product_1" ,
        "192.168.0.112:9412:biz72_product_2" ,
        "192.168.0.112:9413:biz72_product_3" ,
        "192.168.0.112:9414:biz72_product_4" ,
        "192.168.0.112:9415:biz72_product_5" ,
        "192.168.0.112:9416:biz72_product_6"),
    
    "search_config_sql" => "
    sql_query = SELECT id,title,keyword,com_name, \
                tag_id,min_order,total,com_id,province,city,block,clk_times,pub_time,update_time,price,com_tag_id, \
                mem_level,point,sale_cnt,status, \
                LEFT(tag_id,3)*1 as r_tag_id, \
                LEFT(tag_id,6)*1 as c_tag_id, \
                (img IS NOT NULL AND img !='') AS isimg \
                FROM pro_info WHERE id>=\$start AND id<=\$end      
        
    sql_range_step  = 2000
",
    "search_config_att" => "
    sql_attr_bigint   = tag_id
    sql_attr_uint   = min_order
    sql_attr_uint   = total
    sql_attr_uint   = com_id
    sql_attr_uint   = province
    sql_attr_uint   = city
    sql_attr_uint   = block
    sql_attr_uint   = clk_times
    sql_attr_uint   = pub_time
    sql_attr_uint   = update_time
    sql_attr_uint   = mem_level
    sql_attr_uint   = point
    sql_attr_uint   = sale_cnt
    sql_attr_uint   = r_tag_id
    sql_attr_uint   = c_tag_id
    sql_attr_uint   = status
    sql_attr_uint   = com_tag_id
    sql_attr_bool = isimg    
    sql_attr_float = price
"
);

$biz72_company = array(
    "sphinx_db_host" => "192.168.0.111",
    "sphinx_db_port" => "3322",
    "sphinx_db_user" => "sphinx",
    "sphinx_db_password" => "sphinx",
    "sphinx_db_name" => "biz72_company",
    
    //建立daily索引，从主库去生成，这样为了可以清空主库的相关索引temp表的数据
    "mysql_db_host" => "192.168.0.112",
    "mysql_db_port" => "3301",
    "mysql_db_user" => "sphinx",
    "mysql_db_password" => "sphinx",
    "mysql_db_name" => "biz72_company",
    
    "table" => "com_info",
    "field" => "id",
    "limit" => 1000000,
    "limit_add" => 100000, //如果文档总量已经超过 （$limit * $globals["count_ports"]），那么把这个值叠加到$limit 重新计算每个索引的分布式文档量
    "sphinx_distributed" => array(
        "192.168.0.112:9410:biz72_company_daily" ,
        "192.168.0.112:9411:biz72_company_1" ,
        "192.168.0.112:9412:biz72_company_2" ,
        "192.168.0.112:9413:biz72_company_3" ,
        "192.168.0.112:9414:biz72_company_4" ,
        "192.168.0.112:9415:biz72_company_5" ,
        "192.168.0.112:9416:biz72_company_6"),
    
    "search_config_sql" => "
    sql_query = SELECT id,status,com_name,pub_time,update_time, \
                user_id,country,province,city,county,com_kind, \
                com_jyms,com_clsj,clk_times,collect_times,mem_level, \
                point,(img IS NOT NULL AND img !='') AS isimg, \
                (con_web IS NOT NULL AND con_web !='') AS isconweb \
                FROM com_info WHERE id>=\$start AND id<=\$end      
        
    sql_range_step  = 2000
",
    "search_config_att" => "
    sql_attr_uint = pub_time
    sql_attr_uint = update_time 
    sql_attr_uint = user_id
    sql_attr_uint = country
    sql_attr_uint = province
    sql_attr_uint = city
    sql_attr_uint = county
    sql_attr_uint = com_kind
    sql_attr_uint = com_jyms
    sql_attr_uint = com_clsj
    sql_attr_uint = clk_times
    sql_attr_uint = collect_times
    sql_attr_uint = mem_level 
    sql_attr_uint = point
    sql_attr_uint = status    
    sql_attr_bool = isimg
    sql_attr_bool = isconweb
"
);

$biz72_price = array(
    "sphinx_db_host" => "192.168.0.111",
    "sphinx_db_port" => "3322",
    "sphinx_db_user" => "sphinx",
    "sphinx_db_password" => "sphinx",
    "sphinx_db_name" => "biz72_price",
    
    //建立daily索引，从主库去生成，这样为了可以清空主库的相关索引temp表的数据
    "mysql_db_host" => "192.168.0.112",
    "mysql_db_port" => "3301",
    "mysql_db_user" => "sphinx",
    "mysql_db_password" => "sphinx",
    "mysql_db_name" => "biz72_price",
    
    "table" => "price_info",
    "field" => "id",
    "limit" => 300000,
    "limit_add" => 100000, //如果文档总量已经超过 （$limit * $globals["count_ports"]），那么把这个值叠加到$limit 重新计算每个索引的分布式文档量
    "sphinx_distributed" => array(
        "192.168.0.112:9410:biz72_price_daily" ,
        "192.168.0.112:9411:biz72_price_1" ,
        "192.168.0.112:9412:biz72_price_2" ,
        "192.168.0.112:9413:biz72_price_3" ,
        "192.168.0.112:9414:biz72_price_4" ,
        "192.168.0.112:9415:biz72_price_5" ,
        "192.168.0.112:9416:biz72_price_6"),
    
    "search_config_sql" => "
    sql_query = SELECT id,name,title, \
                update_time,tag_id,price,com_id,pub_time,addrid,status, \
                LEFT(tag_id,3)*1 as r_tag_id, \
                LEFT(tag_id,6)*1 as c_tag_id \
                FROM price_info WHERE id>=\$start AND id<=\$end      
        
    sql_range_step  = 2000
",
    "search_config_att" => "
    sql_attr_bigint   = tag_id
    sql_attr_uint = price
    sql_attr_uint = com_id
    sql_attr_uint = pub_time
    sql_attr_uint = update_time
    sql_attr_uint = addrid
    sql_attr_uint = status
    sql_attr_uint = r_tag_id
    sql_attr_uint = c_tag_id
"
);

$biz72_law = array(
    "sphinx_db_host" => "192.168.0.111",
    "sphinx_db_port" => "3322",
    "sphinx_db_user" => "sphinx",
    "sphinx_db_password" => "sphinx",
    "sphinx_db_name" => "biz72_news",
    
    //建立daily索引，从主库去生成，这样为了可以清空主库的相关索引temp表的数据
    "mysql_db_host" => "192.168.0.112",
    "mysql_db_port" => "3301",
    "mysql_db_user" => "sphinx",
    "mysql_db_password" => "sphinx",
    "mysql_db_name" => "biz72_news",
    
    "table" => "news_law",
    "field" => "id",
    "limit" => 10000,
    "limit_add" => 1000, //如果文档总量已经超过 （$limit * $globals["count_ports"]），那么把这个值叠加到$limit 重新计算每个索引的分布式文档量
    "sphinx_distributed" => array(
        "192.168.0.112:9410:biz72_law_daily" ,
        "192.168.0.112:9411:biz72_law_1" ,
        "192.168.0.112:9412:biz72_law_2" ,
        "192.168.0.112:9413:biz72_law_3" ,
        "192.168.0.112:9414:biz72_law_4" ,
        "192.168.0.112:9415:biz72_law_5" ,
        "192.168.0.112:9416:biz72_law_6"),
    
    "search_config_sql" => "
    sql_query = SELECT id,title,keyword,kind_name, \
                tag_id,clk_times,download_times,pub_time,status,update_time, \
                LEFT(tag_id,3)*1 as r_tag_id, \
                LEFT(tag_id,6)*1 as c_tag_id \
                FROM news_law WHERE id>=\$start AND id<=\$end      
        
    sql_range_step  = 2000
",
    "search_config_att" => "
    sql_attr_bigint   = tag_id
    sql_attr_uint = clk_times
    sql_attr_uint = download_times
    sql_attr_uint = pub_time
    sql_attr_uint = update_time
    sql_attr_uint = r_tag_id
    sql_attr_uint = c_tag_id
    sql_attr_uint = status
"
);

$biz72_expo = array(
    "sphinx_db_host" => "192.168.0.111",
    "sphinx_db_port" => "3322",
    "sphinx_db_user" => "sphinx",
    "sphinx_db_password" => "sphinx",
    "sphinx_db_name" => "biz72_expo",
    
    //建立daily索引，从主库去生成，这样为了可以清空主库的相关索引temp表的数据
    "mysql_db_host" => "192.168.0.112",
    "mysql_db_port" => "3301",
    "mysql_db_user" => "sphinx",
    "mysql_db_password" => "sphinx",
    "mysql_db_name" => "biz72_expo",
    
    "table" => "expo_info",
    "field" => "id",
    "limit" => 10000,
    "limit_add" => 1000, //如果文档总量已经超过 （$limit * $globals["count_ports"]），那么把这个值叠加到$limit 重新计算每个索引的分布式文档量
    "sphinx_distributed" => array(
        "192.168.0.112:9410:biz72_expo_daily" ,
        "192.168.0.112:9411:biz72_expo_1" ,
        "192.168.0.112:9412:biz72_expo_2" ,
        "192.168.0.112:9413:biz72_expo_3" ,
        "192.168.0.112:9414:biz72_expo_4" ,
        "192.168.0.112:9415:biz72_expo_5" ,
        "192.168.0.112:9416:biz72_expo_6"),
    
    "search_config_sql" => "
    sql_query = SELECT id, title,trade,addr, \
                tag_id,com_id,clk_times,in_time_start,in_time_end, \
                show_time_start,show_time_end,out_time_start,out_time_end,addr_tag_id,status, \
                (img IS NOT NULL AND img !='' ) AS isimg, \
                FROM_UNIXTIME(show_time_start, '%c') as monthDay, \
                FROM_UNIXTIME(show_time_start, '%Y') as yearDay \
                FROM expo_info WHERE id>=\$start AND id<=\$end      
        
    sql_range_step  = 2000
",
    "search_config_att" => "
    sql_attr_bigint = tag_id
    sql_attr_bigint = addr_tag_id    
    sql_attr_uint = com_id
    sql_attr_uint = clk_times
    sql_attr_uint = in_time_start
    sql_attr_uint = in_time_end
    sql_attr_uint = show_time_start
    sql_attr_uint = show_time_end
    sql_attr_uint = out_time_start
    sql_attr_uint = out_time_end    
    sql_attr_uint = monthDay
    sql_attr_uint = yearDay
    sql_attr_uint = status
    sql_attr_bool = isimg
"
);

$biz72_buy = array(
    "sphinx_db_host" => "192.168.0.111",
    "sphinx_db_port" => "3322",
    "sphinx_db_user" => "sphinx",
    "sphinx_db_password" => "sphinx",
    "sphinx_db_name" => "biz72_buy",
    
    //建立daily索引，从主库去生成，这样为了可以清空主库的相关索引temp表的数据
    "mysql_db_host" => "192.168.0.112",
    "mysql_db_port" => "3301",
    "mysql_db_user" => "sphinx",
    "mysql_db_password" => "sphinx",
    "mysql_db_name" => "biz72_buy",
    
    "table" => "buy_info",
    "field" => "id",
    "limit" => 10000,
    "limit_add" => 1000, //如果文档总量已经超过 （$limit * $globals["count_ports"]），那么把这个值叠加到$limit 重新计算每个索引的分布式文档量
    "sphinx_distributed" => array(
        "192.168.0.112:9410:biz72_buy_daily" ,
        "192.168.0.112:9411:biz72_buy_1" ,
        "192.168.0.112:9412:biz72_buy_2" ,
        "192.168.0.112:9413:biz72_buy_3" ,
        "192.168.0.112:9414:biz72_buy_4" ,
        "192.168.0.112:9415:biz72_buy_5" ,
        "192.168.0.112:9416:biz72_buy_6"),
    
    "search_config_sql" => "
    sql_query = SELECT id, buy_product,title,keyword,com_name, \
                tag_id,mem_level,block,com_id,pub_time,province,city,info_kind,total,status,price,update_time, \
                (img IS NOT NULL AND img !='' ) AS isimg, \
                (`desc` IS NOT NULL AND CHAR_LENGTH(`desc`) >50) AS isdesc,\
                LEFT(tag_id,3)*1 as r_tag_id, \
                LEFT(tag_id,6)*1 as c_tag_id \
                FROM buy_info WHERE id>=\$start AND id<=\$end      
        
    sql_range_step  = 2000
",
    "search_config_att" => "
    sql_attr_bigint   = tag_id
    sql_attr_uint = mem_level
    sql_attr_uint = block
    sql_attr_uint = com_id
    sql_attr_uint = pub_time
    sql_attr_uint = province
    sql_attr_uint = city
    sql_attr_uint = info_kind
    sql_attr_uint = total
    sql_attr_uint = status
    sql_attr_uint = r_tag_id
    sql_attr_uint = c_tag_id
    sql_attr_uint = update_time
    sql_attr_float = price    
    sql_attr_bool = isimg
"
);

$biz72_contract = array(
    "sphinx_db_host" => "192.168.0.111",
    "sphinx_db_port" => "3322",
    "sphinx_db_user" => "sphinx",
    "sphinx_db_password" => "sphinx",
    "sphinx_db_name" => "biz72_news",
    
    //建立daily索引，从主库去生成，这样为了可以清空主库的相关索引temp表的数据
    "mysql_db_host" => "192.168.0.112",
    "mysql_db_port" => "3301",
    "mysql_db_user" => "sphinx",
    "mysql_db_password" => "sphinx",
    "mysql_db_name" => "biz72_news",
    
    "table" => "news_contract",
    "field" => "id",
    "limit" => 10000,
    "limit_add" => 1000, //如果文档总量已经超过 （$limit * $globals["count_ports"]），那么把这个值叠加到$limit 重新计算每个索引的分布式文档量
    "sphinx_distributed" => array(
        "192.168.0.112:9410:biz72_contract_daily" ,
        "192.168.0.112:9411:biz72_contract_1" ,
        "192.168.0.112:9412:biz72_contract_2" ,
        "192.168.0.112:9413:biz72_contract_3" ,
        "192.168.0.112:9414:biz72_contract_4" ,
        "192.168.0.112:9415:biz72_contract_5" ,
        "192.168.0.112:9416:biz72_contract_6"),
    
    "search_config_sql" => "
    sql_query = SELECT id, title,keyword,kind_name, \
                update_time,tag_id,clk_times,download_times,pub_time,status, \
                LEFT(tag_id,3)*1 as r_tag_id, \
                LEFT(tag_id,6)*1 as c_tag_id \
                FROM news_contract WHERE id>=\$start AND id<=\$end      
        
    sql_range_step  = 2000
",
    "search_config_att" => "
    sql_attr_bigint = tag_id    
    sql_attr_uint = clk_times
    sql_attr_uint = download_times
    sql_attr_uint = update_time
    sql_attr_uint = pub_time
    sql_attr_uint = status
    sql_attr_uint = r_tag_id
    sql_attr_uint = c_tag_id
"
);

$biz72_baikeask = array(
    "sphinx_db_host" => "192.168.0.111",
    "sphinx_db_port" => "3322",
    "sphinx_db_user" => "sphinx",
    "sphinx_db_password" => "sphinx",
    "sphinx_db_name" => "biz72_baike",
    
    //建立daily索引，从主库去生成，这样为了可以清空主库的相关索引temp表的数据
    "mysql_db_host" => "192.168.0.112",
    "mysql_db_port" => "3301",
    "mysql_db_user" => "sphinx",
    "mysql_db_password" => "sphinx",
    "mysql_db_name" => "biz72_baike",
    
    "table" => "baike_ask",
    "field" => "id",
    "limit" => 10000,
    "limit_add" => 1000, //如果文档总量已经超过 （$limit * $globals["count_ports"]），那么把这个值叠加到$limit 重新计算每个索引的分布式文档量
    "sphinx_distributed" => array(
        "192.168.0.112:9410:biz72_baikeask_daily" ,
        "192.168.0.112:9411:biz72_baikeask_1" ,
        "192.168.0.112:9412:biz72_baikeask_2" ,
        "192.168.0.112:9413:biz72_baikeask_3" ,
        "192.168.0.112:9414:biz72_baikeask_4" ,
        "192.168.0.112:9415:biz72_baikeask_5" ,
        "192.168.0.112:9416:biz72_baikeask_6"),
    
    "search_config_sql" => "
    sql_query = SELECT id,title,com_name, \
                com_id,clk_times,pub_time,status,tag_id,LEFT(tag_id,3)*1 as r_tag_id, \
                LEFT(tag_id,6)*1 as c_tag_id \
                FROM baike_ask WHERE id>=\$start AND id<=\$end      
        
    sql_range_step  = 2000
",
    "search_config_att" => "
    sql_attr_bigint   = tag_id    
    sql_attr_uint = com_id
    sql_attr_uint = clk_times
    sql_attr_uint = pub_time
    sql_attr_uint = status
    sql_attr_uint = r_tag_id
    sql_attr_uint = c_tag_id
"
);

$biz72_baikeinfo = array(
    "sphinx_db_host" => "192.168.0.111",
    "sphinx_db_port" => "3322",
    "sphinx_db_user" => "sphinx",
    "sphinx_db_password" => "sphinx",
    "sphinx_db_name" => "biz72_baike",
    
    //建立daily索引，从主库去生成，这样为了可以清空主库的相关索引temp表的数据
    "mysql_db_host" => "192.168.0.112",
    "mysql_db_port" => "3301",
    "mysql_db_user" => "sphinx",
    "mysql_db_password" => "sphinx",
    "mysql_db_name" => "biz72_baike",
    
    "table" => "baike_info",
    "field" => "id",
    "limit" => 10000,
    "limit_add" => 1000, //如果文档总量已经超过 （$limit * $globals["count_ports"]），那么把这个值叠加到$limit 重新计算每个索引的分布式文档量
    "sphinx_distributed" => array(
        "192.168.0.112:9410:biz72_baikeinfo_daily" ,
        "192.168.0.112:9411:biz72_baikeinfo_1" ,
        "192.168.0.112:9412:biz72_baikeinfo_2" ,
        "192.168.0.112:9413:biz72_baikeinfo_3" ,
        "192.168.0.112:9414:biz72_baikeinfo_4" ,
        "192.168.0.112:9415:biz72_baikeinfo_5" ,
        "192.168.0.112:9416:biz72_baikeinfo_6"),
    
    "search_config_sql" => "
    sql_query = SELECT id,title,keyword,com_name, \
                com_id,clk_times,pub_time,status, \
                LEFT(tag_id,3)*1 as r_tag_id,LEFT(tag_id,6)*1 as c_tag_id, \
                (img IS NOT NULL AND img != '') AS isimg, tag_id \
                FROM baike_info WHERE id>=\$start AND id<=\$end      
        
    sql_range_step  = 2000
",
    "search_config_att" => "
    sql_attr_uint = tag_id    
    sql_attr_uint = com_id
    sql_attr_uint = clk_times
    sql_attr_uint = pub_time
    sql_attr_uint = status
    sql_attr_uint = r_tag_id
    sql_attr_uint = c_tag_id
    sql_attr_uint = isimg
"
);

$biz72_zhaoshang = array(
    "sphinx_db_host" => "192.168.0.111",
    "sphinx_db_port" => "3322",
    "sphinx_db_user" => "sphinx",
    "sphinx_db_password" => "sphinx",
    "sphinx_db_name" => "biz72_zhaoshang",
    
    //建立daily索引，从主库去生成，这样为了可以清空主库的相关索引temp表的数据
    "mysql_db_host" => "192.168.0.112",
    "mysql_db_port" => "3301",
    "mysql_db_user" => "sphinx",
    "mysql_db_password" => "sphinx",
    "mysql_db_name" => "biz72_zhaoshang",
    
    "table" => "zs_info",
    "field" => "id",
    "limit" => 10000,
    "limit_add" => 1000, //如果文档总量已经超过 （$limit * $globals["count_ports"]），那么把这个值叠加到$limit 重新计算每个索引的分布式文档量
    "sphinx_distributed" => array(
        "192.168.0.112:9410:biz72_zhaoshang_daily" ,
        "192.168.0.112:9411:biz72_zhaoshang_1" ,
        "192.168.0.112:9412:biz72_zhaoshang_2" ,
        "192.168.0.112:9413:biz72_zhaoshang_3" ,
        "192.168.0.112:9414:biz72_zhaoshang_4" ,
        "192.168.0.112:9415:biz72_zhaoshang_5" ,
        "192.168.0.112:9416:biz72_zhaoshang_6"),
    
    "search_config_sql" => "
    sql_query = SELECT id,title,com_name, \
                tag_id,com_id,province,city,clk_times,pub_time,mem_level,point,status, \
                LEFT(tag_id,3)*1 as r_tag_id,LEFT(tag_id,6)*1 as c_tag_id, \
                (img IS NOT NULL AND img != '') AS isimg \
                FROM zs_info WHERE id>=\$start AND id<=\$end      
        
    sql_range_step  = 2000
",
    "search_config_att" => "
    sql_attr_uint = tag_id    
    sql_attr_uint = com_id
    sql_attr_uint = province
    sql_attr_uint = city
    sql_attr_uint = clk_times
    sql_attr_uint = pub_time
    sql_attr_uint = mem_level
    sql_attr_uint = point
    sql_attr_uint = status
    sql_attr_uint = r_tag_id
    sql_attr_uint = c_tag_id
    sql_attr_uint = isimg
"
);

$biz72_user = array(
    "sphinx_db_host" => "192.168.0.111",
    "sphinx_db_port" => "3322",
    "sphinx_db_user" => "sphinx",
    "sphinx_db_password" => "sphinx",
    "sphinx_db_name" => "biz72_user",
    
    //建立daily索引，从主库去生成，这样为了可以清空主库的相关索引temp表的数据
    "mysql_db_host" => "192.168.0.112",
    "mysql_db_port" => "3301",
    "mysql_db_user" => "sphinx",
    "mysql_db_password" => "sphinx",
    "mysql_db_name" => "biz72_user",
    
    "table" => "user_info",
    "field" => "id",
    "limit" => 100000,
    "limit_add" => 10000, //如果文档总量已经超过 （$limit * $globals["count_ports"]），那么把这个值叠加到$limit 重新计算每个索引的分布式文档量
    "sphinx_distributed" => array(
        "192.168.0.112:9410:biz72_user_daily" ,
        "192.168.0.112:9411:biz72_user_1" ,
        "192.168.0.112:9412:biz72_user_2" ,
        "192.168.0.112:9413:biz72_user_3" ,
        "192.168.0.112:9414:biz72_user_4" ,
        "192.168.0.112:9415:biz72_user_5" ,
        "192.168.0.112:9416:biz72_user_6"),
    
    "search_config_sql" => "
    sql_query = SELECT id,name,phone,email,tel, \
                province,city,pub_time,update_time,login_times,last_login_time,status \
                FROM user_info WHERE id>=\$start AND id<=\$end      
        
    sql_range_step  = 2000
",
    "search_config_att" => "
    sql_attr_uint = province    
    sql_attr_uint = city
    sql_attr_uint = pub_time
    sql_attr_uint = update_time
    sql_attr_uint = login_times
    sql_attr_uint = last_login_time
    sql_attr_uint = status
    
"
);
?>
<?php
//计算每个分布式索引的文档量
function count_limit($total,$limit,$limit_add,$globals){
    $result = ceil($total/$limit);
     
    if ($result > $globals["count_ports"]){
        $limit = $limit + $limit_add;
        return count_limit($total,$limit,$limit_add,$globals);
    }
    return $limit;
}

?>