<?php

namespace App\Http\Controllers;

use App\Models\Userdetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function update(Request $request, $id)
    {
        // dd($request);       

        // $request->validate([
        //     'name' => 'required|string',
        //     'profile_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        // ]);

        $user = Userdetail::find($id);
        if (!$user) {
            return redirect()->route('index')->with('error', 'User not found');
        }

        $user->name = $request->input('name');
        // Update profile image if a new one is provided
        if ($request->hasFile('profile_image')) {
            // Delete the old profile image if it exists
            if ($user->profile_image && Storage::exists('public/' . $user->profile_image)) {
                Storage::delete('public/' . $user->profile_image);
            }

            $imageName = time() . '.' . $request->file('profile_image')->getClientOriginalExtension();
            $request->file('profile_image')->storeAs('public/uploads/profiles', $imageName);
            $profile_image = 'uploads/profiles/' . $imageName;
        }
        // $user->image = $profile_image;

        $user->save();

        return redirect()->route('index')->with('success', 'User updated successfully');
    }
}
