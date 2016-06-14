@extends('app')

@section('content')


<h6 class='pull-right'>Published at {{ $article->published_at }} </h6>
<h1>{{ $article->title }}</h1>
<hr>


<div class='body'>
    <p> {{ $article->body }}</p>
    
    
    @unless ($article->tags->isEmpty())
        <h5>Tags:</h5>
        <ul>
            @foreach ($article->tags as $tag)
                <li>{{ $tag->name }}</li>
            @endforeach
        </ul>
    @endunless

</div>
