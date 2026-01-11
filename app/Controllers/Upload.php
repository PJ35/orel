<?php

namespace App\Controllers;

use CodeIgniter\Files\File;
use App\Models\Photo;

class Upload extends BaseController
{
    protected $helpers = ['form'];
    protected $photo;

    public function __construct(){
        $this->photo = new Photo();
    }

    public function index()
    {
        return view('upload_form', ['errors' => []]);
    }

    public function upload()
    {
        $validationRule = [
            'userfile' => [
                'label' => 'Image File',
                'rules' => [
                    'uploaded[userfile]',
                    'is_image[userfile]',
                    'mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[userfile,1000]',
                    'max_dims[userfile,1920,1080]',
                ],
            ],
        ];
        if (! $this->validateData([], $validationRule)) {
            $data = ['errors' => $this->validator->getErrors()];

            return view('upload_form', $data);
        }

        $img = $this->request->getFile('userfile');

        if (! $img->hasMoved()) {
            $newName = $img->getRandomName();
            $img->move(FCPATH . 'photos', $newName);
            
            $filepath = FCPATH . 'photos/' . $newName;

            $insert = [
                'path' => $newName,
                'featured' => 0,
                'article_id' => null,
            ];

            $this->photo->insert($insert);

            $data = ['uploaded_fileinfo' => new File($filepath)];

            return view('upload_success', $data);
        }

        $data = ['errors' => 'The file has already been moved.'];

        return view('upload_form', $data);
    }
}