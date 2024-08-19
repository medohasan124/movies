<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class permissionController extends Controller
{
    public function __construct()
    {
        // $this->middleware('permission:users_read')->only('index');
        // $this->middleware('permission:users_create')->only('create');
        // $this->middleware('permission:users_update')->only('update');
        // $this->middleware('permission:users_delete')->only('delete');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view("admin.permission.index");
    }

    public function data()
    {
        $permission = Permission::all();

        return DataTables::of($permission)

            ->editColumn('created_at', function ($permission) {
                return $permission->created_at->format('d-m-y');
            })
            ->editColumn('updated_at', function ($permission) {
                return $permission->created_at->format('d-m-y');
            })
           
            ->toJson();
    }


}
