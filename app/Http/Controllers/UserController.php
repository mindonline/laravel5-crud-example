<?php

namespace App\Http\Controllers;

use App\Mail\UserCreated;
use Illuminate\Support\Facades\Mail;
use Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;


use App\User;
use App\Role;
use App\City;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;


class UserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.list',['users'=>$users]);
    }

    /**
     * Show the form for creating a new user.
     *
     * @return Response
     */
    public function create()
    {
        $user = new User;
        $roles = Role::all();
        $cities = City::all()->pluck("name","id");
        return view('users.create-edit', ['user'=>$user, 'roles'=>$roles, 'cities'=> $cities ]);
    }

    /**
     * Store a newly created user in storage.
     *
     * @return Response
     */
    public function store(StoreUser $request)
    {
        $user = new User(Input::all());
        if ($user->save()) {
            event(new \App\Events\UserCreated($user));
            $request->session()->flash('message',  __("users.userIsCreated",["email"=>$user->email]));
        }
        return redirect()->action('UserController@index');
    }

    /**
     * Display the specified user.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        // Not used
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = User::whereid($id)->firstOrFail();
        $roles = Role::all();
        $cities = City::all()->pluck("name","id");
        return view('users.create-edit', ['user'=>$user, 'roles'=>$roles, 'cities'=> $cities ]);
    }

    /**
     * @param  UpdateUser  $request
     * @return Response
     */
    public function update(UpdateUser $request, $id)
    {
        $user = User::findOrFail($id);
        $user->fill(Input::all());
        if (!Input::get("roles")) {
            $user->roles = false; // default value
        }
        $user->save();

        $request->session()->flash('message', __("users.userIsUpdated",["email"=>$user->email]) );
        return redirect()->action('UserController@index');
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        $request->session()->flash('message',  __("users.userIsDeleted",["email"=>$user->email]));
        return redirect()->action('UserController@index');
    }


}
