<?php
declare(strict_types = 1);

namespace LampSite;

class DbTableClickCounts extends DbTable
{
    public function __construct() {
        $name = "click_count";
        $_create_table_sql = "CREATE TABLE `click_count` (
                `id` int unsigned NOT NULL AUTO_INCREMENT,
                `user_id` int FOREIGN KEY REFERENCES `users`(`id`) NOT NULL UNIQUE,
                `count_value` int NOT NULL
            );";
        $_fill_data_sql = "INSERT INTO `click_count` (
                `user`,
                `count_value`
            ) VALUES (
                'guest',
                0
            );";
        parent::__construct($name, $_create_table_sql, $_fill_data_sql);
    }
}