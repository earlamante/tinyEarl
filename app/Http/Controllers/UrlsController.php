<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Auth;
use \Illuminate\Http\Request;

class UrlsController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        }
        return redirect('/login');
    }

    public function dashboard()
    {
        return view('my-urls', [
            'urls' => Url::where('user_id', '=', Auth::user()->id)->get(),
        ]);
    }

    public function add_new(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'url' => 'required|url'
        ]);
        $url = new Url;
        $url->user_id = $request->input('user_id');
        $url->url = $request->input('url');
        $url->save();
        $url->custom = idToString($url->id);
        $url->save();
        return redirect('/dashboard');
    }

    public function redirect($str)
    {
        $id = stringToId($str);
        $url = Url::findOrFail($id);
        return redirect($url->url, 301);
    }

    public function destroy($id)
    {
        Url::destroy($id);
        return redirect('/dashboard');
    }
}
