<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\JsonResponse;
use Redirect;
use PDF;
use Exception;
use App\Entities\TestType;
use App\Entities\Test;
use App\Entities\ProgramType;
use App\Entities\Program;
use App\Entities\OutputData;
use App\Entities\ProgramData;
use App\Entities\Client;
use App\Http\Resources\TestTypeCollection;
use App\Entities\TestProgramTypes;
use App\Http\Resources\Program as ProgramResource;
use App\Http\Resources\ProgramCollection;
use App\Http\Resources\ProgramTypeCollection;
use App\Http\Resources\Client as ClientResource;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\StoreTestRequest;
use Illuminate\Http\UpdateTestRequest;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return ProgramCollection
     */
    public function index(Request $request)
    {
        $programQuery = Program::with(['programData']);

        if ($request->has('search')) {
            $search = $request->query('search');
            $programQuery->where('name', 'LIKE', '%' . $search . '%');
        }

        $program = $programQuery->paginate(10);

        return new ProgramCollection($program);

        $program = new ProgramCollection($program);

        // return view('test.index',compact('program'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Factory|Response|View
     */
    public function create(Request $request)
    {
        $user_id = Auth::user()->id;
        $client = Client::find($request->client_id);
        if ($client->user->id == $user_id) {
            //  ***********************
            $testDataQuery = Test::with(['testData', 'testPrograms'])->where('id', $request->test_id)->get();
            $data = [];
            $data1 = [];
            $data2 = [];
            $data3 = [];
            $table1 = [];
            $table2 = [];
            $testProgramTypesArray = [];
            $testId = $request->test_id;
            $testTypeId = $testDataQuery[0]->test_type;
            // $test_type = $testDataQuery[0]->test_type;

            $testTypeQuery = TestType::all();
            $testTypes = new TestTypeCollection($testTypeQuery);

            $test_type_name = isset($testDataQuery[0]->testType) ? $testDataQuery[0]->testType->name : '';
            $test_name = isset($testDataQuery[0]->name) ? $testDataQuery[0]->name : '';


            $testProgramTypes = TestProgramTypes::with(['programTypes'])->where('test_types_id', $testTypeId)->get();
            // $testProgramTypes = TestProgramTypes::where('test_types_id',$testTypeId)->get();

            $xy = 0;
            foreach ($testProgramTypes as $testProgramType) {
                array_push($testProgramTypesArray, $testProgramTypes[$xy]->programTypes[0]);
                $xy++;
            }

            $testProgramTypesArray = collect($testProgramTypesArray);
            // return new ProgramTypeCollection($testProgramTypesArray);

            $testDataQuery = $testDataQuery[0]->testData
                ->groupBy(function ($table) {
                    return $table->table_id;
                })->all();

            $x = 0;
            foreach ($testDataQuery as $testDataQ) {
                if ($x == 0) {
                    $table1 = $testDataQ->groupBy(function ($table) {
                        return $table->row_id;
                    })->all();
                }
                if ($x == 1) {
                    $table2 = $testDataQ->groupBy(function ($table) {
                        return $table->row_id;
                    })->all();
                }
                $x++;
            }

            foreach ($table1[0] as $testData) {
                $data1[$testData->key]['value'] = $testData->value;
            }
            $i = 0;
            foreach ($table2 as $key => $table) {
                foreach ($table as $testData) {
                    $data2[$testData->key]['value'] = $testData->value;
                }
                $table2[$i] = $data2;
                $data2 = [];
                $i++;
            }
            $table1[0] = $data1;
            $data['table1'] = $table1;
            $data['table2'] = $table2;
            // **************************

            $client = Client::find($request->client_id);
            // $programTypeQuery = ProgramType::with(['table'])->get();

            $programTypes = new ProgramTypeCollection($testProgramTypesArray);
            $client = new ClientResource($client);
            return view('program.index', compact('programTypes',
                'client',
                'data',
                'testId',
                'testTypes',
                'testTypeId',
                'test_name',
                'test_type_name'
            ));
        }

        return Redirect::back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return ProgramResource
     */
    public function store(Request $request)
    {
        // $data = $request->all();
        // return $request;

        // $test = Test::create($data);

        // // save test data
        // if($request->has('testData')){
        //     $test->testData()->attach($request->testData);
        // }

        // return new TestResource($test);

        // save program
        $program = Program::create($request->except(['table1', 'output_fields']));

        // save program data as key and value
        // if(count($request->table1[0]) > 0) {
        //     foreach($request->table1[0] as $key => $value) {
        //         return $request->table1;
        //         ProgramData::create([
        //             'program_id' => $program->id,
        //             'table_id' => $request->table_id,
        //             'row_id' => $request->table1[0]['row_id']['value'],
        //             'column_id' => '',
        //             'key' => $key,
        //             'value' => $value['value'],
        //         ]);
        //     }
        // }

        if (count($request->table1) > 0) {
            foreach ($request->table1 as $table) {
                foreach ($table as $key => $value) {

                    ProgramData::create([
                        'program_id' => $program->id,
                        'table_id' => $request->table_id,
                        'row_id' => $table['row_id']['value'],
                        'column_id' => '',
                        'key' => $key,
                        'value' => $key == 'power' ? number_format($value['value']) : $value['value']
                    ]);
                }
            }
        }

        // save outputs
        if (count($request->output_fields) > 0) {
            foreach ($request->output_fields as $outputField) {
                OutputData::create([
                    'program_id' => $program->id,
                    'label' => $outputField['label'],
                    'name' => $outputField['name'],
                    'fieldId' => $outputField['fieldId'],
                    'value' => $outputField['value']
                ]);
            }
        }

        return new ProgramResource($program);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return array
     */
    public function show($id)
    {
        $programDataQuery = Program::with(['programData', 'outputData'])->where('id', $id)->get();

        $data = []; // final array
        $data1 = []; // table 1
        $data4 = []; // input fields data
        $table1 = [];
        $outputFields = [];

        $testTypeId = $programDataQuery[0]->test_type;
        // $test_type = $testDataQuery[0]->test_type;

        $testTypeQuery = TestType::all();
        $testTypes = new TestTypeCollection($testTypeQuery);

        $outputFields = $programDataQuery[0]->outputData;

        $programDataQuery = $programDataQuery[0]->programData
            ->groupBy(function ($table) {
                return $table->table_id;
            })->all();

        // order by row id
        foreach ($programDataQuery as $programData) {
            $table1 = $programData->groupBy(function ($table) {
                return $table->row_id;
            })->all();
        }

        $i = 0;
        foreach ($table1 as $key => $table) {
            foreach ($table as $programData) {
                $data1[$programData->key]['value'] = $programData->value;
            }
            $table1[$i] = $data1;
            $data1 = [];
            $i++;
        }

        $data['table1'] = $table1;
        $data['outputFields'] = $outputFields;

        return $data;
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
     * @param int $id
     * @return Response
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

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return Factory|View
     */
    public function viewProgram(Request $request)
    {
        $programDataQuery = Program::with(['programData', 'outputData', 'testType', 'test'])
            ->where('id', $request->program_id)
            ->get();

        $data = []; // final array
        $data1 = []; // table 1
        $data4 = []; // input fields data
        $table1 = [];
        $outputFields = [];
        $program_id = $request->program_id;
        $program_type = $programDataQuery[0]->program_type;
        $test_id = $programDataQuery[0]->test_id;
        // return $programDataQuery[0];

        $outputFields = $programDataQuery[0]->outputData;
        $test_type_name = isset($programDataQuery[0]->testType) ? $programDataQuery[0]->testType->name : '';
        $test_name = isset($programDataQuery[0]->test) ? $programDataQuery[0]->test->name : '';

        $programDataQuery = $programDataQuery[0]->programData
            ->groupBy(function ($table) {
                return $table->table_id;
            })->all();

        // order by row id
        foreach ($programDataQuery as $programData) {
            $table1 = $programData->groupBy(function ($table) {
                return $table->row_id;
            })->all();
        }

        $i = 0;
        foreach ($table1 as $key => $table) {
            foreach ($table as $programData) {
                $data1[$programData->key]['value'] = $programData->value;
            }
            $table1[$i] = $data1;
            $data1 = [];
            $i++;
        }

        $data['table1'] = $table1;
        $data['outputFields'] = $outputFields;
        // **************************

        $client = Client::find($request->client_id);
        $programTypeQuery = ProgramType::with(['table'])->get();

        $program_types = new ProgramTypeCollection($programTypeQuery);
        $client = new ClientResource($client);

        return view('program.view', compact('program_types',
            'client',
            'data',
            'program_id',
            'program_type',
            'test_id',
            'test_type_name',
            'test_name'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function download(Request $request)
    {
        $client = $request->get('client');
        $test_details = $request->get('test_details');
        $scatter_chart = $request->get('scatter_chart');
        $line_chart = $request->get('line_chart');
        $table_headers = $request->get('table_headers');
        $table_data = $request->get('table_data');
        $summery_data = $request->get('summery_data');
        $legend_data = $request->get('legend_data');
        $hidden_columns = $request->get('hidden_columns');
        $summery_panel = $request->get('summery_panel');
        $report_type = $request->get('report_type');
        $only_fields = $request->get('only_fields');
        $user_id = md5(auth()->id());

        $pdf = PDF::loadView('program.exports.pdf-report', compact('client',
            'test_details',
            'scatter_chart',
            'line_chart',
            'table_headers',
            'table_data',
            'summery_data',
            'legend_data',
            'hidden_columns',
            'summery_panel',
            'report_type',
            'only_fields'
        ));

        //Make Directory for unique user
        Storage::disk('local')
            ->makeDirectory("/public/download/{$user_id}/");

        //Todo save unique file and should be deleted temp file
        $pdf->setPaper('a4', 'landscape')
            ->save(storage_path("app/public/download/{$user_id}/{$report_type}_program_report.pdf"));

        $pathToFile = asset("storage/download/{$user_id}/{$report_type}_program_report.pdf");

        return response()->json(['url' => $pathToFile]);
    }
}
