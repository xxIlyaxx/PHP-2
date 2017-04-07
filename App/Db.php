<?php

namespace App;

use App\Exceptions\DbException;

/**
 * Class Db
 * Класс базы данных
 *
 * @package App
 */
class Db
{
    use Singleton;

    protected $dbh;

    protected function __construct()
    {
        $config = Config::getInstance();

        $dsn = 'mysql:host=' . $config->data['db']['host'] .
            ';dbname=' . $config->data['db']['dbname'];
        try {
            $this->dbh = new \PDO(
                $dsn,
                $config->data['db']['user'],
                $config->data['db']['pass']
            );
        } catch (\PDOException $e) {
            $newExc = new DbException($e->getMessage(), 1);
            throw $newExc;
        }
    }

    /**
     * Выполняет запрос и возвращает результат в виде массива
     *
     * @param string $sql
     * @param string $class
     * @param array $params
     * @return array
     * @throws DbException
     */
    public function query(string $sql, string $class, $params = [])
    {
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($params);

        if (false === $res) {
            throw new DbException('Incorrect SQL query', 2);
        }
        return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
    }

    /**
     * Выполняет запрос и возвращает результат в виде bool
     *
     * @param string $sql
     * @param array $params
     * @return bool
     * @throws DbException
     */
    public function execute($sql, $params = [])
    {
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($params);

        if (false === $res) {
            throw new DbException('Incorrect SQL query', 2);
        }
        return $res;
    }

    /**
     * Возвращает последний, вставленный ID
     *
     * @param string|null $name
     * @return string
     */
    public function lastInsertId(string $name = null)
    {
        return $this->dbh->lastInsertId($name);
    }
}
