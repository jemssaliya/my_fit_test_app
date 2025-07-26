<?php

namespace App\Http\Controllers;

use App\Entities\ProgramType;
use App\Entities\Program;
use App\Http\Requests\Api\Program\StoreProgramTypeRequest;
use App\Http\Requests\Api\Program\UpdateProgramTypeRequest;
use App\Http\Resources\ProgramType as ProgramTypeResource;
use App\Http\Resources\ProgramTypeCollection;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\UpdateTestTypeRequest;

class ProgramTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return ProgramTypeCollection|Response
     */
    public function index(Request $request)
    {
        $programTypeQuery = ProgramType::with(['tables']);

        if ($request->has('search')) {
            $search = $request->query('search');
            $programTypeQuery->where('name', 'LIKE', '%' . $search . '%');
        }

        $programTypes = $programTypeQuery->paginate(10);

        return new ProgramTypeCollection($programTypes);
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
     * @return ProgramTypeResource
     */
    public function store(StoreTestTypeRequest $request)
    {
        $data = $request->all();

        $testType = ProgramType::create($data);

        return new ProgramTypeResource($testType);
    }

    /**
     * Display the specified resource.
     *
     * @param ProgramType $programType
     * @return ProgramTypeResource
     */
    public function show(ProgramType $programType)
    {
        return new ProgramTypeResource($programType);
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
     * @return TestResource|Response
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
     */
    public function destroy(TestType $testType)
    {
        $testType->delete();
    }
}
