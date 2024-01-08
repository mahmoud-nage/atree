<?php

namespace App\Imports\Dashboard\Withdrawals;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Withdrawals;
class WithdrawalsExcelReportImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {

        // dd($rows);
        foreach ($rows as $row) 
        {   
            if ($row[0] == null ) {
                continue;
            } else {
                $withdrawal = Withdrawals::where('number' , $row[0])->first();
                if ($withdrawal) {
                    $withdrawal->status = $row[1];
                    $withdrawal->payment_method = $row[2];
                    $withdrawal->system_notes = $row[3];
                    $withdrawal->save();
                }
            }
        }
    }
}
