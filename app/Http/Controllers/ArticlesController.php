<?php

namespace App\Http\Controllers;

use App\Article;

use Carbon\Carbon;

use App\Http\Requests;

class ArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except'=>'index']);
    }
    
    /**
     * Show all articles
     * 
     * @return Response
     */
    public function index() 
    {
        $articles = Article::latest('published_at')->published()->get();
        
        return view("articles.index", compact('articles'));
    }
    
    /**
     * Show a single aritcle
     * 
     * @param Article $article
     * @return Response
     */
    public function show(Article $article) 
    {
        return view("articles.show", compact('article'));
    }
    
    /**
     * Show the page to create an article
     * we need to make this page accessible only by registered users
     * @return Response
     */
    public function create() 
    {
        return view("articles.create");
    }
    
    /**
     * Save a new article
     * 
     * @param \App\Http\Requests\CreateArticleRequest $request
     * @return type
     */
    public function store(Requests\ArticleRequest $request)
    {
        //Unless validation pass the code below will never be fired
        $article = new Article($request->all());
        
        \Auth::user()->articles()->save($article);
            
        flash()->success('Your article has been created');
        return redirect('articles');
    }
    
    
    public function edit(Article $article) 
    {
        return view('articles.edit', compact('article'));
    }
    
    
    public function update(Article $article, Requests\ArticleRequest $request) 
    {
        $article->update($request->all());
        
        return redirect('articles');
    }
}
