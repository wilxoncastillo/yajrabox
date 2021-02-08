<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\UserDataTable;
use App\User;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(UserDataTable $dataTable)
    {
    	return $dataTable->render('index');
    }

    public function update(Request $request) {
    	$user = User::find($request->get('id'));

    	$request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
        ]);


    	$user->name = $request->get('name');
    	$user->email = $request->get('email');
    	$user->update();

    	return redirect()->route('user.index')->with('status', 'Registro actualizado');
    }
}
