<?php

namespace App\ModelFilters;

use Carbon\Carbon;
use EloquentFilter\ModelFilter;

class BarangKeluarFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function barang($id)
    {
        return $this->where('barang_id', $id);
    }

    public function user($id)
    {
        return $this->where('user_id', $id);
    }

    public function timeFrom($timeFrom)
    {
        return $this->whereDate('created_at', '>=', Carbon::parse($timeFrom)->format('Y-m-d'));
    }

    public function timeTo($timeTo)
    {
        return $this->whereDate('created_at', '<=', Carbon::parse($timeTo)->format('Y-m-d'));
    }
}
