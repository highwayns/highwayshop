<?php

namespace Highwayns\MerchantAdmin\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;


/**
 * DataGridImport class
 *
 * @author    Rahul Shukla <rahulshukla.symfony517@webkul.com>
 * @copyright 2019 Highwayns Software Tokyo Ltd (http://www.highwayns.com)
*/

class DataGridImport implements ToCollection, WithHeadingRow
{
    use Importable;

    /**
     * @param array $row
     * @return void
    */
    public function collection(Collection $rows)
    {
    }
}