<?php

namespace Webkul\Admin\DataGrids;

use Webkul\Ui\DataGrid\DataGrid;
use DB;

/**
 * AgentSourcesDataGrid Class
 *
 * @author Prashant Singh <prashant.singh852@webkul.com> @prashant-webkul
 * @copyright 2019 Highwayns Software Tokyo Ltd (http://www.highwayns.com)
 */
class AgentSourcesDataGrid extends DataGrid
{
    protected $index = 'id';

    protected $sortOrder = 'desc'; //asc or desc

    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('agent_sources')->addSelect('id', 'name', 'vendor_id', 'agency_group_id', 'created_at');

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
            'index' => 'vendor_id',
            'label' => trans('admin::app.datagrid.vendor_id'),
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true
        ]);

        $this->addColumn([
            'index' => 'agency_group_id',
            'label' => trans('admin::app.datagrid.agency_group_id'),
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
            'title' => 'Edit Agent Source',
            'method' => 'GET', // use GET request only for redirect purposes
            'route' => 'admin.agent_sources.edit',
            'icon' => 'icon pencil-lg-icon'
        ]);

        $this->addAction([
            'title' => 'Delete Agent Source',
            'method' => 'POST', // use GET request only for redirect purposes
            'route' => 'admin.agent_sources.delete',
            'confirm_text' => trans('ui::app.datagrid.massaction.delete', ['resource' => 'Exchange Rate']),
            'icon' => 'icon trash-icon'
        ]);
    }
}