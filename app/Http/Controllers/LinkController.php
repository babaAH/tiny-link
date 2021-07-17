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

    /**
     * Redirect the specified link by alias.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = Link::paginate();

        return view("list-aliases", compact("links"));
    }

    /**
     * Redirect the specified link by alias.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        $link = Link::findOrFail($id);

        return view("show-link", compact("link"));
    }

    /**
     * Redirect the specified link by alias.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showUpdateForm($id)
    {
        //todo
    }

    /**
     * Update the specified link by alias.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateAlias()
    {
        //todo
    }

    /**
     * Delete the specified link by alias.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteAlias($id)
    {
        //todo
    }

    /**
     * Create the specified link by alias.
     */
    public function createAlias(Request $request)
    {
        $request->validate([
            "url_link" => "required|url",
            "title" => "required|string"
        ]);

        $latest = Link::latest()->first();

        if($latest){
            $link = Link::create([
                "alias" => "",
                "url" => $request->url_link,
                "title" => $request->title,
            ]);
        }else{
            $link = Link::create([
                "alias" => "aaa",
                "url" => $request->url_link,
                "title" => $request->title,
            ]);
        }

        return view("show-alias", compact("link"));
    }

    public function showCreateAliasForm()
    {
        return view("create-alias");
    }

    public function getDashboard()
    {
        return view("dashboard");
    }
}
