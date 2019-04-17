<?php

namespace App\Exports;

use App\modules\ElecStock;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class InvoicesExport implements FromView
{
    public function view(): View
    {
        return view('pdf.grnepdf', [
            'invoices' => ElecStock::all()
        ]);
    }
}
