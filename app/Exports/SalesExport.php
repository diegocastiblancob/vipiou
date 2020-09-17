<?php

namespace App\Exports;

use App\sale;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

class SalesExport implements FromQuery
{
    Use Exportable;
    /**
    * @return \Illuminate\Database\Query\Builder
    */
    public function query()
    {
        //
        return sale::query();
    }
}
