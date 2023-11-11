<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Exports\DataExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\VwPemilihDetail;

class DownloadExcel extends BaseController
{
    public function downloadExcel(Request $request) {
        // Proses data dan hasilkan file Excel
        // $data = $request->data;
        // dd($data);
        $data = VwPemilihDetail::all();
        $export = new DataExport($data);

        // Memberikan ekstensi file saat menyimpan
        $file = Excel::store($export, '/public/excel.xlsx'); // Berikan ekstensi .xlsx atau tipe file yang sesuai

        // Mengirimkan tautan unduh file Excel
        return response()->json(['file_url' => asset('storage/excel/' . $file)]);
    }

}
