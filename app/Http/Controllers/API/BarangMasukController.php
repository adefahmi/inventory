<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\BarangMasukResource;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10);

        $records = BarangMasuk::query();
        $records->filter($request->all());

        return ResponseFormatter::success(
            BarangMasukResource::collection($records->paginate($perPage)),
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

        $result = BarangMasuk::create($data);
        //increase stock
        $result->barang->increaseStock($data['qty'], [
            'reference' => $result,
        ]);

        return ResponseFormatter::success(
            new BarangMasukResource($result),
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
        $result = BarangMasuk::find($id);

        if ($result) {
            return ResponseFormatter::success(
                new BarangMasukResource($result),
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
    public function update(Request $request, BarangMasuk $barang_masuk)
    {
        $request->validate([
            'qty' => 'required|numeric',
        ]);

        $data['qty'] = $request->qty;
        $data['created_by'] = Auth::user()->id;
        $new_qty = $data['qty'] - $barang_masuk->qty;

        $barang_masuk->update($data);
        $barang_masuk->barang->mutateStock($new_qty);

        return ResponseFormatter::success(
            new BarangMasukResource($barang_masuk),
            'Data berhasil diupdate'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BarangMasuk $barang_masuk)
    {
        $barang_masuk->barang->decreaseStock($barang_masuk->qty);
        $barang_masuk->delete();

        return ResponseFormatter::success(
            null,
            'Data berhasil dihapus'
        );
    }
}
