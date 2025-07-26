<?php

namespace App\Http\Controllers\Api\V1;

use Auth;
use Hash;
use App\Http\Requests\Api\Auth\ResetPasswordRequest;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class PasswordController
 * @package App\Controllers\Api\V1
 */
class PasswordController extends Controller
{
    use SendsPasswordResetEmails;

    /**
     * Get the response for a successful password reset link.
     *
     * @param string $response
     * @return RedirectResponse|JsonResponse
     */
    protected function sendResetLinkResponse($response)
    {
        return response()->json([
            'message' => trans($response),
            'errors' => [],
        ]);
    }

    /**
     * Get the response for a failed password reset link.
     *
     * @param Request $request
     * @param string $response
     * @return RedirectResponse|JsonResponse
     */
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return response()->json([
            'message' => trans($response),
            'errors' => [
                'email' => trans($response),
            ],
        ], 404);
    }

    /**
     * @api {post} /password/email Reset password email
     * @apiVersion 1.0.0
     * @apiName ResetPasswordEmail
     * @apiGroup Auth
     *
     * @apiDescription
     * Send reset password email.
     *
     * @apiHeader {String} Authorization API Key in the format: `Bearer {api-key}`
     * @apiHeader {String} Content-Type `application/json`
     * @apiHeader {String} Accept `application/json`
     *
     * @apiParam {String} email Email address of the user
     *
     * @apiParamExample {json} Request Example
     * {"email":"user@exmpl.com"}
     *
     * @apiSuccessExample {json} Response Example
     *  HTTP/1.1 200 OK
     *  {
     *      "message": "We have e-mailed your password reset link!",
     *      "errors": []
     *  }
     *
     * @apiError 422 Unprocessable Entity
     *
     * @apiErrorExample {json} Invalid email address
     *  HTTP/1.1 422 Unprocessable Entity
     *  {
     *      "message": "The email must be a valid email address.",
     *      "errors": {
     *          "email": [
     *              "The email must be a valid email address."
     *          ]
     *      }
     *  }
     *
     * @apiError 404 Not Found
     *
     * @apiErrorExample {json} User not found
     *  HTTP/1.1 404 Not Found
     *  {
     *      "message": "We can't find a user with that e-mail address.",
     *      "errors": {
     *          "email": [
     *              "We can't find a user with that e-mail address."
     *          ]
     *      }
     *  }
     *
     */

    /**
     * @api {put} /password Reset password
     * @apiVersion 1.0.0
     * @apiName ResetPassword
     * @apiGroup Auth
     *
     * @apiDescription
     * Reset the password of the user.
     *
     * @apiHeader {String} Authorization [Access token](#api-Auth-Get_Access_Token) in the format: `Bearer {access-token}`
     * @apiHeader {String} Content-Type `application/json`
     * @apiHeader {String} Accept `application/json`
     *
     * @apiParam {String} current_password Current password of the user
     * @apiParam {String} password New password
     *
     * @apiParamExample {json} Request Example
     * {"current_password":"123456","password":"654321"}
     *
     * @apiSuccessExample {json} Response Example
     *  HTTP/1.1 200 OK
     *  {
     *      "message": "Password reset successfully.",
     *      "errors": []
     *  }
     *
     * @apiError 422 Unprocessable Entity
     *
     * @apiErrorExample {json} Invalid current password
     *  HTTP/1.1 422 Unprocessable Entity
     *  {
     *      "message": "The current password is invalid.",
     *      "errors": {
     *          "current_password": [
     *              "The current password is invalid."
     *          ]
     *      }
     *  }
     *
     */
    public function reset(ResetPasswordRequest $request)
    {
        if (auth('api')->user()->update(['password' => Hash::make($request->password)])) {
            return [
                'message' => 'Password reset successfully.',
                'errors' => [],
            ];
        }
    }
}
