<?php

namespace DB;

class DB extends \PDO
{
    public function __construct($file = 'db.ini', $database = 'default')
    {
        if (!$conf = parse_ini_file($file, TRUE)) throw new exception("Não foi possível abrir o arquivo $file.");
        
        $dns = "{$conf[$database]['driver']}:host={$conf[$database]['host']};dbname={$conf[$database]['schema']};port=" . ($conf[$database]['port'] ?? '3306');

        $options = [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION];
        
        parent::__construct($dns, $conf[$database]['user'], $conf[$database]['pass'], $options);
    }
}