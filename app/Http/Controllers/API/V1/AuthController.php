<?php

namespace App\Http\Controllers\Api\V1;

use Auth;
use App\Models\User;
use App\Http\Resources\User as UserResource;
use App\Http\Requests\Api\Auth\ConfirmPasswordRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use EMedia\DeviceAuthentication\Entities\Device;
use EMedia\DeviceAuthentication\Http\Controllers\AuthController as BaseAuthController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

/**
 * Class AuthController
 * @package App\Controllers\Api\V1
 */
class AuthController extends BaseAuthController
{
    /**
     * @api {post} /auth/register Register user
     * @apiVersion 1.0.0
     * @apiName RegisterUser
     * @apiGroup Auth
     *
     * @apiDescription
     * Registers a new user. Note that the registering a new user should be done
     * with the `api key`.
     *
     * @apiHeader {String} Authorization API Key in the format: `Bearer {api-key}`
     * @apiHeader {String} Content-Type `application/json`
     * @apiHeader {String} Accept `application/json`
     *
     * @apiParam {String} first_name First name of the user
     * @apiParam {String} last_name Last name of the user
     * @apiParam {String} email Email address of the user
     * @apiParam {String} password Password
     * @apiParam {Boolean} [authenticate] Whether to authenticate the user after creating the account. If this is set to `1` an access token will be issued for the newly created user.
     * @apiParam {String} [device_id] ID of the device
     * @apiParam {String} [device_type] Type of the device, `APPLE`, `ANDROID`
     * @apiParam {String} [device_push_token] Push token of the device
     *
     * @apiParamExample {json} Request Example
     * {
     *      "first_name":"John",
     *      "last_name":"Doe",
     *      "email":"saroonko@xmails.com",
     *      "password":"123456",
     *      "authenticate":1,
     *      "device_id":"9A245375-FBE5-49BF-AA91-54126B121218"
     *      "device_type":"APPLE"
     *      "device_push_token":"cQot_r03NQw:APA91bG31XRdSo58fUwMKohSoKr-qPv5pQYd-540p9oAqFKb_PfhMPUqUTmTTr4hgeQad3c7Ejvnn3bpUZWuzaO_-_ZCho79q3oBMNJHRABmay07rn1fh6CrrhAFoMabFJ9yyMWorDtS"
     * }
     *
     * @apiSuccess {String} first_name First name of the user
     * @apiSuccess {String} last_name Last name of the user
     * @apiSuccess {String} email Email address of the user
     *
     * @apiSuccessExample {json} Success Response When Authenticating
     *  HTTP/1.1 200 OK
     *  {
     *      "access_token": "eyJ0eXAiOiJKV1QiLC . . . bDc25OSDm3CzWphUZBYby9gske3xk"
     *      "token_type": "bearer",
     *      "expires_in": 1296000,
     *      "data": { ... user object ... }
     *  }
     *
     * @apiSuccessExample {json} Success Response When Not Authenticating
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
    public function register(RegisterRequest $request)
    {
        $data = $request->all();
        return $data;
        $data['password'] = Hash::make($request->password);
        if ($request->has('first_name')) {
            $data['name'] = $request->first_name;
        }

        $user = User::create($data);

        if ($request->input('authenticate', false)) {
            $output = $this->login($request);
            $output['data'] = new UserResource($user);
            return $output;
        }

        return new UserResource($user);
    }

    // ========================================================================
    // Docs for auth endpoints available in parent class
    // ========================================================================

    /**
     * @api {post} /auth/login User login
     * @apiVersion 1.0.0
     * @apiName GetAccessToken
     * @apiGroup Auth
     *
     * @apiDescription
     * An access token is used to authorize the requests coming from the users.
     * This API endpoint accepts the username (email) and password of the user
     * and returns an access token for valid user credentials.
     *
     * @apiHeader {String} Content-Type `application/json`
     * @apiHeader {String} Accept `application/json`
     *
     * @apiParam {String} email Username (email) of the user
     * @apiParam {String} password Password of the user
     * @apiParam {String} [device_id] ID of the device
     * @apiParam {String} [device_type] Type of the device, `APPLE`, `ANDROID`
     * @apiParam {String} [device_push_token] Push token of the device
     *
     * @apiParamExample {json} Request Example
     * {
     *      "email":"user@exmpl.com",
     *      "password":"1234",
     *      "device_id":"9A245375-FBE5-49BF-AA91-54126B121218",
     *      "device_type":"APPLE",
     *      "device_push_token":"cQot_r03NQw:APA91bG31XRdSo58fUwMKohSoKr-qPv5pQYd-540p9oAqFKb_PfhMPUqUTmTTr4hgeQad3c7Ejvnn3bpUZWuzaO_-_ZCho79q3oBMNJHRABmay07rn1fh6CrrhAFoMabFJ9yyMWorDtS"
     * }
     *
     * @apiSuccess {String} access_token Access token to be used for future requests.
     * @apiSuccess {String} token_type Type of the token.
     * @apiSuccess {Number} expires_in Lifetime of the token in seconds.
     * @apiSuccess {Object} user User object associated with the provided token.
     *
     * @apiSuccessExample {json} Response Example
     *  HTTP/1.1 200 OK
     *  {
     *      "access_token": "eyJ0eXAiOiJKV1QiLC . . . bDc25OSDm3CzWphUZBYby9gske3xk"
     *      "token_type": "bearer",
     *      "expires_in": 1296000,
     *      "data": { ... user object ... }
     *  }
     *
     * @apiError 401 Unauthorized
     *
     * @apiErrorExample {json} Invalid User Credentials
     *  HTTP/1.1 401 Unauthorized
     *  {
     *      "error": "Unauthorized"
     *  }
     *
     */

    /**
     * @api {get} /auth/refresh Refresh token
     * @apiVersion 1.0.0
     * @apiName RefreshAccessToken
     * @apiGroup Auth
     *
     * @apiDescription
     * Access tokens expire after some time to increase the level of security
     * provided by them. Once a token is expired a new token can be requested
     * using this API.
     *
     * @apiHeader {String} Authorization [Access token](#api-Auth-Get_Access_Token) in the format: `Bearer {access-token}`
     * @apiHeader {String} Accept `application/json`
     *
     * @apiSuccess {String} access_token Access token to be used for future requests.
     * @apiSuccess {String} token_type Type of the token.
     * @apiSuccess {Number} expires_in Lifetime of the token in seconds.
     * @apiSuccess {Object} data User object associated with the provided token.
     *
     * @apiSuccessExample {json} Response Example
     *  HTTP/1.1 200 OK
     *  {
     *      "access_token": "eyJ0eXAiOiJKV1QiLC . . . bDc25OSDm3CzWphUZBYby9gske3xk"
     *      "token_type": "bearer",
     *      "expires_in": 1296000,
     *      "user": { ... user object ... }
     *  }
     *
     * @apiError 401 Unauthorized
     *
     * @apiErrorExample {json} Invalid Access Token
     *  HTTP/1.1 401 Unauthorized
     *  {
     *      "error": "Unauthorized"
     *  }
     *
     */

    /**
     * @api {get} /auth/logout User logout
     * @apiVersion 1.0.0
     * @apiName RevokeAccessToken
     * @apiGroup Auth
     *
     * @apiDescription
     * Access tokens can be revoked using this API. Once revoked, that
     * particular access token is not valid for authorizing any request.
     *
     * @apiHeader {String} Authorization [Access token](#api-Auth-Get_Access_Token) in the format: `Bearer {access-token}`
     * @apiHeader {String} Accept `application/json`
     *
     * @apiSuccessExample {json} Response Example
     *  HTTP/1.1 200 OK
     *  {
     *      "message": "Successfully logged out"
     *  }
     *
     * @apiError 401 Unauthorized
     *
     * @apiErrorExample {json} Invalid Access Token
     *  HTTP/1.1 401 Unauthorized
     *  {
     *      "message": "Unauthenticated"
     *  }
     *
     */

    /**
     * @api {get} /auth/me User details
     * @apiVersion 1.0.0
     * @apiName CurrentUserDetails
     * @apiGroup Auth
     *
     * @apiDescription
     * Returns the details of the current user.
     * User is identified using the access token.
     *
     * @apiHeader {String} Authorization [Access token](#api-Auth-Get_Access_Token) in the format: `Bearer {access-token}`
     * @apiHeader {String} Accept `application/json`
     *
     * @apiSuccessExample {json} Response Example
     *  HTTP/1.1 200 OK
     *  {
     *      "id": 1,
     *      "first_name": "John",
     *      "last_name": "Doe",
     *      "full_name": "John Doe"
     *      "email": "john@exmpl.com",
     *      "confirmed": 1,
     *      "avatar_url": "http://exmpl.com/path/to/avatar/john.png",
     *      "created_at": "2018-04-19 17:51:31",
     *      "updated_at": "2018-04-19 17:51:31",
     *      "status": 1,
     *  }
     *
     * @apiError 401 Unauthorized
     *
     * @apiErrorExample {json} Invalid Access Token
     *  HTTP/1.1 401 Unauthorized
     *  {
     *      "message": "Unauthenticated"
     *  }
     *
     */

    /**
     * Get the authenticated User.
     *
     * @return UserResource|JsonResponse
     */
    public function me()
    {
        return new UserResource(auth('api')->user());
    }
}
