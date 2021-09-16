<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserOfficeRequest;
use App\Http\Requests\UserOfficeUpdateRequest;
use App\Models\Office;
use App\Models\User;
use Illuminate\Http\Request;
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
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (request()->ajax()) {
            $query = User::has('office');

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
        return view('pages.admin.user_office.create', [
            'offices' => Office::orderBy('id', 'ASC')->get(),
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
        $user = User::findOrFail($id);

        return view('pages.admin.user_office.edit', [
            'user' => $user,
            'offices' => Office::orderBy('id', 'ASC')->get(),
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

        if($request->has('password')){
            $password = bcrypt($request->password);
        }else{
            $password = $user->password;
        }

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = $password;
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
