<?php

namespace App\Http\Controllers;

use App\Entities\TestType;
use App\Entities\TestData;
use App\Entities\InputData;
use App\Entities\Test;
use App\Entities\ProgramType;
use App\Entities\Client;
use App\Http\Requests\Test\StoreTestRequest;
use App\Http\Requests\Test\UpdateTestRequest;
use App\Http\Resources\Test as TestResource;
use App\Http\Resources\TestTypeCollection;
use App\Http\Resources\Client as ClientResource;
use App\Http\Resources\ProgramTypeCollection;
use App\Http\Resources\ProgramCollection;
use Exception;
use Illuminate\Support\Facades\Storage;
use PDF;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Auth;
use Illuminate\View\View;
use Redirect;
use DB;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Carbon\Carbon;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response|string
     */
    public function index(Request $request)
    {
        $testDataQuery = Test::with(['testData'])->get();
        $data = [];
        $data1 = [];
        $data2 = [];
        $data3 = [];
        $table1 = [];
        $table2 = [];
        $test_data = [];
        $x = 0;

        // order by table id
        foreach ($testDataQuery as $testDataQr) {
            // $test_data = $testDataQr->get()->except('test_data');
            $testDataQ = $testDataQr->testData
                ->groupBy(function ($table) {
                    return $table->table_id;
                })->all();

            $xy = 0;
            foreach ($testDataQ as $testDataQRY) {
                if ($xy == 0) {
                    $table1 = $testDataQRY->groupBy(function ($table) {
                        return $table->row_id;
                    })->all();
                }

                if ($xy == 1) {
                    $table2 = $testDataQRY->groupBy(function ($table) {
                        return $table->row_id;
                    })->all();
                }

                $xy++;
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
            // $data3['test'] = $test_data;
            $data3['table1'] = $table1;
            $data3['table2'] = $table2;
            $data[$x] = $data3;
            $x++;
        }

        $page = null;
        $perPage = 15;
        if ($request->has('page')) {
            $page = $request->page;
        }
        if ($request->has('per_page')) {
            $perPage = $request->per_page;
        }

        $data = $data instanceof Collection ? $data : Collection::make($data);

        if ($perPage == null || $perPage == "") {
            $data = $data;
        } else {
            $data = new LengthAwarePaginator($data->forPage($page, $perPage), $data->count(), $perPage, $page);
        }

        return '';
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

        if (isset($client->user) && $client->user->id == $user_id) {
            $testTypeQuery = TestType::with(['table'])->get();
            // $testTypeQuery = TestType::get();

            // $testTypes = new TestTypeResource($testTypeQuery);
            $testTypes = new TestTypeCollection($testTypeQuery);

            $client = new ClientResource($client);

            return view('test.index', compact('testTypes', 'client'));
        }

        return Redirect::back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return TestResource
     */
    public function store(Request $request)
    {
        // save test
        $test = Test::create($request->except(['table1', 'table2', 'inputFields']));

        // save form data in seperate table?

        // save test data as key and value
        if (count($request->table1[0]) > 0) {
            foreach ($request->table1[0] as $key => $value) {
                TestData::create([
                    'test_id' => $test->id,
                    'table_id' => $request->table1_id,
                    // 'row_id' => $request->table1[0]['row_id']['value'],
                    'row_id' => 0,
                    'column_id' => $value['column_id'],
                    'key' => $key,
                    'value' => round($value['value'], 1)
                ]);
            }
        }

        if (count($request->table2) > 0) {
            foreach ($request->table2 as $table) {
                foreach ($table as $key => $value) {
                    TestData::create([
                        'test_id' => $test->id,
                        'table_id' => $request->table2_id,
                        'row_id' => $table['row_id']['value'],
                        'column_id' => '',
                        'key' => $key,
                        'value' => round($value['value'], 1)
                    ]);
                }
            }
        }

        if (count($request->inputFields) > 0) {
            foreach ($request->inputFields as $inputField) {
                InputData::create([
                    'test_id' => $test->id,
                    'labal' => $inputField['labal'],
                    'name' => $inputField['name'],
                    'fieldId' => $inputField['fieldId'],
                    'value' => round($inputField['value'], 1)
                ]);
            }
        }
        // save test data
        // if($request->has('testData')){
        //     $test->testData()->attach($request->testData);
        // }

        return new TestResource($test);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return array
     */
    public function show($id)
    {
        $testDataQuery = Test::with(['testData', 'inputData', 'programs', 'programs.programType'])->where('id', $id)->get();
        $testData = Test::find($id);
        $data = []; // final array
        $data1 = []; // table 1
        $data2 = []; // table 2
        $data3 = [];
        $data4 = []; // input fields data
        $table1 = [];
        $table2 = [];
        $inputFields = [];
        $programs = [];
        $slope = 0;
        $intercept = 0;

        $inputFields = $testDataQuery[0]->inputData;
        $programs = $testDataQuery[0]->programs;
        $slope = $testDataQuery[0]->slope;
        $intercept = $testDataQuery[0]->intercept;
        $age = $testDataQuery[0]->age;

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
                // $data2[$testData->key]['color_code'] = '#color';
            }
            $table2[$i] = $data2;
            $data2 = [];
            $i++;
        }
        $table1[0] = $data1;
        // $data['color_code'] = $table1;
        // $data['is_protected'] = $table1;
        // :style="{ background: col.pivot.color_code}"
        $data['table1'] = $table1;
        $data['table2'] = $table2;
        $data['inputFields'] = $inputFields;
        $data['programs'] = $programs;
        $data['slope'] = $slope;
        $data['intercept'] = $intercept;
        $data['dateTest'] = $testData->created_at->format('Y-m-d');
        $data['ageTest'] = $age;

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

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return Factory|Response|View
     */
    public function viewTest(Request $request)
    {

        $user_id = Auth::user()->id;
        $client = Client::find($request->client_id);

        if ($client->user->id == $user_id) {

            $testDataQuery = Test::with(['testData', 'programs', 'inputData', 'testType'])
                ->where('id', $request->test_id)
                ->get();

            $data = [];
            $data1 = [];
            $data2 = [];
            $data3 = [];
            $table1 = [];
            $table2 = [];
            $testId = $request->test_id;
            $test_type = $testDataQuery[0]->test_type;
            $test_name = $testDataQuery[0]->name;
            $input_data = $testDataQuery[0]->inputData;
            $date = $testDataQuery[0]->created_at;

            $test_type_name = $testDataQuery[0]->testType->name;

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
                $data2[$testData->key]['customStyles'] = $testData->value;

            }

            $i = 0;
            foreach ($table2 as $key => $table) {
                foreach ($table as $testData) {
                    $data2[$testData->key]['value'] = $testData->value;
                    $data2[$testData->key]['customStyles'] = $testData->value;
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
            $programTypeQuery = ProgramType::with(['table'])->get();

            $programTypes = new ProgramTypeCollection($programTypeQuery);
            $client = new ClientResource($client);

            return view('test.view', compact('programTypes',
                'client',
                'data',
                'testId',
                'test_type',
                'test_name',
                'input_data',
                'test_type_name',
                'date'
            ));
        }

        return Redirect::back();
    }

    /**
     * Show summery.
     *
     * @param Request $request
     * @return string
     */
    public function testSummery(Request $request)
    {
        $user_id = Auth::id();
        $client = Client::find($request->client_id);

        if ($client->user->id == $user_id) {
            $testsDataQueryMain = Test::with(['testData', 'inputData'])
                ->where('client_id', $request->client_id);


            if ($request->has('from_date'))
                $testsDataQueryMain->where('created_at', '>=', $request->query('from_date'));

            if ($request->has('to_date'))
                $testsDataQueryMain->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"), '<=', $request->query('to_date'));

            $testsDataQueryMain = $testsDataQueryMain->get();
            $data = [];
            $data1 = [];
            $data2 = [];
            $table1 = [];
            $test_data = [];
            $input_data = [];
            $x = 0;
            $testType = '';

            $testsDataQueryMain = $testsDataQueryMain->groupBy(function ($table) {
                return $table->test_id;
            })->all();

            foreach ($testsDataQueryMain as $testsDataQuery) {
                foreach ($testsDataQuery as $testDataQuery) {
                    $test_data = collect($testDataQuery)->except(['test_data'])->toArray();
                    $testType = TestType::find($test_data['test_type'])->name;

                    $testDataQuery = $testDataQuery->testData->groupBy(function ($table) {
                        return $table->table_id;
                    })->all();

                    $xy = 0;
                    foreach ($testDataQuery as $testDataQ) {
                        if ($xy == 0) {
                            $table1 = $testDataQ->groupBy(function ($table) {
                                return $table->row_id;
                            })->all();
                        }
                        $xy++;
                    }

                    $data1 = [];
                    foreach ($table1[0] as $testData) {
                        if (isset($testData->key)) {
                            $data1[$testData->key]['value'] = $testData->value;
                        }
                    }

                    $table1[0] = $data1;
                    $data2 = $test_data;
                    $data2['test_type_name'] = $testType;
                    $data2['table1'] = $table1;
                    $data[$x] = $data2;
                    $x++;
                }
            }

            $page = null;
            $perPage = 1500;
            if ($request->has('page')) {
                $page = $request->page;
            }
            /* if ($request->has('per_page')) {
                 $perPage = $request->per_page;
             }*/

            $data = $data instanceof Collection ? $data : Collection::make($data);

            if ($perPage == null || $perPage == "") {
                $data = $data;
            } else {
                $data = new LengthAwarePaginator($data->forPage($page, $perPage), $data->count(), $perPage, $page);
            }

            return $data;
        }

        return '';
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function downloadPDF(Request $request)
    {
        $client = $request->get('client');
        $test_details = $request->get('test_details');
        $scatter_chart = $request->get('scatter_chart');
        $line_chart = $request->get('line_chart');
        $table_headers = $request->get('table_headers');
        $table_data = $request->get('table_data');
        $summery_headers = $request->get('summery_headers');
        $summery_data = $request->get('summery_data');
        $legend_data = $request->get('legend_data');
        $hidden_columns = $request->get('hidden_columns');
        $report_type = $request->get('report_type');
        $report_date =$request->get('report_date');
        $user_id = md5(auth()->id());
        $date_test = $request->get('date_test');
        $age_test = $request->get('age_test');

        $pdf = PDF::loadView('test.exports.test-report-pdf', compact('client',
            'test_details',
            'scatter_chart',
            'line_chart',
            'table_headers',
            'table_data',
            'summery_headers',
            'summery_data',
            'legend_data',
            'hidden_columns',
            'report_type',
            'report_date',
            'age_test',
            'date_test'
        ));

        //Todo save unique file and should be deleted temp file
        //Make Directory for unique user
        // Storage::disk('local')
        //     ->makeDirectory("/public/download/{$user_id}/");
        $folder = storage_path("app/public/download/{$user_id}");
        $filename = "{$report_type}_test_report.pdf";
        $fullPath = "{$folder}/{$filename}";

        // ✅ Make sure the directory exists
        if (!is_dir($folder)) {
            mkdir($folder, 0755, true);
        }

        $pdf->setPaper('a4', 'landscape')
            ->save(storage_path("app/public/download/{$user_id}/{$report_type}_test_report.pdf"));

        $pathToFile = asset("storage/download/{$user_id}/{$report_type}_test_report.pdf");

        return response()->json(['url' => $pathToFile]);
    }
}
