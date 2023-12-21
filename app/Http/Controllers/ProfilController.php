<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\User;


class ProfilController extends Controller
{
    //get data user login
    public function showProfile()
    {
        /** @var \App\Models\User $user **/
        $user = Auth::user();

        return response()->json(['user' => $user]);
    }

    //upadte profile pic
    public function updateProfilePic(Request $request)
    {
        /** @var \App\Models\User $user **/
        $user = Auth::user();

        if (is_null($user)) {
            return response([
                'message' => 'User Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'profile_pic' => 'nullable|file|image|mimes:jpeg,png,jpg',
        ]);

        if ($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $image = $request->file('profile_pic');
        $uploadFolder = 'img';
        $image_uploaded_path = $image->store($uploadFolder, 'public');
        $uploadedImage =  basename($image_uploaded_path);
        $user->profile_pic = $uploadedImage;

        if ($user->save()) {
            return response([
                'message' => 'Update Profile Pic Success.',
                'data' => $user,
            ], 200);
        } else {
            return response([
                'message' => 'Update Profile Pic Failed',
                'data' => null,
            ], 400);
        }
    }

    public function updateProfile1(Request $request)
    {

        /** @var \App\Models\User $user **/
        $user = Auth::user();

        if (is_null($user)) {
            return response([
                'message' => 'User Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'nama_user' => 'required|string',
            'username' => 'required|string',
            'email_user' => 'required|email:rfc,dns',
            'no_telp_user' => 'required|string',
        ]);


        if ($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $user->nama_user = $updateData['nama_user'];
        $user->username = $updateData['username'];
        $user->email_user = $updateData['email_user'];
        $user->no_telp_user = $updateData['no_telp_user'];

        if ($user->save()) {
            return response([
                'message' => 'Update 1 User Success.',
                'data' => $user,
            ], 200);
        } else {
            return response([
                'message' => 'Update 1 User Failed',
                'data' => null,
            ], 400);
        }
    }

    public function updateProfile2(Request $request)
    {
        /** @var \App\Models\User $user **/
        $user = Auth::user();

        if (is_null($user)) {
            return response([
                'message' => 'User Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'alamat' => 'required|string',
            'kecamatan' => 'required|string',
            'kota_kabupaten' => 'required|string',
            'provinsi' => 'required|string',
            'kode_pos' => 'required|string|min:5',
            'negara' => 'required|string',
        ]);

        if ($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $user->alamat = $updateData['alamat'];
        $user->kecamatan = $updateData['kecamatan'];
        $user->kota_kabupaten = $updateData['kota_kabupaten'];
        $user->provinsi = $updateData['provinsi'];
        $user->kode_pos = $updateData['kode_pos'];
        $user->negara = $updateData['negara'];

        if ($user->save()) {
            return response([
                'message' => 'Update 2 User Success.',
                'data' => $user,
            ], 200);
        } else {
            return response([
                'message' => 'Update 2 User Failed',
                'data' => null,
            ], 400);
        }
    }

    public function forgotPassword(Request $request)
    {
        $forgotData = $request->all();

        $validate = Validator::make($forgotData, [
            'email_user' => 'required|email:rfc,dns',
            'password_new' => 'required|string',
            'password_confirm' => 'required|string',
        ]);

        if ($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $user = User::where('email_user', $forgotData['email_user'])->first();

        if (!$user) {
            return response()->json(['message' => 'Email not found.'], 404);
        }

        //password confirm dan new harus sama
        if ($forgotData['password_new'] != $forgotData['password_confirm']) {
            return response()->json(['message' => 'Password Confirm do not match.'], 404);
        }

        $user->update([
            'password' => bcrypt($forgotData['password_new']),
        ]);

        if ($user->save()) {
            return response([
                'message' => 'Change password success',
                'data' => $user,
            ], 200);
        } else {
            return response([
                'message' => 'Change password failed',
                'data' => null,
            ], 400);
        };
    }
}
