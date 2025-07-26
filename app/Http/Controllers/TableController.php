<?php

namespace App\Http\Controllers;

use App\Entities\Table;
use App\Entities\TestType;
use App\Http\Requests\Table\StoreTableRequest;
use App\Http\Requests\Table\UpdateTableRequest;
use App\Http\Resources\Table as TableResource;
use App\Http\Resources\TableCollection;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        $tableQuery = Table::with(['collumns']);

        if ($request->has('search')) {
            $search = $request->query('search');
            $tableQuery->where('name', 'LIKE', '%' . $search . '%');
        }

        $tables = $tableQuery->paginate(10);

        // return new TableCollection($tables);
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
     * @param StoreTableRequest $request
     * @return TableResource
     */
    public function store(StoreTableRequest $request)
    {

        $table = Table::create($request->all());

        return new TableResource($table);
    }

    /**
     * Display the specified resource.
     *
     * @param Table $table
     * @return TableResource
     */
    public function show(Table $table)
    {
        return new TableResource($table);
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
     * @param UpdateTableRequest $request
     * @param Table $table
     * @return TableResource
     */
    public function update(UpdateTableRequest $request, Table $table)
    {
        $table->update($request->all());

        return new TableResource($table);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Table $table
     * @return void
     * @throws Exception
     */
    public function destroy(Table $table)
    {
        $table->delete();
    }
}
