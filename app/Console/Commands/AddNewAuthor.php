<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class AddNewAuthor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:new_author
        {first_name? : Author First Name} 
        {last_name? : Author Last Name} 
        {birthday? : Author Birthday} 
        {biography? : Author Biography}
        {gender? : Author Gender}
        {place_of_birth? : Author Place of Birth}
        {--force : Do not ask questions, just do it ;)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add new author from cli with artisan';

    /**
     * Execute the console command.
     */
    public function handle()
    {
      
        $response = Http::withBody( 
            '{ "email": "'.config("app.client_email").'",   "password": "'.config("app.client_password").'"}', 'json' ) 
        ->withHeaders([ 
            'accept'=> 'application/json', 
            'Content-Type'=> 'application/json', 
        ]) 
        ->post(config("app.candidate_api_endpoint").'/api/v2/token');
        $res = json_decode($response->body(), true);
        $first_name = ($this->argument('first_name') === null)
            ? $this->ask('Author First Name: ')
            : $this->argument('first_name');
        $last_name = ($this->argument('last_name') === null)
            ? $this->ask('Author Last Name: ')
            : $this->argument('last_name');
        $birthday = ($this->argument('birthday') === null)
            ? $this->ask('Author Birthday: ')
            : $this->argument('birthday');
        $biography = ($this->argument('biography') === null)
            ? $this->ask('Author Biography: ')
            : $this->argument('biography');
        $gender = ($this->argument('gender') === null)
            ? $this->ask('Author Gender: ')
            : $this->argument('gender');
        $place_of_birth = ($this->argument('place_of_birth') === null)
            ? $this->ask('Author Place of Birth: ')
            : $this->argument('place_of_birth');
        $response = Http::withBody( 
            json_encode(['first_name' => $first_name, 'last_name' => $last_name, 'birthday' => $birthday, 'biography' => $biography ,'gender' => $gender, 'place_of_birth' => $place_of_birth]) 
        )->withHeaders([ 
            'accept'=> 'application/json', 
            'Content-Type'=> 'application/json', 
            'Authorization' => $res['token_key'],
            'Name'=> 'Authorization'
        ]) 
        ->post(config("app.candidate_api_endpoint").'/api/v2/authors'); 

        $this->info($response->body());
        return 1;
    }
}
