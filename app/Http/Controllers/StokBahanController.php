<?php

namespace App\Http\Controllers;

use App\Models\StokBahan;
use App\Http\Requests\StokBahanRequest;

class StokBahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stokBahan = StokBahan::latest()->paginate(20);

        return view('stok-bahan.index', compact('stokBahan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stok-bahan.create',[
            'stokBahan' => new StokBahan,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StokBahanRequest $request)
    {
        StokBahan::create($request->validated());

        return redirect()->route('stok-bahan.index');
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
        $stokBahan = StokBahan::find($id);
        return view('stok-bahan.edit', compact('stokBahan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StokBahanRequest $request, $id)
    {
        StokBahan::find($id)->update($request->validated());

        return redirect()->route('stok-bahan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        StokBahan::find($id)->delete();

        return redirect()->route('stok-bahan.index');
    }
}
