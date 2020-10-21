<?php namespace App\Models;

use CodeIgniter\Model;

class LinkModel extends Model{
    protected $table = 'links';
    protected $allowedFields = ['user_id', 'links'];

    public function getLinks($id)
    {
        return $this->asArray()->where(['user_id' => $id])->findAll();
    }

    public function getUpdateLink($id)
    {
        return $this->asArray()->where(['id' => $id])->orderBy('id', 'DESC')->first();
    }
}
