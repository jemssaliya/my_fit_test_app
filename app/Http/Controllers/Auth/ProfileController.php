<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use EMedia\Oxygen\Http\Controllers\Auth\UpdatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Psy\Util\Str;


class ProfileController extends Controller
{

    use UpdatesUsers;

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateProfile(Request $request)
    {
        $validator = $this->updateValidator($request->all());

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        /** @var User $user */
        $user = Auth::user();
        $user->fill($request->all());
        // $user->fill($request->only($user->getProfileUpdatableFields()));
        $result = $user->save();

        //Upload the User Own Logo
        if ($request->file('logo')) {
            $this->handleUploadLogo($request);
        }

        if ($result) return redirect()->back()->with('success', 'Your profile has been updated.');

        return redirect()->back()->withErrors();
    }

    /**
     * Handling Image upload and Destroy old file
     *
     * @param Request $request
     */
    private function handleUploadLogo(Request $request)
    {
        $logo = $request->file('logo');
        $logo->store('public/logos');
        $storage = Storage::disk('public');
        $old_logo = $request->user()->logo_path;

        if (!empty($old_logo) && $storage->exists($old_logo))
            $storage->delete($old_logo);

        $request->user()->update(['logo_path' => "logos/{$logo->hashName()}"]);
    }

    protected function updateValidator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'logo' => 'dimensions:max_width=200,max_height=100'
        ]);
    }

    /**
     * Handle Delete the Logo image
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteLogo(Request $request)
    {
        $storage = Storage::disk('public');
        $old_logo = $request->user()->logo_path;

        if ($storage->exists($old_logo)) {
            $storage->delete($old_logo);
            $request->user()->update(['logo_path' => null]);

            return response()->json(['status' => true, 'message' => 'User logo has been successfully removed.']);
        }

        return response()->json(['status' => false, 'message' => 'User logo could not find.']);
    }
}
