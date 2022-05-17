<?php

namespace App\Http\Controllers;

use App\Models\CartModel;
use App\Models\PasienModel;
use App\Models\TransactionRawatJalanModel;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $member = PasienModel::where('token', session('token'))->first();
        $nik = $member->nik;
        $data['pemesanan'] = CartModel::Join('master_pasien', 'master_pasien.nik', '=', 'temp_cart.nik')
            ->join('master_outlet', 'master_outlet.id', '=', 'temp_cart.outletID')
            ->join('master_tindakan', 'master_tindakan.id', '=', 'temp_cart.tindakanID')
            ->where('temp_cart.nik', '=', $nik)
            ->select('master_pasien.name as namaPasien',  'master_tindakan.*', 'master_outlet.name as nmOutlet', 'temp_cart.id as idCart')
            ->get();
        return view('pemesanan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fullYMD        = date('ymd');
        $thisDay        = date('d');
        $thisMonth      = date('m');
        $thisYear       = date('Y');

        $cekDay = TransactionRawatJalanModel::whereDay('createdAt', $thisDay)
            ->whereMonth('createdAt', $thisMonth)
            ->whereYear('createdAt', $thisYear)->first();
        if ($cekDay->id !== null) {
            $result = TransactionRawatJalanModel::whereDay('createdAt', $thisDay)
                ->whereMonth('createdAt', $thisMonth)
                ->whereYear('createdAt', $thisYear)
                ->orderBy('id', 'desc')
                ->first();
            $noAntrian = $result->id;
            $newAntrian = (int)substr($noAntrian, 6) + 1;
            var_dump($noAntrian);
            if ($newAntrian > 9999) {
                return $invID = str_pad($newAntrian, 5, '0', STR_PAD_LEFT);
            } else {
                $invID = str_pad($newAntrian, 4, '0', STR_PAD_LEFT);
            }
            $finew = $fullYMD . $invID;
        } else {

            $invID = str_pad('1', 4, '0', STR_PAD_LEFT);

            $finew = $fullYMD . $invID;
        }

        var_dump($finew);
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