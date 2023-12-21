<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\User;


class AdminUserController extends Controller
{
    //get semua user
    public function index()
    {
        $users = User::all();
        return response()->json([
            'message' => 'Success',
            'users' => $users
        ]);
    }

    //find user by id
    public function show($id)
    {
        $user = User::find($id);

        if (is_null($user)) {
            return response([
                'message' => 'User Not Found',
                'data' => null
            ], 404);
        }

        return response([
            'message' => 'Retrieve User Success',
            'user' => $user
        ], 200);
    }

    //delete user
    public function destroy($id)
    {
        $user = User::find($id);

        if (is_null($user)) {
            return response([
                'message' => 'User Not Found',
                'data' => null
            ], 404);
        }

        if ($user->delete()) {
            return response([
                'message' => 'Delete User Success',
                'user' => $user,
            ], 200);
        } else {
            return response([
                'message' => 'Delete User Failed',
                'data' => null,
            ], 400);
        }
    }

    //upadte profile pic
    public function editPic(Request $request, $id)
    {
        $user = User::find($id);

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

    public function edituser1(Request $request, $id)
    {

        $user = User::find($id);

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

    public function edituser2(Request $request, $id)
    {
        $user = User::find($id);

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
}
