<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\BarangCategoryResource;
use App\Models\BarangCategory;
use Illuminate\Http\Request;

class BarangCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10);

        $records = BarangCategory::query();
        $records->filter($request->all());

        return ResponseFormatter::success(
            BarangCategoryResource::collection($records->paginate($perPage)),
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
        ]);

        $result = BarangCategory::create($request->all());

        return ResponseFormatter::success(
            new BarangCategoryResource($result),
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
        $result = BarangCategory::find($id);

        if ($result) {
            return ResponseFormatter::success(
                new BarangCategoryResource($result),
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
    public function update(Request $request, BarangCategory $barang_category)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $barang_category->update($request->all());

        return ResponseFormatter::success(
            new BarangCategoryResource($barang_category),
            'Data berhasil diupdate'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BarangCategory $barang_category)
    {
        $barang_category->delete();

        return ResponseFormatter::success(
            null,
            'Data berhasil dihapus'
        );
    }
}
