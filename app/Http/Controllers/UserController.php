<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class UserController extends Controller
{
    public function __construct()
    {
        $this->userModel = new User();
    }
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = $this->userModel->get();

        return view('users.index', ['users' => $users]);
    }

    public function show($id)
    {
        // TODO error handling using try catch
        $user = $this->userModel->where('user_id',$id)->first();

        return view('users.detail', ['user' => $user]);
    }

    public function create()
    {
        return view('users.create');
        // return view('users.create');
    }

    public function store()
    {
        // TODO error handling using try catch and modal notification
        try {
            $user = new User();
            $user->user_id = Uuid::uuid4()->toString();
            $user->name = request('name');
            $user->email = request('email');
            $user->password = Hash::make(request('password'));
            $user->phone_number = request('phone');
            $user->role = 'user';
            $user->save();

            return redirect()->route('user.index')->withStatus(__('User successfully created.'));    
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('user.index')->withStatus(__('User failed to create.'));
        }
    }

    public function detail($id)
    {
        $user = User::find($id);
        return view('users.detail');
    }

    public function edit($id)
    {
        $user = $this->userModel->where('user_id',$id)->first();

        return view('users.edit', ['user' => $user]);
    }

    public function update($id)
    {
        // TODO error handling using try catch and modal notification
        try {
            $data = request()->all();

            $data['phone_number'] = $data['phone'];
            $data['updated_by'] = auth()->user()->id;
    
            $user = $this->userModel->where('id',$id)->first();
            $user->update($data);
    
            return redirect()->route('user.index')->withStatus(__('User successfully updated.'));    
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('user.index')->withStatus(__('User failed to update.'));
        }
    }

    public function destroy($id)
    {
        $user = User::where('id', $id);
        $user->delete();
        return redirect()->route('user.index')->withErrors(['success' => 'User has been deleted']);
    }
}
