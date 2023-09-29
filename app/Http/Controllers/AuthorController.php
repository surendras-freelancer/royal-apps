<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use App\Models\Token;

class AuthorController extends Controller
{
    public function index()
    {
        $tokens = $this->getToken();
        if(isset($tokens)){
            $token =  $tokens->token;
        }else{
            return redirect('/login')->with('error', config('app.login_error'));
        }

        $response = Http::withHeaders([ 
            'accept'=> 'application/json', 
            'Authorization'=> $token, 
        ]) 
        ->get(config('app.candidate_api_endpoint').'/api/v2/authors?orderBy=id&direction=ASC&limit=500&page=1'); 
            
        $authors = $response->json();
        $page_title = "Authors";
        return view('authors', compact('authors','page_title'));
    }

    private function getToken()
    {
        return $tokens = Token::first();

        return null;
    }

    public function show($author_id)
    {
        $tokens = $this->getToken();
        if(isset($tokens)){
            $token =  $tokens->token;
        }else{
            return redirect('/login')->with('error', config('app.login_error'));
        }
                
        $response = Http::withHeaders([ 
            'accept'=> 'application/json', 
            'Authorization'=> $token, 
        ]) 
        ->get(config('app.candidate_api_endpoint').'/api/v2/authors/'.$author_id); 
        if ($response->successful()) {
            $author = $response->json();
            $page_title = "Author Details";
            return view('single-author', compact('author','page_title'));
        } else {
            abort(404); 
        }
    }

    public function deleteAuthor($author_id)
    {
        $tokens = $this->getToken();
        if(isset($tokens)){
            $token =  $tokens->token;
        }else{
            return redirect('/login')->with('error', config('app.login_error'));
        }
                
        $response = Http::withHeaders([ 
            'accept'=> 'application/json', 
            'Authorization'=> $token, 
        ]) 
        ->DELETE(config('app.candidate_api_endpoint').'/api/v2/authors/'.$author_id); 
        if ($response->successful()) {
            $author = $response->json();
            $page_title = "Author Details";
            return redirect('/authors')->with('success', "Author Deleted Successfully!");
        } else {
            return redirect('/authors/'.$author_id)->with('error', "Some Error Occured. Author not deleted.");
        }
    }
}
