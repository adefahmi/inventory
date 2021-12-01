<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class BarangFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function name($name)
    {
        return $this->where('name', 'LIKE', "%$name%");
    }

    public function category($id)
    {
        return $this->where('barang_category_id', $id);
    }

    public function creator($id)
    {
        return $this->where('created_by', $id);
    }

    public function barang($id)
    {
        return $this->where('id', $id);
    }
}
