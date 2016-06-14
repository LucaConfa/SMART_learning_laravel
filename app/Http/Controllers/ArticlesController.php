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
        $tags = \App\Tag::lists('name', 'id');
        return view("articles.create", compact('tags'));
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
        $this->createArticle($request);
            
        flash()->success('Your article has been created');
        return redirect('articles');
    }
    
    
    public function edit(Article $article) 
    {
        $tags = \App\Tag::lists('name', 'id');

        return view('articles.edit', compact('article', 'tags'));
    }
    
    
    public function update(Article $article, Requests\ArticleRequest $request) 
    {
        $article->update($request->all());
        
        $this->syncTags($article, $request->input('tag_list'));
        
        return redirect('articles');
    }
    
    /**
     * Sync up the list of tags in the database
     * @param Article $article
     * @param array $tags
     */
    private function syncTags(Article $article, array $tags)
    {
        $article->tags()->sync($tags);
    }
    
    /**
     * Save a new article
     * @param \App\Http\Controllers\ArticleRequest $request
     * @return Article
     */
    private function createArticle(ArticleRequest $request)
    {
        $article = new Article($request->all());
        
        \Auth::user()->articles()->save($article);
        
        $this->syncTags($article, $request->input('tag_list'));
        
        return $article;
    }
}
