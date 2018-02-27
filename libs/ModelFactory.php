<?php

class ModelFactory {
    protected $db;
    protected $tableName;

    public function __construct() {
        $this->db = App::$db;
    }

    protected static function getTableName() {
        $class = new ReflectionClass(get_called_class()); // this is static method that's why i use get_called_class
        $entity = $class->newInstance();
        return $entity->tableName;
    }

    protected static function getProperties() {
        $class = new ReflectionClass(get_called_class());
        $fields = array();
        foreach ($class->getProperties(ReflectionProperty::IS_PUBLIC) as $prop) {
            $fields[] = $prop->getName();
        }
        return $fields;
    }

    protected static function arrayToObject(array $object) {
        $class = new ReflectionClass(get_called_class());
        $entity = $class->newInstance();

        foreach ($class->getProperties(ReflectionProperty::IS_PUBLIC) as $prop) {
            if (isset($object[$prop->getName()])) {
                $prop->setValue($entity, $object[$prop->getName()]);
            }
        }
        return $entity;
    }

    public static function getAll($select = null, $wheres = []) {
        $result = [];
        $tableName = self::getTableName();
        $query = DbQuery::getSelect($select) . ' FROM ' . $tableName . DbQuery::getWhere($wheres);
        $raw = App::$db->query($query);
        foreach ($raw as $rawRow) {
            $result[] = self::arrayToObject($rawRow);
        }
        return $result;
    }

    public static function find($wheres = []) {
        $tableName = self::getTableName();
        $query = 'SELECT * FROM ' . $tableName . DbQuery::getWhere($wheres);
        $raw = App::$db->query($query);
        if (count($raw) > 0) {
            return self::arrayToObject($raw[0]);
        }
        return null;
    }

    public static function pagination($perPage = 10, $page = 1) {
        $result = [];
        $query = "SELECT COUNT(*) as num FROM " . self::getTableName();
        $totalRow = App::$db->query($query)[0]['num'];
        $totalPage = ceil($totalRow / $perPage);

        $result['totalRow'] = (int)$totalRow;
        $result['totalPage'] = $totalPage;
        $result['perPage'] = $perPage;
        $result['page'] = $page;

        /* Get data. */
        $start = ($page - 1) * $perPage;            //first item to display on this page
        $query = "SELECT * FROM " . self::getTableName() . " LIMIT $start, $perPage";
        $raw = App::$db->query($query);

        foreach ($raw as $rawRow) {
            $result['data'][] = self::arrayToObject($rawRow);
        }
        return $result;
    }

    /**
     * @param array $data
     * @return mixed
     * @throws Exception
     */
    public static function create($data = array()) {
        $fields = self::getProperties();
        foreach ($data as $key => $value) {
            if (!in_array($key, $fields)) {
                throw new Exception("Unknown column '$key' in field list");
            }
        }
        return DbQuery::insert(App::$db, $data, self::getTableName());
    }

    /**
     * Alo ha
     * @param array $data
     * @return mixed
     * @throws Exception
     */
    public static function createBatch($data = array()) {
        $fields = self::getProperties();
        foreach ($data as $row) {
            foreach ($row as $key => $value) {
                if (!in_array($key, $fields)) {
                    throw new Exception("Unknown column '$key' in field list");
                }
            }
        }
        return DbQuery::insertBatch(App::$db, $data, self::getTableName());
    }

    public static function destroy($wheres = []) {
        $tableName = self::getTableName();
        $query = 'DELETE FROM ' . $tableName . DbQuery::getWhere($wheres);
        $result = App::$db->query($query);
        return $result;
    }
}