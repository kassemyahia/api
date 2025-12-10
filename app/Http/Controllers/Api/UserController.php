<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index() {}

    public function show(User $user)
    {
        return $user;
    }
}
