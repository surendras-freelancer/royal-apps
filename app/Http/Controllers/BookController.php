<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use App\Models\Token;

class BookController extends Controller
{

    public function destroy($book_id)
    {
        if (!$book_id) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        
        $token = $this->getToken();
        if($token == null){
            return response()->json(['message' => config('app.login_error')]);
        }
                
        $response = Http::withHeaders([ 
            'accept'=> 'application/json', 
            'Authorization'=> $token, 
        ]) 
        ->delete(config('app.candidate_api_endpoint').'/api/v2/books/'.$book_id); 
        if ($response->successful()) {
            return response()->json(['message' => 'Success']);
        } else {
            return response()->json(['message' => 'Some Error Occured. ']);
        }
    }

    public function addBook()
    {
        $token = $this->getToken();
        if($token == null){
            return response()->json(['message' => config('app.login_error')]);
        }
        $response = Http::withHeaders([ 
            'accept'=> 'application/json', 
            'Authorization'=> $token, 
        ]) 
        ->get(config('app.candidate_api_endpoint').'/api/v2/authors?orderBy=id&direction=ASC&limit=500&page=1'); 
            
        $authors = $response->json();
        $page_title = "Add Book";
        return view('add-book', compact('authors','page_title'));
    }

    public function addBookSubmit(Request $request)
    {
        $token = $this->getToken();
        if($token == null){
            return response()->json(['message' => config('app.login_error')]);
        }
        
        if($request->input('author') == ''){
            Session::flash('error', 'Please select author');
            return redirect()->route('addBook');
        }
        $author_id = $request->input('author');
        $title = $request->input('title');
        $release_date = $request->input('release_date');
        $description = $request->input('description');
        $format = $request->input('format');
        $isbn = $request->input('isbn');
        $number_of_pages = $request->input('number_of_pages');

        $curl = curl_init();

        curl_setopt_array($curl, [
        CURLOPT_URL => config('app.candidate_api_endpoint')."/api/v2/books",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\n  \"author\": {\n    \"id\": $author_id\n  },\n  \"title\": \"$title\",\n  \"release_date\": \"$release_date\",\n  \"description\": \"$description\",\n  \"isbn\": \"$isbn\",\n  \"format\": \"$format\",\n  \"number_of_pages\": $number_of_pages\n}",
        CURLOPT_HTTPHEADER => [
            "Authorization: $token",
            "Content-Type: application/json",
            "accept: application/json"
        ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            Session::flash('error', 'Some Error Occured. Please try again. ');
            return redirect()->route('addBook');
        } else {
            Session::flash('success', 'Book Created Successful. ');
            return redirect()->route('addBook');
        }
        
    }

    private function getToken()
    {
        $tokens = Token::first();
        if(isset($tokens)){
            return $tokens->token;
        }
        return null;
    }
}
