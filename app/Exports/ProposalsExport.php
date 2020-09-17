<?php

namespace App\Exports;

use App\proposal;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

class ProposalsExport implements FromQuery
{
    Use Exportable;
    /**
    * @return \Illuminate\Database\Query\Builder
    */
    public function query()
    {
        //
        return proposal::query();
    }
}
