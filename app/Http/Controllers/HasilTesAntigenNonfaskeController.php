<?php

namespace App\Http\Controllers;
use App\Models\OutletModel;
use App\Models\HasilTesModel;
use App\Models\TransactionRawatJalanModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HasilTesAntigenNonfaskeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['outlet'] = OutletModel::select(
            "*"
        )
            ->where('status', '=', 'Aktif')
            ->where('isFaskes', '=', '0')
            ->get();  
        return view('hasilTesAntigenNonFaskes.index', $data);       
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

        
        /*
        $data['outlet'] = OutletModel::where('status', '=', 'Aktif')
            ->where('isFaskes', '=', '0')
            ->select("*")
            ->get();
        $tglAwal = $request->date_filter;
        $tglAkhir = $request->date_filter2;
        $type = 'Antigen';
      
        $data['hasilAntigens'] = TransactionRawatJalanModel::where('transaksi_rawat_jalan.status', '!=', 'Paid')
        ->where('transaksi_rawat_jalan.outletID', '=', $request->select_outlet)
        ->where(['master_tindakan.typeTindakan' => $type])
        ->whereDate('transaksi_rawat_jalan.tglTindakan', '>=', $tglAwal)
        ->whereDate('transaksi_rawat_jalan.tglTindakan', '<=', $tglAkhir)
        ->leftjoin('master_hasil_tes', 'master_hasil_tes.idTransaction', 'transaksi_rawat_jalan.transaksiID')
        ->leftjoin('master_pasien', 'master_pasien.id', 'master_hasil_tes.idPasien')
        ->leftjoin('master_outlet', 'transaksi_rawat_jalan.outletID', 'master_outlet.id')
        ->leftjoin('master_tindakan', 'master_tindakan.id', 'transaksi_rawat_jalan.tindakanID')
        ->select('master_outlet.name as namaOutlet', 'master_hasil_tes.hasil', 'master_pasien.name as namaPasien', 'master_pasien.nik', 'transaksi_rawat_jalan.transaksiID', 'transaksi_rawat_jalan.tglTindakan', 'transaksi_rawat_jalan.status', 'master_tindakan.typeTindakan', 'master_tindakan.name as namaTindakan', 'master_pasien.phone', 'master_pasien.id as pasienID')
        ->get();
        */

        $outlet=OutletModel::where('status', '=', 'Aktif')
        ->where('isFaskes', '=', '0')
        ->select("*")
        ->get();
        $tglAwal = $request->date_filter;
        $tglAkhir = $request->date_filter2;
        $type = 'Antigen';

        /*
        $hasilAntigens= DB::table('transaksi_rawat_jalan')
        ->select('master_outlet.name as namaOutlet', 'master_hasil_tes.hasil', 'master_pasien.name as namaPasien', 'master_pasien.nik', 'transaksi_rawat_jalan.transaksiID', 'transaksi_rawat_jalan.tglTindakan', 'transaksi_rawat_jalan.status', 'master_tindakan.typeTindakan', 'master_tindakan.name as namaTindakan', 'master_pasien.phone', 'master_pasien.id as pasienID')
        ->where('transaksi_rawat_jalan.status', '!=', 'Paid')
        ->where('master_tindakan.typeTindakan', '=', $type)
        ->where('transaksi_rawat_jalan.outletID', '=', $request->select_outlet)
        ->whereBetween('transaksi_rawat_jalan.tglTindakan', [$tglAwal, $tglAkhir])
        ->join('master_hasil_tes', 'master_hasil_tes.idTransaction', 'transaksi_rawat_jalan.transaksiID')
        ->join('master_pasien', 'master_pasien.id', 'master_hasil_tes.idPasien')
        ->join('master_outlet', 'transaksi_rawat_jalan.outletID', 'master_outlet.id')
        ->join('master_tindakan', 'master_tindakan.id', 'transaksi_rawat_jalan.tindakanID')
        ->get();
       */

      $hasilAntigens= DB::table('transaksi_rawat_jalan')
      ->select('transaksi_rawat_jalan.transaksiID','transaksi_rawat_jalan.pasienID','transaksi_rawat_jalan.barcodeLab', 'master_pasien.nik', 'master_pasien.name as namaPasien', 'master_pasien.phone', 'transaksi_rawat_jalan.status', 'master_tindakan.name as namaTindakan', 'master_outlet.name as namaOutlet', 'transaksi_rawat_jalan.tglTindakan', 'master_tindakan.typeTindakan', 'master_hasil_tes.hasil')
      ->where('transaksi_rawat_jalan.status', '!=', 'Paid')
      ->where('master_tindakan.typeTindakan', '=', $type)
      ->where('transaksi_rawat_jalan.outletID', '=', $request->select_outlet)
      ->whereBetween('transaksi_rawat_jalan.tglTindakan', [$tglAwal, $tglAkhir])
      ->leftjoin('master_hasil_tes', 'master_hasil_tes.idTransaction', 'transaksi_rawat_jalan.transaksiID')
      ->leftjoin('master_pasien', 'master_pasien.id', 'master_hasil_tes.idPasien')
      ->leftjoin('master_outlet', 'transaksi_rawat_jalan.outletID', 'master_outlet.id')
      ->leftjoin('master_tindakan', 'master_tindakan.id', 'transaksi_rawat_jalan.tindakanID')
      ->orderBy('transaksi_rawat_jalan.transaksiID', 'desc')
      ->get();

      foreach ($hasilAntigens as $getTrxPas) {
        $transaksiID=$getTrxPas->transaksiID;
        $pasienID=$getTrxPas->pasienID;
      }
       $data['countAnoF']= DB::table('master_hasil_tes')
         ->select(DB::raw("count(*) as count_Antigen_nonFaskes"))
         ->join('transaksi_rawat_jalan', 'transaksi_rawat_jalan.transaksiID', 'master_hasil_tes.idTransaction')
         ->join('master_pasien', 'master_pasien.id', 'master_hasil_tes.idPasien')
         ->where('master_hasil_tes.idTransaction', '=', $transaksiID)
         ->where('master_hasil_tes.idPasien', '=', $pasienID)
         ->get();
        return view('hasilTesAntigenNonFaskes.index', compact('outlet'), compact('hasilAntigens'),$data);
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