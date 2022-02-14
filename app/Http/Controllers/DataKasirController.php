<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\DataKasir;

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
        return view('data-kasir.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'username' => 'required|max:25|unique:data_kasir',
            'no_telepon' => 'required|min:11|max:13',
            'role' => 'required',
            'password' => 'required|min:8|max:12'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        DataKasir::create($validatedData);
        User::create($validatedData);

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
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'username' => 'required|max:25',
            'no_telepon' => 'required|min:11|max:13',
            'role' => 'required',
            'password' => 'required|min:8|max:12'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        $dataKasir = User::find($id);
        $dataKasir->update($validatedData);

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
        $dataKasir = User::find($id);
        $dataKasir->delete();

        return redirect()->route('data-kasir.index');
    }
}
