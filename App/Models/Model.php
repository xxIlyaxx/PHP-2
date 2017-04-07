<?php

namespace App\Models;

use App\Db;
use App\Exceptions\NotFoundException;

/**
 * Class Model
 * Класс модели
 *
 * @package App\Models
 */
abstract class Model
{
    protected const TABLE = null;
    public $id = null;

    /**
     * Находит и возвращает все модели
     * из текущей таблицы
     *
     * @return mixed
     */
    public static function findAll()
    {
        $db = Db::getInstance();
        $sql = 'SELECT * FROM ' . static::TABLE;
        return $db->query($sql, static::class);
    }

    /**
     * Находит модель из текущей таблицы
     * по ее ID
     *
     * @param int $id
     * @return mixed
     * @throws NotFoundException
     */
    public static function findById(int $id)
    {
        $db = Db::getInstance();
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE id = :id';
        $res = $db->query($sql, static::class, [':id' => $id]);
        if (empty($res)) {
            throw new NotFoundException('No record found with this id', 2);
        }
        return $res[0];
    }

//    public static function findLast($count = 3)
//    {
//        $db = new Db();
//        $sql = 'SELECT * FROM ' . static::TABLE . ' ORDER BY id DESC LIMIT ' . (int)$count;
//        return $db->query($sql, static::class);
//    }

    /**
     * @param int $count
     * @return array
     */
    public static function findLast(int $count = 3)
    {
        $articles = static::findAll();
        return array_slice(array_reverse($articles), 0, $count);
    }

    /**
     * Создает запись текущей модели
     * в базе данных
     *
     * @return bool
     */
    public function insert()
    {
        $db = Db::getInstance();
        $vars = get_object_vars($this);

        $columns = [];
        $params = [];
        $data = [];

        foreach ($vars as $key => $value) {
            if ($key == 'id') {
                continue;
            }
            $columns[] = $key;
            $params[] = ':' . $key;
            $data[':' . $key] = $value;
        }

        $sql = 'INSERT INTO ' . static::TABLE . ' (' . implode(', ', $columns) . ') ' .
            'VALUES (' . implode(', ', $params) . ')';

        $res = $db->execute($sql, $data);
        if (true === $res) {
            $this->id = $db->lastInsertId();
        }
        return $res;
    }

    /**
     * Обновляет запись в базе данных
     *
     * @return bool
     */
    public function update()
    {
        $db = Db::getInstance();
        $vars = get_object_vars($this);

        $params = [];
        $sqlParams = [];

        foreach ($vars as $key => $value) {
            $params[':' . $key] = $value;
            if ($key == 'id') {
                continue;
            }
            $sqlParams[] = $key . ' = :' . $key;
        }

        $sql = 'UPDATE ' . static::TABLE . ' SET ' .
            implode(', ', $sqlParams) . ' WHERE id = :id';
        return $db->execute($sql, $params);
    }

    /**
     * Удаляет текущую модель из
     * базы данных
     *
     * @return bool
     */
    public function delete()
    {
        $db = Db::getInstance();
        $sql = 'DELETE FROM ' . static::TABLE . ' WHERE id = :id';

        return $db->execute($sql, [':id' => $this->id]);
    }

    /**
     * Записывает изменения текущей модели в
     * базу данных
     *
     * @return bool
     */
    public function save()
    {
        if (null === $this->id) {
            return $this->insert();
        } else {
            return $this->update();
        }
    }
}
