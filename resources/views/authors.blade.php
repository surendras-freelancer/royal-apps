@extends('layouts.default')
@section('content')

@if(session('error'))
    <p style="color: red">{{ session('error') }}</p>
@endif
@if(session('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Birthday</th>
                <th>Gender</th>
                <th>Place of Birth</th>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @foreach ($authors['items'] as $author)
                <tr>
                    <td>{{ $author['id'] }}</td>
                    <td>{{ $author['first_name']." ".$author['last_name'] }}</td>
                    <td>{{ $author['birthday'] }}</td>
                    <td>{{ $author['gender'] }}</td>
                    <td>{{ $author['place_of_birth'] }}</td>
                    <td><button type="button" onclick="view_author({{ $author['id'] }})">View</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection