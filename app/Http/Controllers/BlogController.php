<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class BlogController extends Controller
{
    public function home()
    {
        return view('home.home');
    }

    public function createuser()
    {
        return view('home.createuser');
    }

    // CREATE
    public function blogcreate()
    {
        $users = Blog::all();
        return view('home.createuser', compact('users'));
    }

    // TO LIST
    public function blogindex()
    {
        $users = Blog::all();
        return view('home.userlist', compact('users'));
    }

    // TO STORE
    public function blogstore(Request $request)
    {
        // Validation rules
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:blogs', // Updated table name to 'blogs'
            'password' => 'required|string|min:6',
            'gender' => 'required',
            'hobbies' => 'required|array', // Ensure hobbies is an array
            'qualification' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = new Blog();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password')); // Hash the password
        $user->gender = $request->input('gender');
        $user->hobbies = json_encode($request->input('hobbies')); // Encode the hobbies array as JSON
        $user->qualification = $request->input('qualification');

        // Handle the image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/uploads/highlights');
            // Store the image path as a string
            $user->image = str_replace('public/', 'storage/', $imagePath); // Corrected path
        }

        $user->save();

        return redirect()->route('bloguserlist')->with('success', 'User created successfully');
    }

        // EDIT
        public function blogedit($id)
        {
            $user = Blog::find($id);
            if (!$user) {
                return redirect()->route('bloguserlist')->with('error', 'User not found');
            }
            return view('home.createuser', compact('user'));
        }

        // TO UPDATE
        public function update(Request $request, $id)
        {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:user_details,email,' . $id,
                'password' => 'nullable|string|min:6', // Password validation rules (optional)
                'mobile' => 'required|string',
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $user = Blog::find($id);
            if (!$user) {
                return redirect()->route('index')->with('error', 'User not found');
            }

            $user->name = $request->input('name');
            $user->email = $request->input('email');
            
            // Update password only if provided
            if ($request->has('password') && !empty($request->input('password'))) {
                $user->password = bcrypt($request->input('password')); // Hash the password
            }

            $user->mobile = $request->input('mobile');

            if ($request->hasFile('image')) {
                if ($user->image) {
                    if (Storage::disk('public')->exists($user->image)) {
                        Storage::disk('public')->delete($user->image);
                    }
                }
                $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->storeAs('public/uploads/highlights/', $imageName);
                $user->image = 'uploads/highlights/' . $imageName;
            }

            $user->save();

            return redirect()->route('index')->with('success', 'User updated successfully');
        }
        

    // TO DELETE
    public function blogdestroy($id)
    {
        $user = Blog::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('bloguserlist')->with('success', 'User deleted successfully');
        }

        return redirect()->route('bloguserlist')->with('error', 'User not found');
    }

    // LISTING IN YAJRA DATATABLE
    public function bloggetUser(Request $request)
    {
        if ($request->ajax()) {
            $data = Blog::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('blogedit', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a>
                <a href="' . route('blogdelete', $row->id) . '" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->editColumn('hobbies', function ($row) {
                    return implode(', ', json_decode($row->hobbies));
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
