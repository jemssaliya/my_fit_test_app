<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;

use App\Entities\Test;
use App\Entities\TestType;
use App\Http\Requests\Test\StoreTestRequest;
use App\Http\Requests\Test\UpdateTestRequest;
use App\Http\Resources\Test as TestResource;
use App\Http\Resources\TestCollection;


use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TestTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        dd("Called");
        $testQuery = TestType::all();

        return $testQuery->tables();

        // if ($request->has('search')) {
        //     $search = $request->query('search');
        //     $testQuery->where('name', 'LIKE', '%' . $search . '%');
        // }

        // $tests = $testQuery->paginate(10);

        // return new TestCollection($tests);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
         dd("Calle11d");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTestRequest $request
     * @return TestResource|Response
     */
    public function store($request)
    {
        dd("cfdsef");
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
          dd("cfdsef233");
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
        dd("cfdsef233");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTestRequest $request
     * @param Test $test
     * @return TestResource
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
