<?php

namespace App\Http\Controllers;

use App\Note;
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
        //$plats = Plat::orderBy('id', 'desc')->get();
        $plats = Plat::leftJoin('notes', 'plats.id', '=', 'notes.plat_id')
            ->join('users', 'plats.user_id', '=', 'users.id')
            ->select('plats.*', 'users.name AS user_name', 'notes.*')
            ->orderBy('plats.id', 'desc')
            ->get();

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
        $note = new Note;
        $plat->name = $request->input('name');
        $plat->price = $request->input('price');
        $plat->url = ($request->input('url') != null ? $request->input('url') : "");
        $plat->user_id = $currentUser->id;
        $plat->save();
        $note->plat_id = $plat->id;
        $note->mark = $request->input('mark');
        $note->fat = $request->input('fat');
        $note->user_id = $currentUser->id;
        $note->save();

        return redirect('/');
    }
}
