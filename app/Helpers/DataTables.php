<?php
namespace App\Helpers;

class DataTables
{
	protected $limit;
	protected $start;
	protected $order;
	protected $direction;

	protected $searchColumns = [];
	protected $search = '';
	protected $columns = [];
	protected $columnsSelect = [];
	protected $allRequest;
	protected $query;

	public function __construct($request) {
		$this->columns    	= $request->input('columns');
        $this->limit 		= $request->input('length');
        $this->start      	= $request->input('start');
        $this->order      	= $this->columns[$request->input('order.0.column')];
        $this->direction    = $request->input('order.0.dir');
        $this->allRequest 	= $request;
    }

    protected function getSearchColumns() {
    	foreach ($this->columns as $column) {
            if (!empty($column['search']['value'])) {
                $this->searchColumns[] = [
                    'column' => $column['data'],
                    'value'  => $column['search']['value'],
                ];
            }
        }

        return $this->searchColumns;
    }

    public function setQuery($query) {
    	$this->query = $query;
    }

    public function setColumnsSelect($columns) {
    	$this->columnsSelect = $columns;
    }

    public function response() {
    	$request = $this->allRequest;
    	$model = $this->query;

    	$totalData = $model->count(); 
        $totalFiltered = $totalData;

    	if ($request->has('search')) {
            if ($request->input('search.value') != '') {
                $searchTerm = $request->input('search.value');
                $model->where(function($query) use ($searchTerm) {
                    foreach ($this->columnsSelect as $column) {
                        $query->orWhere($column, 'like', '%' . $searchTerm . '%');
                    }
                });
            }
        }

        if (count($this->getSearchColumns()) > 0) {
            $model->where(function($query) {
                foreach ($this->getSearchColumns() as $column) {
                    $query->where($this->columnsSelect[$column['column']], 'like', '%' . $column['value'] . '%');
                }
            });
        }

        if ($request->has('order')) {
            if ($request->input('order.0.column') != '') {
                $orderColumn    = $request->input('order.0.column');
                $orderDirection = $request->input('order.0.dir');
                $model->orderBy($this->columns[intval($orderColumn)]['data'], $orderDirection);
            }
        }

        $totalFiltered  = $model->count();
        $model          = $model->offset($this->start)->limit($this->limit);
        $data           = $model->get();
        
        $tableContent = [
            "draw"              => intval($request->input('draw')), 
            "recordsTotal"      => intval($totalData), 
            "recordsFiltered"   => intval($totalFiltered),
            "data"              => $data
        ];

        return $tableContent;
    }

}    