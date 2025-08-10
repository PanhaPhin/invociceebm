<?php


namespace App\DataTables;

use App\Models\Tax;

class TaxDataTable
{
    public function get()
    {
        return Tax::query();
    }
}