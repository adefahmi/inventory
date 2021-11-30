<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BarangResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'barang_category_id' => $this->barang_category_id,
            'barang_category_name' => $this->category->name,
            'created_by' => $this->created_by,
            'created_by_name' => $this->creator->name,
        ];
    }
}
