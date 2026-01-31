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
        $title = $this->request->getPost('title');
        $content = $this->request->getPost('content');

        $data = [
            'title' => $title,
            'text' => $content,
            'user_id' => session()->get('user_id') ?? 1,
        ];
        $this->article->insert($data);
        return redirect()->to('/article/create')->with('success', 'Article created successfully.');
    }
}
