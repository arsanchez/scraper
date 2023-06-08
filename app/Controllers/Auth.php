<?php

namespace App\Controllers;
use App\Models\AccountModel;

class Auth extends BaseController
{
    protected $helpers = ['form'];

    public function login()
    {
        if (! $this->request->is('post')) {
            return view('auth/login');
        }

        $session = session();
        $accountModel = new AccountModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $data = $accountModel->where('username', $username)->first();

        if($data){
            $pass = $data['password'];
            $valid = password_verify($password, $pass);
            if($valid){
                $ses_data = [
                    'id' => $data['id'],
                    'username' => $data['username'],
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->redirect("/");

            }else{
                $session->setFlashdata('msg', 'Password is incorrect.');
                return redirect()->redirect("/auth/login");
            }
        }else{
            $session->setFlashdata('msg', 'Email does not exist.');
            return redirect()->redirect("/auth/login");
        }
    }

    public function signup()
    {
        if (! $this->request->is('post')) {
            return view('auth/signup');
        }

        $rules = [
            'username'          => 'required|min_length[2]|max_length[50]',
            'password'      => 'required|min_length[4]|max_length[50]',
            'confirmpassword'  => 'matches[password]'
        ];

        if($this->validate($rules)){
            $accountModel = new AccountModel();
            $data = [
                'username'     => $this->request->getVar('username'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
            ];
            $accountModel->save($data);
            return redirect()->redirect("/auth/login");
        }else{
            $data['validation'] = $this->validator;
            return view('auth/signup', $data);
        }

    }
}