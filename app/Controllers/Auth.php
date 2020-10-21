<?php namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
	public function register()
	{
	    $data = [];
	    helper(['form']);
	    if($this->request->getMethod() == 'post'){
	        $rules = [
	            'username' => [
	                'rules' => 'required|min_length[6]|max_length[12]|is_unique[users.username]',
                    'label' => 'Username'
                ],
                'email' => [
                    'rules' => 'required|valid_email|is_unique[users.email]',
                    'label' => 'Email Address'
                ],
                'password' => [
                    'rules' => 'required|min_length[4]',
                    'label' => 'Password'
                ]
            ];

	        if(!$this->validate($rules)){
	            $data['validation'] = $this->validator;
            }else{
	            $passwordhash = $this->request->getVar('password');
	            $hashedpass = password_hash($passwordhash, PASSWORD_DEFAULT);
            $model = new UserModel();
            $newData = [
                'username' => $this->request->getVar('username'),
                'email' => $this->request->getVar('email'),
                'password' => $hashedpass,
            ];
            $data = $model->save($newData);
            if($data){
                $user = $model->where('email', $this->request->getVar('email'))->first();
                $this->setUserSession($user);
                return redirect()->to('/home');
            }else{
                return false;
            }
            }

        }
		echo view('auth/register', $data);
	}

	private function setUserSession($user){
	    $data = [
	        'id' => $user['id'],
            'username' => $user['username'],
            'isLoggedIn' => True,
        ];
	    session()->set($data);
	    return true;
    }

    public function login()
    {
        $data = [];
        if($this->request->getMethod() == 'post'){
            $rules = [
                'username' => [
                    'rules' => 'required|min_length[6]|max_length[12]',
                    'label' => 'Username'
                ],
                'password' => [
                    'rules' => 'required|min_length[4]',
                    'label' => 'Password'
                ]
            ];
            if(!$this->validate($rules)){
                $data['validation'] = $this->validator;
            }
            else{
                $username = $this->request->getVar('username');
                $password = $this->request->getVar('password');
                $model = new UserModel();
                $user = $model->where('username', $username)->first();
                if(!$user){
                    $session = session();
                    $session->setFlashdata('error', 'Wrong username or password');
                }else{
                    $passwordVerify = password_verify($password, $user['password']);
                    $user = $model->where('username', $this->request->getVar('username'))->first();
                    $data = [
                        'id' => $user['id'],
                        'username' => $user['username'],
                        'isLoggedIn' => True,
                    ];
                    session()->set($data);
                    return redirect()->to('/home');
                }
            }
        }
        echo view('auth/login', $data);
    }

	//--------------------------------------------------------------------

}
