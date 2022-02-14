<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataMenu;
use App\Models\DataKategoriMenu;
use File;

class DataMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataMenu = DataMenu::latest()->paginate(10);

        return view('data-menu.index', compact('dataMenu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataKategoriMenu = DataKategoriMenu::all();

        return view('data-menu.create', compact('dataKategoriMenu'));
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
            'nama_menu' => 'required|max:255',
            'harga' => 'required|numeric|min:1',
            'kategori' => 'required',
            'photo' => 'required|image|mimes:jpg,png|file|max:1024'
        ]);

        $photo = $request->file('photo');
        $photo_name = time()."_".$photo->getClientOriginalName();
        $photo->move('img/menu',$photo_name);

        DataMenu::create([
            'nama_menu' => $request->nama_menu,
            'harga' => $request->harga,
            'kategori' => $request->kategori,
            'photo' => $photo_name,
            'id_dataKategoriMenu' => $request->id_dataKategoriMenu
        ]);

        return redirect()->route('data-menu.index');
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
        $dataMenu = DataMenu::find($id);
        $dataKategoriMenu = DataKategoriMenu::all();

        return view('data-menu.edit', compact('dataMenu', 'dataKategoriMenu'));
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
            'nama_menu' => 'required|max:255',
            'harga' => 'required|numeric|min:1',
            'kategori' => 'required',
            'photo' => 'image|mimes:jpg,png|file|max:1024'
        ]);

        $dataMenu = DataMenu::find($id);
        $dataMenu->update([
            'nama_menu' => $request->nama_menu,
            'harga' => $request->harga,
            'kategori' => $request->kategori,
            'id_dataKategoriMenu' => $request->id_dataKategoriMenu
        ]);

        // // update foto            
        if($request->hasFile('photo')){
            File::delete('img/menu/'.$dataMenu->photo);
            $photo = $request->file('photo');
            $photo_name = time()."_".$photo->getClientOriginalName();
            $photo->move('img/menu',$photo_name);
            $dataMenu->photo = $photo_name;
            $dataMenu->update();            
        }

        return redirect()->route('data-menu.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataMenu = DataMenu::find($id);
        File::delete('img/menu/'.$dataMenu->photo);
        $dataMenu->delete();

        return redirect()->route('data-menu.index');
    }

    public function jsonDataKategoriMenu($id)
    {
        $dataKategoriMenu = DataKategoriMenu::find($id);
        return response()->json($dataKategoriMenu, 200);
    }
}
