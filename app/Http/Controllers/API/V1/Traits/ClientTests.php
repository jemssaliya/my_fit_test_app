<?php

namespace App\Http\Controllers\Api\V1\Traits;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Storage;
use App\Entities\Client;
use App\Entities\Test;
use App\Entities\ProgramType;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

use App\Http\Resources\Test as TestResource;
use App\Http\Resources\TestCollection;
use App\Http\Resources\TestType as TestTypeResource;
use App\Http\Resources\TestTypeCollection;
use App\Http\Resources\Client as ClientResource;
use App\Http\Resources\ProgramTypeCollection;

/**
 * Class UserAvatar
 * @package App\Http\Controllers\Api\V1\Traits
 */
trait ClientTests
{
    /**
     * Returns the client's tests data.
     *
     * @param Request $request
     * @param Client $client
     * @return array|LengthAwarePaginator|Collection
     */
    public function getTests(Request $request, Client $client)
    {
        $testDataQuery = Test::with(['testData'])
            ->where('client_id', $client->id)->get();

        $data = [];
        $data1 = [];
        $data2 = [];
        $data3 = [];
        $table1 = [];
        $table2 = [];
        $x = 0;

        // order by table id
        foreach ($testDataQuery as $testDataQr) {
            $testDataQ = $testDataQr->testData->groupBy(function ($table) {
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

        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Client $client
     * @param Test $test
     * @return Factory|Response|View
     */
    public function viewTest(Request $request, Client $client, Test $test)
    {

        $testDataQuery = Test::with(['testData', 'programs'])->where('id', $test->id)->get();
        $data = [];
        $data1 = [];
        $data2 = [];
        $data3 = [];
        $table1 = [];
        $table2 = [];
        $testId = $test->id;
        $test_type = $testDataQuery[0]->test_type;

        $testDataQuery = $testDataQuery[0]->testData->groupBy(function ($table) {
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

        $programTypeQuery = ProgramType::with(['table'])->get();

        $programTypes = new ProgramTypeCollection($programTypeQuery);
        $client = new ClientResource($client);

        return view('test.view', compact('programTypes', 'client', 'data', 'testId', 'test_type'));
    }

    /**
     * Delete the tests data.
     *
     * @param StoreAvatarRequest $request
     * @param User $user
     * @return array
     */
    public function deleteTests(StoreAvatarRequest $request, User $user)
    {
        $data = $request->all();

        // save the file
        if ($request->hasFile('file')) {
            $disk = Storage::disk('public');

            $path = $request->file->store('avatars/' . $user->id, 'public');
            $url = $disk->url($path);
            $user->update(['avatar_path' => $path, 'avatar_url' => $url]);
        }

        return [
            'message' => 'Avatar updated.'
        ];
    }
}
