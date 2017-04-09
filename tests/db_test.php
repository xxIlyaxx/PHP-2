<?php

require __DIR__ . '/../autoload.php';

use App\Db;

$db = Db::getInstance();
$sql = 'INSERT INTO news (title, lead) VALUES (:title, :lead)';
$params = [':title' => 'some title', ':lead' => 'some lead'];
assert(true == $db->execute($sql, $params));

$sql = 'INSERT INTO sometable (title, lead) VALUES (:title, :lead)';
assert(false == $db->execute($sql, $params));
