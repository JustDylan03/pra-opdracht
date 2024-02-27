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
    </div>


    <table class="table table-striped table-hover m-2">
        <tr>
            <th>Player</th>
            <th>Match</th>
            <th>Minute</th>
        </tr>
        @foreach($goals as $goal)
            <tr>
                <td>{{ $goal->player->name }}</td>
                <td>{{ $goal->competition->team1->name }} && {{ $goal->competition->team2->name }} </td>
                <td>{{ $goal->minute }}</td>
            </tr>
        @endforeach
    </table>
@endsection