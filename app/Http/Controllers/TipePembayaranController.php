<?php

namespace App\Http\Controllers;
use App\Models\TipePembayaranModel;
use Illuminate\Http\Request;

class TipePembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipepembayarans['tipepembayarans']=TipePembayaranModel::where('status', 'Aktif')
        ->get();
        return view('tipePembayaran.index',$tipepembayarans);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipePembayaran.create');
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
            'namePayment' => 'required'
        ]);

        $tipepembayarans = TipePembayaranModel::create([
            'namePayment' => $request->namePayment,
            'status'   => 'Aktif'
        ]);

        if ($tipepembayarans) {

            return redirect('/tipepembayaran')->with('success', 'Data Tipe Pembayaran baru berhasil ditambahkan ke dalam sistem');
        } else {

            return back()->with('error', 'Data Tipe Pembayaran baru tidak berhasil ditambahkan ke dalam sistem');
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
        $tipepembayarans = TipePembayaranModel::findOrFail($id);
        return view('tipePembayaran.show', compact('tipepembayarans'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
