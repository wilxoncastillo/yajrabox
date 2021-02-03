<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Yajra\Datatables\Datatables;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


        return view('home');
    }

    public function getUsers() {
        return Datatables::of(User::query())
            //*******************************
            //Row Id
            //->setRowId('id')

            //->setRowId(function ($user) {
            //    return $user->id;
            //})

            //->setRowId( '{{ $id }}' )

            //*****************************
            //Row Class
            //->setRowClass(function ($user) {
            //    return $user->id % 2 == 0 ? 'alert-success' : 'alert-warning';
            //})

            //->setRowClass('{{ $id % 2 == 0 ? "alert-success" : "alert-warning" }}')

            //*****************************
            //Row Data
            //->setRowData([
            //    'data-id' => function($user) {
            //        return 'row-' . $user->id;
            //    },
            //    'data-name' => function($user) {
            //        return 'row-' . $user->name;
            //    },
            //])

            //->setRowData([
            //    'data-id' => 'row-{{$id}}',
            //    'data-name' => '0001-{{$name}}',
            //])

            //*****************************
            // Row Attributes
            //->setRowAttr([
            //    'color' => function($user) {
            //        return $user->color;
            //    },
            //])

            //->setRowAttr([
            //    'color' => '{{$color}}',
            //    ])

            //->setRowAttr([
            //    'align' => 'center',
            //    ])

            //->make(true);

            //-----------------------------------
            // Column Editing Options
            ->addColumn('intro', 'Hi {{$name}}!')
            ->addColumns(['foo','bar','buzz'=>"red"])
            ->editColumn('name', 'Hi {{$name}}!')

            ->editColumn('created_at', function(User $user) {
                    return $user->created_at->diffForHumans() ;
                })

            ->editColumn('updated_at', 'column')
            ->rawColumns(['updated_at'])
            ->addIndexColumn()
            ->toJson();

    }
}
