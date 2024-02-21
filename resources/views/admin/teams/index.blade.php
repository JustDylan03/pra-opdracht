@extends('layouts.base')
@section('content')

<div class="container">
    <h1 class="h1">All Teams</h1>
    
    <a class="btn btn-primary" href="{{ route('teams.create') }}">Create new team</a>
       
    <table class="table table-striped table-hover mt-4">
        <tr>
            <th>Team</th>
            <th>Points</th>
            <th>Destroy</th>
        </tr>

        @foreach ($teams as $team)
        <tr>
            <td>{{ $team->name}}</td>
            <td>{{ $team->points}}</td> 
            <td>
                <form action="{{ route('teams.destroy', $team->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline-danger" type="submit" value="Delete">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
        
    </table>
</div>
@endsection
