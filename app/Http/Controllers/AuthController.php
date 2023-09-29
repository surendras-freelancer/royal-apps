<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use App\Models\Token;

class AuthController extends Controller
{
    public function loginForm()
    {
        $page_title = "Login";
        return view('login', compact('page_title'));
    }

    public function getToken()
    {
        $tokens = Token::first();
        if(isset($tokens)){
            return $tokens->token;
        }else{
            return redirect('/login')->with('error',config('app.login_error'));
        }
    }

    public function login(Request $request)
    {
        $body = '{
            "email": "'.$request->input('uname').'",
            "password": "'.$request->input('psw').'"
          }';
        $response = Http::withBody( 
            $body, 'json' 
        ) 
        ->withHeaders([ 
            'accept'=> 'application/json', 
            'Content-Type'=> 'application/json', 
        ]) 
        ->post(config('app.candidate_api_endpoint') .'/api/v2/token'); 

        if ($response->successful()) {
            $data = $response->json();
            if (isset($data['token_key'])) {
                $tokenKey = $data['token_key'];
                $user_id = $data['user']['id'];
                $user_name = $data['user']['first_name']." ".$data['user']['last_name'];
            }else{
                Session::flash('error', 'Authentication failed. Token key not found ');
                return redirect()->route('login');
            }
            Session::put('access_token', $tokenKey);
            Session::put('user_name', $user_name);
            Token::create([
                'token' => $tokenKey,
                'user_id' => $user_id
            ]);
            Session::flash('success', 'Login successful.');
            return redirect()->route('authors');
        } else {
            Session::flash('error', 'Authentication failed. ');
            return redirect()->route('login');
        }
    }

    public function logout()
    {
        session()->flush();
        Session::flash('success', 'You have been successfully logged out.');
        Token::truncate();
        return redirect()->route('login');
    }

    public function profile()
    {
        $token = $this->getToken();
        $user_id = $this->getUserID();
                
        $response = Http::withHeaders([ 
            'accept'=> 'application/json', 
            'Authorization'=> $token, 
        ]) 
        ->get(config('app.candidate_api_endpoint').'/api/v2/users/'.$user_id); 
        if ($response->successful()) {
            $profile = $response->json();
            $page_title = "Profile";
            return view('profile', compact('profile','page_title'));
        } else {
            abort(404); // Handle not found or other errors as needed
        }
    }

    public function getUserID()
    {
        $tokens = Token::first();
        if(isset($tokens)){
            return $tokens->user_id;
        }else{
            return redirect('/login')->with('error', 'UserID not found.');
        }
    }
}
