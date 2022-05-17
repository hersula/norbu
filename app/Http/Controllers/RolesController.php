<?php

namespace App\Http\Controllers;

use App\Models\OutletModel;
use App\Models\RoleModel;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['roles'] = RoleModel::where('status', 'Aktif')
            ->get();

        return view('roles.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create');
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
            'roleName' => 'required'
        ]);

        $namaRole = RoleModel::where('roleName', '=', $request->roleName)->get();
        if ($namaRole->count() > 0) {
            return back()->with('error', 'Nama Role yang dimasukkan sudah terdaftar di sistem!');
        } 
        $roles = RoleModel::create([
            'roleName' => $request->roleName,
            'status'   => 'Aktif'
        ]);
       
        if ($roles) {
            return redirect('/roles')->with('success', 'Role berhasil di tambahkan');
        } else {
            return back()->with('error', 'Data Role tidak berhasil ditambahkan ke dalam sistem');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $roles = RoleModel::findOrFail($id);
        return view('roles.show', compact('roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = RoleModel::findOrFail($id);
        return view('roles.edit', compact('roles'));
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
            'roleName' => 'required'
        ]);

        $roles = RoleModel::findOrFail($id);
        $namaRole = RoleModel::where('roleName', '=', $request->roleName)->get();
        if ($namaRole->count() > 0) {
            return back()->with('error', 'Nama Role yang dimasukkan sudah terdaftar di sistem!');
        } 
        $roles->update([
            'roleName' => $request->roleName
        ]);

        if ($roles) {
            return redirect('/roles')->with('success', 'Role berhasil di ubah');
        } else {
            return back()->with('error', 'Data Role tidak berhasil diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $roles = RoleModel::find($request->roleid);
        $roles->status = 'Non Aktif';
        $roles->save();

        if ($roles) {
           return back()->with('success','Data Role berhasil dihapus');
        } else {
            return back()->with('error','Data Role tidak berhasil dihapus');
        }
    }
}