<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\UserDataTable;

class UserController extends Controller
{
    public function index(UserDataTable $dataTable)
    {
    	return $dataTable->render('index');
    }

    public function update(Request $request) {
    	return $request;
    }
}
