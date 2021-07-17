<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LinkController extends Controller
{

    /**
     * Redirect the specified link by alias.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response || \Illuminate\Support\Facades\Redirect
     */
    public function redirect($alias)
    {
        $url = Link::where("alias", $alias)->first();

        if(!$url){
            abort(404);
        }

        return Redirect::to($url->url);
    }
}
