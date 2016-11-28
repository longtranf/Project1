<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\ProductRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;


use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\ProductItem;
use App\Models\Comment;
use App\User;
use App\Models\Review;
use App\Models\Vote;

class UserController extends Controller
{
    private $user;
    
    public function __construct () {
        $this->user = Auth::user();

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users_all = User::all();

        $data = array (
            'users_all' => $users_all,
            'user' => $this->user,
            );
        return view('admin.index_user')->with($data);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_show = User::find($id);
        $data = array (
            'user_show' => $user_show,
            'user' => $this->user,
            );

        return view('interface.profile')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_target = User::findOrFail($id);
        $data = array (
            'user' => $this->user,
            'user_target' => $user_target,
            );
        return view('interface.edit_user')->with($data);
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function change_pass (Request $request, $id) 
    {
        if ($this->user->id != $id) 
            return Redirect::route('home');

        $data = array (
            'user' => $this->user,
            'id' => $id,
            );

        return view('interface.change_pass')->with($data);
    }

    public function update_pass (Request $request, $id) 
    {
        if ($this->user->id != $id) 
            return Redirect::route('home');

        $user_change_pass = User::find($id);

        if (Hash::check($request->password, $user_change_pass->password)) 
        {
            if ($request->new_password == $request->confirm_password) 
            {
                $user_change_pass->password = bcrypt($request->new_password);
                $user_change_pass->save();
                return Redirect::route('users.show', $id);
            }
        }

        return redirect()->back();
    }
}
