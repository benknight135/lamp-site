<?php
declare(strict_types = 1);

namespace LampSite;

class DbTableClickCounts extends DbTable
{
    public function __construct() {
        $name = "ClickCounts";
        $_create_table_sql = "CREATE TABLE `ClickCounts` (
                `id` int unsigned NOT NULL AUTO_INCREMENT,
                `user` varchar(30) NOT NULL,
                `count` int NOT NULL,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
        parent::__construct($name, $_create_table_sql);
    }
}