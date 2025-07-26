<?php

namespace App\Http\Controllers;

use App\Entities\TableColumn;
use App\Http\Requests\TableColumn\StoreTableColumnRequest;
use App\Http\Requests\TableColumn\UpdateTableColumnRequest;
use App\Http\Resources\TableColumn as TableColumnResource;
use App\Http\Resources\TableColumnCollection;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TableColumnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $tableColumnQuery = TableColumn::all();

        if ($request->has('search')) {
            $search = $request->query('search');
            $tableColumnQuery->where('name', 'LIKE', '%' . $search . '%');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTableColumnRequest $request
     * @return TableColumnResource
     */
    public function store(StoreTableColumnRequest $request)
    {
        $data = $request->all();

        $tableColumn = Table::create($data);

        return new TableColumnResource($tableColumn);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTableColumnRequest $request
     * @param TableColumn $tableColumn
     * @return TableColumnResource
     */
    public function update(UpdateTableColumnRequest $request, TableColumn $tableColumn)
    {
        $data = $request->all();

        $tableColumn->update($data);

        return new TableColumnResource($tableColumn);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TableColumn $tableColumn
     * @return void
     * @throws Exception
     */
    public function destroy(TableColumn $tableColumn)
    {
        $tableColumn->delete();
    }
}
