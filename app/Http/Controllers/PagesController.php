<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
    public function about() 
    {
        $people = [
            'Adam', 'Andrew', 'Astrid', 'Charlotte'
        ];
        
        return View('pages.about', compact('people'));
    }
    
    public function contact(){
        return View('pages.contact');
    }
}
