<?php

namespace App\Http\Controllers\Api\V1;

use Exception;
use Hash;
use Storage;
use Illuminate\Http\Request;
use App\Http\Requests\Api\User\ManageUserRequest;
use App\Http\Requests\Api\User\StoreUserRequest;
use App\Http\Requests\Api\User\UpdateUserRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Controllers\Api\V1\Traits\UserAvatar;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserCollection;

class UserController extends Controller
{
    use UserAvatar;

    /**
     * Display a listing of the resource.
     *
     * @return UserCollection
     */
    public function index()
    {
        return new UserCollection(User::all());
    }

    /**
     * @api {post} /users Add new user
     * @apiVersion 1.0.0
     * @apiName CreateUser
     * @apiGroup Users
     *
     * @apiDescription
     * Note that the creating a new user should be done with the `api key`
     * as this would be the API endpoint for registering new users.
     *
     * @apiHeader {String} Authorization API Key in the format: `Bearer {api-key}`
     * @apiHeader {String} Content-Type `application/json`
     * @apiHeader {String} Accept `application/json`
     *
     * @apiParam {String} first_name First name of the user
     * @apiParam {String} last_name Last name of the user
     * @apiParam {String} email Email address of the user
     * @apiParam {String} password Password
     *
     * @apiParamExample {json} Request Example
     * {"first_name":"John","last_name":"Doe","email":"john@xmails.com","password":"123456"}
     *
     * @apiSuccess {String} first_name First name of the user
     * @apiSuccess {String} last_name Last name of the user
     * @apiSuccess {String} email Email address of the user
     *
     * @apiSuccessExample {json} Success Response
     *  HTTP/1.1 200 OK
     *  {
     *      "data": {
     *          "id": 1,
     *          "first_name": "John",
     *          "last_name": "Doe",
     *          "email": "john@xmails.com",
     *          "avatar_url": null,
     *          "confirmed": 1,
     *          "created_at": "2016-11-22 12:09:45",
     *          "updated_at": "2016-11-22 12:09:45",
     *          "status": 1
     *      }
     *  }
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @return UserResource
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        if ($request->has('first_name')) {
            $data['name'] = $request->first_name;
        }

        $user = User::create($data);

        return new UserResource($user);
    }

    /**
     * @api {get} /users/{id} Get user
     * @apiVersion 1.0.0
     * @apiName Get User
     * @apiGroup Users
     *
     * @apiDescription
     * Get the user details.
     *
     * @apiHeader {String} Authorization [Access token](#api-Auth-Get_Access_Token) in the format: `Bearer {access-token}`
     * @apiHeader {String} Accept `application/json`
     *
     * @apiParam {String} id ID of the user
     *
     * @apiSuccessExample {json} Success Response
     *  HTTP/1.1 200 OK
     *  {
     *      "data": {
     *          "id": 1,
     *          "first_name": "John",
     *          "last_name": "Doe",
     *          "email": "john@xmails.com",
     *          "avatar_url": null,
     *          "confirmed": 1,
     *          "created_at": "2016-11-22 12:09:45",
     *          "updated_at": "2016-11-22 12:09:45",
     *          "status": 1
     *      }
     *  }
     */

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return UserResource
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * @api {put} /users Update user
     * @apiVersion 1.0.0
     * @apiName UpdateUser
     * @apiGroup Users
     *
     * @apiDescription
     * Update user details.
     *
     * @apiHeader {String} Authorization API Key in the format: `Bearer {api-key}`
     * @apiHeader {String} Content-Type `application/json`
     * @apiHeader {String} Accept `application/json`, `multipart/form-data`
     *
     * @apiParam {String} [first_name] First name of the user
     * @apiParam {String} [last_name] Last name of the user
     * @apiParam {String} [email] Email address of the user
     * @apiParam {String} [avatar] Image file to be used as user avatar
     * @apiParam {String} [password] Password
     *
     * @apiParamExample {json} Request Example
     * {"first_name":"John","last_name":"Doe","email":"john@xmails.com","password":"123456"}
     *
     * @apiSuccess {String} first_name First name of the user
     * @apiSuccess {String} last_name Last name of the user
     * @apiSuccess {String} email Email address of the user
     * @apiSuccess {String} avatar_url URL of the user avatar
     * @apiSuccess {String} confirmed If user's email address is confirmed
     * @apiSuccess {String} status User status
     *
     * @apiSuccessExample {json} Success Response
     *  HTTP/1.1 200 OK
     *  {
     *      "data": {
     *          "id": 1,
     *          "first_name": "John",
     *          "last_name": "Doe",
     *          "email": "john@xmails.com",
     *          "avatar_url": null,
     *          "confirmed": 1,
     *          "created_at": "2016-11-22 12:09:45",
     *          "updated_at": "2016-11-22 12:09:45",
     *          "status": 1
     *      }
     *  }
     */

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return UserResource
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->all();

        // save the file
        if ($request->hasFile('avatar')) {
            $disk = Storage::disk('public');

            $path = $request->file->store('avatars/' . $user->id, 'public');
            $url = $disk->url($path);
            $data = array_merge($data, ['avatar_path' => $path, 'avatar_url' => $url]);
        }

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->has('first_name')) {
            $data['name'] = $request->first_name;
        }

        $user->update($data);

        return new UserResource($user);
    }

    /**
     * @api {delete} /users/{id} Delete user
     * @apiVersion 1.0.0
     * @apiName DeleteUser
     * @apiGroup Users
     *
     * @apiDescription
     * Delete user.
     *
     * @apiHeader {String} Authorization [Access token](#api-Auth-Get_Access_Token) in the format: `Bearer {access-token}`
     * @apiHeader {String} Accept `application/json`
     *
     * @apiParam {String} id ID of the user
     *
     * @apiSuccessExample {json} Success Response
     *  HTTP/1.1 200 OK
     *  {
     *      "messge": "User successfully deleted.",
     *      "errors": []
     *  }
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return array|void
     * @throws Exception
     */
    public function destroy(User $user)
    {
        if ($user->delete()) {
            return [
                'message' => 'User successfully deleted.',
                'errors' => [],
            ];
        }

        return abort(500, 'Error deleting user.');
    }
}
