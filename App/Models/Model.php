<?php

namespace App\Models;

use App\Db;
use App\Exceptions\Errors;
use App\GetSet;
use App\TraitIterator;

/**
 * Class Model
 * Класс модели
 *
 * @package App\Models
 * @property string id
 */
abstract class Model implements \Iterator
{
    use GetSet;
    use TraitIterator;

    protected const TABLE = null;

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
        return (empty($res)) ? false : $res[0];
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

        $columns = [];
        $params = [];
        $data = [];

        foreach ($this as $key => $value) {
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

        $params = [];
        $sqlParams = [];

        foreach ($this as $key => $value) {
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

    /**
     * Заполняет свойства текущей
     * модели данными из массива $data
     *
     * @param array $data
     * @throws Errors
     */
    public function fill(array $data)
    {
        $errors = new Errors();

        foreach ($data as $key => $value) {
            try {
                $this->$key = $value;
            } catch (\Exception $e) {
                $errors->add($e);
            }
        }

        if (!empty($errors->getErrors())) {
            throw $errors;
        }
    }

    public function __set($key, $value) {
        $method = 'set' . ucfirst($key);
        if (method_exists($this, $method)) {
            $this->$method($value);
        } else {
            $this->data[$key] = $value;
        }
    }

    /**
     * Устанавливает свойство ID
     * у текущей модели
     *
     * @param $id
     */
    public function setId($id) {
        if (!is_numeric($id) && 0 > $id) {
            throw new \InvalidArgumentException('The id must be a number and greater than 0');
        }
        $this->data['id'] = (int)$id;
    }
}
