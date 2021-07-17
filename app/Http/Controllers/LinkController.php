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
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function updateAlias(Request $request, $id)
    {
        $val = \Validator::make($request->all, [
            "id" => "exists:links,id",
            "title" => "string",
            "description" => "string",
            "url_link" => "url"
        ]);

        if($val->fails()){
            dd($val->errors);
        }

        $link = Link::when($request->title, function($query) use($request){
            $query->update(["title" => $request->title]);
        })->when($request->description, function($query) use($request){
            $query->update(["description" => $request->description]);
        })->when($request->url_link, function($query) use($request){
            $query->update(["url" => $request->url_link]);
        })->where("id", $id);

        return view("show-alias", compact("link"));
    }

    /**
     * Delete the specified link by alias.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteAlias(Request $request, $id)
    {
        $link = Link::findOrFail($id);
        $link->delete();

        return response()->route("alias.aliases");
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
            $alias = $latest->alias;
            ++$alias;

            $link = Link::create([
                "alias" => $alias,
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
