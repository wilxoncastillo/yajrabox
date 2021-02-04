<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Datatables\UsersDataTable;
use App\Datatables\UserDataTableEditor;

class UsersController extends Controller
{
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('crud');
    }

    public function store(UsersDataTableEditor $editor)
    {
        return $editor->process(request());
    }
}
