<?php

namespace App\Http\Controllers;

use App\Models\Callback;
use Illuminate\Http\Request;
use App\Http\Requests\HomeCallbackRequest;

class HomeController extends Controller
{

    public function index()
    {
        $callbackItems = Callback::all();

        return view('templates.home' , [
            'callbackItems' => $callbackItems
        ]);
    }
    //

    public function callback(HomeCallbackRequest $request)
    {

        $request->validated();



        try{
            $result= Callback::create($request->all());
        }
        catch (\Exception $e){
            $result=false;
            dd($e->getMessage());
        }

        return $result ? back() : back()->withInput();

    }


}
