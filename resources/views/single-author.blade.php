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
            <div class="row">
                <div class="col-md-4 text-bold">
                    <label for="uname">Id :</label>
                </div>
                <div class="col-md-8">
                    {{ $author['id'] }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 text-bold">
                    <label for="uname">Name :</label>
                </div>
                <div class="col-md-8">
                    {{ $author['first_name']." ".$author['last_name'] }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 text-bold">
                    <label for="uname">Birthday :</label>
                </div>
                <div class="col-md-8">
                    {{ $author['birthday'] }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 text-bold">
                    <label for="uname">Gender :</label>
                </div>
                <div class="col-md-8">
                    {{ $author['gender'] }}
                </div>
            </div>
           
            <div class="row">
                <div class="col-md-4 text-bold">
                    <label for="uname">Place of Birth :</label>
                </div>
                <div class="col-md-8">
                    {{ $author['place_of_birth'] }}
                </div>
            </div>
            @if(empty($author['books']))
                <button type="button" class="delete-author"  >Delete Author</button>
            @endif
            <button type="submit" style="visibility:hidden;">Login</button>
        </div>
    </form>
    <h2>Author Book List</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Release Date</th>
                <th>Description</th>
                <th>Isbn</th>
                <th>Format</th>
                <th>No. of Pages</th>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @foreach ($author['books'] as $book)
                <tr data-books-id="{{ $book['id'] }}">
                    <td>{{ $book['id'] }}</td>
                    <td>{{ $book['title'] }}</td>
                    <td>{{ $book['release_date'] }}</td>
                    <td>{{ $book['description'] }}</td>
                    <td>{{ $book['isbn'] }}</td>
                    <td>{{ $book['format'] }}</td>
                    <td>{{ $book['number_of_pages'] }}</td>
                    <td><button type="button"  class="delete-button" data-book-id="{{ $book['id'] }}">Delete</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.delete-author').click(function() {
            if (confirm('Are you sure you want to delete this author?')) {
                window.location.href="/delete-author/{{ $author['id'] }}";
            }
        });

        $('.delete-button').click(function() {
            const book_id = $(this).data('book-id');
            if (confirm('Are you sure you want to delete this Book?')) {
                $.ajax({
                    type: 'DELETE',
                    url: '/api/books/' + book_id, //
                    success: function(data) {
                        if(data.message == 'Success') {
                            $(`tr[data-books-id="${book_id}"]`).remove();
                        }else{
                            alert(data.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        alert('Failed to delete book. Please try again.');
                    }
                });
            }
        });
    });
</script>


@endsection