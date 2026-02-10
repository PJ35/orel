<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Contact as ContactModel;

class Contact extends BaseController
{
    protected $helpers = ['form'];
    protected $contact;
    
    public function __construct()
    {
        $this->contact = new ContactModel();
    }

    public function index()
    {
        $data = [
            'contacts' => $this->contact->findAll(),
        ];
        return view('contact', $data);
    }
}
