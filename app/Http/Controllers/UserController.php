<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Attempting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //

    public function index(){
        return 'Hello from UserController';
    }

    public function register(){
        if(View::exists('user.register')){
            return view('user.register')->with('title', 'Student Registration');
        }else{
            return abort(404);
        }
            
    }

    public function store(Request $request){
        // dd($request);
        $validated = $request->validate([
            "name" => ['required', 'min:4'],
            "email" => ['required', 'email' , Rule::unique('users', 'email')],//yung users tumutukoy sa users table sa database tapos yung column na email
            "password" => 'required|confirmed|min:6'
        ]);
        
        // $validated['password'] = Hash::make($validated['password']);//pwede itong hash gamitin or pwede din yung bcrypt();
        $validated['password'] = bcrypt($validated['password']);
        // $user = User::create($validated);//User na model
        User::create($validated);
        // auth()->login($user);
        return redirect('/login')->with('message', 'User added successfully!');
        // return $user;

    }

    public function login(){
        if(View::exists('user.login')){
            return view('user.login')->with('title', 'Student Admin');
        }else{
            return abort(404);
            // return response()->view('errors.404');//pwede din ito gumawa ako ng errors na folder sa view tapos gumawa ng 404.blade.php na file. pwede mo icustomize yung error message
        }
    }

    public function process(Request $request){
        $validated = $request->validate([
            "email" => ['required', 'email'],
            "password" => 'required'
        ]);
        if(auth()->attempt($validated)){
            $request->session()->regenerate();

            return redirect('/')->with('message', 'Welcome!');
        }
        return back()->withErrors(['email' => 'Login Unsuccessful!'])->onlyInput('email');
    }

    public function logout(Request $request){
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('message', 'Logout successfully!');
    }

    public function show($id){

        //unang way ng pagbato ng data
        /* $data = array(
            "id" => $id,
            "name" => "Ren",
            "age" => 29,
            "email" => "ren@gmail.com"
        );
        return view('user', $data); */

        //second way ng pagbato ng data using wih() method on controller
        $data = ["data" => "data from database"];
        return view('user') 
                ->with('data', $data)
                ->with('name', 'Ren')
                ->with('age', '29')
                ->with('email', 'ren@gmail.com')
                ->with('id', $id);

        // return view('user', ['data' => $data]);
        
        
    }
}
