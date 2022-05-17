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

class HasilTesPCRFaskesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $sesOutlet= Session::get('outlet');
        $type = 'PCR';
        $todayDate = Carbon::now()->format('Y-m-d');
        $isFaskes= Session::get('isFaskes');
        $data['tglAwal'] = $request->date_filter;
        $data['tglAkhir'] = $request->date_filter2;

        if ($isFaskes==1) {
            $data['hasilPCRFaskes']= DB::table('transaksi_rawat_jalan')
                ->select('transaksi_rawat_jalan.barcodeLab', 'transaksi_rawat_jalan.transaksiID', 
                'transaksi_rawat_jalan.pasienID', 'transaksi_rawat_jalan.tglTindakan', 
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
                $data['hasilPCRFaskes']= DB::table('transaksi_rawat_jalan')
                ->select('transaksi_rawat_jalan.barcodeLab', 'transaksi_rawat_jalan.transaksiID', 
                'transaksi_rawat_jalan.pasienID', 'transaksi_rawat_jalan.tglTindakan', 
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

        /*count jumlah negatif */
        if ($isFaskes==1) {
            $data['jml_hasil_pcr_negatif']= DB::table('transaksi_rawat_jalan')
            ->select(DB::raw("count(*) as count_hasil_pcr_negatif"))
            ->leftjoin('master_pasien', 'master_pasien.id', 'transaksi_rawat_jalan.pasienID')
            ->leftjoin('master_tindakan', 'master_tindakan.id', 'transaksi_rawat_jalan.tindakanID')
            ->leftjoin('master_outlet', 'transaksi_rawat_jalan.outletID', 'master_outlet.id')
            ->leftjoin('master_hasil_tes', 'master_hasil_tes.idTransaction', 'transaksi_rawat_jalan.transaksiID')
            ->where('master_tindakan.typeTindakan', '=', $type)
            ->where('master_outlet.name', '=', $sesOutlet)
            ->where('master_outlet.isFaskes', '=', '1')
            ->where('transaksi_rawat_jalan.tglTindakan', '=', $todayDate)
            ->where('master_hasil_tes.hasil', '=', 'Negatif')
            ->get();
        }else{
            $data['jml_hasil_pcr_negatif']= DB::table('transaksi_rawat_jalan')
            ->select(DB::raw("count(*) as count_hasil_pcr_negatif"))
            ->leftjoin('master_pasien', 'master_pasien.id', 'transaksi_rawat_jalan.pasienID')
            ->leftjoin('master_tindakan', 'master_tindakan.id', 'transaksi_rawat_jalan.tindakanID')
            ->leftjoin('master_outlet', 'transaksi_rawat_jalan.outletID', 'master_outlet.id')
            ->leftjoin('master_hasil_tes', 'master_hasil_tes.idTransaction', 'transaksi_rawat_jalan.transaksiID')
            ->where('master_tindakan.typeTindakan', '=', $type)
            ->where('master_outlet.isFaskes', '=', '1')
            ->where('transaksi_rawat_jalan.tglTindakan', '=', $todayDate)
            ->where('master_hasil_tes.hasil', '=', 'Negatif')
            ->get();
        }
        /*akhir dari count jumlah negatif*/

        /*count jumlah positif */
        if ($isFaskes==1) {
            $data['jml_hasil_pcr_positif']= DB::table('transaksi_rawat_jalan')
            ->select(DB::raw("count(*) as count_hasil_pcr_positif"))
            ->leftjoin('master_pasien', 'master_pasien.id', 'transaksi_rawat_jalan.pasienID')
            ->leftjoin('master_tindakan', 'master_tindakan.id', 'transaksi_rawat_jalan.tindakanID')
            ->leftjoin('master_outlet', 'transaksi_rawat_jalan.outletID', 'master_outlet.id')
            ->leftjoin('master_hasil_tes', 'master_hasil_tes.idTransaction', 'transaksi_rawat_jalan.transaksiID')
            ->where('master_tindakan.typeTindakan', '=', $type)
            ->where('master_outlet.name', '=', $sesOutlet)
            ->where('master_outlet.isFaskes', '=', '1')
            ->where('transaksi_rawat_jalan.tglTindakan', '=', $todayDate)
            ->where('master_hasil_tes.hasil', '=', 'Positif')
            ->get();
        }else{
            $data['jml_hasil_pcr_positif']= DB::table('transaksi_rawat_jalan')
            ->select(DB::raw("count(*) as count_hasil_pcr_positif"))
            ->leftjoin('master_pasien', 'master_pasien.id', 'transaksi_rawat_jalan.pasienID')
            ->leftjoin('master_tindakan', 'master_tindakan.id', 'transaksi_rawat_jalan.tindakanID')
            ->leftjoin('master_outlet', 'transaksi_rawat_jalan.outletID', 'master_outlet.id')
            ->leftjoin('master_hasil_tes', 'master_hasil_tes.idTransaction', 'transaksi_rawat_jalan.transaksiID')
            ->where('master_tindakan.typeTindakan', '=', $type)
            ->where('master_outlet.isFaskes', '=', '1')
            ->where('transaksi_rawat_jalan.tglTindakan', '=', $todayDate)
            ->where('master_hasil_tes.hasil', '=', 'Positif')
            ->get();
        }
        /*akhir dari count jumlah positif*/
        $data['namaRole']= Session::get('namaRole');
        return view('hasilTesPCRFaskes.index',$data);
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
        $sesOutlet= Session::get('outlet');
        $type = 'PCR';
        $todayDate = Carbon::now()->format('Y-m-d');
        $isFaskes= Session::get('isFaskes');
        $tglAwal['tglAwal'] = $request->date_filter;
        $tglAkhir['tglAkhir'] = $request->date_filter2;

        if ($request->date_filter2 < $request->date_filter) {
            return back()->with('error', 'Maaf! Tanggal pertama tidak boleh melewati tanggal kedua!');
        }


        

        if ($isFaskes==1) {
            if ($request->barcodeLab !='Semua'){
                if($request->barcodeLab=='Belum dibarcode') {
                    $data['hasilPCRFaskesPeriode']= DB::table('transaksi_rawat_jalan')
                    ->select('transaksi_rawat_jalan.barcodeLab', 'transaksi_rawat_jalan.transaksiID', 
                    'transaksi_rawat_jalan.pasienID', 'transaksi_rawat_jalan.tglTindakan', 
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
                    ->where('transaksi_rawat_jalan.barcodeLab', '=', 'Belum dibarcode')
                    ->get();
                }elseif($request->barcodeLab=='Sudah dibarcode'){
                    $data['hasilPCRFaskesPeriode']= DB::table('transaksi_rawat_jalan')
                    ->select('transaksi_rawat_jalan.barcodeLab', 'transaksi_rawat_jalan.transaksiID', 
                    'transaksi_rawat_jalan.pasienID', 'transaksi_rawat_jalan.tglTindakan', 
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
                    ->where('transaksi_rawat_jalan.barcodeLab', '!=', 'Belum dibarcode')
                    ->get();

                }
            }else{
                $data['hasilPCRFaskesPeriode']= DB::table('transaksi_rawat_jalan')
                    ->select('transaksi_rawat_jalan.barcodeLab', 'transaksi_rawat_jalan.transaksiID', 
                    'transaksi_rawat_jalan.pasienID', 'transaksi_rawat_jalan.tglTindakan', 
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
                }
        }else {
            if ($request->barcodeLab !='Semua'){
                if($request->barcodeLab=='Belum dibarcode') {
                    $data['hasilPCRFaskesPeriode']= DB::table('transaksi_rawat_jalan')
                    ->select('transaksi_rawat_jalan.barcodeLab', 'transaksi_rawat_jalan.transaksiID', 
                    'transaksi_rawat_jalan.pasienID', 'transaksi_rawat_jalan.tglTindakan', 
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
                    ->where('transaksi_rawat_jalan.barcodeLab', '=', 'Belum dibarcode')
                    ->get();
                }elseif($request->barcodeLab=='Sudah dibarcode'){
                    $data['hasilPCRFaskesPeriode']= DB::table('transaksi_rawat_jalan')
                    ->select('transaksi_rawat_jalan.barcodeLab', 'transaksi_rawat_jalan.transaksiID', 
                    'transaksi_rawat_jalan.pasienID', 'transaksi_rawat_jalan.tglTindakan', 
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
                    ->where('transaksi_rawat_jalan.barcodeLab', '!=', 'Belum dibarcode')
                    ->get();

                }
            }else {
                $data['hasilPCRFaskesPeriode']= DB::table('transaksi_rawat_jalan')
                ->select('transaksi_rawat_jalan.barcodeLab', 'transaksi_rawat_jalan.transaksiID', 
                'transaksi_rawat_jalan.pasienID', 'transaksi_rawat_jalan.tglTindakan', 
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
        }
        /*untuk menampilkan data di tab 1 Sample PCR Hari ini ketika sudah ditekan tombol Tampilkan 
        di tab kedua*/
        if ($isFaskes==1) {
            $data['hasilPCRFaskes']= DB::table('transaksi_rawat_jalan')
                ->select('transaksi_rawat_jalan.barcodeLab', 'transaksi_rawat_jalan.transaksiID', 
                'transaksi_rawat_jalan.pasienID', 'transaksi_rawat_jalan.tglTindakan', 
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
                $data['hasilPCRFaskes']= DB::table('transaksi_rawat_jalan')
                ->select('transaksi_rawat_jalan.barcodeLab', 'transaksi_rawat_jalan.transaksiID', 
                'transaksi_rawat_jalan.pasienID', 'transaksi_rawat_jalan.tglTindakan', 
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
        /*count jumlah negatif */
        if ($isFaskes==1) {
            $data['jml_hasil_pcr_negatif']= DB::table('transaksi_rawat_jalan')
            ->select(DB::raw("count(*) as count_hasil_pcr_negatif"))
            ->leftjoin('master_pasien', 'master_pasien.id', 'transaksi_rawat_jalan.pasienID')
            ->leftjoin('master_tindakan', 'master_tindakan.id', 'transaksi_rawat_jalan.tindakanID')
            ->leftjoin('master_outlet', 'transaksi_rawat_jalan.outletID', 'master_outlet.id')
            ->leftjoin('master_hasil_tes', 'master_hasil_tes.idTransaction', 'transaksi_rawat_jalan.transaksiID')
            ->where('master_tindakan.typeTindakan', '=', $type)
            ->where('master_outlet.name', '=', $sesOutlet)
            ->where('master_outlet.isFaskes', '=', '1')
            ->where('transaksi_rawat_jalan.tglTindakan', '=', $todayDate)
            ->where('master_hasil_tes.hasil', '=', 'Negatif')
            ->get();
        }else{
            $data['jml_hasil_pcr_negatif']= DB::table('transaksi_rawat_jalan')
            ->select(DB::raw("count(*) as count_hasil_pcr_negatif"))
            ->leftjoin('master_pasien', 'master_pasien.id', 'transaksi_rawat_jalan.pasienID')
            ->leftjoin('master_tindakan', 'master_tindakan.id', 'transaksi_rawat_jalan.tindakanID')
            ->leftjoin('master_outlet', 'transaksi_rawat_jalan.outletID', 'master_outlet.id')
            ->leftjoin('master_hasil_tes', 'master_hasil_tes.idTransaction', 'transaksi_rawat_jalan.transaksiID')
            ->where('master_tindakan.typeTindakan', '=', $type)
            ->where('master_outlet.isFaskes', '=', '1')
            ->where('transaksi_rawat_jalan.tglTindakan', '=', $todayDate)
            ->where('master_hasil_tes.hasil', '=', 'Negatif')
            ->get();
        }
        /*akhir dari count jumlah negatif*/

        /*count jumlah positif */
        if ($isFaskes==1) {
            $data['jml_hasil_pcr_positif']= DB::table('transaksi_rawat_jalan')
            ->select(DB::raw("count(*) as count_hasil_pcr_positif"))
            ->leftjoin('master_pasien', 'master_pasien.id', 'transaksi_rawat_jalan.pasienID')
            ->leftjoin('master_tindakan', 'master_tindakan.id', 'transaksi_rawat_jalan.tindakanID')
            ->leftjoin('master_outlet', 'transaksi_rawat_jalan.outletID', 'master_outlet.id')
            ->leftjoin('master_hasil_tes', 'master_hasil_tes.idTransaction', 'transaksi_rawat_jalan.transaksiID')
            ->where('master_tindakan.typeTindakan', '=', $type)
            ->where('master_outlet.name', '=', $sesOutlet)
            ->where('master_outlet.isFaskes', '=', '1')
            ->where('transaksi_rawat_jalan.tglTindakan', '=', $todayDate)
            ->where('master_hasil_tes.hasil', '=', 'Positif')
            ->get();
        }else{
            $data['jml_hasil_pcr_positif']= DB::table('transaksi_rawat_jalan')
            ->select(DB::raw("count(*) as count_hasil_pcr_positif"))
            ->leftjoin('master_pasien', 'master_pasien.id', 'transaksi_rawat_jalan.pasienID')
            ->leftjoin('master_tindakan', 'master_tindakan.id', 'transaksi_rawat_jalan.tindakanID')
            ->leftjoin('master_outlet', 'transaksi_rawat_jalan.outletID', 'master_outlet.id')
            ->leftjoin('master_hasil_tes', 'master_hasil_tes.idTransaction', 'transaksi_rawat_jalan.transaksiID')
            ->where('master_tindakan.typeTindakan', '=', $type)
            ->where('master_outlet.isFaskes', '=', '1')
            ->where('transaksi_rawat_jalan.tglTindakan', '=', $todayDate)
            ->where('master_hasil_tes.hasil', '=', 'Positif')
            ->get();
        }
        /*akhir dari count jumlah positif*/
    /*Akhir untuk menampilkan data di tab 1 Sample PCR Hari ini ketika sudah ditekan tombol Tampilkan 
        di tab kedua*/
        
        $data['namaRole']= Session::get('namaRole');
        return view('hasilTesPCRFaskes.index',$data,compact('tglAwal'), compact('tglAkhir'));

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
