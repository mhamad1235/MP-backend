<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function test(){
        $user=Auth::user();
        return $this->jsonResponse(true, $message="data", Response::HTTP_OK, $user);
    }
}
