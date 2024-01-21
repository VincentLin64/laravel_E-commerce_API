<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'title' => $row[0],
            'content' => $row[1],
            'price' => $row[2],
            'quantity' => $row[3],
            'unit_name' => $row[4]
        ]);
    }
}
