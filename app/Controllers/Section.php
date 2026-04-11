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
            'sections' => $this->section->findAll(),
        ];
        return view('sections', $data);
    }

    public function show($id)
    {
        $data = [
            'section' => $this->section->find($id),
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
        
        return view('section/create');
    }

    public function store()
    {
        if (!$this->ionAuth->loggedIn() || !$this->ionAuth->isAdmin()) {
            return redirect()->to('/auth/login')->with('error', 'Přístup odepřen');
        }
        
        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'user_id' => $this->ionAuth->user()->row()->id,
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
        
        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
        ];
        $this->section->update($id, $data);
        return redirect()->to('sections')->with('success', 'Oddíl byl úspěšně aktualizován.');
    }
}
