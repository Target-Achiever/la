<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Arcanedev\SeoHelper\Entities\Title;

use Arcanedev\SeoHelper\Entities\Webmasters;

use Illuminate\Support\Facades\Route;

use App\SeoTitleSettings;
use App\SeoPages;
use App\SeoWeb;

use App\Services;

use App\Blog;


class LaSeoController extends Controller
{
    public function __construct()
	{

		$pages = array('about-us','blog','services','privacy-policy','terms','/','{services_id}/services_read_content','blog-single/{blog}');

		
		$currentPath= Route::getFacadeRoot()->current()->uri();



		$id = Route::current()->getParameter('services_id');

		$id_b = Route::current()->getParameter('blog');


      

		//$path = $request->path();

		//print_r($path); exit;
		
		if(in_array($currentPath, $pages)){
			$this->set_seo($currentPath,$id,$id_b);
		}else{
				$title = new Title;
				$title->set('Linkaesthetics');
				$title->setSiteName('');

				//echo $title->render();
		}
        
	}

	public function set_seo($page,$id="",$id_b=""){

//echo $id_b; exit;

		    if($page == '/')
            {
            $page_detail = SeoPages::where('page', '=', 0)->get();
            }
			if($page == 'about-us')
			{
            $page_detail = SeoPages::where('page', '=', 1)->get();
			}
			if($page == 'blog')
			{
            $page_detail = SeoPages::where('page', '=', 2)->where('sub_topic','=',0)->get();
			}
			if($page == 'blog-single/{blog}')
			{
			$page_detail = SeoPages::where('page', '=', 2)->where('sub_topic','=',$id_b)->get();	
			//print_r($page_detail); exit;
			}
			if($page == 'services')
			{
            $page_detail = SeoPages::where('page', '=', 3)->where('sub_topic','=',0)->get();
			}
			if($page == '{services_id}/services_read_content')
			{
			$page_detail = SeoPages::where('page', '=', 3)->where('sub_topic','=',$id)->get();	
			}
			if($page == 'privacy-policy')
			{
            $page_detail = SeoPages::where('page', '=', 4)->get();
			}
			if($page == 'terms')
			{
            $page_detail = SeoPages::where('page', '=', 5)->get();
			}

			$site_detail = SeoTitleSettings::get();

            if(isset($site_detail) && count($site_detail) > 0)
            {
			$siteinfo['site_name'] = $site_detail[0]->site_name;
			$siteinfo['title_separator'] = $site_detail[0]->title_separator;

		    }
		    else
		    {
		    	$siteinfo['site_name'] = 'Linkaesthetics';
		    	$siteinfo['title_separator'] = '-';
		    }

			if(isset($page_detail))
			{
				foreach ($page_detail as $key => $value) {
					$seopageinfo['title'] = $value->title;
			        $seopageinfo['description'] = $value->description;
			        $seopageinfo['keyword'] = [$value->keyword];
				}
			}


            
            if(isset($seopageinfo))
            {
			echo $this->seo()
             ->setTitle($seopageinfo['title'] ?: $seopageinfo['title'],$siteinfo['site_name'] ?: $siteinfo['site_name'],$siteinfo['title_separator'] ?: $siteinfo['title_separator'])
             //->setSiteName($siteinfo['site_name'] ?: $siteinfo['site_name'])
             ->setDescription($seopageinfo['description'] ?: $seopageinfo['description'])
             ->setKeywords($seopageinfo['keyword'] ?: $seopageinfo['keyword']);
           }
           else
           {
           	$title = new Title;
			$title->set('Linkaesthetics');
			$title->setSiteName('');

			echo $title->render();
           }

           $web_master = SeoWeb::get();

           $web = Array();

           foreach ($web_master as $key => $value) {
           	if($value->web_master == 0)
           	{
               $web['google'] = $value->verification_code;
           	}
           	if($value->web_master == 1)
           	{
               $web['bing'] = $value->verification_code;
           	}
           		if($value->web_master == 2)
           	{
               $web['alexa'] = $value->verification_code;
           	}
           		if($value->web_master == 3)
           	{
               $web['pinterest'] = $value->verification_code;
           	}
           		if($value->web_master == 4)
           	{
               $web['yandex'] = $value->verification_code;
           	}
           }
            
           if(isset($web) && count($web) > 0)
           {
           $webmasters = Webmasters::make($web);
           echo $webmasters->render();
           }

	}
}
