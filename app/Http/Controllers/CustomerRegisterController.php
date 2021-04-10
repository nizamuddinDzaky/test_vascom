<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use App\Models\Customer;
use App\Models\Cart;
use Nexmo;

class CustomerRegisterController extends Controller
{
    

    public function register(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'phone' => 'required|numeric',
        ]);

        $cust_email = Customer::where('email', $request->email)->first();
        // print_r($request->photo);die;
        $data = $request->photo;

        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);
        $uniq_id = uniqid();
        $path_image = '/tmp/'.$uniq_id.'.png';
        // echo public_path();die;
        file_put_contents(public_path($path_image), $data);
        if ($cust_email !== NULL) {
            return redirect()->back()->with(['error' => 'Akun sudah terdaftar, silakan Login']);
        }

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phone_number' => $request->phone,
            'image2wbmp(image)' => $path_image,
            'activate_token' => Str::random(4)
        ]);

        $credentials = $request->only('email', 'password');
        return redirect()->back()->with(['success' => 'Berhasil.']);
    }

}
