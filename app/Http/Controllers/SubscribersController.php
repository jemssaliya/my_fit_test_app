<?php

namespace App\Http\Controllers;

use App\Entities\Subscription;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Redirect;
use Storage;
use EMedia\Formation\Builder\Formation;

class SubscribersController extends Controller
{

    protected $indexRoute;

    public function __construct()
    {
        $this->indexRoute = route('manage.subscribers');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Factory|Response|View
     */
    public function index(Request $request)
    {
        $subscribersQuery = Subscription::with(['user'])->latest();

        if ($request->has('q')) {
            $search = $request->query('q');
            $subscribersQuery->where(function ($q) use ($search) {
                $q->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%");
                })->orWhere('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('trial_ends_at', 'LIKE', '%' . $search . '%')
                    ->orWhere('created_at', 'LIKE', '%' . $search . '%');
            });
            // $subscribersQuery->Where('name', 'LIKE', '%' . $search . '%');
        }

        $subscribers = $subscribersQuery->paginate(15);

        return view('subscribers.index', [
            'pageTitle' => 'Manage Subscribers',
            'subscribers' => $subscribers,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
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
    public function edit(Subscription $subscription)
    {
        // return view('subscription.edit',[
        // 'pageTitle' => "Edit Subscription - `{$subscription->name}`",
        // 	'entity' => $subscription,
        // 	'form' => new Formation($subscription),
        // ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Subscription $subscription
     * @return RedirectResponse|Response
     */
    public function update(Request $request, Subscription $subscription)
    {
        $data = $request->all();

        return redirect($this->indexRoute)->with('success', 'Subscription updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Subscription $subscription
     * @return RedirectResponse|Response
     * @throws Exception
     */
    public function destroy(Subscription $subscription)
    {
        $subscription->delete();
        return redirect($this->indexRoute)->with('success', 'Subscription canceled.');
    }

}
