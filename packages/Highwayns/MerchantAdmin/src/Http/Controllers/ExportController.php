<?php

namespace Highwayns\MerchantAdmin\Http\Controllers;

use Highwayns\MerchantAdmin\Exports\DataGridExport;
use Excel;

/**
 * Export controlller
 *
 * @author    Rahul Shukla <rahulshukla.symfony517@webkul.com>
 * @copyright 2019 Highwayns Software Tokyo Ltd (http://www.highwayns.com)
 */
class ExportController extends Controller
{
    protected $exportableGrids = [
        'OrderDataGrid', 'OrderInvoicesDataGrid', 'OrderShipmentsDataGrid', 'OrderRefundDataGrid', 'CustomerDataGrid', 'TaxRateDataGrid', 'ProductDataGrid', 'CMSPageDataGrid'
    ];

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('agentadmin');
    }

    /**
     * function for export datagrid
     *
     * @return \Illuminate\Http\Response
    */
    public function export()
    {
        $criteria = request()->all();

        $format = $criteria['format'];

        $gridName = explode('\\', $criteria['gridName']);
        $path = '\Highwayns\MerchantAdmin\DataGrids'.'\\'.last($gridName);

        $proceed = false;

        foreach ($this->exportableGrids as $exportableGrid) {
            if (last($gridName) == $exportableGrid) {
                $proceed = true;
            }
        }

        if (! $proceed) {
            return redirect()->back();
        }

        $gridInstance = new $path;
        $records = $gridInstance->export();

        if (count($records) == 0) {
            session()->flash('warning', trans('admin::app.export.no-records'));

            return redirect()->back();
        }

        if ($format == 'csv') {
            return Excel::download(new DataGridExport($records), last($gridName).'.csv');
        }

        if ($format == 'xls') {
            return Excel::download(new DataGridExport($records), last($gridName).'.xlsx');
        }

        session()->flash('warning', trans('admin::app.export.illegal-format'));

        return redirect()->back();
    }
}