<?php

class MY_Model extends CI_Model {
    const DB_TABLE = 'abstract';
    const DB_TABLE_PK = 'abstract';

    /**
     * Create record.
     */
    private function insert() {
        if ($this->db->insert($this::DB_TABLE, $this)) {
            $this->{$this::DB_TABLE_PK} = $this->db->insert_id();
            return true;
        }
        return false;
    }

    /**
     * Update record.
     */
    private function update () {
        return $this->db->update($this::DB_TABLE, $this, array($this::DB_TABLE_PK => $this->{$this::DB_TABLE_PK}));
    }

    /**
     * Populate from an array or standard class.
     * @param mixed $row
     */
    private function populate ($row) {
        foreach ($row as $key => $value) {
            $this->$key = $value;
        }
        $this->loadObjectAttributes();
    }

    public static function load ($id) {
        $db = &get_instance()->db;
        $query = $db->get_where(static::DB_TABLE, array(
            static::DB_TABLE_PK => $id,
        ));

        $class = get_called_class();
        $obj = new $class;
        $obj->populate($query->row());

        return $obj;
    }

    /**
     * Delete the current record.
     */
    public function delete() {
        if ($this->db->delete($this::DB_TABLE, array($this::DB_TABLE_PK => $this->{$this::DB_TABLE_PK}))) {
            unset($this->{$this::DB_TABLE_PK});
            return true;
        }
        return false;
    }

    /**
     * Save the record.
     */
    public function save () {
        if (isset($this->{$this::DB_TABLE_PK}) && $this->countWhere(array($this::DB_TABLE_PK => $this->{$this::DB_TABLE_PK}))){
            return $this->update();
        } else {
            return $this->insert();
        }
    }

    /**
     * Get an array of Models with an optional limit, offset.
     * @param array $andCondition Optional.
     * @param string $order Optional.
     * @param int $limit Optional.
     * @param int $offset Optional; if set, requires $limit.
     * @return MY_Model [] populated by database, keyed by PK.
     */
    public static function get($andCondition = array(),$order = 0, $limit = 0, $offset = 0) {
        $db = &get_instance()->db;
        if($limit){
            if ($order) {
                $db->order_by($order);
            }
            $query = $db->get_where(static::DB_TABLE, $andCondition, $limit, $offset);
        } else {
            if ($order) {
                $db->order_by($order);
            }
            $query = $db->get_where(static::DB_TABLE, $andCondition);
        }

        $ret_val = array();
        $class = get_called_class();

        foreach ($query->result() as $row) {
            $obj = new $class;
            $obj->populate($row);
            $ret_val[$row->{static::DB_TABLE_PK}] = $obj;
        }

        return $ret_val;
    }

    public static function countWhere ($condition = array()) {
        $db = &get_instance()->db;
        $db->where($condition);
        return $db->count_all_results(static::DB_TABLE);
    }

    protected function loadObjectAttributes() {
        //Must be override in the inherited classes
    }
}