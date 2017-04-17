<?php

namespace App;

use App\Exceptions\DbException;
use App\Logger;

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
            $this->dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            $newExc = new DbException($e->getMessage(), $e->getCode());
            Logger::getInstance()->error((string)$newExc);
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
        try {
            $sth = $this->dbh->prepare($sql);
            $sth->execute($params);
            return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
        } catch (\PDOException $e) {
            $newExc = new DbException($e->getMessage(), $e->getCode());
            Logger::getInstance()->error((string)$newExc);
            throw $newExc;
        }
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
        try {
            $sth = $this->dbh->prepare($sql);
            return $sth->execute($params);
        } catch (\PDOException $e) {
            $newExc = new DbException($e->getMessage(), $e->getCode());
            Logger::getInstance()->error((string)$newExc);
            throw $newExc;
        }
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
