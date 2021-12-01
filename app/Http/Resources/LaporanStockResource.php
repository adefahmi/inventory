<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class LaporanStockResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'barang_id' => $this->id,
            'barang_name' => $this->name,
            'barang_category_id' => $this->barang_category_id,
            'barang_category_name' => $this->category->name,
            'stock_awal' => $this->stock(Carbon::parse($request->timeFrom)->subDay()->endOfDay()),
            'barang_masuk_qty' => $this->barangMasuk->sum('qty'),
            'barang_keluar_qty' => $this->barangKeluar->sum('qty'),
            'stock_akhir' => $this->stock(Carbon::parse($request->timeTo)->endOfDay()),
        ];
    }
}
