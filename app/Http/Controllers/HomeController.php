<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Http\Request;
use App\Plat;
use Validator;
use Session;
use Illuminate\Support\Facades\Cookie;
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
        $plats = Plat::orderBy('id', 'desc')->with('notes')->get();
        $users = User::with('notes')->get();

        if(Cookie::get('firstVisit') == null){
            Cookie::queue('firstVisit', 'done', 525600);
            return view('pages.index', ['plats' => $plats, 'users' => $users, 'cookieFirstVisit' => false]);
        }

        return view('pages.index', ['plats' => $plats,
                                    'users' => $users,
                                    'cookieFirstVisit' => true]);
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

    public function AddNote(Request $request)
    {
        $plat = Plat::findOrFail($request->id);
        return $plat->toJson();
    }

    public function CreateNote(Request $request)
    {
        $currentUser = Auth::user();

        $validator = Validator::make($request->all(), [
            'plat_id' => 'required',
            'mark' => 'required',
            'fat' => 'required'
        ]);

        if ($validator->fails()) {
            Session::flash('flash_message', 'données manquantes ou erronées');
            return redirect('/')
                ->withErrors($validator)
                ->withInput();
        }

        $plat = Plat::findOrFail($request->input('plat_id'));
        if($plat != null) {
            $note = new Note;
            $note->plat_id = $request->input('plat_id');
            $note->mark = $request->input('mark');
            $note->fat = $request->input('fat');
            $note->user_id = $currentUser->id;
            $note->save();
        }

        return redirect('/');
    }

    public function DeletePlat(Request $request)
    {
        $plat = Plat::destroy($request->id);
        return redirect('/');
    }
}
