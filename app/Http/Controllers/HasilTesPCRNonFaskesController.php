<?php

namespace App\Http\Controllers;

use App\Models\OutletModel;
use App\Models\HasilTesModel;
use App\Models\PasienModel;
use App\Models\TransactionRawatJalanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Session;

class HasilTesPCRNonFaskesController extends Controller
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
        ->get();
        $data['namaRole']= Session::get('namaRole');
        return view('hasilTesPCRNonFaskes.index',$data);

    
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
        $type = 'PCR';
        $sesOutlet= Session::get('outlet');
        $todayDate = Carbon::now()->format('Y-m-d');
        $tglAwal['tglAwal']= $request->date_filter;
        $tglAkhir['tglAkhir'] = $request->date_filter2;
        $data['outlet'] = OutletModel::where('status', '=', 'Aktif')
        ->get();

        if ($request->date_filter2 < $request->date_filter) {
            return back()->with('error', 'Maaf! Tanggal pertama tidak boleh melewati tanggal kedua!');
        }


        if ($request->date_filter !='' && $request->date_filter2 !='') {
            if($request->name_outlet_filter) {
                $data['hasilPCR']= DB::table('transaksi_rawat_jalan')
                ->select('transaksi_rawat_jalan.transaksiID', 'transaksi_rawat_jalan.status as status_tindakan', 'transaksi_rawat_jalan.pasienID', 'transaksi_rawat_jalan.barcodeLab', 'master_pasien.nik', 'master_pasien.phone','master_pasien.name as namaPasien', 'master_outlet.name as namaOutlet', 'master_tindakan.name as namaTindakan','transaksi_rawat_jalan.createdAt as waktuTindakan', 'transaksi_rawat_jalan.sampleTime', 'master_hasil_tes.hasil')
                ->leftjoin('master_pasien', 'master_pasien.id', 'transaksi_rawat_jalan.pasienID')
                ->leftjoin('master_outlet', 'transaksi_rawat_jalan.outletID', 'master_outlet.id')
                ->leftjoin('master_tindakan', 'master_tindakan.id', 'transaksi_rawat_jalan.tindakanID')
                ->leftjoin('master_hasil_tes', 'master_hasil_tes.idTransaction', 'transaksi_rawat_jalan.transaksiID')
                ->where('master_tindakan.typeTindakan', '=', $type)
                ->where('transaksi_rawat_jalan.status', '!=', 'Paid')
                ->where('transaksi_rawat_jalan.status', '!=', 'Failed')
                ->where('transaksi_rawat_jalan.barcodeLab', '!=', 'Belum dibarcode')
                ->where('transaksi_rawat_jalan.outletID', '=', $request->name_outlet_filter)
                ->whereBetween('transaksi_rawat_jalan.tglTindakan', [$tglAwal, $tglAkhir])
                ->orderBy('transaksi_rawat_jalan.transaksiID', 'desc')
                ->get();
            }elseif ($request->name_outlet_filter==0) {
                $data['hasilPCR']= DB::table('transaksi_rawat_jalan')
                ->select('transaksi_rawat_jalan.transaksiID', 'transaksi_rawat_jalan.status as status_tindakan', 'transaksi_rawat_jalan.pasienID', 'transaksi_rawat_jalan.barcodeLab', 'master_pasien.nik', 'master_pasien.phone','master_pasien.name as namaPasien', 'master_outlet.name as namaOutlet', 'master_tindakan.name as namaTindakan','transaksi_rawat_jalan.createdAt as waktuTindakan', 'transaksi_rawat_jalan.sampleTime', 'master_hasil_tes.hasil')
                ->leftjoin('master_pasien', 'master_pasien.id', 'transaksi_rawat_jalan.pasienID')
                ->leftjoin('master_outlet', 'transaksi_rawat_jalan.outletID', 'master_outlet.id')
                ->leftjoin('master_tindakan', 'master_tindakan.id', 'transaksi_rawat_jalan.tindakanID')
                ->leftjoin('master_hasil_tes', 'master_hasil_tes.idTransaction', 'transaksi_rawat_jalan.transaksiID')
                ->where('master_tindakan.typeTindakan', '=', $type)
                ->where('transaksi_rawat_jalan.status', '!=', 'Paid')
                ->where('transaksi_rawat_jalan.status', '!=', 'Failed')
                ->where('transaksi_rawat_jalan.barcodeLab', '!=', 'Belum dibarcode')
                ->where('transaksi_rawat_jalan.outletID', '=', $request->name_outlet_filter)
                ->whereBetween('transaksi_rawat_jalan.tglTindakan', [$tglAwal, $tglAkhir])
                ->orderBy('transaksi_rawat_jalan.transaksiID', 'desc')
                ->get();
            }
        }
        if ($request->date_filter =='' && $request->date_filter2 =='') {
            if($request->name_outlet_filter) {
                $data['hasilPCR']= DB::table('transaksi_rawat_jalan')
                ->select('transaksi_rawat_jalan.transaksiID', 'transaksi_rawat_jalan.status as status_tindakan', 
                'transaksi_rawat_jalan.pasienID', 'transaksi_rawat_jalan.barcodeLab', 'master_pasien.nik', 'master_pasien.phone',
                'master_pasien.name as namaPasien', 'master_outlet.name as namaOutlet', 'master_tindakan.name as namaTindakan',
                'transaksi_rawat_jalan.createdAt as waktuTindakan', 'transaksi_rawat_jalan.sampleTime', 'master_hasil_tes.hasil')
                ->leftjoin('master_pasien', 'master_pasien.id', 'transaksi_rawat_jalan.pasienID')
                ->leftjoin('master_outlet', 'transaksi_rawat_jalan.outletID', 'master_outlet.id')
                ->leftjoin('master_tindakan', 'master_tindakan.id', 'transaksi_rawat_jalan.tindakanID')
                ->leftjoin('master_hasil_tes', 'master_hasil_tes.idTransaction', 'transaksi_rawat_jalan.transaksiID')
                ->where('master_tindakan.typeTindakan', '=', $type)
                ->where('transaksi_rawat_jalan.status', '!=', 'Paid')
                ->where('transaksi_rawat_jalan.status', '!=', 'Failed')
                ->where('transaksi_rawat_jalan.barcodeLab', '!=', 'Belum dibarcode')
                ->where('transaksi_rawat_jalan.outletID', '=', $request->name_outlet_filter)
                ->where('transaksi_rawat_jalan.tglTindakan', '=', $todayDate)
                ->orderBy('transaksi_rawat_jalan.transaksiID', 'desc')
                ->get();
            }elseif ($request->name_outlet_filter==0) {
                $data['hasilPCR']= DB::table('transaksi_rawat_jalan')
                ->select('transaksi_rawat_jalan.transaksiID', 'transaksi_rawat_jalan.status as status_tindakan', 
                'transaksi_rawat_jalan.pasienID', 'transaksi_rawat_jalan.barcodeLab', 'master_pasien.nik', 'master_pasien.phone',
                'master_pasien.name as namaPasien', 'master_outlet.name as namaOutlet', 'master_tindakan.name as namaTindakan',
                'transaksi_rawat_jalan.createdAt as waktuTindakan', 'transaksi_rawat_jalan.sampleTime', 'master_hasil_tes.hasil')
                ->leftjoin('master_pasien', 'master_pasien.id', 'transaksi_rawat_jalan.pasienID')
                ->leftjoin('master_outlet', 'transaksi_rawat_jalan.outletID', 'master_outlet.id')
                ->leftjoin('master_tindakan', 'master_tindakan.id', 'transaksi_rawat_jalan.tindakanID')
                ->leftjoin('master_hasil_tes', 'master_hasil_tes.idTransaction', 'transaksi_rawat_jalan.transaksiID')
                ->where('master_tindakan.typeTindakan', '=', $type)
                ->where('transaksi_rawat_jalan.status', '!=', 'Paid')
                ->where('transaksi_rawat_jalan.status', '!=', 'Failed')
                ->where('transaksi_rawat_jalan.barcodeLab', '!=', 'Belum dibarcode')
                ->where('transaksi_rawat_jalan.tglTindakan', '=', $todayDate)
                ->orderBy('transaksi_rawat_jalan.transaksiID', 'desc')
                ->get();
            }
        }
        $data['namaRole']= Session::get('namaRole');
        return view('hasilTesPCRNonFaskes.index',$data);
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
