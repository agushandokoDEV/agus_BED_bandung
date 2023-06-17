<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class DaftarPemesananController extends Controller
{
    public function index()
    {
        return view('admin.pemesanan.index');
    }

    public function list(Request $request)
    {
        $qry=Pemesanan::with(['konser','kelas']);
        return datatables()->eloquent($qry)->toJson();
    }
}
