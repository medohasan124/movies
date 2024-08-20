<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{


    public function __construct()
    {
        $this->middleware('permission:users-read')->only('index');
         $this->middleware('permission:users-create')->only('create');
         $this->middleware('permission:users-update')->only('update');
         $this->middleware('permission:users-delete')->only('delete');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


       // dd($Users[0]->UserRoles()->pluck('name')) ;
        return view("admin.Users.index");
    }

    public function data()
    {
        $Users = User::all() ;

        return DataTables::of($Users)
            ->addColumn('checkbox', 'admin.Users.dataTable.checkbox')
            ->addColumn('action', 'admin.Users.dataTable.action')
            ->addColumn('roles', function($Users){
                $roles = $Users->UserRoles()->pluck('name');
                return view('admin.Users.dataTable.roles',compact('roles'));
            })
            ->editColumn('created_at', function ($Users) {
                return $Users->created_at->format('d-m-y');
            })
            ->editColumn('updated_at', function ($Users) {
                return $Users->created_at->format('d-m-y');
            })
            ->rawColumns(['action', 'checkbox','roles'])
            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Role = Role::all();

        return view("admin.Users.create", compact("Role"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            "name" => "required|max:25|min:5",
            "email" => "required|unique:users",
            "password" => "required|confirmed|max:50|min:8",
            "role" => "required|integer|min:1",
            "image" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",

        ]);



        $User = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password),
            "image" => $request->image->store('users', 'public')
        ]);

        $role = Role::find($request->role);
        $User->addRole($role->name);
        notify()->success(__('admin.c_user'));
        return redirect()->route('admin.User.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);


        $Role = Role::all();

        return view("admin.Users.edit", compact("Role", "user"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "name" => "required|max:25|min:5",
            "email" => "required|unique:users,email," . $id,
            "password" => "nullable|confirmed|max:50|min:8",
            "role" => "required|integer|min:1",
            "image" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",

        ]);

        $user= User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        if ($request->image) {
            Storage::disk('public')->delete($user->image);
            $user->image = $request->image->store('users', 'public');
        }
        $user->save();


         $role = Role::find($request->role);
         $user->syncRoles([$role->id]);
        notify()->success(__('admin.u_user'));
        return redirect()->route('admin.User.index');



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        Storage::disk('public')->delete($user->image);
        $user->delete();
        notify()->success(__('admin.d_user'));
        return redirect()->route('admin.User.index');
    }

    public function bulckDelete(Request  $request)
    {

        $data = $request['buclkDelete'][0];
        $numbers = explode(',', $data);
        $role = User::whereIn('id', $numbers)->get();
        foreach ($role as $key => $value) {
            Storage::disk('public')->delete($value->image);
            $value->delete();
        }
        notify()->success(__('admin.d_user'));
        return redirect()->route('admin.User.index');
    }
}
