<?php

namespace App\Http\Controllers;

use App\Models\KaryawanModel;
use App\Models\KaryawanRoleListModel;
use App\Models\OutletModel;
use App\Models\RoleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['karyawan'] = KaryawanModel::where('status', 'Aktif')
            ->get()->sortDesc();

        return view('employe.index', $data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = RoleModel::where('status', 'Aktif')
            ->get();
        $outlet = OutletModel::where('status', 'Aktif')
            ->get();
        return view('employe.create', compact('roles'), compact('outlet'));
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
            'name'          => 'required',
            'email'         => 'required|unique:master_karyawan',
            'phone'         => 'required|unique:master_karyawan',
            'password'      => 'required'
        ]);

    
        $karyawan = new KaryawanModel();
        $karyawan->outletID = $request->outlet;
        $karyawan->name = $request->name;
        $karyawan->email = $request->email;
        $karyawan->phone = $request->phone;
        $karyawan->password = md5($request->password);
        $karyawan->createdAt = now();
        $karyawan->save();
        $role = $request->role;
        if ($role) {
            $karyawanID = KaryawanModel::where('status', 'Aktif')->max('id');
            foreach ($role as $ro) {
                $listRoleKaryawan = new KaryawanRoleListModel();
                $listRoleKaryawan->karyawanID = $karyawanID;
                $listRoleKaryawan->rolesID = $ro;
                $listRoleKaryawan->status = "Aktif";
                $listRoleKaryawan->save();
            }
        }

        $karyawanID = KaryawanModel::where('status', 'Aktif')->max('id');
        $marketing = OutletModel::find($request->outlet);
        $marketing->marketingID = $karyawanID;
        $marketing->update();
        return redirect('/karyawan')->with('success', 'Data Karyawan baru berhasil di Tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
        $data['karyawan']=KaryawanModel::findOrFail($id);
        $data['outlet']=OutletModel::where('status', 'Aktif')
            ->get();
        $data['role']=KaryawanRoleListModel::where('karyawanID',$id)
            ->join('master_roles', 'master_roles.id', 'karyawan_role_list.rolesID')->get();
        $data['masterRoles'] = RoleModel::all();
        return view('employe.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['karyawan'] = KaryawanModel::findOrFail($id);
        $data['outlet'] = OutletModel::where('status', 'Aktif')
            ->get();
        $data['role'] = KaryawanRoleListModel::where('karyawanID', $id)
            ->join('master_roles', 'master_roles.id', 'karyawan_role_list.rolesID')->get();
        $data['masterRoles'] = DB::table('master_roles')
            ->select('id', 'roleName')
            ->whereNotIn('id', DB::table('karyawan_role_list')->select('rolesID')->where('karyawanID', '=', $id)->pluck('rolesID')->toArray())
            ->get();

        return view('employe.edit', $data);
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
            'name'          => 'required',
            'email'         => 'required',
            'phone'         => 'required'
        ]);

        $karyawan = KaryawanModel::findOrFail($id);
        $emailKaryawan= KaryawanModel::select('*')
        ->where('email', '=', $request->email)
        ->where('email', '!=', 'null')
        ->where('email', '!=', '')
        ->where('email', '!=', 'NULL')
        ->where('status', '=', 'Aktif')
        ->where('id', '<>', $id)
        ->get();
        if ($emailKaryawan->count() > 0) {
            return back()->with('error', 'Maaf! Email karyawan yang dimasukkan sudah terdaftar di sistem.');
        } 

        $phoneKaryawan= KaryawanModel::select('*')
        ->where('phone', '=', $request->phone)
        ->where('status', '=', 'Aktif')
        ->where('id', '<>', $id)
        ->get();
        if ($phoneKaryawan->count() > 0) {
            return back()->with('error', 'Maaf! Nomor handphone karyawan yang dimasukkan sudah terdaftar di sistem.');
        } 
        
        $karyawan->name = $request->name;
        $karyawan->email = $request->email;
        $karyawan->phone = $request->phone;
        $karyawan->outletID=$request->outlet;
        $karyawan->update();
       
        //$detailRole = KaryawanRoleListModel::where(['karyawanID' => $id])->first();
        //$detailRole->delete();
        $detailRole=DB::table('karyawan_role_list')->where('karyawanID', $id)->delete();
        $role= $request->role;
        $jumlah = count($request->role);
        for ($i = 0; $i < $jumlah; $i++) {
            KaryawanRoleListModel::create([
                'rolesID'       => $role[$i],
                'karyawanID'    => $id,
                'status'        => 'Aktif'
            ]);
        }
        return redirect('/karyawan')->with('success', 'Data Karyawan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $karyawan = KaryawanModel::find($request->karyawanid);
        $karyawan->status = 'Non Aktif';
        $karyawan->save();
        $roleKaryawan = DB::table('karyawan_role_list')->where('karyawanID', $request->karyawanid)->update(['status' => 'Non Aktif']);
        return back()->with('success', 'Data Karyawan berhasil dihapus');
    }
}