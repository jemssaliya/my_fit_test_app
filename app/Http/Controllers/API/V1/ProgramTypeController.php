<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Entities\Test;
use App\Entities\ProgramType;
use App\Http\Requests\Test\StoreTestRequest;
use App\Http\Requests\Test\UpdateTestRequest;
use App\Http\Resources\Test as TestResource;
use App\Http\Resources\TestCollection;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProgramTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $programTypeQuery = ProgramType::all();

        return $programTypeQuery->tables();

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
     * @param StoreTestRequest $request
     * @return TestResource|Response
     */
    public function store(StoreTestRequest $request)
    {
        $data = $request->all();

        $test = Test::create($data);

        // save test data
        if ($request->has('testData')) {
            $test->testData()->attach($request->testData);
        }

        return new TestResource($test);
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
     * @param UpdateTestRequest $request
     * @param Test $test
     * @return TestResource|Response
     */
    public function update(UpdateTestRequest $request, Test $test)
    {
        $data = $request->all();

        $test->update($data);

        return new TestResource($test);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Test $test
     * @return void
     * @throws Exception
     */
    public function destroy(Test $test)
    {
        $test->delete();
    }
}
