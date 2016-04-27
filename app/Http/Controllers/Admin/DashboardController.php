<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ApiController;
use App\PermissionApiKey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use JWTAuth;


class DashboardController extends ApiController
{

    public $pageTitle = '控制面板';


    public function index()
    {
        return view('admin.dashboard');
    }
}