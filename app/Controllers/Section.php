<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Section as SectionModel;
use IonAuth\Libraries\IonAuth;

class Section extends BaseController
{
    protected $helpers = ['form'];
    protected $section;
    protected $ionAuth;

    public function __construct()
    {
        $this->section = new SectionModel();
        $this->ionAuth = new IonAuth();
    }

    public function index()
    {
        $data = [
            'sections' => $this->section->select('section.*, users.email')->join('users', 'users.id = section.user_id', 'left')->findAll(),
        ];
        return view('sections', $data);
    }

    public function show($id)
    {
        $data = [
            'section' => $this->section->select('section.*, users.email')->join('users', 'users.id = section.user_id', 'left')->find($id),
        ];
        if (!$data['section']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Section not found');
        }
        return view('section', $data);
    }

    public function create()
    {
        if (!$this->ionAuth->loggedIn() || !$this->ionAuth->isAdmin()) {
            return redirect()->to('/auth/login')->with('error', 'Přístup odepřen');
        }
        
        $data = [
            'users' => $this->ionAuth->users()->result(),
        ];

        return view('section/create', $data);
    }

    public function store()
    {
        if (!$this->ionAuth->loggedIn() || !$this->ionAuth->isAdmin()) {
            return redirect()->to('/auth/login')->with('error', 'Přístup odepřen');
        }

        $validation = \Config\Services::validation();
        $validation->setRule('user_id', 'Vedoucí', 'required|is_natural_no_zero|is_not_unique[users.id]');

        if (! $validation->withRequest($this->request)->run()) {
            $data = [
                'users' => $this->ionAuth->users()->result(),
                'validation' => $validation,
                'name' => $this->request->getPost('name'),
                'description' => $this->request->getPost('description'),
                'selectedUserId' => $this->request->getPost('user_id'),
            ];

            return view('section/create', $data);
        }
        
        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'user_id' => $this->request->getPost('user_id'),
        ];
        $this->section->insert($data);
        return redirect()->to('sections')->with('success', 'Oddíl byl úspěšně vytvořen.');
    }

    public function edit($id)
    {
        if (!$this->ionAuth->loggedIn() || !$this->ionAuth->isAdmin()) {
            return redirect()->to('/auth/login')->with('error', 'Přístup odepřen');
        }
        
        $data = [
            'section' => $this->section->find($id),
            'users' => $this->ionAuth->users()->result(),
        ];
        if (!$data['section']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Oddíl nenalezen');
        }
        return view('section/edit', $data);
    }

    public function update($id)
    {
        if (!$this->ionAuth->loggedIn() || !$this->ionAuth->isAdmin()) {
            return redirect()->to('/auth/login')->with('error', 'Přístup odepřen');
        }

        $validation = \Config\Services::validation();
        $validation->setRule('user_id', 'Vedoucí', 'required|is_natural_no_zero|is_not_unique[users.id]');

        if (! $validation->withRequest($this->request)->run()) {
            $data = [
                'section' => $this->section->find($id),
                'users' => $this->ionAuth->users()->result(),
                'validation' => $validation,
                'name' => $this->request->getPost('name'),
                'description' => $this->request->getPost('description'),
                'selectedUserId' => $this->request->getPost('user_id'),
            ];

            if (!$data['section']) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException('Oddíl nenalezen');
            }

            return view('section/edit', $data);
        }
        
        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'user_id' => $this->request->getPost('user_id'),
        ];
        $this->section->update($id, $data);
        return redirect()->to('sections')->with('success', 'Oddíl byl úspěšně aktualizován.');
    }
}
