<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LinkController extends Controller
{
    /**
     * @param $alias
     * @return \Illuminate\Http\RedirectResponse
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        $links = Link::paginate(5);

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
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showUpdateForm($id)
    {
        $link = Link::findOrFail($id);

        return view("update-alias", compact("link"));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function updateAlias(Request $request, $id)
    {
        $val = \Validator::make($request->all(), [
            "id" => "exists:links,id",
            "title" => "string",
            "url_link" => "url"
        ]);

        if($val->fails()){
            return Redirect::back()->withErrors($val);
        }

        Link::where("id", $id)->update([
            "title" => $request->title,
            "description" => $request->description ?? "" ,
            "url" => $request->url_link ?? ""
        ]);

        $link = Link::find($id);

        return view("update-alias", compact("link"));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAlias(Request $request, $id)
    {
        $link = Link::findOrFail($id);
        $link->delete();

        return redirect()->route("alias.aliases");
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
