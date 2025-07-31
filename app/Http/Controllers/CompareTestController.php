<?php

namespace App\Http\Controllers;

use App\Entities\TestType;
use App\Entities\CompareData;
use App\Entities\Compare;
use App\Entities\Client;
use App\Http\Requests\Compare\StoreCompareRequest;
use App\Http\Requests\Compare\UpdateCompareRequest;
use App\Http\Resources\Compare as CompareResource;
use App\Http\Resources\CompareCollection;
use App\Http\Resources\CompareType as CompareTypeResource;
use App\Http\Resources\CompareTypeCollection;
use App\Http\Resources\Client as ClientResource;
use App\Http\Resources\ProgramTypeCollection;

use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Response;
use Illuminate\Http\StoreTestRequest;
use Illuminate\Http\UpdateTestRequest;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Redirect;
use PDF;
use Storage;
use Carbon\Carbon;


class CompareTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|Response|View
     */
    public function index(Request $request)
    {
        $testDataQuery = Compare::with(['compareData', 'client'])
            ->where('id', $request->compare_id)
            ->get();

        return view('test.compare', compact('testDataQuery'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Factory|Response|View
     */
    public function create(Request $request)
    {
        return view('test.compare');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return CompareResource
     */

    public function random_color_part($index_number)
    {
        $color_array = ['#c42300','#334FFF','#1BA923','#EC9922','#1A1918','#FF33FF','#A19D9A','#861CB4','#F88605','#00FFFF'];

        if ($index_number < 10) {
            return $color_array[$index_number];
        } else{
            $chars = 'ABCDEF0123456789';
            $color = '#';
            for ($i = 0; $i < 6; $i++) {
                $color .= $chars[rand(0, strlen($chars) - 1)];
            }
            return $color;
        }
    }

    public function store(Request $request)
    {

        $compare = Compare::create(['client_id' => $request->client_id]);

        // save comapare data as x and y
        if (count($request->cycleTest) > 0) {
            foreach ($request->cycleTest as $key=>$cycle) {
                CompareData::create([
                    'compare_id' => (int)$compare->id,
                    'test_type' => (int)$cycle['test_type'],
                    'x' => Carbon::parse($cycle['created_at']),
                    // 'x' => $cycle['created_at'] Carbon::parse(,
                    'y' => (float)$cycle['table1'][0]['vo2peakEst']['value'],
                    'color_code'=>$this->random_color_part($key)
                ]);
            }
        }

        if (count($request->walkTest) > 0) {
            foreach ($request->walkTest as $key=>$walk) {
                CompareData::create([
                    'compare_id' => (int)$compare->id,
                    'test_type' => (int)$walk['test_type'],
                    // 'x' => $walk['created_at'],
                    'x' => Carbon::parse($walk['created_at']),
                    'y' => (float)$walk['table1'][0]['vo2peakEst']['value'],
                    'color_code'=>$this->random_color_part($key)
                ]);
            }
        }

        if (count($request->runTest) > 0) {
            foreach ($request->runTest as $key=>$run) {
                CompareData::create([
                    'compare_id' => (int)$compare->id,
                    'test_type' => (int)$run['test_type'],
                    'x' => Carbon::parse($run['created_at']),
                    // 'x' => $run['created_at'],
                    'y' => (float)$run['table1'][0]['vo2peakEst']['value'],
                    'color_code'=>$this->random_color_part($key)
                ]);
            }
        }

        if (count($request->stepTest) > 0) {
            foreach ($request->stepTest as $key=>$step) {
                CompareData::create([
                    'compare_id' => (int)$compare->id,
                    'test_type' => (int)$step['test_type'],
                    // 'x' => $step['created_at'],
                    'x' => Carbon::parse($step['created_at']),
                    'y' => (float)$step['table1'][0]['vo2peakEst']['value'],
                    'color_code'=>$this->random_color_part($key)
                ]);
            }
        }
        return new CompareResource($compare);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return Factory|Response|View
     */
    public function show(Request $request)
    {
        $testDataQuery = Compare::with(['compareData'=>function($q){
            $q->orderBy('x', 'asc');
        }, 'client'])
            ->where('id', $request->compare_id)
            ->get();

        if (count($testDataQuery) < 1)
            return Redirect::back();


        return view('test.compare', compact('testDataQuery'));
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
     * @param Compare $compare
     * @return void
     * @throws Exception
     */
    public function destroy(Compare $compare)
    {
        $compare->compareData()->delete();
        $compare->delete();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return Factory|Response|View
     */
    public function viewTest(Request $request)
    {
        $testDataQuery = Test::with(['testData', 'programs'])->where('id', $request->test_id)->get();
        $data = [];
        $data1 = [];
        $data2 = [];
        $data3 = [];
        $table1 = [];
        $table2 = [];
        $testId = $request->test_id;
        $test_type = $testDataQuery[0]->test_type;

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

        $client = Client::find($request->user_id);
        $programTypeQuery = ProgramType::with(['table'])->get();

        $programTypes = new ProgramTypeCollection($programTypeQuery);
        $client = new ClientResource($client);

        return view('test.view', compact('programTypes', 'client', 'data', 'testId', 'test_type'));
    }

    /**
     * Show summery.
     *
     * @param Request $request
     * @return array|LengthAwarePaginator|Collection
     */
    public function testSummery(Request $request)
    {
        $testDataQuery = Test::with(['testData', 'inputData'])->get();
        $data = [];
        $data1 = [];
        $data2 = [];
        $data3 = [];
        $table1 = [];
        $table2 = [];
        $test_data = [];
        $input_data = [];
        $x = 0;
        $testType = '';

        // return $testDataQuery[22]->inputData;

        // order by table id
        foreach ($testDataQuery as $testDataQr) {
            $testDataQ = $testDataQr->testData->groupBy(function ($table) {
                return $table->table_id;
            })->all();

            $test_data = collect($testDataQr)->except(['test_data'])->toArray();
            $input_data = collect($testDataQr->inputData)->toArray();

            $xy = 0;
            foreach ($testDataQ as $testDataQRY) {
                if ($xy == 0) {
                    $table1 = $testDataQRY->groupBy(function ($table) {
                        return $table->row_id;
                    })->all();
                }
                $xy++;
            }

            foreach ($table1[0] as $testData) {
                $data1[$testData->key]['value'] = $testData->value;
            }

            $testType = TestType::find($test_data['test_type'])->name;

            $table1[0] = $data1;
            $data3 = $test_data;
            $data3['test_type_name'] = $testType;
            $data3['input_data'] = $input_data;
            $data3['table1'] = $table1;
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

        return $data;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function downloadPDF(Request $request)
    {

        $client = $request->get('client');
        $cycle_test = $request->get('cycle_test');
        $walk_test = $request->get('walk_test');
        $run_test = $request->get('run_test');
        $step_test = $request->get('step_test');
        $user_id = md5(auth()->id());

        $cycle_table = $request->cycle_table;
        $walk_table = $request->walk_table;
        $run_table = $request->run_table;
        $step_table = $request->step_table;

        $pdf = PDF::loadView('test.exports.compare-report-pdf', compact('client',
            'cycle_test',
            'walk_test',
            'run_test',
            'step_test',
            'cycle_table',
            'walk_table',
            'run_table',
            'step_table'
        ));


        //Todo save unique file and should be deleted temp file
        //Make Directory for unique user
        // Storage::disk('local')
        //     ->makeDirectory("/public/download/{$user_id}/");

        $folder = storage_path("app/public/download/{$user_id}");
        $filename = "compare_test_report.pdf";
        $fullPath = "{$folder}/{$filename}";

        // ✅ Make sure the directory exists
        if (!is_dir($folder)) {
            mkdir($folder, 0755, true);
        }

        $pdf->setPaper('a4', 'landscape')
            ->save(storage_path("app/public/download/{$user_id}/compare_test_report.pdf"));

        $pathToFile = asset("storage/download/{$user_id}/compare_test_report.pdf");

        return response()->json(['url' => $pathToFile]);
    }
}
