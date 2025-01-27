<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display the list of users.
     */
    public function index()
    {
        $users = User::all(); // Get all users
        return view('admin-dashboard', compact('users')); // Pass users to the view
    }

    // edit the user
    public function editUser(User $user)
    {
        return view('auth.edit-user', compact('user'));
    }


    // Delete the user.
    public function deleteUser(User $user)
    {
        if ($user->is_admin == 1) {
            return redirect()->route('admin.dashboard')->with('error', 
        'an admin can not delete other admin');
        }
        $user->delete();
        // Check if user is admin and redirect accordingly
        
        return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully');
    }

    public function addUser()
    {
        return view('auth.addUser');
    }

    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:8',
            'mobile' => 'required|string|max:15',
            'branch' => 'required|string',
            'terms' => 'accepted',
            
        ]);

        $user = User::create([
            'firstname' => $validated['firstname'],
            'lastname' => $validated['lastname'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'mobile' => $validated['mobile'],
            'branch' => $validated['branch'],
        ]);

        if ($user) {
            return redirect()->route('admin.dashboard')
                ->with('success', 'User added successfully.');
        }
        
        return back()->with('error', 'Failed to add user. Please try again.');
    }
    
    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'mobile' => 'required|string|max:15',
            'branch' => 'required|string',
        ]);

        $user->update($validated);
        return redirect()->route('admin.dashboard')->with('success', 'User updated successfully');
    }

    public function bookMaintain(Request $request, User $user ){
        return redirect()->route('admin.bookMaintain.dashboard');
    }
}
