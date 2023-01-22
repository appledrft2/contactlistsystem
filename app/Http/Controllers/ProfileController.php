<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
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

        return redirect(route('home'))
            ->with('success', 'Profile Successfully Updated');
    }

    public function updatePassword(Request $request, $id)
    {
        $validated = $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $hash = Hash::make($validated['password']);
        $user = User::findOrFail($id);
        $user->update(['password' => $hash]);
        return redirect(route('home'))->with('success', 'Password Successfully Updated');
    }
}
