<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Konser;
use App\Models\Pemesanan;
use App\Traits\AjaxResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PemesananController extends Controller
{
    use AjaxResponse;
    public function index()
    {
        $data['list_konser'] = Konser::orderBy('tanggal','DESC')->where('tanggal','>', Carbon::now())->get();
        return view('guest.pemesanan.index')->with($data);
    }

    public function listkelas($id)
    {
        $data=Kelas::where('konser_id',$id)->orderBy('nama','ASC')->get();
        return $this->successResponse($data);
    }

    public function submitPemesanan(Request $request){
        $request->validate(
            [
                'konser_id' => ['required', 'uuid'],
                'kelas_id'=>['required','uuid'],
                'nama' => ['required'],
                'email' => ['required','email'],
                // 'jumlah'=>['required','int']
            ]
        );

        $cek_konser=Konser::find($request->konser_id);
        if(!$cek_konser){
            return $this->errorResponse('Data tidak dimeukan',404);
        }

        if ($cek_konser->tanggal <= Carbon::now()) {
            return $this->errorResponse('Konser sudah tidak tersedia', 400);
        }

        $cek_kelas=Kelas::find($request->kelas_id);
        $cek_pemesanan=Pemesanan::where('konser_id',$request->konser_id)->where('kelas_id',$request->kelas_id)->count();
        if($cek_pemesanan > $cek_kelas->kapasitas){
            return $this->errorResponse('Kapasistas sudah penuh',400);
        }

        $data=Pemesanan::create([
            'konser_id' => $request->konser_id,
            'nama_pemesan' => $request->nama,
            'email_pemesan'=>$request->email,
            'kelas_id'=>$request->kelas_id,
            'kode'=>Str::upper(Str::random(6))
        ]);
        return $this->successResponse($data);
    }
}
