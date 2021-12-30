<?php
declare(strict_types = 1);

namespace LampSite;

class DbTable
{
    private string $_name;
    private string $_create_table_sql;

    public function __construct($name, $create_table_sql) {
        $this->_name = $name;
        // remove newlines and tabs
        $this->_create_table_sql = str_replace(array("\n", "\r", "\t"), '', $create_table_sql);
        // replace double or more spaces with single space
        $this->_create_table_sql = preg_replace('/ +/', ' ', $this->_create_table_sql);
        error_log($this->_create_table_sql, 0);
    }

    public function getName(): string {
        return $this->_name;
    }

    public function getCreateTableSql(): string {
        return $this->_create_table_sql;
    }
}