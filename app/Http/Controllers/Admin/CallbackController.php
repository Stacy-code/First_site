<?php

namespace App\Http\Controllers\Admin;

use App\Models\Callback;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Client\HttpClientException;

/**
 * Class CallbackController
 *
 * @package App\Http\Controllers\Admin
 */
class CallbackController extends Controller
{
    /**
     * Відображення списка відгуків клієнтів
     *
     * @return mixed
     */
    public function index()
    {
        // Пагінація сторінки в 10 записів
        $items = Callback::paginate(10);

        // Відображення списка відгуків
        return view('templates.admin.callback.index', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws HttpClientException
     */
    public function create()
    {
        // @todo Show create view form
        throw new HttpClientException('404');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @throws HttpClientException
     */
    public function store(Request $request)
    {
        // @todo Save created request
        throw new HttpClientException('404');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @throws HttpClientException
     */
    public function show(int $id)
    {
        // @todo show view on one record
        throw new HttpClientException('404');
    }

    /**
     * Шукаємо відгук по id редагуємо відгук
     *
     * @param int|null $id
     *
     * @return mixed
     * @throws HttpClientException
     */
    public function edit(int $id = null)
    {
        $callback = Callback::find($id);
        if ($callback instanceof Callback) {
            return view('templates.admin.callback.edit', compact('callback'));
        }
        throw new HttpClientException('404');
    }

    /**
     * Перевіряємо поля
     * Оновлюємо дані після едагування в таблиці
     *
     * @param Request $request
     * @param int     $id
     *
     * @return mixed
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'content' => 'required|max:300',
            'email' => 'required||max:255',
        ]);

        $callback = Callback::find($id);
        $callback->name = $request->get('name');
        $callback->email = $request->get('email');
        $callback->content = $request->get('content');
        $callback->update();

        return redirect('/admin/callback')->with('success', 'Callback updated successfully');
    }

    /**
     * Видалення відгуку
     *
     * @param int $id
     *
     * @return mixed
     */
    public function destroy(int $id)
    {
        $callback = Callback::find($id);
        if ($callback instanceof Callback) {
            $callback->delete();
            return redirect('/admin/callback')->with('success', 'Callback deleted');
        }
        return redirect('/admin/callback')->with('error', 'Callback delete error');
    }

    /**
     * Підтверджуємо наш відгук за допомогою ajax
     *
     * @param Request $request
     *
     * @return mixed
     * @throws HttpClientException
     */
    public function confirm(Request $request)
    {
        $result = ['success' => false];
        if ($request->ajax() && $request->isMethod('post')) {
            $model = Callback::find($request->post('id'));
            if ($model instanceof Callback) {
                $model->confirmed = true;
                $result['success'] = $model->save();

                // Відправляємо повідомлення автору відгука
                mail($model->email, 'Confirmed', 'BESTSITE.com confirmed your callback');
            }

            $result['msg'] = $result['success']
                ? 'You confirmed callback'
                : 'Не вдалося підтвердити!';

            // Відправляємо відповідь в json форматі
            return \response()->json($result);
        }
        throw new HttpClientException('404');
    }
}
