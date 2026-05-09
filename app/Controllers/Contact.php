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

    public function create()
    {
        return view('contact/create');
    }

    public function store()
    {
        $this->contact->save([
            'name' => $this->request->getPost('name'),
            'address' => $this->request->getPost('address'),
        ]);
        return redirect()->to('/contact');
    }

    public function edit($id)
    {
        $contact = $this->contact->find($id);
        if (!$contact) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Contact not found');
        }
        $data = [
            'contact' => $contact,
        ];
        return view('contact/edit', $data);
    }

    public function update($id)
    {
        $contact = $this->contact->find($id);
        if (!$contact) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Contact not found');
        }
        $this->contact->update($id, [
            'name' => $this->request->getPost('name'),
            'address' => $this->request->getPost('address'),
        ]);
        return redirect()->to('/contact');
    }
}
