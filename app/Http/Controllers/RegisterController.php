<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use App\Mail\MailSend;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    private $idregistered;

    public function actionRegister1(Request $request)
    {

        $registrationData = $request->all();
        $validate = Validator::make($registrationData, [
            'nama_user' => 'required|string',
            'username' => 'required|string',
            'password' => 'required|string',
            'email_user' => 'required|email:rfc,dns|unique:user',
            'no_telp_user' => 'required|string',
        ]);

        if ($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $registrationData['password'] = bcrypt($request->password);

        $user = User::create([
            'nama_user' => $registrationData['nama_user'],
            'username' => $registrationData['username'],
            'password' => $registrationData['password'],
            'email_user' => $registrationData['email_user'],
            'no_telp_user' => $registrationData['no_telp_user'],
        ]);

        $this->idregistered = $user->id_user;

        return response([
            'message' => 'Register User part 1 Success.',
            'data' => $user,
            'idregistered' => $this->idregistered,
        ], 200);
    }

    //UPDATE
    public function actionRegister2(Request $request, $idregistered)
    {
        $user = User::find($idregistered);

        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        $validatedData = $request->validate([
            'alamat' => 'required|string',
            'kecamatan' => 'required|string',
            'kota_kabupaten' => 'required|string',
            'provinsi' => 'required|string',
            'kode_pos' => 'required|string|min:5',
            'negara' => 'required|string',
            'profile_pic' => 'nullable|file|image|mimes:jpeg,png,jpg',
        ]);

        if ($request->hasFile('profile_pic')) {
            $image = $request->file('profile_pic');
            $uploadFolder = 'img';
            $image_uploaded_path = $image->store($uploadFolder, 'public');
            $uploadedImage =  basename($image_uploaded_path);
            $user->profile_pic = $uploadedImage;
        }

        //update
        $str = Str::random(100);

        $user->alamat = $validatedData['alamat'];
        $user->kecamatan = $validatedData['kecamatan'];
        $user->kota_kabupaten = $validatedData['kota_kabupaten'];
        $user->provinsi = $validatedData['provinsi'];
        $user->kode_pos = $validatedData['kode_pos'];
        $user->negara = $validatedData['negara'];
        $user->verify_key = $str;

        $user->save();

        //untuk verifikasi email
        $email = $user->email_user;
        $username = $user->username;

        $details = [
            'username' => $username,
            'website' => 'Millenial Aucion',
            'datetime' => date('Y-m-d H:i:s'),
            'url' => request()->getHttpHost() . '/api/register/verify/' . $str
        ];

        Mail::to($email)->send(new MailSend($details));

        Session::flash('message', 'Link verifikasi telah dikirim ke email anda. Silahkan cek email anda untuk mengaktifkan akun.');

        return response([
            'message' => 'Register User Success.',
            'data' => $user,
        ], 200);
    }

    public function verify($verify_key)
    {
        $keyCheck = User::where('verify_key', $verify_key)->exists();

        if ($keyCheck) {
            User::where('verify_key', $verify_key)->update([
                'email_verified_at' => now(),
            ]);

            return response()->json(['message' => 'Verifikasi berhasil. Akun anda sudah aktif.'], 200);
        } else {
            return response()->json(['message' => 'Keys tidak valid.'], 404);
        }
    }
}
