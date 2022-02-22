<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class UserManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = ['admin', 'guru', 'siswa'];
        return view('dashboard.admin.user.index', [
            'title' => 'Semua User',
            'users' => User::orderBy('role', 'asc')->orderBy('updated_at', 'desc')->get(),
            'roles' => $roles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // dd(empty($request->email));
        $rules = [
            'name' => 'required',
            // 'email' => 'email:dns|unique:users',
            'username' => 'required',
            'role' => 'required',
            'password' => 'required|min:5|max:255|'
        ];

        $requestData = $request->all();
        if (!empty($request->email)) {
            $requestData['email'] = $request->email;
            $rules['email'] = 'required|email:dns|unique:users';
            // $request->merge(['email' => $requestData['email']]);
        } else {
            $requestData['email'] = null;
        }
        $request->merge(['email' => $requestData['email']]);

        $validatedData['password'] = Hash::make($request->password);
        $validatedData = $request->validate($rules);

        User::create($validatedData);

        $title = $validatedData['name'];
        toastr()->success("User baru telah berhasil <strong>ditambahkan</strong>!");
        return redirect(route('users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email:dns|unique:users',
            'username' => 'required',
            'role' => 'required',
            'password' => 'required|min:5|max:255|'
        ];

        if ($request->email != $user->email) {
            $rules['email'] = 'required|unique:users';
        }

        // $requestData = $request->all();
        $validatedData = $request->validate($rules);
        $validatedData['password'] = Hash::make($validatedData['password']);


        User::where('id', $user->id)->update($validatedData);
        $title = $validatedData['name'];
        toastr()->success("User $title telah berhasil <strong>diubah</strong>!");
        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $title = $user->name;
        User::destroy($user->id);
        toastr()->success("User <strong>$title</strong> telah berhasil <strong>dihapus</strong>!");

        return redirect(route('users.index'));
    }
}
