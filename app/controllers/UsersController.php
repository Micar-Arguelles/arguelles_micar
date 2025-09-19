<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: UsersController
 * 
 * Automatically generated via CLI.
 */
class UsersController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->model('UsersModel');
        $this->call->library('pagination');
    }


    function index()
{       
    $page = 1;
    if ($this->io->get('page')) {
        $page = (int)$this->io->get('page');
    }

    $q = '';
    if ($this->io->get('q')) {
        $q = trim($this->io->get('q'));
    }

    $records_per_page = 5;

    // Kukunin sa model na may page() function
    $all = $this->UsersModel->page($q, $records_per_page, $page);

    $data['users'] = $all['records'];   // use 'users' para consistent sa view
    $total_rows = $all['total_rows'];

    // Setup pagination
    $this->pagination->set_options([
        'first_link'     => '⏮ First',
        'last_link'      => 'Last ⏭',
        'next_link'      => 'Next →',
        'prev_link'      => '← Prev',
        'page_delimiter' => '&page='
    ]);
    $this->pagination->set_theme('custom'); 
    $this->pagination->initialize($total_rows, $records_per_page, $page, '/?q='.$q);

    $data['page'] = $this->pagination->paginate();
    $data['q'] = $q;

    $this->call->view('users/index', $data);
}

    function create(){
        if($this->io->method() == 'post'){
            $first_name = $this->io->post('first_name');
            $last_name = $this->io->post('last_name');
            $email = $this->io->post('email');

            $data = [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email
            ];

            if($this->UsersModel->insert($data)){
                redirect(site_url(''));
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
            $first_name = $this->io->post('first_name');
            $last_name = $this->io->post('last_name');
            $email = $this->io->post('email');

            $data = [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email
            ];

            if($this->UsersModel->update($id, $data)){
                redirect();
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
            redirect();
        }else{
            echo "Error in deleting user.";
        }
    }
}