<?php

namespace App\Http\Controllers;
use App\Models\TransactionRawatJalanModel;
use App\Models\HasilTesModel;
use App\Models\RoleModel;
use App\Models\OutletModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Session;

class RiwayatTindakanController extends Controller
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
        $data['outlet'] = OutletModel::select(
            "*"
        )
        ->where('status', '=', 'Aktif')
        ->get();
        $data['stan1'] = OutletModel::select(
            "*"
        )
        ->where('status', '=', 'Aktif')
        ->get();
        return view('riwayatTindakan.index', $data);       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        /*
        $data['riwayatTindakanPeriode']= TransactionRawatJalanModel::select(
            "transaksi_rawat_jalan.id", 
            "transaksi_rawat_jalan.transaksiID", 
            "transaksi_rawat_jalan.pasienID",
            "transaksi_rawat_jalan.paymenType",
            "master_pasien.dateOfBirth",
            "master_pasien.nik",
            "master_pasien.name name_pasien",
            "transaksi_rawat_jalan.status",
            "master_tindakan.name name_tindakan",
            "transaksi_rawat_jalan.tglTindakan",
            "transaksi_rawat_jalan.sampleTime",
            "master_payment.namePayment",
            "master_outlet.name name_outlet",
            "master_tindakan.typeTindakan",
            "transaksi_rawat_jalan.grandTotal",
            "transaksi_rawat_jalan.createdAt",
            "master_tindakan.typeTindakan",
            "master_hasil_tes.hasil"
        )
        ->join("master_pasien", "transaksi_rawat_jalan.pasienID", "=", "master_pasien.id")
        ->join("master_outlet", "transaksi_rawat_jalan.outletID", "=", "master_outlet.id")
        ->join("master_tindakan", "transaksi_rawat_jalan.tindakanID", "=", "master_tindakan.id")
        ->join("master_payment", "master_payment.id", "=", "transaksi_rawat_jalan.paymentType")
        ->join("master_hasil_tes", "master_hasil_tes.idTransaction", "=", "transaksi_rawat_jalan.transaksiID")
        ->where('transaksi_rawat_jalan.status', '!=', 'Failed')
        ->whereDate('transaksi_rawat_jalan.tglTindakan', '>=', '2022-03-01')
        ->whereDate('transaksi_rawat_jalan.tglTindakan', '<=', '2022-04-05')
        ->get();
        return view('riwayatTindakan.index', $data);
        */
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data['outlet']=OutletModel::where('status', '=', 'Aktif')
        ->select("*")
        ->get();
        $data['stan1'] = OutletModel::select(
            "*"
        )
        ->where('status', '=', 'Aktif')
        ->get();
        $todayDate = Carbon::now()->format('Y-m-d');  
        $tglAwal = $request->date_filter;
        $tglAkhir = $request->date_filter2;
  
       
       
        $data['riwayatTindakanNow']= DB::table('transaksi_rawat_jalan')
        ->select('transaksi_rawat_jalan.id','transaksi_rawat_jalan.transaksiID','transaksi_rawat_jalan.pasienID','transaksi_rawat_jalan.paymentType', 'master_pasien.dateOfBirth', 'master_pasien.nik', 'master_pasien.name as namaPasien', 'transaksi_rawat_jalan.status', 'master_tindakan.name as namaTindakan','transaksi_rawat_jalan.tglTindakan', 'transaksi_rawat_jalan.sampleTime', 'master_payment.namePayment', 'master_outlet.name as namaOutlet', 'master_tindakan.typeTindakan', 'transaksi_rawat_jalan.grandTotal', 'transaksi_rawat_jalan.createdAt', 'master_hasil_tes.hasil')
        ->where('transaksi_rawat_jalan.status', '!=', 'Failed')
        ->where('transaksi_rawat_jalan.outletID', '=', $request->select_outlet)
        ->where('transaksi_rawat_jalan.tglTindakan', '=', $todayDate)
        ->leftjoin('master_hasil_tes', 'master_hasil_tes.idTransaction', 'transaksi_rawat_jalan.transaksiID')
        ->leftjoin('master_pasien', 'master_pasien.id', 'transaksi_rawat_jalan.pasienID')
        ->leftjoin('master_outlet', 'transaksi_rawat_jalan.outletID', 'master_outlet.id')
        ->leftjoin('master_tindakan', 'master_tindakan.id', 'transaksi_rawat_jalan.tindakanID')
        ->leftjoin('master_payment', 'master_payment.id', 'transaksi_rawat_jalan.paymentType')
        ->orderBy('transaksi_rawat_jalan.transaksiID', 'desc')
        ->get();

        if ($request->select_outlet_periode) {
            $data['riwayatTindakanPeriode']= DB::table('transaksi_rawat_jalan')
            ->select('transaksi_rawat_jalan.id','transaksi_rawat_jalan.transaksiID','transaksi_rawat_jalan.pasienID','transaksi_rawat_jalan.paymentType', 'master_pasien.dateOfBirth', 'master_pasien.nik', 'master_pasien.name as namaPasien', 'transaksi_rawat_jalan.status', 'master_tindakan.name as namaTindakan','transaksi_rawat_jalan.tglTindakan', 'transaksi_rawat_jalan.sampleTime', 'master_payment.namePayment', 'master_outlet.name as namaOutlet', 'master_tindakan.typeTindakan', 'transaksi_rawat_jalan.grandTotal', 'transaksi_rawat_jalan.createdAt', 'master_hasil_tes.hasil')
            ->where('transaksi_rawat_jalan.status', '!=', 'Failed')
            ->where('transaksi_rawat_jalan.outletID', '=', $request->select_outlet_periode)
            ->whereBetween('transaksi_rawat_jalan.tglTindakan', [$tglAwal, $tglAkhir])
            ->leftjoin('master_hasil_tes', 'master_hasil_tes.idTransaction', 'transaksi_rawat_jalan.transaksiID')
            ->leftjoin('master_pasien', 'master_pasien.id', 'transaksi_rawat_jalan.pasienID')
            ->leftjoin('master_outlet', 'transaksi_rawat_jalan.outletID', 'master_outlet.id')
            ->leftjoin('master_tindakan', 'master_tindakan.id', 'transaksi_rawat_jalan.tindakanID')
            ->leftjoin('master_payment', 'master_payment.id', 'transaksi_rawat_jalan.paymentType')
            ->orderBy('transaksi_rawat_jalan.transaksiID', 'desc')
            ->get();
        }elseif ($request->select_outlet_periode==0) {
            $data['riwayatTindakanPeriode']= DB::table('transaksi_rawat_jalan')
            ->select('transaksi_rawat_jalan.id','transaksi_rawat_jalan.transaksiID','transaksi_rawat_jalan.pasienID','transaksi_rawat_jalan.paymentType', 'master_pasien.dateOfBirth', 'master_pasien.nik', 'master_pasien.name as namaPasien', 'transaksi_rawat_jalan.status', 'master_tindakan.name as namaTindakan','transaksi_rawat_jalan.tglTindakan', 'transaksi_rawat_jalan.sampleTime', 'master_payment.namePayment', 'master_outlet.name as namaOutlet', 'master_tindakan.typeTindakan', 'transaksi_rawat_jalan.grandTotal', 'transaksi_rawat_jalan.createdAt', 'master_hasil_tes.hasil')
            ->where('transaksi_rawat_jalan.status', '!=', 'Failed')
            ->whereBetween('transaksi_rawat_jalan.tglTindakan', [$tglAwal, $tglAkhir])
            ->leftjoin('master_hasil_tes', 'master_hasil_tes.idTransaction', 'transaksi_rawat_jalan.transaksiID')
            ->leftjoin('master_pasien', 'master_pasien.id', 'transaksi_rawat_jalan.pasienID')
            ->leftjoin('master_outlet', 'transaksi_rawat_jalan.outletID', 'master_outlet.id')
            ->leftjoin('master_tindakan', 'master_tindakan.id', 'transaksi_rawat_jalan.tindakanID')
            ->leftjoin('master_payment', 'master_payment.id', 'transaksi_rawat_jalan.paymentType')
            ->orderBy('transaksi_rawat_jalan.transaksiID', 'desc')
            ->get();
        }
        return view('riwayatTindakan.index', $data);
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