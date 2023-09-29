@extends('layouts.default')
@section('content')

        @if(session('error'))
            <p style="color: red">{{ session('error') }}</p>
        @endif
        @if(session('success'))
            <p style="color: green">{{ session('success') }}</p>
        @endif
        <form method="POST" action="{{ route('addBookSubmit') }}">
            @csrf
            
            <div class="container">
                <label for="author">Author:</label>
                <select name="author" id="author">
                @foreach ($authors['items'] as $author)
                <option value="{{ $author['id'] }}">{{ $author['first_name']." ".$author['last_name'] }} </option>
                @endforeach
                </select>

                <br><br>

                <label for="title">Title:</label>
                <input type="text" name="title" id="title" required>
            
                <label for="isbn">Isbn:</label>
                <input type="text" name="isbn" id="isbn" required>

                <label for="format">Format:</label>
                <input type="text" name="format" id="format" required>

                <label for="number_of_pages">No. of Pages:</label>
                <input type="text" name="number_of_pages" id="number_of_pages" required>
                
                <label for="release_date">Relase Date:</label>
                <input type="date" name="release_date" id="release_date" required>
                <br><br>

                <label for="description">Description:</label>
                <textarea id="description" name="description"></textarea>
            
                <button type="submit">Add</button>
            </div>
        </form>
    </body>
</html>
@endsection
