<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

//author: dimple kundu
// controller class used for validation of login request
class AuthController extends Controller
{
    // to view login page
    public function login()
    {   
        // to get if the session already exists, since in every session if user clicks back, it goes back to login page, thus a check to ensure that it doesn't goes back to login
        
        if (Auth::check()) {
            
            if (Auth::user()->is_admin == 1) {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('user.dashboard');
        }
        
        return view('auth.login');
    }

    // when login button clicked, the loginPost method gets triggered fro validation and redirect
    public function loginPost(Request $request)
    {
        $validated = $request->validate([
            "username" => "required",
            "password" => "required",
        ]);

        // Explicitly specify which field to use for authentication
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate(); // Add this line for security
            
            Log::info('Login successful for user: ' . $request->username);
            
            // Check if user is admin and redirect accordingly
            if (Auth::user()->is_admin == 1) {
                return redirect()->route('admin.dashboard');
            }
            
            return redirect()->route("user.dashboard");
        }
        
        Log::warning('Failed login attempt for username: ' . $request->username);
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

    // register function to view the register page from views/auth
    public function register()
    {
        if(!Auth::check())
        {
            return view('auth.register');
        }
        return back();
    }

    // function to view the userDashbaord page from views/auth only on successfull login
    public function userDashboard()
    {
        return view('auth.userDashboard');
    }
    
    // function to view the admminDashbaord page from views/auth only on successfull login when user is admin only
    public function adminDashboard()
    {
        return view('auth.adminDashboard');
    }
    // function to register new user, validates the input fields from register form when clicked on register button
    public function registerPost(Request $request)
    {
        try {
            // Validate incoming request
            $validated = $request->validate([
                'firstname' => 'required|string|max:255|min:1',
                'lastname' => 'required|string|max:255|min:1',
                'username' => 'required|string|unique:users,username|max:255|min:1',
                'email' => 'required|email|unique:users,email|max:255|min:1',
                'password' => 'required|string|min:8|confirmed|min:1',
                'mobile' => 'required|digits:10|min:1',
                'branch' => 'required',
                'terms' => 'accepted',
            ]);

            // Create new user using data from validated form data fields
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
                return redirect()->route('login')
                    ->with('success', 'Registration successful! Please log in.');
            }

            return back()->with('error', 'Registration failed! Please try again.');
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Registration error: ' . $e->getMessage());

            return back()->withErrors(['error' => 'Registration failed! ' . $e->getMessage()])
                ->withInput();
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Logged out successfully');
    }

    


}
