<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FakeHadith;
use Illuminate\Http\Request;
use function Laravel\Prompts\select;

class FakeHadithController extends Controller
{
    public function index(){
        return FakeHadith::query()
            ->select('id','FakeHadithText','Ruling')
            ->get();
    }
}
