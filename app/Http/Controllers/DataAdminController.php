<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\DataAdmin;

class DataAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataAdmin = User::where('role', 'admin')->latest()->paginate(10); 

        return view('data-admin.index', compact('dataAdmin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('data-admin.create');
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
            'username' => 'required|max:25|unique:data_admin',
            'no_telepon' => 'required|min:11|max:13',
            'role' => 'required',
            'password' => 'required|min:8|max:12'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        DataAdmin::create($validatedData);
        User::create($validatedData);

        return redirect()->route('data-admin.index');
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
        $dataAdmin = User::find($id);

        return view('data-admin.edit', compact('dataAdmin'));
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

        $dataAdmin = User::find($id);
        $dataAdmin->update($validatedData);

        return redirect()->route('data-admin.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataAdmin = User::find($id);
        $dataAdmin->delete();

        return redirect()->route('data-admin.index');
    }
}
