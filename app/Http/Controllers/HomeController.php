<?php

namespace App\Http\Controllers;

use App\Models\Callback;
use App\Http\Requests\HomeCallbackRequest;
use Illuminate\Support\Facades\Storage;

/**
 * Class HomeController
 *
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Відображення головної сторінки з одобриними відгуками
     *
     * @return string
     */
    public function index()
    {
        $callbackItems = Callback::where('confirmed', 1)->get();
        return view('templates.home', [
            'callbackItems' => $callbackItems
        ]);
    }

    /**
     * Валідація відгуку, створення відгуку
     *
     * @param HomeCallbackRequest $request
     *
     * @return mixed
     */
    public function callback(HomeCallbackRequest $request)
    {
        $request->validated();

        try {
            $result = Callback::create($request->all());
        } catch (\Exception $e) {
            $result = false;
        }

        return $result
            ? redirect('/')->with('success', 'Callback was sent successfully')
            : back()->withInput();
    }
}
