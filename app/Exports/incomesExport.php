<?php

namespace App\Exports;

use App\credit;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

class incomesExport implements FromQuery
{
    Use Exportable;
    /**
    * @return \Illuminate\Database\Query\Builder
    */
    public function query()
    {
        //
        return credit::query();
    }
}
