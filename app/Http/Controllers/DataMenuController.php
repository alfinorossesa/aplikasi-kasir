<?php

namespace App\Http\Controllers;

use App\Models\DataMenu;
use App\Models\DataKategoriMenu;
use App\Http\Requests\DataMenuRequest;
use App\Services\DataMenuService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DataMenuController extends Controller
{
    protected $dataMenu;
    public function __construct(DataMenuService $dataMenu)
    {
        $this->dataMenu = $dataMenu;
    }

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
    public function store(DataMenuRequest $request)
    {
        try {
            $this->dataMenu->dataMenuStore($request);
        } catch (\Throwable $th) {
            Log::info($th);
        }

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
    public function update(DataMenuRequest $request, $id)
    {
        try {
            $this->dataMenu->dataMenuUpdate($request, $id);
        } catch (\Throwable $th) {
            Log::info($th);
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
        Storage::delete('public/images/'.$dataMenu->photo);
        $dataMenu->delete();

        return redirect()->route('data-menu.index');
    }

    public function jsonDataKategoriMenu($id)
    {
        $dataKategoriMenu = DataKategoriMenu::find($id);
        return $dataKategoriMenu;
    }
}
