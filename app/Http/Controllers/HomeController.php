<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plat;
use Validator;
use Session;
use Illuminate\Support\Facades\Auth;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function Index()
    {
        $plats = Plat::orderBy('id', 'desc')->get();

        return view('pages.index', ['plats' => $plats]);
    }

    public function Create(Request $request)
    {
        $currentUser = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'price' => 'required',
            'mark' => 'required',
            'fat' => 'required'
        ]);

        if ($validator->fails()) {
            Session::flash('flash_message', 'données manquantes ou erronées');
            return redirect('/')
                ->withErrors($validator)
                ->withInput();
        }

        $plat = new Plat;
        $plat->name = $request->input('name');
        $plat->price = $request->input('price');
        $plat->mark = $request->input('mark');
        $plat->fat = $request->input('fat');
        $plat->url = ($request->input('url') != null ? $request->input('url') : "");
        $plat->user_id = $currentUser->name;
        $plat->save();

        return redirect('/');
    }
}
