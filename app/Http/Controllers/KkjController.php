<?php

namespace App\Http\Controllers;

use App\Http\Requests\KKJ\{
    StoreRequest,
    UpdateRequest
};
use App\Models\{
    AnggotaKeluarga,
    Kkj,
    KkjAnak,
    KkjKeluarga,
    KkjKepalaKeluarga,
    KkjPasangan,
    Wali
};
use Illuminate\Http\Request;

class KkjController extends Controller
{
    public function index()
    {
        $datas = Kkj::paginate(4);

        return view("kkj.index", compact('datas'));
    }

    public function create()
    {
        $status_menikah = ["Sudah Menikah", "Belum Menikah", "Cerai"];
        $jenjangs = ['SD', 'SMP', 'SMA/Sederajat', 'D1', 'D2', "D3", 'S1', 'S2', "S3"];
        $hubungans = ["Ayah", "Ibu", "Kakak", "Adik", "Suami", "Istri", "Keponakan", "Sepupu"];
        return view("kkj.form", compact("status_menikah", 'jenjangs', 'hubungans'));
    }

    public function store(StoreRequest $request)
    {
        try {
            $kkj = kartu_keluarga_jemaat($request->all());
            
            send_pdf_email($kkj, $request->email, 'kkj');
            
            return redirect()->route("kkj.index")->with("msg_success", "Berhasil menambahkan kartu keluarga jemaat");
        } catch (\Throwable $th) {
            return redirect()->route("kkj.index")->with("msg_error", "Gagal menambahkan kartu keluarga jemaat");
        }
    }

    public function show(Kkj $kkj)
    {
        //
    }

    public function edit(Kkj $kkj)
    {
        $data = Kkj::with(['wali', 'anggota_keluarga', 'urgent'])->find($kkj->id);

        $kepalaKeluarga = Wali::where('kkj_id', $kkj->id)->where('status', 'kepala keluarga')->first();
        $pasangan = Wali::where('kkj_id', $kkj->id)->where('status', 'pasangan')->first();
        
        $anaks = AnggotaKeluarga::where('kkj_id', $kkj->id)->where('hubungan', 'Anak')->get();
        $keluargas = AnggotaKeluarga::where('kkj_id', $kkj->id)->where('hubungan', "<>",'Anak')->get();
        
        $status_menikah = ["Sudah Menikah", "Belum Menikah", "Cerai"];
        $jenjangs = ['SD', 'SMP', 'SMA/Sederajat', 'D1', 'D2', "D3", 'S1', 'S2', "S3"];
        $hubungans = ["Ayah", "Ibu", "Kakak", "Adik", "Suami", "Istri", "Keponakan", "Sepupu"];

        return view("kkj.form", compact("data", "status_menikah", 'jenjangs', 'hubungans', 'kepalaKeluarga', 'pasangan', 'anaks', 'keluargas'));
    }

    public function update(UpdateRequest $request, Kkj $kkj)
    {
        try {
            $kkj = edit_kartu_kerluarga_jemaat($request->all(), $kkj->id);
            
            send_pdf_email($kkj, $request->email, 'kkj');
            return redirect()->route("kkj.index")->with("msg_success", "Berhasil mengubah kartu keluarga jemaat");
        } catch (\Throwable $th) {
            return redirect()->route("kkj.index")->with("msg_error", "Gagal mengubah kartu keluarga jemaat");
        }
    }

    public function destroy(Kkj $kkj)
    {
        if(!$kkj) return abort(403, 'TIDAK ADA DATA TERSEBUT');

        $kkj->delete();

        return redirect()->route("kkj.index")->with("msg_success", "Berhasil menghapus kartu keluarga jemaat");
    }

    public function destroyAnak($id)
    {
        $kkjAnak = AnggotaKeluarga::find($id);
        if(!$kkjAnak) return abort(403, "TIDAK ADA DATA TERSEBUT");

        $kkjAnak->delete();

        return back()->with("msg_success", "Berhasil menghapus anak");
    }

    public function destroyKeluarga($id)
    {
        $kkjKeluarga = AnggotaKeluarga::find($id);
        if(!$kkjKeluarga) return abort(403, "TIDAK ADA DATA TERSEBUT");

        $kkjKeluarga->delete();

        return back()->with("msg_success", "Berhasil menghapus keluarga");
    }
}
