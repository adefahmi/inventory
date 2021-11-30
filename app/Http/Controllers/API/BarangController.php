<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\BarangResource;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10);

        $records = Barang::query();
        $records->filter($request->all());

        return ResponseFormatter::success(
            BarangResource::collection($records->paginate($perPage)),
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
            'name' => 'required',
            'barang_category_id' => 'required',
        ]);

        $data = $request->all();
        $data['created_by'] = Auth::user()->id;

        $result = Barang::create($data);

        return ResponseFormatter::success(
            new BarangResource($result),
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
        $result = Barang::find($id);

        if ($result) {
            return ResponseFormatter::success(
                new BarangResource($result),
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
    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'name' => 'required',
            'barang_category_id' => 'required',
        ]);

        $data = $request->all();
        $data['created_by'] = Auth::user()->id;

        $barang->update($data);

        return ResponseFormatter::success(
            new BarangResource($barang),
            'Data berhasil diupdate'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();

        return ResponseFormatter::success(
            null,
            'Data berhasil dihapus'
        );
    }
}
