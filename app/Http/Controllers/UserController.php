<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (!Auth::check() || Auth::user()->role_id === null) {
            abort(403, 'Unauthorized');
        }

        if (Auth::user()->role_id == 1) {
            $data = User::all();

            return view('Admin.User.index', compact('data'));
        }

        abort(403, 'Unauthorized');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::check() || Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized');
        }

        return view('Admin.User.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::check() || Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized');
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,user',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role === 'admin' ? 1 : 2,
        ]);

        return redirect()->route('Admin.User.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!Auth::check() || Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized');
        }

        $user = User::findOrFail($id);
        return view('Admin.User.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!Auth::check() || Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized');
        }

        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:admin,user',
        ]);

        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->role_id = $request->role === 'admin' ? 1 : 2;
        $user->save();

        return redirect()->route('admin.user.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!Auth::check() || Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized');
        }

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.user.index')->with('success', 'User deleted successfully.');
    }
}
