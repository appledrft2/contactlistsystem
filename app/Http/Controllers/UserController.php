<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id', '!=', Auth::user()->id)->get();
        return view('user.index', ['users' => $users]);
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
        return view('user.edit', ['user' => $user]);
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
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        $user = User::findOrFail($id);
        if ($request->profileimg) {
            $request->validate([
                'profileimg' => 'required|image|mimes:png,jpg,jpeg|max:2048'
            ]);
            $imageName = time() . '.' . $request->profileimg->extension();
            $request->profileimg->move(public_path('images'), $imageName);

            $img_path = "/images/$imageName";

            $user->update(['profileimg' => $img_path]);
        }
        $user->update($validated);

        return redirect(route('users.index'))
            ->with('success', 'User Successfully Updated');
    }

    public function updateAccessLevel(Request $request, $id)
    {
        $validated = $request->validate([
            'access_level' => ['required', 'string', 'max:255'],
        ]);
        $user = User::findOrFail($id);
        $user->update($validated);
        return redirect(route('users.index'))
            ->with('success', 'User Successfully Updated');
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
        return redirect(route('users.index'))
            ->with('success', 'User Successfully Updated');
    }
}
