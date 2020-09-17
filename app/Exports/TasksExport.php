<?php

namespace App\Exports;

use App\task;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

class TasksExport implements FromQuery
{
    Use Exportable;
    /**
    * @return \Illuminate\Database\Query\Builder
    */
    public function query()
    {
        //
        return task::query();        
    }
}
