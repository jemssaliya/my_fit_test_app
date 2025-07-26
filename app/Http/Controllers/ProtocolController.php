<?php

namespace App\Http\Controllers;


use DB;
use Auth;
use Redirect;
use App\Entities\Test;
use App\Entities\Protocol;
use Illuminate\Http\Request;
use App\Http\Requests\Test\StoreTestRequest;
use App\Http\Requests\Test\UpdateTestRequest;


class ProtocolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\StoreTestRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return array
     */
    public function show($id)
    {
        $testDataQuery = Protocol::with(['values'])->where('id', $id)->get();

        $data = [];
        $data1 = [];
        $data2 = [];
        $data3 = [];
        $table1 = [];
        $table2 = [];

        $testDataQuery = $testDataQuery[0]->values->groupBy(function ($table) {
            return $table->protocol_id;
        })->all();

        // $testDataQuery = $testDataQuery->groupBy(function ($table) {
        //     return $table->row_id;
        // })->all();

        $x = 0;
        foreach ($testDataQuery as $testDataQ) {
            $table1 = $testDataQ->groupBy(function ($table) {
                return $table->row_id;
            })->all();
            $x++;
        }

        $i = 0;
        foreach ($table1 as $key => $table) {
            $n = 0;
            foreach ($table as $protocolData) {
                // $data2[$protocolData->column_name]['value'] = $protocolData->value;
                $data2[$n]['column_name'] = $protocolData->column_name;
                $data2[$n]['value'] = $protocolData->value;
                $table1[$i] = $data2;
                $n++;
            }
            $table1[$i] = $data2;
            $data2 = [];
            $i++;
        }
        // $table1[0] = $data1;
        $data['table1'] = $table1;
        // $data['table2'] = $table2;

        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\UpdateTestRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTestRequest $request, Test $test)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Test $test)
    {
    }

}
