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

class HasilTesAntigenfaskesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['outlet'] = OutletModel::select(
            "*"
        )
            ->where('status', '=', 'Aktif')
            ->where('isFaskes', '=', '1')
            ->get();
    
        $type = 'Antigen';
        $sesOutlet= Session::get('outlet');
        $todayDate = Carbon::now()->format('Y-m-d');
        $isFaskes= Session::get('isFaskes');
        $data['tglAwal'] = $request->date_filter;
        $data['tglAkhir'] = $request->date_filter2;
       
        
        if ($isFaskes==1) {
        $data['hasilAntigensFaskes']= DB::table('transaksi_rawat_jalan')
            ->select('transaksi_rawat_jalan.barcodeLab', 'transaksi_rawat_jalan.transaksiID', 
            'transaksi_rawat_jalan.pasienID', 'transaksi_rawat_jalan.tglTindakan', 'master_pasien.nik', 
            'master_pasien.name as namaPasien', 'master_pasien.phone', 
            'master_tindakan.name as namaTindakan', 'transaksi_rawat_jalan.barcodeLabTime', 
            'transaksi_rawat_jalan.status as status_tindakan','master_outlet.name as name_outlet',
            'transaksi_rawat_jalan.sampleTime', 'master_hasil_tes.hasil')
            ->leftjoin('master_pasien', 'master_pasien.id', 'transaksi_rawat_jalan.pasienID')
            ->leftjoin('master_tindakan', 'master_tindakan.id', 'transaksi_rawat_jalan.tindakanID')
            ->leftjoin('master_outlet', 'transaksi_rawat_jalan.outletID', 'master_outlet.id')
            ->leftjoin('master_hasil_tes', 'master_hasil_tes.idTransaction', 'transaksi_rawat_jalan.transaksiID')
            ->where('master_tindakan.typeTindakan', '=', $type)
            ->where('master_outlet.name', '=', $sesOutlet)
            ->where('master_outlet.isFaskes', '=', '1')
            ->where('transaksi_rawat_jalan.tglTindakan', '=', $todayDate)
            ->get();
        }else {
            $data['hasilAntigensFaskes']= DB::table('transaksi_rawat_jalan')
            ->select('transaksi_rawat_jalan.barcodeLab', 'transaksi_rawat_jalan.transaksiID', 
            'transaksi_rawat_jalan.pasienID', 'transaksi_rawat_jalan.tglTindakan', 'master_pasien.nik', 
            'master_pasien.name as namaPasien', 'master_pasien.phone', 
            'master_tindakan.name as namaTindakan', 'transaksi_rawat_jalan.barcodeLabTime', 
            'transaksi_rawat_jalan.status as status_tindakan','master_outlet.name as name_outlet',
            'transaksi_rawat_jalan.sampleTime', 'master_hasil_tes.hasil')
            ->leftjoin('master_pasien', 'master_pasien.id', 'transaksi_rawat_jalan.pasienID')
            ->leftjoin('master_tindakan', 'master_tindakan.id', 'transaksi_rawat_jalan.tindakanID')
            ->leftjoin('master_outlet', 'transaksi_rawat_jalan.outletID', 'master_outlet.id')
            ->leftjoin('master_hasil_tes', 'master_hasil_tes.idTransaction', 'transaksi_rawat_jalan.transaksiID')
            ->where('master_tindakan.typeTindakan', '=', $type)
            ->where('master_outlet.isFaskes', '=', '1')
            ->where('transaksi_rawat_jalan.tglTindakan', '=', $todayDate)
            ->get();

        }
        
          
     
       /*
        $data['hasil']= DB::table('master_hasil_tes')
        ->select(array('master_hasil_tes.*',DB::raw("COUNT(master_hasil_tes.id) as count_hasil")))
        ->join('master_pasien', 'master_pasien.id', '=', 'master_hasil_tes.idPasien')
        ->where('master_hasil_tes.idTransaction', '=', $transaksiID)
        ->where('master_hasil_tes.idPasien', '=', $pasienID)
        ->get();
        */

        $data['namaRole']= Session::get('namaRole');
        return view('hasilTesAntigenFaskes.index',$data);
          
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
       
        $type = 'Antigen';
        $sesOutlet= Session::get('outlet');
        $isFaskes= Session::get('isFaskes');
        $todayDate = Carbon::now()->format('Y-m-d');
        $tglAwal['tglAwal']= $request->date_filter;
        $tglAkhir['tglAkhir'] = $request->date_filter2;

        if ($isFaskes==1) {
            $data['hasilAntigensFaskes']= DB::table('transaksi_rawat_jalan')
                ->select('transaksi_rawat_jalan.barcodeLab', 'transaksi_rawat_jalan.transaksiID', 
                'transaksi_rawat_jalan.pasienID', 'transaksi_rawat_jalan.tglTindakan', 'master_pasien.nik', 
                'master_pasien.name as namaPasien', 'master_pasien.phone', 
                'master_tindakan.name as namaTindakan', 'transaksi_rawat_jalan.barcodeLabTime', 
                'transaksi_rawat_jalan.status as status_tindakan','master_outlet.name as name_outlet',
                'transaksi_rawat_jalan.sampleTime', 'master_hasil_tes.hasil')
                ->leftjoin('master_pasien', 'master_pasien.id', 'transaksi_rawat_jalan.pasienID')
                ->leftjoin('master_tindakan', 'master_tindakan.id', 'transaksi_rawat_jalan.tindakanID')
                ->leftjoin('master_outlet', 'transaksi_rawat_jalan.outletID', 'master_outlet.id')
                ->leftjoin('master_hasil_tes', 'master_hasil_tes.idTransaction', 'transaksi_rawat_jalan.transaksiID')
                ->where('master_tindakan.typeTindakan', '=', $type)
                ->where('master_outlet.name', '=', $sesOutlet)
                ->where('master_outlet.isFaskes', '=', '1')
                ->where('transaksi_rawat_jalan.tglTindakan', '=', $todayDate)
                ->get();
            }else {
                $data['hasilAntigensFaskes']= DB::table('transaksi_rawat_jalan')
                ->select('transaksi_rawat_jalan.barcodeLab', 'transaksi_rawat_jalan.transaksiID', 
                'transaksi_rawat_jalan.pasienID', 'transaksi_rawat_jalan.tglTindakan', 'master_pasien.nik', 
                'master_pasien.name as namaPasien', 'master_pasien.phone', 
                'master_tindakan.name as namaTindakan', 'transaksi_rawat_jalan.barcodeLabTime', 
                'transaksi_rawat_jalan.status as status_tindakan','master_outlet.name as name_outlet',
                'transaksi_rawat_jalan.sampleTime', 'master_hasil_tes.hasil')
                ->leftjoin('master_pasien', 'master_pasien.id', 'transaksi_rawat_jalan.pasienID')
                ->leftjoin('master_tindakan', 'master_tindakan.id', 'transaksi_rawat_jalan.tindakanID')
                ->leftjoin('master_outlet', 'transaksi_rawat_jalan.outletID', 'master_outlet.id')
                ->leftjoin('master_hasil_tes', 'master_hasil_tes.idTransaction', 'transaksi_rawat_jalan.transaksiID')
                ->where('master_tindakan.typeTindakan', '=', $type)
                ->where('master_outlet.isFaskes', '=', '1')
                ->where('transaksi_rawat_jalan.tglTindakan', '=', $todayDate)
                ->get();
    
            }
            
    
          
        if ($isFaskes==1) {
            $data['hasilAntigensFaskesPeriode']= DB::table('transaksi_rawat_jalan')
                ->select('transaksi_rawat_jalan.barcodeLab', 'transaksi_rawat_jalan.transaksiID', 
                'transaksi_rawat_jalan.pasienID', 'transaksi_rawat_jalan.tglTindakan', 'master_pasien.nik', 
                'master_pasien.name as namaPasien', 'master_pasien.phone', 
                'master_tindakan.name as namaTindakan', 'transaksi_rawat_jalan.barcodeLabTime', 
                'transaksi_rawat_jalan.status as status_tindakan','master_outlet.name as name_outlet',
                'transaksi_rawat_jalan.sampleTime', 'master_hasil_tes.hasil')
                ->leftjoin('master_pasien', 'master_pasien.id', 'transaksi_rawat_jalan.pasienID')
                ->leftjoin('master_tindakan', 'master_tindakan.id', 'transaksi_rawat_jalan.tindakanID')
                ->leftjoin('master_outlet', 'transaksi_rawat_jalan.outletID', 'master_outlet.id')
                ->leftjoin('master_hasil_tes', 'master_hasil_tes.idTransaction', 'transaksi_rawat_jalan.transaksiID')
                ->where('master_tindakan.typeTindakan', '=', $type)
                ->where('master_outlet.name', '=', $sesOutlet)
                ->where('master_outlet.isFaskes', '=', '1')
                ->whereBetween('transaksi_rawat_jalan.tglTindakan', [$tglAwal, $tglAkhir])
                ->get();
        }else {
                $data['hasilAntigensFaskesPeriode']= DB::table('transaksi_rawat_jalan')
                ->select('transaksi_rawat_jalan.barcodeLab', 'transaksi_rawat_jalan.transaksiID', 
                'transaksi_rawat_jalan.pasienID', 'transaksi_rawat_jalan.tglTindakan', 'master_pasien.nik', 
                'master_pasien.name as namaPasien', 'master_pasien.phone', 
                'master_tindakan.name as namaTindakan', 'transaksi_rawat_jalan.barcodeLabTime', 
                'transaksi_rawat_jalan.status as status_tindakan','master_outlet.name as name_outlet',
                'transaksi_rawat_jalan.sampleTime', 'master_hasil_tes.hasil')
                ->leftjoin('master_pasien', 'master_pasien.id', 'transaksi_rawat_jalan.pasienID')
                ->leftjoin('master_tindakan', 'master_tindakan.id', 'transaksi_rawat_jalan.tindakanID')
                ->leftjoin('master_outlet', 'transaksi_rawat_jalan.outletID', 'master_outlet.id')
                ->leftjoin('master_hasil_tes', 'master_hasil_tes.idTransaction', 'transaksi_rawat_jalan.transaksiID')
                ->where('master_tindakan.typeTindakan', '=', $type)
                ->where('master_outlet.isFaskes', '=', '1')
                ->whereBetween('transaksi_rawat_jalan.tglTindakan', [$tglAwal, $tglAkhir])
                ->get();
    
        }
      

        $data['namaRole']= Session::get('namaRole');
        return view('hasilTesAntigenFaskes.index',$data,compact('tglAwal'), compact('tglAkhir'));
    
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
