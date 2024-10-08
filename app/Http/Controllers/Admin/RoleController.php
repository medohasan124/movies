<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{

    public function __construct(){
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

        return view("admin.roles.index");
    }

    public function data()
    {
        $roles = Role::all() ;

        return DataTables::of($roles)
        ->addColumn('checkbox', 'admin.roles.dataTable.checkbox')
        ->addColumn('action', 'admin.roles.dataTable.action')
        ->editColumn('created_at',function($roles){
                        return $roles->created_at->format('d-m-y');
        })
        ->editColumn('updated_at',function($roles){
                        return $roles->created_at->format('d-m-y');
        })
         ->rawColumns(['action','checkbox'])
      ->toJson() ;

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $Permission = Permission::all();

        /*
        [[User => [user-create, user-read, user-update, user-delete] ]
        */
        $permissionArray = [] ;
        $permissonName = '';
        foreach($Permission as $per){
            if($permissonName != $per->display_name){
                $permissionArray[$per->display_name] = []  ;
                $permissonName = $per->display_name ;
            }
            $permissionArray[$per->display_name][] = $per->name ;
        }
        return view("admin.roles.create" ,compact("permissionArray"));


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|unique:roles,name",
            "permission" => "required|array",
        ]);




              $role = Role::create([
                  "name" => $request->name,
                 "display_name" => $request->name,
              ]);


        $permissons =$request->permission ;

             foreach($permissons as $k => $row){
                 $findPermission = Permission::where('name', $row)->first();
                 $role->givePermission($findPermission);
             }

            $curd = ['create','read','update','delete'];
            foreach($curd as  $row){
                $permisson = $request->name. "-" . $row  ;
                 $per =  Permission::create([
                    'name'=>$permisson ,
                    'display_name' => $request->name
                ]);
                 $role->givePermission($per);
            }

        notify()->success(__('admin.c_role'));
        return redirect()->route('admin.roles.index');


    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ModelsRole = Role::find($id);


        return view("admin.roles.edit",compact('ModelsRole'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "name" => "required|unique:roles,name,".$id,
            "role" => "required|array",
        ]);

        $name = $request->name;
        $role =  Role::find($id);
        $role->name = $request->name;
        $role->save();


        $role->permissions()->delete();
        $permissons = $request->role;
        foreach ($permissons as $row) {
            $permisson = $name . "-" .$row ;

            $per =  Permission::create(['name' => $permisson]);
            $role->givePermission($per);
        }
        notify()->success(__('admin.edit_success'));
        return redirect()->route('admin.roles.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role =  Role::find($id);
        $role->permissions()->delete();
        $role->delete() ;
        notify()->success(__('admin.delete_success'));
         return redirect()->route('admin.roles.index');
    }
    public function bulckDelete(Request  $request)
    {

        $data = $request['buclkDelete'][0] ;
        $numbers = explode(',', $data);
        $role = Role::whereIn('id',$numbers)->get();
        foreach($role as $row){
            $row->permissions()->delete();
            $row->delete() ;
        }
        notify()->success(__('admin.delete_success'));
        return redirect()->route('admin.roles.index');
    }
}
