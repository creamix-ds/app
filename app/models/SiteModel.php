<?php

class SiteModel
{
    private array $db;

    public function __construct()
    {
        $this->db = require __DIR__ . '/../config/fake_db.php';
    }

    public function getAllContent(): array
    {
        return $this->db;
    }
}
