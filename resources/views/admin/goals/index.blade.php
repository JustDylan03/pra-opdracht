@extends('layouts.base')
@section('content')

<div class="container justify-content-center">
    <h1 class="h1">All Goals</h1>
    
    <!-- Create & delete button and a alert, if there's one -->
    <div class="container text-center ">
        @isset($err)
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <span>{{ $err }}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endisset
        <div class="row m-6">
            <div class="col-md-4">
                <a class="btn btn-primary" href="{{ route('goals.create') }}">Create Goal</a>
            </div>
            <!-- <div class="col-md-8">
                <a class="btn btn-danger" href="{{ route('competitions.destroyall') }}">Destroy competitions</a>
            </div> -->
        </div>
    </div>


    <table class="table table-striped table-hover m-2">
        <tr>
            <th>Player</th>
            <th>Match</th>
            <th>Minute</th>
            <th>Edit</th>
        </tr>
        @foreach($goals as $goal)
            <tr>
                <td>{{ $goal->player->name }}</td>
                <td>{{ $goal->competition->team1->name }} && {{ $goal->competition->team2->name }} </td>
                <td>{{ $goal->minute }}</td>
                <td><a class="btn btn-warning" href="{{ route('goals.edit', $goal->id) }}">Edit Entry</a></td>
            </tr>
        @endforeach
    </table>
@endsection