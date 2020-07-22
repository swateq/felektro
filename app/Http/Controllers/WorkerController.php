<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Worker;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.admin.workers.index',['workers' => Worker::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.admin.workers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(strlen($request->name) > 2)
        {
            Worker::create($request->all());
            toast('Nowy pracownik dodany pomyślnie!','success')->autoClose(5000)->position('top-end')->timerProgressBar();
            return redirect('/admin/workers');
        }

        toast('Podaj minimalnie 3 znaki!','warning')->autoClose(5000)->position('top-end')->timerProgressBar();

        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $worker = Worker::findOrFail($id);
        $worker->delete();
        toast('Pracownik usunięty pomyślnie!','success')->autoClose(5000)->position('top-end')->timerProgressBar();
        return redirect('/admin/workers');
    }
}
