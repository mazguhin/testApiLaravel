<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use \App\User;

class PointsController extends Controller
{
    public function index()
    {
      return JWTAuth::parseToken()->authenticate()->points;
    }

    public function update(Request $request)
    {
      $user = JWTAuth::parseToken()->authenticate();
      $user->points=$request->points;
      $user->save();
      
      return response('Данные обновлены',200);
    }
}
