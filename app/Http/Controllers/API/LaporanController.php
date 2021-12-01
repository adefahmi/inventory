<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\BarangKeluarResource;
use App\Http\Resources\BarangMasukResource;
use App\Http\Resources\LaporanStockResource;
use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function barangMasuk(Request $request)
    {
        $perPage = $request->input('perPage', 10);

        $records = BarangMasuk::query();
        $records->filter($request->all());

        return ResponseFormatter::success(
            BarangMasukResource::collection($records->paginate($perPage)),
            'Data berhasil diambil'
        );
    }

    public function barangKeluar(Request $request)
    {
        $perPage = $request->input('perPage', 10);

        $records = BarangKeluar::query();
        $records->filter($request->all());

        return ResponseFormatter::success(
            BarangKeluarResource::collection($records->paginate($perPage)),
            'Data berhasil diambil'
        );
    }

    public function stock(Request $request)
    {
        $perPage = $request->input('perPage', 10);
        $filterTime = $request->only(['timeFrom', 'timeTo']);

        $records = Barang::query();
        $records->filter($request->only(['name', 'category', 'barang']));
        $records->with([
            'barangMasuk' => function($q) use($filterTime) {
                $q->filter($filterTime);
            },
            'barangKeluar' => function($q) use($filterTime) {
                $q->filter($filterTime);
            },
            'stockMutations'
        ]);

        return ResponseFormatter::success(
            LaporanStockResource::collection($records->paginate($perPage)),
            'Data berhasil diambil'
        );

    }
}
