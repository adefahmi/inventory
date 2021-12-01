<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\BarangKeluarResource;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10);

        $records = BarangKeluar::query();
        $records->filter($request->all());

        return ResponseFormatter::success(
            BarangKeluarResource::collection($records->paginate($perPage)),
            'Data berhasil diambil'
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required',
            'qty' => 'required|numeric',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        $result = BarangKeluar::create($data);
        //decrease stock
        $result->barang->decreaseStock($data['qty'], [
            'reference' => $result,
        ]);

        return ResponseFormatter::success(
            new BarangKeluarResource($result),
            'Data berhasil disimpan'
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = BarangKeluar::find($id);

        if ($result) {
            return ResponseFormatter::success(
                new BarangKeluarResource($result),
                'Data berhasil diambil'
            );
        }

        return ResponseFormatter::error(
            null,
            'Data tidak ada',
            404
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BarangKeluar $barang_keluar)
    {
        $request->validate([
            'qty' => 'required|numeric',
        ]);

        $data['qty'] = $request->qty;
        $data['created_by'] = Auth::user()->id;
        $new_qty = $barang_keluar->qty - $data['qty'];

        $barang_keluar->update($data);
        $barang_keluar->barang->mutateStock($new_qty);

        return ResponseFormatter::success(
            new BarangKeluarResource($barang_keluar),
            'Data berhasil diupdate'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BarangKeluar $barang_keluar)
    {
        $barang_keluar->barang->increaseStock($barang_keluar->qty);
        $barang_keluar->delete();

        return ResponseFormatter::success(
            null,
            'Data berhasil dihapus'
        );
    }
}
