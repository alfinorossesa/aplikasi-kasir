<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataKategoriMenu;

class DataKategoriMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataKategoriMenu = DataKategoriMenu::latest()->paginate(10);

        return view('data-kategori-menu.index', compact('dataKategoriMenu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('data-kategori-menu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_kategori' => 'required|max:255'
        ]);

        DataKategoriMenu::create($request->all());

        return redirect()->route('data-kategori-menu.index');
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
        $dataKategoriMenu = DataKategoriMenu::find($id);

        return view('data-kategori-menu.edit', compact('dataKategoriMenu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_kategori' => 'required|max:255'
        ]);

        $dataKategoriMenu = DataKategoriMenu::find($id);
        $dataKategoriMenu->update($request->all());

        return redirect()->route('data-kategori-menu.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataKategoriMenu = DataKategoriMenu::find($id);
        $dataKategoriMenu->delete();

        return redirect()->route('data-kategori-menu.index');
    }
}
