<?php

namespace App\Http\Controllers;
use App\Models\OutletModel;
use App\Models\TransactionRawatJalanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Session;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {  
    
        $sesOutlet= Session::get('outlet');
        $outlet['outlet'] = OutletModel::where('status', '=', 'Aktif')
        ->get(); 

    
        $todayDate = Carbon::now()->format('Y-m-d');

        $data['jml_trx_open']= DB::table('transaksi_rawat_jalan')
         ->select(DB::raw("count(*) as count_trx_open"))
         ->join('master_outlet', 'transaksi_rawat_jalan.outletID', 'master_outlet.id')
         ->where('transaksi_rawat_jalan.status', '=', 'Open')
         ->where('master_outlet.name', '=', $sesOutlet)
         ->where('transaksi_rawat_jalan.tglTindakan', '=', $todayDate)
         ->get();

        $data['jml_trx_paid']= DB::table('transaksi_rawat_jalan')
         ->select(DB::raw("count(*) as count_trx_paid"))
         ->join('master_outlet', 'transaksi_rawat_jalan.outletID', 'master_outlet.id')
         ->where('transaksi_rawat_jalan.status', '=', 'Paid')
         ->where('master_outlet.name', '=', $sesOutlet)
         ->where('transaksi_rawat_jalan.tglTindakan', '=', $todayDate)
         ->get(); 

        $data['jml_trx_onprocess']= DB::table('transaksi_rawat_jalan')
         ->select(DB::raw("count(*) as count_trx_onprocess"))
         ->join('master_outlet', 'transaksi_rawat_jalan.outletID', 'master_outlet.id')
         ->where('transaksi_rawat_jalan.status', '=', 'On Process')
         ->where('master_outlet.name', '=', $sesOutlet)
         ->where('transaksi_rawat_jalan.tglTindakan', '=', $todayDate)
         ->get(); 
         
        $data['jml_trx_close']= DB::table('transaksi_rawat_jalan')
        ->select(DB::raw("count(*) as count_trx_close"))
        ->join('master_outlet', 'transaksi_rawat_jalan.outletID', 'master_outlet.id')
        ->where('transaksi_rawat_jalan.status', '=', 'Close')
        ->where('master_outlet.name', '=', $sesOutlet)
        ->where('transaksi_rawat_jalan.tglTindakan', '=', $todayDate)
        ->get();

        
        if ($request->selected_outlet) {
            $getOutletLapTrx2= DB::table('master_outlet')
            ->select('master_outlet.name as namaOutlet')
            ->where('master_outlet.id', '=', $request->selected_outlet)
            ->get();
            $data['getOutletLapTrx']=$getOutletLapTrx2->namaOutlet;
        }elseif ($request->selected_outlet=='' || $request->selected_outlet==0) {
            $data['getOutletLapTrx']=$sesOutlet;
        }else {
            $data['getOutletLapTrx']="Semua Outlet";
        }

        return view('dashboard.index', $outlet, $data);   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
        $sesOutlet= Session::get('outlet');
        $tglAwal = $request->date_filter;
        $tglAkhir = $request->date_filter2;
        $data['outlet'] = OutletModel::where('status', '=', 'Aktif')
        ->get();

        /*laporan transaksi outlet yang dipilih */ 
        if ($tglAwal !='' && $tglAkhir !='') {
            if($request->selected_outlet) {
                $data['laporanTransaksi'] = DB::table('transaksi_rawat_jalan')
                ->select('master_pasien.name as name_pasien', 'master_tindakan.name as jenis_tindakan', 'master_outlet.name as namaOutlet', 'master_payment.namePayment', 'transaksi_rawat_jalan.tglTindakan', 'transaksi_rawat_jalan.status', 'transaksi_rawat_jalan.price', 'transaksi_rawat_jalan.totalDisc', 'transaksi_rawat_jalan.Tax', 'transaksi_rawat_jalan.grandTotal')
                ->where('transaksi_rawat_jalan.outletID', '=', $request->selected_outlet)
                ->whereBetween('transaksi_rawat_jalan.tglTindakan', [$tglAwal, $tglAkhir])
                ->join('master_tindakan', 'master_tindakan.id', 'transaksi_rawat_jalan.tindakanID')
                ->join('master_outlet', 'transaksi_rawat_jalan.outletID', 'master_outlet.id')
                ->join('master_pasien', 'master_pasien.id', 'transaksi_rawat_jalan.pasienID')
                ->join('master_payment', 'master_payment.id', 'transaksi_rawat_jalan.paymentType')
                ->get();
            }elseif ($request->selected_outlet==0) {
                $data['laporanTransaksi'] = DB::table('transaksi_rawat_jalan')
                ->select('master_pasien.name as name_pasien', 'master_tindakan.name as jenis_tindakan', 'master_outlet.name as namaOutlet', 'master_payment.namePayment', 'transaksi_rawat_jalan.tglTindakan', 'transaksi_rawat_jalan.status', 'transaksi_rawat_jalan.price', 'transaksi_rawat_jalan.totalDisc', 'transaksi_rawat_jalan.Tax', 'transaksi_rawat_jalan.grandTotal')
                ->whereBetween('transaksi_rawat_jalan.tglTindakan', [$tglAwal, $tglAkhir])
                ->join('master_tindakan', 'master_tindakan.id', 'transaksi_rawat_jalan.tindakanID')
                ->join('master_outlet', 'transaksi_rawat_jalan.outletID', 'master_outlet.id')
                ->join('master_pasien', 'master_pasien.id', 'transaksi_rawat_jalan.pasienID')
                ->join('master_payment', 'master_payment.id', 'transaksi_rawat_jalan.paymentType')
                ->get();
            }
        }
        $data['totalLaporanTransaksiOutlet']=DB::table('transaksi_rawat_jalan')
        ->select(DB::raw("SUM(transaksi_rawat_jalan.grandTotal) as Total"))
        ->where('transaksi_rawat_jalan.outletID', '=', $request->selected_outlet)
        ->whereBetween('transaksi_rawat_jalan.tglTindakan', [$tglAwal, $tglAkhir])
        ->join('master_tindakan', 'master_tindakan.id', 'transaksi_rawat_jalan.tindakanID')
        ->join('master_outlet', 'transaksi_rawat_jalan.outletID', 'master_outlet.id')
        ->join('master_pasien', 'master_pasien.id', 'transaksi_rawat_jalan.pasienID')
        ->join('master_payment', 'master_payment.id', 'transaksi_rawat_jalan.paymentType')
        ->get();

        $todayDate = Carbon::now()->format('Y-m-d');
        $data['jml_trx_open']= DB::table('transaksi_rawat_jalan')
         ->select(DB::raw("count(*) as count_trx_open"))
         ->join('master_outlet', 'transaksi_rawat_jalan.outletID', 'master_outlet.id')
         ->where('transaksi_rawat_jalan.status', '=', 'Open')
         ->where('master_outlet.name', '=', $sesOutlet)
         ->where('transaksi_rawat_jalan.tglTindakan', '=', $todayDate)
         ->get();

        $data['jml_trx_paid']= DB::table('transaksi_rawat_jalan')
         ->select(DB::raw("count(*) as count_trx_paid"))
         ->join('master_outlet', 'transaksi_rawat_jalan.outletID', 'master_outlet.id')
         ->where('transaksi_rawat_jalan.status', '=', 'Paid')
         ->where('master_outlet.name', '=', $sesOutlet)
         ->where('transaksi_rawat_jalan.tglTindakan', '=', $todayDate)
         ->get(); 

        $data['jml_trx_onprocess']= DB::table('transaksi_rawat_jalan')
         ->select(DB::raw("count(*) as count_trx_onprocess"))
         ->join('master_outlet', 'transaksi_rawat_jalan.outletID', 'master_outlet.id')
         ->where('transaksi_rawat_jalan.status', '=', 'On Process')
         ->where('master_outlet.name', '=', $sesOutlet)
         ->where('transaksi_rawat_jalan.tglTindakan', '=', $todayDate)
         ->get(); 
         
        $data['jml_trx_close']= DB::table('transaksi_rawat_jalan')
        ->select(DB::raw("count(*) as count_trx_close"))
        ->join('master_outlet', 'transaksi_rawat_jalan.outletID', 'master_outlet.id')
        ->where('transaksi_rawat_jalan.status', '=', 'Close')
        ->where('master_outlet.name', '=', $sesOutlet)
        ->where('transaksi_rawat_jalan.tglTindakan', '=', $todayDate)
        ->get(); 

        if ($tglAwal !='' && $tglAkhir !='') {
            if($request->selected_outlet) {
                $data['getLaporanGrupTindakan']=DB::table('transaksi_rawat_jalan')
                ->selectRaw('master_tindakan.name as nama_tindakan, SUM(transaksi_rawat_jalan.grandTotal) as totalPrice, count(master_tindakan.name) as totalTindakan')
                ->join('master_tindakan', 'transaksi_rawat_jalan.tindakanID', 'master_tindakan.id')
                ->where('transaksi_rawat_jalan.status', '!=', 'Failed')
                ->where('transaksi_rawat_jalan.outletID', '=', $request->selected_outlet)
                ->whereBetween('transaksi_rawat_jalan.tglTindakan', [$tglAwal, $tglAkhir])
                ->groupBy('master_tindakan.name')
                ->get();
            }elseif ($request->selected_outlet==0) {
                $data['getLaporanGrupTindakan']=DB::table('transaksi_rawat_jalan')
                ->selectRaw('master_tindakan.name as nama_tindakan, SUM(transaksi_rawat_jalan.grandTotal) as totalPrice, count(master_tindakan.name) as totalTindakan')
                ->join('master_tindakan', 'transaksi_rawat_jalan.tindakanID', 'master_tindakan.id')
                ->where('transaksi_rawat_jalan.status', '!=', 'Failed')
                ->whereBetween('transaksi_rawat_jalan.tglTindakan', [$tglAwal, $tglAkhir])
                ->groupBy('master_tindakan.name')
                ->get();
            }
        }

        if ($tglAwal !='' && $tglAkhir !='') {
            if($request->selected_outlet) {
                $data['getLaporanGrupPembayaran']=DB::table('transaksi_rawat_jalan')
                ->selectRaw('master_payment.namePayment as nama_payment, SUM(transaksi_rawat_jalan.grandTotal) as totalPrice, count(master_payment.namePayment) as totalPayment')
                ->join('master_payment', 'transaksi_rawat_jalan.paymentType', 'master_payment.id')
                ->where('transaksi_rawat_jalan.status', '!=', 'Failed')
                ->where('transaksi_rawat_jalan.outletID', '=', $request->selected_outlet)
                ->whereBetween('transaksi_rawat_jalan.tglTindakan', [$tglAwal, $tglAkhir])
                ->groupBy('master_payment.namePayment')
                ->get();
            }else{
                $data['getLaporanGrupPembayaran']=DB::table('transaksi_rawat_jalan')
                ->selectRaw('master_payment.namePayment as nama_payment, SUM(transaksi_rawat_jalan.grandTotal) as totalPrice, count(master_payment.namePayment) as totalPayment')
                ->join('master_payment', 'transaksi_rawat_jalan.paymentType', 'master_payment.id')
                ->where('transaksi_rawat_jalan.status', '!=', 'Failed')
                ->whereBetween('transaksi_rawat_jalan.tglTindakan', [$tglAwal, $tglAkhir])
                ->groupBy('master_payment.namePayment')
                ->get();
            }
        }   

        if ($tglAwal !='' && $tglAkhir !='') {
            if($request->selected_outlet) {
                $data['getLaporanGrupStatus']=DB::table('transaksi_rawat_jalan')
                ->selectRaw('transaksi_rawat_jalan.status as nama_status, count(transaksi_rawat_jalan.status) as totalStatus')
                ->where('transaksi_rawat_jalan.outletID', '=', $request->selected_outlet)
                ->whereBetween('transaksi_rawat_jalan.tglTindakan', [$tglAwal, $tglAkhir])
                ->groupBy('transaksi_rawat_jalan.status')
                ->get();
            }else{
                $data['getLaporanGrupStatus']=DB::table('transaksi_rawat_jalan')
                ->selectRaw('transaksi_rawat_jalan.status as nama_status, count(transaksi_rawat_jalan.status) as totalStatus')
                ->whereBetween('transaksi_rawat_jalan.tglTindakan', [$tglAwal, $tglAkhir])
                ->groupBy('transaksi_rawat_jalan.status')
                ->get();
            }
        }  

        $data['getOutletLapTrx']= DB::table('master_outlet')
        ->select('master_outlet.name as namaOutlet')
        ->where('master_outlet.id', '=', $request->selected_outlet)
        ->get();
        
        return view('dashboard.index', $data); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        /*
        $sesOutlet= Session::get('outlet');
        if ($request->StatOpen) {
            $data['laporanTindakanOutlet']=TransactionRawatJalanModel::join('master_pasien', 'master_pasien.id', '=', 'transaksi_rawat_jalan.pasienID')
            ->join('master_tindakan', 'master_tindakan.id', '=', 'transaksi_rawat_jalan.transaksiID')
            ->join('master_outlet', 'master_outlet.id', '=', 'transaksi_rawat_jalan.outletID')
            ->join('master_payment', 'master_payment.id', '=', 'transaksi_rawat_jalan.paymentType')
            ->select('transaksi_rawat_jalan.id', 'transaksi_rawat_jalan.transaksiID', 'master_pasien.nik', 'master_pasien.name as namaPasien', 'master_pasien.passport', 'master_tindakan.name as namaTindakan', 'master_outlet.name as namaOutlet', 'master_payment.namePayment', 'transaksi_rawat_jalan.tglTindakan', 'transaksi_rawat_jalan.grandTotal')
            ->where('transaksi_rawat_jalan.status', 'Open')
            ->where('transaksi_rawat_jalan.status', $sesOutlet)
            ->where('transaksi_rawat_jalan.tglTindakan', $tglDipilih)
            ->orderBy('transaksi_rawat_jalan.id', 'desc')
            ->get();
            
        }elseif ($request->StatPaid) {
            $data['laporanTindakanOutlet']=TransactionRawatJalanModel::join('master_pasien', 'master_pasien.id', '=', 'transaksi_rawat_jalan.pasienID')
            ->join('master_tindakan', 'master_tindakan.id', '=', 'transaksi_rawat_jalan.transaksiID')
            ->join('master_outlet', 'master_outlet.id', '=', 'transaksi_rawat_jalan.outletID')
            ->join('master_payment', 'master_payment.id', '=', 'transaksi_rawat_jalan.paymentType')
            ->select('transaksi_rawat_jalan.id', 'transaksi_rawat_jalan.transaksiID', 'master_pasien.nik', 'master_pasien.name as namaPasien', 'master_pasien.passport', 'master_tindakan.name as namaTindakan', 'master_outlet.name as namaOutlet', 'master_payment.namePayment', 'transaksi_rawat_jalan.tglTindakan', 'transaksi_rawat_jalan.grandTotal')
            ->where('transaksi_rawat_jalan.status', 'Paid')
            ->where('transaksi_rawat_jalan.status', $sesOutlet)
            ->where('transaksi_rawat_jalan.tglTindakan', $tglDipilih)
            ->orderBy('transaksi_rawat_jalan.id', 'desc')
            ->get();

        }elseif ($request->StatOnProcess) {

            $data['laporanTindakanOutlet']=TransactionRawatJalanModel::join('master_pasien', 'master_pasien.id', '=', 'transaksi_rawat_jalan.pasienID')
            ->join('master_tindakan', 'master_tindakan.id', '=', 'transaksi_rawat_jalan.transaksiID')
            ->join('master_outlet', 'master_outlet.id', '=', 'transaksi_rawat_jalan.outletID')
            ->join('master_payment', 'master_payment.id', '=', 'transaksi_rawat_jalan.paymentType')
            ->select('transaksi_rawat_jalan.id', 'transaksi_rawat_jalan.transaksiID', 'master_pasien.nik', 'master_pasien.name as namaPasien', 'master_pasien.passport', 'master_tindakan.name as namaTindakan', 'master_outlet.name as namaOutlet', 'master_payment.namePayment', 'transaksi_rawat_jalan.tglTindakan', 'transaksi_rawat_jalan.grandTotal')
            ->where('transaksi_rawat_jalan.status', 'On Process')
            ->where('transaksi_rawat_jalan.status', $sesOutlet)
            ->where('transaksi_rawat_jalan.tglTindakan', $tglDipilih)
            ->orderBy('transaksi_rawat_jalan.id', 'desc')
            ->get();

        }elseif ($request->StatClose) {
            $data['laporanTindakanOutlet']=TransactionRawatJalanModel::join('master_pasien', 'master_pasien.id', '=', 'transaksi_rawat_jalan.pasienID')
            ->join('master_tindakan', 'master_tindakan.id', '=', 'transaksi_rawat_jalan.transaksiID')
            ->join('master_outlet', 'master_outlet.id', '=', 'transaksi_rawat_jalan.outletID')
            ->join('master_payment', 'master_payment.id', '=', 'transaksi_rawat_jalan.paymentType')
            ->select('transaksi_rawat_jalan.id', 'transaksi_rawat_jalan.transaksiID', 'master_pasien.nik', 'master_pasien.name as namaPasien', 'master_pasien.passport', 'master_tindakan.name as namaTindakan', 'master_outlet.name as namaOutlet', 'master_payment.namePayment', 'transaksi_rawat_jalan.tglTindakan', 'transaksi_rawat_jalan.grandTotal')
            ->where('transaksi_rawat_jalan.status', 'Close')
            ->where('transaksi_rawat_jalan.status', $sesOutlet)
            ->where('transaksi_rawat_jalan.tglTindakan', $tglDipilih)
            ->orderBy('transaksi_rawat_jalan.id', 'desc')
            ->get();
        }
        return view('dashboard.showReportOutlet', $data);  
        */
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