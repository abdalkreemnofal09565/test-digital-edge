<?php

namespace App\Http\Controllers\Session;

use App\Models\User;
use App\Rules\PhoneOrEmail;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    
    public function getRegister(){
        return view('basic.partials.auth.register');
    }

    public function register(Request $request){

        $validated = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'identifier' => ['required', 'max:255','unique:users', new PhoneOrEmail],
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);

        $user->assignRole('User');

        return redirect()->route('login');
    }

    public function getLogin(){
        return view('basic.partials.auth.login');
    }

    public function login(Request $request){
        $request->validate([
            'identifier' => ['required', 'max:255', new PhoneOrEmail],
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only(['identifier', 'password']))) {
            return back()->with([
                'error' => __('auth.failed')
            ]);
        }   
        return redirect()->route('dashboard');
    }

    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect()->route('login');
    }




    /**
     * 
     * Dashboard Methods
     * 
     */
    public function getDashboardLogin(){
        return view('dashboard.auth.login');
    }

    public function loginDashboard(Request $request){
        
        $request->validate([
            'identifier' => ['required','exists:users,identifier', 'max:255', new PhoneOrEmail],
            'password' => 'required',
        ]);
       

        
        if (!Auth::attempt($request->only(['identifier', 'password']))) {
            return back()->with([
                'error' => __('auth.failed')
            ]);
        }   
        return redirect()->route('dashboard');
    }

    public function changePasswordShowForm(){       
        return view('dashboard.auth.changePassword');
    }

    public function changePassword(Request $request){

        $request->validate([
            'current_password' => 'required|min:6',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password',
        ]);

        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return back()->with([
                'error' => "Old Password Doesn't match!"
            ]);
        }

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        return redirect()->route('dashboard')->with('success', __('password has been changed successfully'));
    }

    public function logoutDashboard(){
        Session::flush();
        Auth::logout();
        return redirect()->route('dashboard.login');
    }
}
