<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Article as ArticleModel;

class Article extends BaseController
{
    protected $helpers = ['form'];
    protected $article;

    public function __construct()
    {
        $this->article = new ArticleModel();
    }

    public function index()
    {
        $data = [
            'articles' => $this->article->paginate(5),//5 for testing, 10 for production
            'pager' => $this->article->pager,
        ];
        return view('articles', $data);
    }

    public function show($id)
    {
        $data = [
            'article' => $this->article->find($id),
        ];
        if (!$data['article']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Article not found');
        }
        return view('article', $data);
    }

    public function create()
    {
        return view('article/create');
    }

    public function store()
    {
        $data = [
            'title' => $this->request->getPost('title'),
            'text' => $this->request->getPost('content'),
            'user_id' => session()->get('user_id') ?? 1,
        ];
        $this->article->insert($data);
        return redirect()->to('article/create')->with('success', 'Article created successfully.');
    }

    public function edit($id)
    {
        $data = [
            'article' => $this->article->find($id),
        ];
        if (!$data['article']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Article not found');
        }
        return view('article/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'title' => $this->request->getPost('title'),
            'text' => $this->request->getPost('content'),
        ];
        $this->article->update($id, $data);
        return redirect()->to('articles')->with('success', 'Article updated successfully.');
    }
}
