@extends('layouts.base')
@section('content')
<div class="container text-center">
    <div class="row">
        <div class="col-12 mx-auto">
            <div class="my-4 p-3">
            <h1 class="h1" >Edit Competition</h1>
                <form action="{{ route('competitions.update',$competition->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="row mb-3 justify-content-center">
                        <label for="team1_id" class="col-sm-2 col-form-label text-end">Choose team 1</label>
                        <div class="col-sm-2">
                            <select name="team1_id" id="team1_id">
                                @foreach ($teams as $team)
                                    <option value="{{ $team->id }}" {{ $team->id == $competition->team1_id ? 'selected' : '' }} >{{ $team->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3 justify-content-center">
                        <label for="team2_id" class="col-sm-2 col-form-label text-end">Choose team 2</label>
                        <div class="col-sm-2">
                        <select name="team2_id" id="team2_id">
                                @foreach ($teams as $team)
                                    <option value="{{ $team->id }}" {{ $team->id == $competition->team2_id ? 'selected' : '' }}>{{ $team->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3 justify-content-center">
                        <label for="team1_score" class="col-sm-2 col-form-label text-end">Team 1 score</label>
                        <div class="col-sm-2">
                            <input type="number" placeholder="Current amount of points" value="{{$competition->team1_score}}" class="form-control" step="1" id="team1_score" name="team1_score">
                        </div>
                    </div>
                    <div class="row mb-3 justify-content-center">
                        <label for="team2_score" class="col-sm-2 col-form-label text-end">Team 2 score</label>
                        <div class="col-sm-2">
                            <input type="number" placeholder="Current amount of points" value="{{$competition->team2_score}}" class="form-control" step="1" id="team2_score" name="team2_score">
                        </div>
                    </div>
                    <div class="row mb-3 justify-content-center">
                        <div class="col-sm-2 text-start">
                            <button type="submit" class="btn btn-outline-primary">Update Competition</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection