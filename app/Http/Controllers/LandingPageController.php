<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Entities\Client;
use App\Entities\Settings;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

use App\Http\Controllers\Api\V1\Traits\ClientTests;
use Illuminate\View\View;


class LandingPageController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Factory|Response|View
     */
    public function index(Request $request)
    {
        $url_1 = '';
        $url_2 = '';
        $settings = Settings::latest()->get();

        foreach ($settings as $setting) {
            if ($setting->setting_key == 'homepage_video_1')
                $url_1 = $setting->setting_value;

            if ($setting->setting_key == 'homepage_video_2')
                $url_2 = $setting->setting_value;

        }

        return view('welcome', compact('url_1', 'url_2'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|Response|View
     */
    public function create()
    {
        return view('forms.formClient');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\App\Entities\Client $client
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

}
