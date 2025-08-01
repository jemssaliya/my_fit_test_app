<?php

namespace App\Http\Controllers;

use App\Entities\TestData;
use App\Http\Requests\Test\StoreTestDataRequest;
use App\Http\Requests\Test\UpdateTestDataRequest;
use App\Http\Resources\TestData as TestDataResource;
use App\Http\Resources\TestDataCollection;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TestDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $testDataQuery = TestData::all();

        if ($request->has('search')) {
            $search = $request->query('search');
            $testDataQuery->where('name', 'LIKE', '%' . $search . '%');
        }

        // $tests = $testDataQuery->paginate(10);

        // return new TestDataCollection($tests);
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
