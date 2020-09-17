<?php

namespace App\Exports;

use App\expense;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

class ExpensesExport implements FromQuery
{
    Use Exportable;
    /**
    * @return \Illuminate\Database\Query\Builder
    */
    public function query()
    {
        return expense::query();
    }
}
