<?php

namespace App\Services;

use App\Models\DataMenu;
use Illuminate\Support\Facades\Storage;

class DataMenuService
{
    public function dataMenuStore($request)
    {
        $photo = $request->file('photo');
        $photo_name = time()."_".$photo->getClientOriginalName();
        $photo->storeAs('public/images', $photo_name);

        $dataMenu = DataMenu::create([
                    'nama_menu' => $request->nama_menu,
                    'harga' => $request->harga,
                    'kategori' => $request->kategori,
                    'photo' => $photo_name,
                    'id_dataKategoriMenu' => $request->id_dataKategoriMenu,
        ]);

        return $dataMenu;
    }

    public function dataMenuUpdate($request, $id)
    {
        $dataMenu = DataMenu::find($id);
        $dataMenu->update([
            'nama_menu' => $request->nama_menu,
            'harga' => $request->harga,
            'kategori' => $request->kategori,
            'id_dataKategoriMenu' => $request->id_dataKategoriMenu,
        ]);

        // // update foto            
        if($request->hasFile('photo')){
            Storage::delete('public/images/'.$dataMenu->photo);
            $photo = $request->file('photo');
            $photo_name = time()."_".$photo->getClientOriginalName();
            $photo->storeAs('public/images', $photo_name);
            $dataMenu->photo = $photo_name;
            $dataMenu->update();            
        }

        return $dataMenu;
    }
    
}