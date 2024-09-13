<?php

namespace App\Controllers;
use App\Models\Model_user;

class Auth extends BaseController
{
    protected $main_model;
 
    function __construct(){
        $this->main_model = new Model_user();
    }
    
    public function index()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Login'])
		];
		return view('auth-login', $data);
	}

	public function show_pages_register()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Register'])
		];
		return view('auth-register', $data);
	}

	public function show_pages_recoverpw()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Recover_Password'])
		];
		return view('auth-recoverpw', $data);
	}
	
	public function login()
    {
	    $session = session();
        
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $data = $this->main_model->where('username', $username)->first();
        if($data){
            $pass = $data->password;
            $verify_pass = password_verify($password, $pass);

            $user_data = $this->main_model->get_by_id($data->id);

            if($pass == $password){
                $ses_data = [
                    'activeId'  => $user_data->id,
                    'username'  => $user_data->username,
                    'nama'      => $user_data->nama,
                    'role'      => $user_data->role_name,
                    'signatureFile' => $user_data->signature_filename,
                    'id_karyawan' => $user_data->id_karyawan,
                    'logged_in' => TRUE,
                    'last_activity' => time()
                ];
                $session->set($ses_data);
                $session->setFlashdata('message', 'Login Berhasil');
                return redirect()->to('/dashboard');
            }else{
                $session->setFlashdata('error', 'Password Anda Salah');
                return redirect()->to('/');
            }
        }else{
            $session->setFlashdata('error', 'Username Tidak Ditemukan');
            return redirect()->to('/');
        }
    }
 
    public function logout()
    {
        $session = session();
        $session->setFlashdata('message', 'Berhasil Logout');
        $session->destroy();
        return redirect()->to('/');
    }

    // add user
    public function addUser()
    {   
        // Get the username and password from POST data
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Validate the input (this is basic validation, you can expand it as needed)
        if (empty($username) || empty($password)) {
            return redirect()->back()->with('error', 'Username and password are required.');
        }

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Create an instance of UserModel
        $userModel = new UserModel();

        // Prepare the data to be inserted
        $data = [
            'username' => $username,
            'password' => $hashedPassword,
        ];

        // Insert the data
        if ($userModel->insert($data)) {
            return redirect()->back()->with('success', 'User created successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to create user.');
        }
    }

}
