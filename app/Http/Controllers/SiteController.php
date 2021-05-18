<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{

    public function index()
    {

        return view('templates.site');
    }
    //

    public function post(Request $request)
    {

       $request->validate([
            'title' => 'required||max:255'
        ]);

       User::create( $request->all());


       return back()->withInput();
    }


}
