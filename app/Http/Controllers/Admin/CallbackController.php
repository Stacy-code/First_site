<?php

namespace App\Http\Controllers\Admin;

use App\Models\Callback;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Prophecy\Call\Call;

class CallbackController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function index()
    {
        $items = Callback::paginate(10);

        return view('templates.admin.post.index', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return mixed
     */
    public function create()
    {
        //return view('templates.admin.post.create');
    }


    /**
     * @param $id
     */
    public function confirm(Request $request){

        $result = [
            'success' => false,
            'msg' => 'Не вдалося підтвердити!'
        ];


        if ($request->ajax()) {

            $result['success'] = Callback::confirm($request->post('id'));
            $result['msg'] = 'You confirmed callback';
            // Запишемо результат видалення до сесії
            // $_SESSION['delete'] = [
            //     'success' => $result,
            //     'msg' => $result ? 'Видалено 1 запис' : 'Не вдалося видалити!'
            // ];
        }

        return \response()->json($result);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // @todo show view on one record
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string|null $id
     */
    public function edit(string $id = null)
    {
        $callback = Callback::find($id);
        return view('templates.admin.post.edit',compact('callback'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'content' => 'required|max:512',
            'email' => 'required||max:255',
        ]);


        $callback = Callback::find($id);
        $callback->name = $request->get('name');
        $callback->email = $request->get('email');
        $callback->content = $request->get('content');

        $callback->update();

        return redirect('/admin/post')->with('success', 'Callback updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $callback = Callback::find($id);

        $callback->delete();

        return redirect('/admin/post')->with('success', 'Callback deleted');
    }
}

