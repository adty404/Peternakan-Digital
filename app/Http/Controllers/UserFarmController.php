<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFarmRequest;
use App\Models\Farm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class UserFarmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        if($user['role'] == 'master'){
            $query = User::has('farm');
        }else if($user['role'] == 'super-admin'){
            $office_id = auth()->user()->office->id;
            $farm_code = Farm::where('office_id', $office_id)->first();

            $query = User::has('farm')->where('code', $farm_code['code']);
        }

        if (request()->ajax()) {

            return DataTables::of($query)
            ->addColumn('aksi', 'pages.admin.user_farm.action')
            ->addColumn('farm', function($user){
                return $user->farm['name'];
            })
            ->addColumn('office', function($user){
                return $user->farm->office['name'];
            })
            ->addIndexColumn()
            ->rawColumns(['aksi'])
            ->toJson();
        }
        return view('pages.admin.user_farm.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        
        if($user['role'] == 'master'){
            $farms = Farm::orderBy('id', 'ASC')->get();
        }else if($user['role'] == 'super-admin'){
            $office_id = auth()->user()->office->id;
            $farms = Farm::where('office_id', $office_id)->get();
        }

        return view('pages.admin.user_farm.create', [
            'farms' => $farms,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserFarmRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'created_by' => $request->created_by,
            'updated_by' => $request->updated_by,
            'role' => $request->role,
            'code' => $request->code,
        ]);

        Alert::success('Success', 'Berhasil menambahkan data User Peternakan');
        return redirect()->route('user-farm.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        $user_auth = auth()->user();
        
        if($user_auth['role'] == 'master'){
            $farms = Farm::orderBy('id', 'ASC')->get();
        }else if($user_auth['role'] == 'super-admin'){
            $office_id = auth()->user()->office->id;
            $farms = Farm::where('office_id', $office_id)->get();
        }
        
        return view('pages.admin.user_farm.edit', [
            'user' => $user,
            'farms' => $farms,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['unique:users,email,'.$user->id],
            // email_verified_at
            'password' => ['nullable','min:6'],
            // remember token
            'created_by' => ['nullable', 'numeric'],
            'updated_by' => ['required', 'numeric'],
            'role' => ['required'],
            'code' => ['required']
        ]);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        if($request->filled('password')){
            $data['password'] = Hash::make($request->password);
        }else{
            $data['password'] = $user->password;
        }
        $data['updated_by'] = $request->updated_by;
        $data['role'] = $request->role;
        $data['code'] = $request->code;        

        $user->update($data);

        Alert::success('Success', 'Berhasil mengubah data user Peternakan');
        return redirect()->route('user-farm.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user-farm.index');
    }
}
