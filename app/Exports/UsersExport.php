<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromView	
{
    /**
    * @return \Illuminate\Support\Collection
    */
   public function view(): View
    {
        return view('pdf.grnepdf', [
            'data' => ElecStock::all()
        ]);
    }
}
