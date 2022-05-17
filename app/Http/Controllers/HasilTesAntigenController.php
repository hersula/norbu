<?php

namespace App\Http\Controllers;
use App\Models\TransactionRawatJalanModel;
use App\Models\HasilTesModel;
use App\Models\OutletModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HasilTesAntigenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
     

        $outlet=OutletModel::select("*"
        )
        ->where('status', '=', 'Aktif')
        ->where('isFaskes', '=', '0')
        ->get();
        
        if ($request->select_outlet) {
            $data['hasilantigens']= TransactionRawatJalanModel::select(
                "transaksi_rawat_jalan.transaksiID", 
                "transaksi_rawat_jalan.pasienID",
                "transaksi_rawat_jalan.barcodeLab",
                "master_pasien.nik",
                "master_pasien.name as name_pasien",
                "master_pasien.phone",
                "transaksi_rawat_jalan.status",
                "master_tindakan.name as name_tindakan",
                "master_tindakan.typeTindakan",
                "master_outlet.name as name_outlet",
                "transaksi_rawat_jalan.tglTindakan",
                "master_hasil_tes.hasil"
            )
            ->join("master_pasien", "transaksi_rawat_jalan.pasienID", "=", "master_pasien.id")
            ->join("master_outlet", "transaksi_rawat_jalan.outletID", "=", "master_outlet.id")
            ->join("master_tindakan", "transaksi_rawat_jalan.tindakanID", "=", "master_tindakan.id")
            ->join("master_hasil_tes", "master_hasil_tes.idTransaction", "=", "transaksi_rawat_jalan.transaksiID")
            ->where('transaksi_rawat_jalan.status', '!=', 'Paid')
            ->where('transaksi_rawat_jalan.outletID', '=', $request->select_outlet)
            ->where('master_tindakan.typeTindakan', '=', 'Antigen')
            ->get();   
        } else {
            $data['hasilantigens']= TransactionRawatJalanModel::select(
                "transaksi_rawat_jalan.transaksiID", 
                "transaksi_rawat_jalan.pasienID",
                "transaksi_rawat_jalan.barcodeLab",
                "master_pasien.nik",
                "master_pasien.name as name_pasien",
                "master_pasien.phone",
                "transaksi_rawat_jalan.status",
                "master_tindakan.name as name_tindakan",
                "master_tindakan.typeTindakan",
                "master_outlet.name as name_outlet",
                "transaksi_rawat_jalan.tglTindakan",
                "master_hasil_tes.hasil"
            )
            ->join("master_pasien", "transaksi_rawat_jalan.pasienID", "=", "master_pasien.id")
            ->join("master_outlet", "transaksi_rawat_jalan.outletID", "=", "master_outlet.id")
            ->join("master_tindakan", "transaksi_rawat_jalan.tindakanID", "=", "master_tindakan.id")
            ->join("master_hasil_tes", "master_hasil_tes.idTransaction", "=", "transaksi_rawat_jalan.transaksiID")
            ->where('transaksi_rawat_jalan.status', '!=', 'Paid')
            ->where('transaksi_rawat_jalan.outletID', '=', '22')
            ->where('master_tindakan.typeTindakan', '=', 'Antigen')
            ->whereDate('transaksi_rawat_jalan.tglTindakan', '>=', '2022-03-01')
            ->whereDate('transaksi_rawat_jalan.tglTindakan', '<=', '2022-04-05')
            ->get();

        }
        return view('hasiltesAntigen.index', $data, compact('outlet'));
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
        //
    }

    public function filter (Request $request) {
        if(!empty($request->date_filter)&& !empty($request->date_filter2)){
            $data = DB::table('master_hasil_tes')
            ->join('transaksi_rawat_jalan', 'transaksi_rawat_jalan.transaksiID', '=', 'master_hasil_tes.idTransaction')
            ->join('master_pasien', 'master_pasien.id', '=', 'master_hasil_tes.idPasien')
            ->select('master_hasil_tes.*', 'transaksi_rawat_jalan.id', 'transaksi_rawat_jalan.transaksiID', 'master_pasien.id')
             ->whereBetween('tglTindakan', array($request->date_filter, $request->date_filter2))
             ->get();
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
