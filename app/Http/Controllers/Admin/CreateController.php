<?php

namespace App\Http\Controllers\Admin;

use App\Models\Userdetail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class CreateController extends Controller
{
    // CREATE
    public function create()
    {
        $users = Userdetail::all(); 
        return view('admin.auth.create', compact('users'));
    }

    // TO LIST
    public function index()
    {
        $users = Userdetail::all();
        return view('admin.auth.users.index', compact('users'));
    }


// TO STORE
public function store(Request $request)
{
    // Validation rules
    $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique:user_details',
        'password' => 'required|string|min:6', // Password validation rules
        'mobile' => 'required|string',
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming you want to allow image files
    ]);

    $user = new Userdetail();
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->password = bcrypt($request->input('password')); // Hash the password
    $user->mobile = $request->input('mobile');

    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->storeAs('public/uploads/highlights/', $imageName);
        $user->image = 'uploads/highlights/' . $imageName;
    }

    $user->save();

    return redirect()->route('index')->with('success', 'User created successfully');
}

    // EDIT
    public function edit($id)
    {
        $user = Userdetail::find($id);
        if (!$user) {
            return redirect()->route('index')->with('error', 'User not found');
        }
        return view('admin.auth.create', compact('user'));
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

    $user = Userdetail::find($id);
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
    public function destroy($id)
    {
        $user = Userdetail::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('index')->with('success', 'User deleted successfully');
        }

        return redirect()->route('index')->with('error', 'User not found');
    }

    // LISTING IN YAJRA DATATABLE
    public function getUser(Request $request)
    {   
        if ($request->ajax()) {
            $data = Userdetail::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('edit', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a>
                    <a href="' . route('delete', $row->id) . '" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    // PROFILE
    public function profile()
    {
        $user = auth()->user();

        return view('admin.auth.profile', compact('user'));
    }

    public function loadSidebar()
{
    $user = Auth::guard('web')->user();

    return view('sidebar', ['user' => $user]);
}
}
