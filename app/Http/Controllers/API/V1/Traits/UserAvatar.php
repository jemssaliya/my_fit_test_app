<?php

namespace App\Http\Controllers\Api\V1\Traits;

use Illuminate\Http\Response;
use Storage;
use App\Models\User;
use App\Helpers\ImageResponse;
use App\Http\Requests\Api\User\StoreAvatarRequest;

/**
 * Class UserAvatar
 * @package App\Http\Controllers\Api\V1\Traits
 */
trait UserAvatar
{
    /**
     * @api {get} /users/{id}/avatar Get user avatar
     * @apiVersion 1.0.0
     * @apiName Get User Avatar
     * @apiGroup Users
     *
     * @apiDescription
     * Get profile picture of a user. This will return raw image data
     * data in response body and `Content-Type` header is set to relevant mime
     * type of the file.
     *
     * @apiHeader {String} Authorization `Bearer {access-token}`
     * @apiHeader {String} Accept `image/jpeg, image/png, image/gif`
     *
     * @apiSuccessExample {json} Success Response
     *  HTTP/1.1 200 OK
     *  -- PICTURE DATA --
     */

    /**
     * Returns the profile picture data.
     *
     * @param User $user
     * @return Response
     */
    public function getAvatar(User $user)
    {
        if (empty($user->avatar_path)) {
            abort(404);
        }

        return ImageResponse::output($user->avatar_path);
    }

    /**
     * @api {post} /users/{id}/avatar Update avatar
     * @apiVersion 1.0.0
     * @apiName Upload Avatar
     * @apiGroup Users
     *
     * @apiDescription
     * Upload a profile picture. This request should use `multipart/form-data`
     * to upload the file.
     *
     * @apiHeader {String} Authorization `Bearer {access-token}`
     * @apiHeader {String} Content-Type `multipart/form-data`
     * @apiHeader {String} Accept `application/json`
     *
     * @apiParam {File} file Image file
     *
     * @apiSuccessExample {json} Success Response
     *  HTTP/1.1 200 OK
     *  {
     *      "message": "Profile picture saved."
     *  }
     */

    public function updateAvatar(StoreAvatarRequest $request, User $user)
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
