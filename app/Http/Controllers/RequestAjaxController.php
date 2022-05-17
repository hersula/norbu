<?php

namespace App\Http\Controllers;

use App\Models\OutletTindakanListModel;
use App\Models\PasienModel;


class RequestAjaxController extends Controller
{
    public function pasien()
    {
        $nik = $_POST['pasien_id'];
        $data = PasienModel::where('nik', $nik)->first();
        return  response()->json([
            'data' => $data,
            'status' => 200

        ]);
    }
    public function tindakan()
    {
        $outletID = $_POST['outlet_id'];
        $tindakan = OutletTindakanListModel::join('master_outlet', 'master_outlet.id', '=', 'outlet_tindakan_list.outletID')
            ->join('master_tindakan', 'master_tindakan.id', '=', 'outlet_tindakan_list.outletTindakan')
            ->where('outlet_tindakan_list.outletID', $outletID)
            ->select('Outlet_tindakan_list.price as harga', 'Outlet_tindakan_list.id as idList_tindakan', 'master_tindakan.*')
            ->get();

        return  response()->json([
            'data' => $tindakan,
            'status' => 200

        ]);
    }
    public function listTindakan()
    {
        $listId = $_POST['list_id'];
        $listTindakan = OutletTindakanListModel::join('master_outlet', 'master_outlet.id', '=', 'outlet_tindakan_list.outletID')
            ->join('master_tindakan', 'master_tindakan.id', '=', 'outlet_tindakan_list.outletTindakan')
            ->where('outlet_tindakan_list.id', $listId)
            ->select('Outlet_tindakan_list.price as harga', 'Outlet_tindakan_list.id as idList_tindakan', 'master_tindakan.*')
            ->first();

        return  response()->json([
            'data' => $listTindakan,
            'status' => 200

        ]);
    }

    public function testPrice() {
        $tindakanID = $_POST['tindakanID'];
        $outletID = $_POST['outletID'];
        $tindakanPrice = OutletTindakanListModel::select(
            "price"
        )
            ->where('outletTindakan', '=', $tindakanID)
            ->where('outletID', '=', $outletID)
            ->get();  
    }
   
}