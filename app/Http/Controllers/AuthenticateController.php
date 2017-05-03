<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use \App\User;

class AuthenticateController extends Controller
{
  public function index(Request $request)
  {
    // grab credentials from the request
    $credentials = $request->only('email', 'password');

    try {
        // attempt to verify the credentials and create a token for the user
        if (! $token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'invalid_credentials'], 401);
        }
    } catch (JWTException $e) {
        // something went wrong whilst attempting to encode the token
        return response()->json(['error' => 'could_not_create_token'], 500);
    }

    // all good so return the token
    return response()->json(compact('token'));
  }

  public function create(Request $request)
  {
    if ($request->email!='' && $request->password!='') {
      if ($this->valid($request)) {
        User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        return response('Пользователь создан',201);
      }
      return response('Email уже используется',200);
    }
    return response('Нехватает данных',400);
  }

  public function valid(Request $request)
  {
    if (User::where('email',$request->email)->count()>0)
      return 0;
    return 1;
  }
}
