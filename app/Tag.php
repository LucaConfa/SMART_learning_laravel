<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * Fillable fields for a tag
     */
    protected $fillable = [
        'name'
    ];


    /**
     * Get articles associated with a given tag
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function articles()
    {
        //second arg is pivot table
        //third is identifiers
        //forth other identifier
        
        return $this->belongsToMany('App\Article');
    }
}
