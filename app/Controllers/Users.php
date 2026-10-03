<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();

        $users = $userModel->findAll();

        return view('users/index', [
            'users' => $users
        ]);
    }

    public function new()
    {
        return view('users/new');
    }

    public function create()
    {
        $rules = [
            'username' => 'required|is_unique[users.username]',
            'full_name' => 'required'
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $userModel = new UserModel();

        $data = [
            'username' => $this->request->getPost('username'),
            'full_name' => $this->request->getPost('full_name'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        $userModel->insert($data);

        return redirect()->to('/users');
    }

    public function edit($id)
    {
        $userModel = new UserModel();

        $user = $userModel->find($id);

        if (!$user) {
            return redirect()->to('/users');
        }

        return view('users/edit', [
            'user' => $user
        ]);
    }

    public function update($id)
    {
        $rules = [
            'username' => 'required|is_unique[users.username,id,' . $id . ']',
            'full_name' => 'required'
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $userModel = new UserModel();

        $data = [
            'username' => $this->request->getPost('username'),
            'full_name' => $this->request->getPost('full_name')
        ];

        $avatar = $this->request->getFile('avatar');

        if ($avatar && $avatar->getError() !== UPLOAD_ERR_NO_FILE) {
            if (! $this->validateData([], [
                'avatar' => 'is_image[avatar]|mime_in[avatar,image/jpeg,image/png]|ext_in[avatar,jpg,jpeg,png]|max_size[avatar,2048]',
            ])) {
                return redirect()->back()->withInput();
            }
        }

        if ($avatar && $avatar->isValid() && !$avatar->hasMoved()) {

            if ($avatar->getSize() > 2048 * 1024) {
                return redirect()->back()->withInput();
            }

            $allowedTypes = ['image/jpeg', 'image/png'];

            if (!in_array($avatar->getMimeType(), $allowedTypes)) {
                return redirect()->back()->withInput();
            }

            $newName = $avatar->getRandomName();

            $avatar->move(FCPATH . 'uploads/avatars', $newName);

            $image = service('image');

            $image->withFile(FCPATH . 'uploads/avatars/' . $newName)
                ->fit(300, 300)
                ->save(FCPATH . 'uploads/avatars/' . $newName);

            $data['avatar'] = $newName;
        }

        $userModel->update($id, $data);

        return redirect()->to('/users');
    }
}
