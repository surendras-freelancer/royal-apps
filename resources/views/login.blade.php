@extends('layouts.default')
@section('content')

        @if(session('error'))
            <p style="color: red">{{ session('error') }}</p>
        @endif
        @if(session('success'))
            <p style="color: green">{{ session('success') }}</p>
        @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="container">
                <label for="uname">Email:</label>
                <input type="text" name="uname" id="uname" required>
            
                <label for="psw">Password:</label>
                <input type="password" name="psw" id="psw" required>
            
                <button type="submit">Login</button>
            </div>
        </form>
    </body>
</html>
@endsection
