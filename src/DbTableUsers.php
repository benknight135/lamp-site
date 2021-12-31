<?php
declare(strict_types = 1);

namespace LampSite;

class DbTableUsers extends DbTable
{
    public function __construct() {
        $name = "users";
        $_create_table_sql = "CREATE TABLE `users` (
                `id` int unsigned NOT NULL AUTO_INCREMENT,
                `username` varchar(50) NOT NULL UNIQUE,
                `password` varchar(255) NOT NULL,
                `click_count` int DEFAULT 0,
                `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`)
            );";
        $guest_username = "guest";
        $guest_password = password_hash("guest", PASSWORD_DEFAULT);
        $_fill_data_sql = "INSERT INTO `users` (
                    `username`,
                    `password`
                ) VALUES (
                    '" . $guest_username . "',
                    '" . $guest_password . "'
                );";
        parent::__construct($name, $_create_table_sql, $_fill_data_sql);
    }
}