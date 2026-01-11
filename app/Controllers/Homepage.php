<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Photo;

class Homepage extends BaseController
{
    protected $photo;

    public function __construct(){
        $this->photo = new Photo();
    }
    
    public function index()
    {
        $data = [
            'photos' => $this->photo->where('featured', 1)->findAll(),
        ];
        return view('homepage', $data);
    }
}
