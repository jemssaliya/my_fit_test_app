<?php

namespace App\Http\Controllers;

use App\Entities\TestType;
use App\Entities\Test;
use App\Http\Requests\Api\Test\StoreTestTypeRequest;
use App\Http\Requests\Api\Test\UpdateTestTypeRequest;
use App\Http\Resources\TestType as TestTypeResource;
use App\Http\Resources\TestTypeCollection;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TestTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return TestTypeCollection
     */
    public function index(Request $request)
    {
        $testTypeQuery = TestType::with(['tables']);

        if ($request->has('search')) {
            $search = $request->query('search');
            $testTypeQuery->where('name', 'LIKE', '%' . $search . '%');
        }

        $testTypes = $testTypeQuery->paginate(10);

        return new TestTypeCollection($testTypes);
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
     * @param StoreTestTypeRequest $request
     * @return TestTypeResource|Response
     */
    public function store(StoreTestTypeRequest $request)
    {
        $data = $request->all();

        $testType = TestType::create($data);

        return new TestTypeResource($testType);
    }

    /**
     * Display the specified resource.
     *
     * @param TestType $testType
     * @return TestTypeResource|Response
     */
    public function show(TestType $testType)
    {
        return new TestTypeResource($testType);
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
     * @param UpdateTestTypeRequest $request
     * @param TestType $testType
     * @return TestResource
     */
    public function update(UpdateTestTypeRequest $request, TestType $testType)
    {
        $data = $request->all();

        $testType->update($data);

        return new TestResource($testType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TestType $testType
     * @return void
     * @throws Exception
     */
    public function destroy(TestType $testType)
    {
        $testType->delete();
    }
}
