<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Files\File;
use App\Models\Photo as PhotoModel;
use App\Models\Article as ArticleModel;
use IonAuth\Libraries\IonAuth;

class Photo extends BaseController
{
    protected $photo;
    protected $article;
    protected $ionAuth;

    public function __construct()
    {
        $this->photo = new PhotoModel();
        $this->article = new ArticleModel();
        $this->ionAuth = new IonAuth();
    }

    public function index()
    {
        // Get random photos from each article
        $randomPhotos = $this->photo->getRandomPhotosByArticle();
        
        // Attach article information to each photo
        foreach ($randomPhotos as $photo) {
            $photo->article = $this->article->where('id', $photo->article_id)->first();
        }
        
        $data = [
            'photos' => $randomPhotos,
        ];
        return view('gallery', $data);
    }

    public function article($article_id)
    {
        $article = $this->article->where('id', $article_id)->first();
        if (!$article) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Article not found');
        }
        $data = [
            'article' => $article,
            'photos' => $this->photo->where('article_id', $article_id)->findAll(),
        ];
        return view('photos', $data);
    }

    public function show($id)
    {
        $photo = $this->photo->find($id);
        if (!$photo) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Photo not found');
        }
        $article = $this->article->where('id', $photo->article_id)->first();
        $data = [
            'photo' => $photo,
            'article' => $article,
        ];
        return view('photo', $data);
    }

    public function upload()
    {
        if (!$this->ionAuth->loggedIn() || !$this->ionAuth->isAdmin()) {
            return redirect()->to('/auth/login')->with('error', 'Přístup odepřen');
        }
        
        return view('upload_form', [
            'errors' => [],
            'articles' => $this->article->findAll(),
        ]);
    }

    public function store()
    {
        if (!$this->ionAuth->loggedIn() || !$this->ionAuth->isAdmin()) {
            return redirect()->to('/auth/login')->with('error', 'Přístup odepřen');
        }
        
        $validationRule = [
            'article_id' => [
                'label' => 'Article',
                'rules' => 'required|is_natural_no_zero',
            ],
            'featured' => [
                'label' => 'Featured',
                'rules' => 'permit_empty|in_list[0,1]',
            ],
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
        if (! $this->validateData($this->request->getPost(), $validationRule)) {
            $data = [
                'errors' => $this->validator->getErrors(),
                'articles' => $this->article->findAll(),
            ];
            return view('upload_form', $data);
        }

        $articleId = $this->request->getPost('article_id');
        $article = $this->article->find($articleId);
        if (! $article) {
            return view('upload_form', [
                'errors' => ['Vybraný článek neexistuje.'],
                'articles' => $this->article->findAll(),
            ]);
        }

        $featured = $this->request->getPost('featured') ? 1 : 0;

        $img = $this->request->getFile('userfile');
        if (! $img->hasMoved()) {
            $newName = $img->getRandomName();
            $img->move(FCPATH . 'photos', $newName);
            $filepath = FCPATH . 'photos/' . $newName;
            $insert = [
                'path' => $newName,
                'featured' => 0,
                'article_id' => $articleId,
            ];
            $this->photo->insert($insert);
            $data = ['uploaded_fileinfo' => new File($filepath)];
            return view('upload_success', $data);
        }
        $data = ['errors' => 'The file has already been moved.'];
        return view('upload_form', $data);
    }
}
