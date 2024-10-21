<?php
class HomeModel extends Model
{
    protected $_table = 'provinces';

    public function __construct()
    {
        parent::__construct();
    }

    public function getList()
    {
        $data = $this->db->query('SELECT * FROM ' . $this->_table)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getDetails($id)
    {
        $data = ['item1', 'item2', 'item3'];
        return $data[$id];
    }
}