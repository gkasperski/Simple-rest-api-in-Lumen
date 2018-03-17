<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function __construct() { }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function register(Request $request) 
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
        
        $password = Hash::make($request->input('password'));

        try {
            $user = Users::create(['email'=>$request->input('email'), 'password'=>$password]);
            return response()->json($user);
        } catch (\Exception $e) {
            return response()->json(['status' => 'fail'], 401);
        }

    }

    public function authenticate(Request $request)
    {
      $this->validate($request, [
          'email' => 'required',
          'password' => 'required',
      ]);

      $user = Users::where('email', $request->input('email'))->first();

      if (Hash::check($request->input('password'), $user->password)) {
          $apikey = base64_encode(str_random(40));
          Users::where('email', $request->input('email'))->update(['api_key' => "$apikey"]);

          return response()->json(['status' => 'success', 'api_key' => $apikey]);
      } else {
          return response()->json(['status' => 'fail'], 401);
      }

    }

}
