<?php
declare(strict_types = 1);

namespace LampSite;

class DbTable
{
    private string $_name;
    private string $_create_table_sql;
    private string $_fill_data_sql;

    public function __construct($name, $create_table_sql, $_fill_data_sql) {
        $this->_name = $name;
        // remove newlines and tabs
        $this->_create_table_sql = str_replace(array("\n", "\r", "\t"), '', $create_table_sql);
        // replace double or more spaces with single space
        $this->_create_table_sql = preg_replace('/ +/', ' ', $this->_create_table_sql);
        // remove newlines and tabs
        $this->_fill_data_sql = str_replace(array("\n", "\r", "\t"), '', $_fill_data_sql);
        // replace double or more spaces with single space
        $this->_fill_data_sql = preg_replace('/ +/', ' ', $this->_fill_data_sql);
        //error_log($this->_create_table_sql, 0);
        //error_log($this->_fill_data_sql, 0);
    }

    public function getName(): string {
        return $this->_name;
    }

    public function getCreateTableSql(): string {
        return $this->_create_table_sql;
    }

    public function getFillDataSql(): string {
        return $this->_fill_data_sql;
    }
}