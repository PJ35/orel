<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Section as SectionModel;

class Section extends BaseController
{
    protected $helpers = ['form'];
    protected $section;

    public function __construct()
    {
        $this->section = new SectionModel();
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
        return view('section/create');
    }

    public function store()
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'user_id' => session()->get('user_id') ?? 1,
        ];
        $this->section->insert($data);
        return redirect()->to('section/create')->with('success', 'Section created successfully.');
    }
}
