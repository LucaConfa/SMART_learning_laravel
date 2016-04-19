<?php

namespace App\Http\Controllers;

use App\Article;

use Carbon\Carbon;

use App\Http\Requests;

class ArticlesController extends Controller
{
    public function index() 
    {
        $articles = Article::latest('published_at')->published()->get();
        
        return view("articles.index", compact('articles'));
    }
    
    public function show($id) 
    {
        $article = Article::findOrFail($id);
        return view("articles.show", compact('article'));
    }
    
    /**
     *  
     * @return type
     */
    public function create() 
    {
        return view("articles.create");
    }
    
    /**
     * 
     * @param \App\Http\Requests\CreateArticleRequest $request
     * @return type
     */
    public function store(Requests\ArticleRequest $request)
    {
        //Unless validation pass the code below will never be fired
        Article::create($request->all());
        
        return redirect('articles');
    }
    
    
    public function edit($id) 
    {
        $article = Article::findOrFail($id);
        
        return view('articles.edit', compact('article'));
    }
    
    
    public function update($id, Requests\ArticleRequest $request) 
    {
        $article = Article::findOrFail($id);
        
        $article->update($request->all());
        
        return redirect('articles');
    }
}
