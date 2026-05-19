<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Article as ArticleModel;
use App\Models\Photo as PhotoModel;
use IonAuth\Libraries\IonAuth;

class Article extends BaseController
{
    protected $helpers = ['form'];
    protected $article;
    protected $photo;
    protected $ionAuth;

    public function __construct()
    {
        $this->article = new ArticleModel();
        $this->photo = new PhotoModel();
        $this->ionAuth = new IonAuth();
    }

    public function index()
    {
        $articles = $this->article->paginate(10);
        foreach ($articles as $article) {
            $article->featured_photo = $this->photo->where('article_id', $article->id)->where('featured', 1)->first();
        }
        $data = [
            'articles' => $articles,
            'pager' => $this->article->pager,
        ];
        return view('articles', $data);
    }

    public function show($id)
    {
        $article = $this->article->find($id);
        if (!$article) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Article not found');
        }
        $data = [
            'article' => $article,
            'photos' => $this->photo->where('article_id', $id)->findAll(),
        ];
        return view('article', $data);
    }

    public function create()
    {
        if (!$this->ionAuth->loggedIn()) {
            return redirect()->to('/auth/login')->with('error', 'Přístup odepřen');
        }
        return view('article/create');
    }

    public function store()
    {
        if (!$this->ionAuth->loggedIn()) {
            return redirect()->to('/auth/login')->with('error', 'Přístup odepřen');
        }
        
        $data = [
            'title' => $this->request->getPost('title'),
            'text' => $this->request->getPost('content'),
            'user_id' => $this->ionAuth->user()->row()->id,
        ];
        $this->article->insert($data);
        return redirect()->to('articles')->with('success', 'Článek byl úspěšně vytvořen.');
    }

    public function edit($id)
    {
        if (!$this->ionAuth->loggedIn() || !$this->ionAuth->isAdmin()) {
            return redirect()->to('/auth/login')->with('error', 'Přístup odepřen');
        }
        
        $data = [
            'article' => $this->article->find($id),
        ];
        if (!$data['article']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Článek nenalezen');
        }
        return view('article/edit', $data);
    }

    public function update($id)
    {
        if (!$this->ionAuth->loggedIn() || !$this->ionAuth->isAdmin()) {
            return redirect()->to('/auth/login')->with('error', 'Přístup odepřen');
        }
        
        $data = [
            'title' => $this->request->getPost('title'),
            'text' => $this->request->getPost('content'),
        ];
        $this->article->update($id, $data);
        return redirect()->to('articles')->with('success', 'Článek byl úspěšně aktualizován.');
    }
}
