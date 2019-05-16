<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Services;

use App\Blog;

class SitemapController extends Controller
{
    //
    public function index(){

    	 $blog = Blog::where( 'blog_status', '=', '1' )->get();

    	 $services=Services::where (function ($query){ $query -> where('service_type','=','4')
            -> orWhere('service_type','=','1'); })->get();


     return view('sitemap',compact('blog','services'));

    }
}
