<?php

namespace Webkul\Admin\DataGrids;

use Webkul\Ui\DataGrid\DataGrid;
use DB;

/**
 * VendorSourcesDataGrid Class
 *
 * @author Prashant Singh <prashant.singh852@webkul.com> @prashant-webkul
 * @copyright 2019 Highwayns Software Tokyo Ltd (http://www.highwayns.com)
 */
class VendorSourcesDataGrid extends DataGrid
{
    protected $index = 'id';

    protected $sortOrder = 'desc'; //asc or desc

    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('vendor_sources')->addSelect('id', 'name', 'name_kana', 'created_at');

        $this->setQueryBuilder($queryBuilder);
    }

    public function addColumns()
    {
        $this->addColumn([
            'index' => 'id',
            'label' => trans('admin::app.datagrid.id'),
            'type' => 'number',
            'searchable' => false,
            'sortable' => true,
            'filterable' => true
        ]);

        $this->addColumn([
            'index' => 'name',
            'label' => trans('admin::app.datagrid.name'),
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true
        ]);

        $this->addColumn([
            'index' => 'name_kana',
            'label' => trans('admin::app.datagrid.name_kana'),
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true
        ]);

        $this->addColumn([
            'index' => 'created_at',
            'label' => trans('admin::app.datagrid.created_at'),
            'type' => 'datetime',
            'searchable' => false,
            'sortable' => true,
            'filterable' => true
        ]);

    }

    public function prepareActions() {
        $this->addAction([
            'title' => 'Edit Vendor Source',
            'method' => 'GET', // use GET request only for redirect purposes
            'route' => 'admin.vendor_sources.edit',
            'icon' => 'icon pencil-lg-icon'
        ]);

        $this->addAction([
            'title' => 'Delete Vendor Source',
            'method' => 'POST', // use GET request only for redirect purposes
            'route' => 'admin.vendor_sources.delete',
            'confirm_text' => trans('ui::app.datagrid.massaction.delete', ['resource' => 'Exchange Rate']),
            'icon' => 'icon trash-icon'
        ]);
    }
}