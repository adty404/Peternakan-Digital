<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserOfficeRequest;
use App\Http\Requests\UserOfficeUpdateRequest;
use App\Models\Office;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class UserOfficeController extends Controller
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
            $query = User::has('office');
        }else if($user['role'] == 'super-admin'){
            $office_code = auth()->user()->office->code;

            $query = User::has('office')->where('code', $office_code);
        }

        if (request()->ajax()) {

            return DataTables::of($query)
            ->addColumn('aksi', 'pages.admin.user_office.action')
            ->addColumn('office', function($user){
                return $user->office['name'];
            })
            ->addColumn('created_by', function($user){
                return $user->cb['name'];
            })
            ->addColumn('updated_by', function($user){
                return $user->ub['name'];
            })
            ->addIndexColumn()
            ->rawColumns(['aksi'])
            ->toJson();
        }
        return view('pages.admin.user_office.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();

        $offices = Office::all();

        return view('pages.admin.user_office.create', [
            'offices' => $offices,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserOfficeRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'created_by' => $request->created_by,
            'updated_by' => $request->updated_by,
            'role' => 'super-admin',
            'code' => $request->code,
        ]);

        Alert::success('Success', 'Data User Office Successfully Created');
        return redirect()->route('user-office.index');

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
        $user = auth()->user();
        $user_office = User::findOrFail($id);
        
        if($user['role'] == 'master'){
            $offices = Office::all();
        }else if($user['role'] == 'super-admin'){
            $office_id = auth()->user()->office->id;

            $offices = Office::where('id', $office_id)->get();
        }

        return view('pages.admin.user_office.edit', [
            'user' => $user_office,
            'offices' => $offices,
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
            'created_by' => ['required', 'numeric'],
            'updated_by' => ['required', 'numeric'],
            // role
            'code' => ['required']
        ]);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        if($request->filled('password')){
            $data['password'] = Hash::make($request->password);
        }else{
            $data['password'] = $user->password;
        }
        $data['created_by'] = $request->created_by;
        $data['updated_by'] = $request->updated_by;
        $data['role'] = 'super-admin';
        $data['code'] = $request->code;        

        $user->update($data);

        Alert::success('Success', 'Data User Office Successfully Updated');
        return redirect()->route('user-office.index');
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

        return redirect()->route('user-office.index');
    }
}
