<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
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
        $limit = 3;
        $category = BarangCategory::all();

        return ResponseFormatter::success(
            $category,
            'Data list kategori barang berhasil diambil'
        );
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
     * @param  \App\Models\BarangCategory  $barangCategory
     * @return \Illuminate\Http\Response
     */
    public function show(BarangCategory $barangCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BarangCategory  $barangCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(BarangCategory $barangCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BarangCategory  $barangCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BarangCategory $barangCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BarangCategory  $barangCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(BarangCategory $barangCategory)
    {
        //
    }
}
