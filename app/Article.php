<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     *  Fillable fields
     * @var array
     */
    protected $fillable = [
        'title',
        'body',
        'published_at'
    ];
    /**
     * fields to be treated as Carbon instances
     * @var type 
     */
    protected $dates =['published_at'];

    
    /**
     * set published_at attribute (mutator)
     * @param type $date
     */
    public function setPublishedAtAttribute($date)
    {
        $this->attributes['published_at'] = Carbon::parse($date);
    }
    
    
    /**
     * Scope queries to articles that have been published
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
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() 
    {
        return $this->belongsTo('App\User');
    }
}
