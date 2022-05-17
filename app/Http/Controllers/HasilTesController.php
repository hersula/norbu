<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\HasilTesModel;
use App\Models\PasienModel;

class HasilTesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hasils['hasils'] = HasilTesModel::join('master_pasien', 'master_pasien.id', '=', 'master_hasil_tes.idPasien')
        ->get(['master_hasil_tes.id', 'master_hasil_tes.idTransaction', 'master_hasil_tes.idPasien', 'master_hasil_tes.pemeriksaan', 'master_hasil_tes.spesimen', 'master_hasil_tes.hasil', 'master_hasil_tes.keterangan','master_hasil_tes.nameTargetGen', 'master_hasil_tes.gen0', 'master_hasil_tes.gen1','master_hasil_tes.gen2', 'master_hasil_tes.gen3', 'master_hasil_tes.gen4', 'master_hasil_tes.gen5','master_hasil_tes.createdAt', 'master_pasien.name']);

        return view('masterHasilTes.index',$hasils);
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hasils = HasilTesModel::findOrFail($id);
        $pasien=PasienModel::where('status', 'Aktif')
        ->get();
        return view('masterHasilTes.show',compact('hasils'),compact('pasien'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hasils = HasilTesModel::findOrFail($id);
        $pasien=PasienModel::where('status', 'Aktif')
        ->get();
        return view('masterHasilTes.edit',compact('hasils'),compact('pasien'));
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
        $this->validate($request, [
            'idTransaction' => 'required',
            'idPasien'      => 'required',
            'spesimen'      => 'required',
            'hasil'         => 'required'
          
        ]);

        $hasils = HasilTesModel::findOrFail($id);
        
        $hasils->update([
            'idTransaction' => $request->idTransaction,
            'idPasien'      => $request->idPasien,
            'pemeriksaan'   => $request->pemeriksaan,
            'spesimen'      => $request->spesimen,
            'hasil'         => $request->hasil,
            'keterangan'    => $request->keterangan,
            'nameTargetGen' => $request->nameTargetGen,
            'gen0'          => $request->gen0,
            'gen1'          => $request->gen1,
            'gen2'          => $request->gen2,
            'gen3'          => $request->gen3,
            'gen4'          => $request->gen4,
            'gen5'          => $request->gen5,
            'createdAt'     => NOW()
        ]);

        if ($hasils) {
            return redirect('/hasiltes')->with('success', 'Data Hasil Tes berhasil diubah');
        } else {
            return back()->with('error', 'Data Hasil Tes tidak berhasil diubah');
        }
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
