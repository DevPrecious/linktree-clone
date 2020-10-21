<?php namespace App\Controllers;

use App\Models\LinkModel;
use App\Models\UserModel;

class Home extends BaseController
{
	public function home()
	{
	    $data = [];
	    $model = new UserModel();
	    $modelLinks = new LinkModel();
	    $id = session()->get('id');
	    $data['user'] = $model->getUser($id);
	    $data['links']  = $modelLinks->getLinks($id);
		return view('home', $data);
	}

    public function create()
    {
        $data = [];
        $id = session()->get('id');
        if($this->request->getMethod() == 'post'){
            $rules = [
                'link' => [
                    'rules' =>'required|valid_url'
                ]
            ];
            if(!$this->validate($rules)){
                $data['validation'] = $this->validator;
            }else{
                $model = new LinkModel();
                $newData = [
                    'user_id' => $id,
                    'links' => $this->request->getVar('link')
                ];
                $model->save($newData);
                $session = session();
                $session->setFlashdata('success', 'Created');
                return redirect()->to('/home');
            }
        }
        echo view('link/create', $data);
	}

    public function edit($id)
    {
        $data = [];
        $userid = session()->get('id');
        $modelLink = new LinkModel();
        $modelUser = new UserModel();
        $data['link'] = $modelLink->getUpdateLink($id);
        $data['user'] = $modelUser->getUser($userid);

          if (empty($data['link']))
    {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the edit item: '. $id);
    }

        if($this->request->getMethod() == 'post'){
            $rules = [
                'link' => [
                    'rules' =>'required|valid_url'
                ]
            ];
            if(!$this->validate($rules)){
                $data['validation'] = $this->validator;
            }else{
                $updateData = [
                    'id' => $this->request->getVar('id'),
                    'links' => $this->request->getVar('link')
                ];
                $modelLink->update($updateData['id'], $updateData);
                $session = session();
                $session->setFlashdata('update', 'Updated');
                return redirect()->to('/home');
            }
        }
        echo view('link/edit', $data);
	}


    public function user($username)
    {
        $data = [];
        $model = new UserModel();
        $data['users'] = $model->getAll($username);

          if (empty($data['users']))
    {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the User: '. $username);
    }
        echo view('link/user', $data);
    }

    public function delete($id)
    {
        $modelLink = new LinkModel();
        $modelLink->delete($id);
        return redirect()->to('/home');
	}

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
	}

	//--------------------------------------------------------------------

}
