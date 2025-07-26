<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

use App\Entities\AvailableData;
use App\Http\Requests\AvailableData\StoreAvailableDataRequest;
use App\Http\Requests\AvailableData\UpdateAvailableDataRequest;
use App\Http\Resources\AvailableData as AvailableDataResource;
use App\Http\Resources\AvailableDataCollection;
use Illuminate\Http\Response;

class AvailableDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AvailableData[]|Collection|Response
     */
    public function index()
    {
        return AvailableData::all();
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
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return AvailableDataResource
     */
    public function show($id)
    {
        $availableData = AvailableData::find($id);
        return new AvailableDataResource($availableData);
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
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
