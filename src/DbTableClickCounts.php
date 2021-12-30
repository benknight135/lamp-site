<?php
declare(strict_types = 1);

namespace LampSite;

class DbTableClickCounts extends DbTable
{
    public function __construct() {
        $name = "ClickCounts";
        $_create_table_sql = "CREATE TABLE `ClickCounts` (
                `ID` int unsigned NOT NULL AUTO_INCREMENT,
                `User` varchar(30) NOT NULL,
                `CountValue` int NOT NULL,
                PRIMARY KEY (`id`)
            );";
        $_fill_data_sql = "INSERT INTO `ClickCounts` (
                `User`,
                `CountValue`
            ) VALUES (
                'Guest',
                0
            );";
        parent::__construct($name, $_create_table_sql, $_fill_data_sql);
    }
}