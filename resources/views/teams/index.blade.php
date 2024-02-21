@extends('layouts.base')
@section('content')

<div class="container">
    <h1 class="h1">All Teams</h1>
    
    <a class="btn btn-primary" href="{{ route('teams.create') }}">Create new team</a>
       
    <table class="table table-striped table-hover mt-4">
        <tr>
            <th>Team</th>
            <th>Points</th>
        </tr>

        @foreach ($teams as $team)
        <tr>
            <td>{{ $team->name}}</td>
            <td>{{ $team->points}}</td> 
        </tr>
        @endforeach
    </table>
</div>
@endsection
