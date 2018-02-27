<?php

class DbQuery {

    public static function getSelect($select) {
        if ($select != null) {
            if (is_string($select)) {
                $query = "SELECT $select";
            } else if (is_array($select)) {
                if (!empty($select)) {
                    $query = "SELECT " . implode(',', $select);
                }
            } else {
                throw new Exception('Wrong parameter type of select');
            }
        } else {
            $query = "SELECT *";
        }
        return $query;
    }

    public static function getWhere($wheres = []) {
        $whereConditions = [];
        $query = '';
        if (is_array($wheres)) {
            if (!empty($wheres)) {
                foreach ($wheres as $key => $value) {
                    $whereConditions[] = '`' . $key . '` = "' . $value . '"';
                }
                $query = " WHERE " . implode(' AND ', $whereConditions);
            }
        } else if (is_numeric($wheres)) {
            $query = ' WHERE id = ' . $wheres;
        } else if (is_string($wheres)) {
            $query = " WHERE $wheres";
        } else {
            throw new \Exception('Wrong parameter type of options');
        }
        return $query;
    }

    public static function insert($db, $data, $tableName, $id = 0) {
        foreach ($data as $key => $value) {
            $propsToImplode[] = '`' . $key . '` = "' . $db->escape($value) . '"';
        }

        $setClause = implode(',', $propsToImplode); // glue all key value pairs together

        if ($id > 0) {
            $sqlQuery = 'UPDATE `' . $tableName . '` SET ' . $setClause . ' WHERE id = ' . $id;
        } else {
            $sqlQuery = 'INSERT INTO `' . $tableName . '` SET ' . $setClause;
        }

        $result = $db->query($sqlQuery);
        return $result;
    }

    public static function insertBatch($db, $data, $tableName) {
        $sql = array();
        $fields = '';
        $updateStr = '';
        $i = 0;
        foreach ($data as $row) {
            $strVals = '';
            foreach ($row as $key => $val) {
                if ($i == 0) {
                    $fields .= ",`$key`";
                    $updateStr .= ", `$key` = VALUES(`$key`)";
                }
                $strVals .= ",'" . $db->escape($val) . "'";
            }
            $strVals = trim($strVals, ',');
            $sql[] = '(' . $strVals . ')';
            $i++;
        }

        $fields = trim($fields, ',');
        $updateStr = trim($updateStr, ',');
        $sqlInsertBatch = 'INSERT INTO `' . $tableName . '` (' . $fields . ') VALUES ' . implode(',', $sql);
        $sqlInsertBatch .= ' ON DUPLICATE KEY UPDATE ' . $updateStr;

        $result = $db->query($sqlInsertBatch);
        return $result;
    }
}