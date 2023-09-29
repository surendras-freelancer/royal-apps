@extends('layouts.default')
@section('content')
    <form method="GET" action="{{ route('logout') }}">
        @csrf
        
        <div class="container">
            <div class="row">
                <div class="col-md-4 text-bold">
                    <label for="uname">Id :</label>
                </div>
                <div class="col-md-8">
                    {{ $profile['id'] }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 text-bold">
                    <label for="uname">Name :</label>
                </div>
                <div class="col-md-8">
                    {{ $profile['first_name']." ".$profile['last_name'] }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 text-bold">
                    <label for="uname">Active :</label>
                </div>
                <div class="col-md-8">
                    {{ $profile['active'] }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 text-bold">
                    <label for="uname">Gender :</label>
                </div>
                <div class="col-md-8">
                    {{ $profile['gender'] }}
                </div>
            </div>
           
            <div class="row">
                <div class="col-md-4 text-bold">
                    <label for="uname">Email :</label>
                </div>
                <div class="col-md-8">
                    {{ $profile['email'] }}
                </div>
            </div>
            <button type="submit" >Logout</button>
        </div>
    </form>
    


@endsection