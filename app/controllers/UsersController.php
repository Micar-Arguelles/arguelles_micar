<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UsersController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->model('UsersModel');
    }

    public function index()
    {
        $search = $this->io->get('search') ?? '';
        $page   = (int) ($this->io->get('page') ?? 1);
        $limit  = 5; // students per page
        $offset = ($page - 1) * $limit;

        $data['search'] = $search;
        $data['users']  = $this->UsersModel->get_users($limit, $offset, $search);
        $total_users    = $this->UsersModel->count_users($search);
        $data['total_pages'] = ceil($total_users / $limit);
        $data['current_page'] = $page;

        $this->call->view('users/index', $data);
    }

    function create(){
        if($this->io->method() == 'post'){
            $data = [
                'first_name' => $this->io->post('first_name'),
                'last_name'  => $this->io->post('last_name'),
                'email'      => $this->io->post('email')
            ];

            if($this->UsersModel->insert($data)){
                redirect(site_url('users'));
            }else{
                echo "Error in creating user.";
            }

        }else{
            $this->call->view('users/create');
        }
    }

    function update($id){
        $user = $this->UsersModel->find($id);
        if(!$user){
            echo "User not found.";
            return;
        }

        if($this->io->method() == 'post'){
            $data = [
                'first_name' => $this->io->post('first_name'),
                'last_name'  => $this->io->post('last_name'),
                'email'      => $this->io->post('email')
            ];

            if($this->UsersModel->update($id, $data)){
                redirect(site_url('users'));
            }else{
                echo "Error in updating information.";
            }
        }else{
            $data['user'] = $user;
            $this->call->view('users/update', $data);
        }
    }
    
    function delete($id){
        if($this->UsersModel->delete($id)){
            redirect(site_url('users'));
        }else{
            echo "Error in deleting user.";
        }
    }
}
