<?php

namespace App\Controllers;
use App\Models\AccountModel;

class Auth extends BaseController
{
    protected $helpers = ['form'];

    public function login()
    {
        $data = [];
        return view('auth/login', $data);
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