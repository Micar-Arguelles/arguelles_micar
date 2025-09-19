<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Model: UsersModel
 * 
 * For handling students table with pagination & search.
 */
class UsersModel extends Model {
    protected $table = 'students';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get paginated users with optional search
     */
    public function page($q = '', $records_per_page = 5, $page = 1) {
        $query = $this->db->table($this->table);

        // Search (LIKE conditions)
        if (!empty($q)) {
            $query->group_start()
                  ->like('id', $q)
                  ->or_like('last_name', $q)
                  ->or_like('first_name', $q)
                  ->or_like('email', $q)
                  ->group_end();
        }

        // Count all results
        $countQuery = $this->db->table($this->table);
        if (!empty($q)) {
            $countQuery->group_start()
                       ->like('id', $q)
                       ->or_like('last_name', $q)
                       ->or_like('first_name', $q)
                       ->or_like('email', $q)
                       ->group_end();
        }
        $total_rows = $countQuery->count_all_results();

        // Fetch paginated records
        $records = $query->order_by('id', 'ASC')
                         ->pagination($records_per_page, $page)
                         ->get_all();

        return [
            'total_rows' => $total_rows,
            'records'    => $records
        ];
    }

    /**
     * Get all users (no pagination, no search)
     */
    public function all() {
        return $this->db->table($this->table)->get_all();
    }
}
