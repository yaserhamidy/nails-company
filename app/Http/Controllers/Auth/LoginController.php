<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
  

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected function redirectTo(){
        if(Auth()->user()->role == 1){
            return route('admin.index');
        }elseif(Auth()->user()->role == 2){
            return route('user.index');
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
    public function login(Request $request)
    {
        $input = $request->all();
    
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        
        if (auth()->attempt(['email' => $input['email'], 'password' => $input['password']])) {
            // Check user role and redirect accordingly
            if (auth()->user()->role == 1) {
                return redirect()->route('admin.index');
            } elseif (auth()->user()->role == 2) {
                return redirect()->route('user.index');
            }
        }
    
        // If authentication fails, redirect back with error
        return redirect()->route('login')->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

public function showExamPages(){
    $subjects = subject::where('status', 'active')->paginate(4);
   
    return view('dashboards.users.index', compact('subjects'));
}
}