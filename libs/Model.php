<?php

class Model extends ModelFactory {

    public function toArray() {
        $class = new ReflectionClass($this);
        $fields = array();
        foreach ($class->getProperties(ReflectionProperty::IS_PUBLIC) as $property) { // consider only public properties of the providen
            $propertyName = $property->getName();
            if (isset($this->$propertyName)) {
                $fields[$propertyName] = $this->{$propertyName};
            }
        }
        return $fields;
    }

    public function save() {
        $result = DbQuery::insert($this->db, $this->toArray(), $this->tableName, $this->id);
        return $result;
    }

    public function delete() {
        return self::destroy($this->id);
    }

    public function show() {
        $class = new ReflectionClass(get_called_class());

        foreach ($class->getProperties(ReflectionProperty::IS_PUBLIC) as $prop) {
            $p = $prop->getName();
            if (isset($this->$p)) {
                echo $p . ':' . $this->$p;
            }
        }
    }
}