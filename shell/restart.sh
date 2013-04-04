#!/bin/bash
sphinx_bin_path="/usr/local/sphinx-for-chinese/bin"
index_conf_path="/home/sphinx-for-chinese/distributed"

sudo $sphinx_bin_path/searchd -c $index_conf_path/9400.conf --stopwait
sudo $sphinx_bin_path/searchd -c $index_conf_path/9400.conf

sudo $sphinx_bin_path/searchd -c $index_conf_path/9410.conf --stopwait
sudo $sphinx_bin_path/searchd -c $index_conf_path/9410.conf

sudo $sphinx_bin_path/searchd -c $index_conf_path/9411.conf --stopwait
sudo $sphinx_bin_path/searchd -c $index_conf_path/9411.conf

sudo $sphinx_bin_path/searchd -c $index_conf_path/9412.conf --stopwait
sudo $sphinx_bin_path/searchd -c $index_conf_path/9412.conf

sudo $sphinx_bin_path/searchd -c $index_conf_path/9413.conf --stopwait
sudo $sphinx_bin_path/searchd -c $index_conf_path/9413.conf

#sudo /usr/local/sphinx-for-chinese/bin/searchd -c /home/sphinx-for-chinese/distributed/9414.conf --stopwait
#sudo /usr/local/sphinx-for-chinese/bin/searchd -c /home/sphinx-for-chinese/distributed/9414.conf

#sudo /usr/local/sphinx-for-chinese/bin/searchd -c /home/sphinx-for-chinese/distributed/9415.conf --stopwait
#sudo /usr/local/sphinx-for-chinese/bin/searchd -c /home/sphinx-for-chinese/distributed/9415.conf

#sudo /usr/local/sphinx-for-chinese/bin/searchd -c /home/sphinx-for-chinese/distributed/9416.conf --stopwait
#sudo /usr/local/sphinx-for-chinese/bin/searchd -c /home/sphinx-for-chinese/distributed/9416.conf