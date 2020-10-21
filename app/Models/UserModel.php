<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model{
    protected $table = 'users';
    protected $allowedFields = ['username', 'email', 'password'];

    public function getUser($id)
    {
        return $this->asArray()->where(['id' => $id])->first();
    }

    public function getAll($username)
    {
    	return $this->asArray()->where(['username' => $username])->join('links', 'users.id = links.user_id')->findAll();
    }
}
