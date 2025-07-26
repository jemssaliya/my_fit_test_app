<?php

namespace App\Http\Controllers;

use App\Notifications\Subscription\ExpiredNotification;
use App\Notifications\Subscription\ExpiryNotification;
use App\Notifications\Subscription\RenewedNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Redirect;
use Exception;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Validation\ValidationException;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Entities\Test;
use App\Entities\Client;
use App\Http\Resources\TestCollection;
use App\Http\Resources\ClientCollection;
use App\Http\Requests\Client\StoreClientRequest;
use App\Http\Requests\Client\UpdateClientRequest;
use App\Http\Controllers\Api\V1\Traits\ClientTests;

class ClientController extends Controller
{

    use ClientTests;

    /**
     * @api {get} /clients Get clients
     * @apiVersion 1.0.0
     * @apiName GetClients
     * @apiGroup Clients
     *
     * @apiDescription
     * Get the list of clients. Pagination is supported using `page` and
     * `per_page` query parameters. Searching is supported using `query`
     * parameter.
     *
     * @apiHeader {String} Authorization [Access token](#success-examples-Auth-GetAccessToken-1_0_0-0) in the format: `Bearer {access-token}`
     * @apiHeader {String} Content-Type `application/json`
     * @apiHeader {String} Accept `application/json`
     *
     * @apiParam {Integer} [page] Number of the page
     * @apiParam {Integer} [per_page] Number of clients per page
     * @apiParam {String} [search] Keywords to search the clients by `name`
     *
     * @apiParamExample {url} Request Example
     * http://localhost:8000/api/v1/clients?page=1&per_page=20
     *
     * @apiSuccess {Client} client Details of the client
     *
     * @apiSuccess {String} first URL of the first page
     * @apiSuccess {String} last URL of the last page
     * @apiSuccess {String} prev URL of the previous page
     * @apiSuccess {String} next URL of the next page
     *
     * @apiSuccess {String} current_page Number of current page
     * @apiSuccess {String} from Starting offset of the list
     * @apiSuccess {String} last_page Number of last page
     * @apiSuccess {String} path Base URL to get the list
     * @apiSuccess {Integer} per_page Nunber of items per page
     * @apiSuccess {String} to Ending offset of the list
     * @apiSuccess {String} total Total number of the items in list
     *
     * @apiSuccessExample {json} Success Response
     *  HTTP/1.1 200 OK
     *  {
     *      "data": [
     *          {... client ...},
     *          {... client ...}
     *      ],
     *      "links": {
     *          "first": "http://localhost:8000/api/v1/clients?page=1",
     *          "last": "http://localhost:8000/api/v1/clients?page=1",
     *          "prev": null,
     *          "next": null
     *      },
     *      "meta": {
     *          "current_page": 1,
     *          "from": 1,
     *          "last_page": 1,
     *          "path": "http://localhost:8000/api/v1/clients",
     *          "per_page": 15,
     *          "to": 1,
     *          "total": 1
     *      }
     *  }
     */

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $user_id = Auth::id();
        $page = $request->get('page');
        $perPage = $request->get('per_page', 20);

        $clientQuery = Client::where('user_id', $user_id);

        if ($request->filled('search')) {
            $search = $request->query('search');
            $clientQuery->where('name', 'LIKE', '%' . $search . '%');
        }

        $clientQuery = $clientQuery->get();

        $clientQuery = ($clientQuery instanceof Collection) ? $clientQuery : Collection::make($clientQuery);

        if ($perPage !== null || $perPage !== "") {
            $clientQuery = new LengthAwarePaginator(
                $clientQuery->forPage($page, $perPage),
                $clientQuery->count(),
                $perPage,
                $page
            );
        }

        $clients = new ClientCollection($clientQuery);

        return view('client.index', compact('clients'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getClientList(Request $request)
    {
        $user_id = Auth::user()->id;
        $perPage = $request->get('per_page', 20);

        $clientQuery = Client::where('user_id', $user_id);

        if ($request->filled('q')) {
            $search = $request->query('q');
            $clientQuery->where('name', 'LIKE', '%' . $search . '%');
        }

        $clientQuery = $clientQuery->paginate($perPage);

        return response()->json((new ClientCollection($clientQuery))->resource);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $client = new Client();
        $method = 'post';
        $labal = 'Add Client';
        $title = 'Add New Client';
        $redirect_url = \Request::getPathInfo();

        return view('client.create', compact(
            'client', 'method', 'labal', 'title', 'redirect_url'
        ));
    }

    /**
     * @api {post} /clients Add new client
     * @apiVersion 1.0.0
     * @apiName CreateClient
     * @apiGroup Clients
     *
     * @apiDescription
     * Add new client.
     *
     * @apiHeader {String} Authorization [Access token](#success-examples-Auth-GetAccessToken-1_0_0-0) in the format: `Bearer {access-token}`
     * @apiHeader {String} Content-Type `application/json`
     * @apiHeader {String} Accept `application/json`
     *
     * @apiParam {String} [name] Name of the client
     * @apiParam {String} [dob] Date of birth
     * @apiParam {String} [gender] Gender of the client
     *
     * @apiParamExample {json} Request Example
     * {
     *    "name": "John Doe",
     *    "dob": "1990",
     *    "gender": "male",
     *  }
     *
     * @apiSuccess {Integer} id ID of the client
     * @apiSuccess {String} name Name of the client
     * @apiSuccess {String} dob date of birth of the client
     * @apiSuccess {String} gender Phone number of the client
     *
     * @apiParamExample {json} Request Example
     * {
     *    "id": 1524,
     *    "name": "John Doe",
     *    "dob": "1990",
     *    "gender": "male",
     *  }
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
            'dob' => 'required|date_format:d/m/Y',
            'gender' => 'required'
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        $client = Client::create($data);

        // return new ClientResource($client);
        $user_id = Auth::user()->id;
        $clientQuery = Client::where('user_id', $user_id)->get();

        $testQuery = Test::paginate(20);

        $clients = new ClientCollection($clientQuery);
        $tests = new TestCollection($testQuery);

        return redirect()->route('clients.index');
    }

    /**
     * @api {get} /clients/{id} Get client
     * @apiVersion 1.0.0
     * @apiName GetClient
     * @apiGroup Clients
     *
     * @apiDescription
     * Get details of a client.
     *
     * @apiHeader {String} Authorization [Access token](#success-examples-Auth-GetAccessToken-1_0_0-0) in the format: `Bearer {access-token}`
     * @apiHeader {String} Content-Type `application/json`
     * @apiHeader {String} Accept `application/json`
     *
     * @apiParam {Integer} id ID of the client
     *
     * @apiSuccess {Integer} id ID of the client
     * @apiSuccess {String} name Name of the client
     * @apiSuccess {String} dob date of birth of the client
     * @apiSuccess {String} gender Phone number of the client
     *
     * @apiParamExample {json} Request Example
     * {
     *    "id": 1524,
     *    "name": "John Doe",
     *    "dob": "1990",
     *    "gender": "male",
     *  }
     */

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Response
     */
    public function show($id)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $user_id = Auth::id();
        $client = Client::find($id);
        $method = 'put';
        $label = 'Update Client';
        $title = 'Update Client';
        $redirect_url = \Request::getPathInfo();

        if ($client->user_id == $user_id)
            return view('client.edit', compact(
                'client',
                'method',
                'label',
                'title',
                'redirect_url'
            ));

        return Redirect::back();
    }

    /**
     * @api {put} /clients/{id} Update client
     * @apiVersion 1.0.0
     * @apiName UpdateCustomer
     * @apiGroup Customers
     *
     * @apiDescription
     * Update details of a customer.
     *
     * @apiHeader {String} Authorization [Access token](#success-examples-Auth-GetAccessToken-1_0_0-0) in the format: `Bearer {access-token}`
     * @apiHeader {String} Content-Type `application/json`
     * @apiHeader {String} Accept `application/json`
     *
     * @apiParam {String} [name] Name of the client
     * @apiParam {String} [dob] Date of birth
     * @apiParam {String} [gender] Gender of the client
     *
     * @apiParamExample {json} Request Example
     * {
     *    "name": "John Doe",
     *    "dob": "1990",
     *    "gender": "male",
     *  }
     *
     * @apiSuccess {Integer} id ID of the client
     * @apiSuccess {String} name Name of the client
     * @apiSuccess {String} dob date of birth of the client
     * @apiSuccess {String} gender Phone number of the client
     *
     * @apiParamExample {json} Request Example
     * {
     *    "id": 1524,
     *    "name": "John Doe",
     *    "dob": "1990",
     *    "gender": "male",
     *  }
     */

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Client $client
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, Client $client)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
            'dob' => 'required|date_format:d/m/Y',
            'gender' => 'required'
        ]);

        $client->update($request->all());
        return redirect()->route('clients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Client $client
     * @return RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy(Client $client)
    {
        // check if any records exists with client before delete
        // if ($client->tests()->count() < 1) {
            $client->delete();
        // }
        return redirect('/all-clients');
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function viewAll(Request $request)
    {
        $clientQuery = Client::where('user_id', Auth::id())->get();

        if ($request->has('search')) {
            $search = $request->query('search');
            $clientQuery->where('name', 'LIKE', '%' . $search . '%');
        }

        $page = $request->get('page');
        $perPage = $request->get('per_page', 20);
        $clientQuery = $clientQuery instanceof Collection ? $clientQuery : Collection::make($clientQuery);

        $clientQuery = ($perPage == null) || ($perPage == "")
            ? $clientQuery
            : new LengthAwarePaginator(
                $clientQuery->forPage($page, $perPage),
                $clientQuery->count(),
                $perPage,
                $page
            );


        $clientQuery->setPath('/all-clients');

        $clients = new ClientCollection($clientQuery);

        return view('client.all', compact('clients'));
    }
}
