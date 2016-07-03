<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     *  Fillable fields being specific about which fileds might be mass assigned
     * @var array
     */
    protected $fillable = [
        'title',
        'body',
        'published_at',
        'user_id'
    ];
    /**
     * fields to be treated as Carbon instances
     * so we can treat it as a Carbon object: $article->published_at->format('Y-m-d')
     * @var type 
     */
    protected $dates =['published_at']; 

    
    /**
     * set published_at attribute (mutator) 
     * every time we do $article->published_at Laravel will call the mutator and parse the date.
     * @param type $date
     */
    public function setPublishedAtAttribute($date)
    {
        $this->attributes['published_at'] = Carbon::parse($date);
    }
    
    /**
     * Get the published_at attribute 
     * @param type $date
     * @return type
     */
    public function getPublishedAtAttribute($date)
    {
        return Carbon::parse($date)->format('Y-m-d');
    }
    
    
    /**
     * Scope queries to articles that have been published
     * Prevent us to reapating all the time the clause. We can do Article::published() 
     * and we'll get the aricles already filtered
     * @param type $query
     */
    public function scopePublished($query)
    {
        $query->where('published_at', '<=', Carbon::now());
    }
    
    
    /**
     * Scope queries to articles that have NOT been published
     * @param type $query
     */
    public function scopeUnpublished($query)
    {
        $query->where('published_at', '>=', Carbon::now());
    }
    
    /**
     * An article is owned by a user  (name of method is customizable)
     * We can do: $article->user we'll get a user object that is associated with the aritcle
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() 
    {
        return $this->belongsTo('App\User');
    }
    
    /**
     * Get the tags associated with a given article
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }
    
    /**
     * Get a list of tag ids associated with the current article
     * @return array
     */
    public function getTagListAttribute()
    {
        return $this->tags->lists('id')->toArray();
    }
}
