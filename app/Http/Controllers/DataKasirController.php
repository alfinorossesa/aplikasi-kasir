<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\DataKasirRequest;

class DataKasirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataKasir = User::where('role', 'kasir')->latest()->paginate(10); 

        return view('data-kasir.index', compact('dataKasir'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('data-kasir.create',[
            'dataKasir' => new User,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DataKasirRequest $request)
    {
        User::create($request->validated());

        return redirect()->route('data-kasir.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataKasir = User::find($id);

        return view('data-kasir.edit', compact('dataKasir'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DataKasirRequest $request, $id)
    {
        User::find($id)->update($request->validated());

        return redirect()->route('data-kasir.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();

        return redirect()->route('data-kasir.index');
    }
}
