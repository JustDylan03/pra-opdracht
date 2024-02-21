@extends('layouts.base')
@section('content')

<div class="container">
    <h1 class="h1">All competitions</h1>
    <div class="col-md-4">
        <a class="btn btn-primary" href="{{ route('competitions.autocreate') }}">Create competitions</a>
    </div>
    <div class="col-md-8">
        <a class="btn btn-danger" href="{{ route('competitions.destroyall') }}">Destroy competitions</a>
    </div>

    <table class="table table-striped table-hover">
        <tr>
            <th>ID</th>
            <th>Team 1</th>
            <th>Team 2</th>
            <th>Team 1 score</th>
            <th>Team 2 score</th>
            <th>Field</th>
            <th>Referee</th>
            <th>time</th>
            <th>Edit</th>
        </tr>
        @foreach($competitions as $competition)
            <tr>
                <td><strong>{{ $competition->id }}</strong></td>
                <td>{{ $competition->team1->name}}</td>
                <td>{{ $competition->team2->name }}</td>
                <td>{{ $competition->team1_score }}</td>
                <td>{{ $competition->team2_score }}</td>
                <td>{{ $competition->field }}</td>
                <td>{{ $competition->referee->name }}</td>
                <td>{{ $competition->time }}</td>
                <td><a class="edit" href="{{ route('competitions.edit', $competition->id) }}">Edit</a></td>
            </tr>
        @endforeach
    </table>
@endsection