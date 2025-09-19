<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UsersModel extends Model {
    protected $table = 'students';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_users($limit, $offset, $search = '')
    {
        $builder = $this->db->table($this->table);

        if(!empty($search)){
            $builder->like('first_name', $search);
            $builder->or_like('last_name', $search);
            $builder->or_like('email', $search);
        }

        return $builder->limit($limit, $offset)->get_all();
    }

    public function count_users($search = '')
    {
        $builder = $this->db->table($this->table);

        if(!empty($search)){
            $builder->like('first_name', $search);
            $builder->or_like('last_name', $search);
            $builder->or_like('email', $search);
        }

        return $builder->count();
    }
}
