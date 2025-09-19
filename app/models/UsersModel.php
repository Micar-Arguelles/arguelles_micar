<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UsersModel extends Model {
    protected $table = 'students';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    // Kunin lahat ng users with pagination + search
    public function get_users($limit, $offset, $search = '')
    {
        $builder = $this->db->table($this->table);

        if (!empty($search)) {
            $builder->like('first_name', $search);
            $builder->or_like('last_name', $search);
            $builder->or_like('email', $search);
        }

        $builder->limit($limit, $offset);
        return $builder->get_all();
    }

    // Bilangin total users for pagination
    public function count_users($search = '')
    {
        $builder = $this->db->table($this->table);

        if (!empty($search)) {
            $builder->like('first_name', $search);
            $builder->or_like('last_name', $search);
            $builder->or_like('email', $search);
        }

        return $builder->count();
    }
}
