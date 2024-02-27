@extends('layouts.base')
@section('content')
<div class="container text-center">
    <div class="row">
        <div class="col-12 mx-auto">
            <div class="my-4 p-3">
            <h1 class="h1" >Create new Goal</h1>
                <form action="{{ route('goals.store') }}" method="POST">
                    
                    @csrf
                    <div class="row mb-3 justify-content-center">
                        <label for="player" class="col-sm-2 col-form-label text-end">Player</label>
                        <div class="col-sm-2">
                            <select name="player" id="player">
                                @foreach ($players as $player)
                                    <option value="{{ $player->id }}">{{ $player->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3 justify-content-center">
                        <label for="competition" class="col-sm-2 col-form-label text-end">Competition</label>
                        <div class="col-sm-2">
                            <select name="competition" id="competition">
                                @foreach ($competitions as $competition)
                                    <option value="{{ $competition->id }}">{{ $competition->id }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3 justify-content-center">
                        <label for="minute" class="col-sm-2 col-form-label text-end">Minute</label>
                        <div class="col-sm-2">
                            <input type="number" placeholder="Minute" class="form-control" step="1" id="minute" name="minute">
                        </div>
                    </div>

                    <div class="row mb-3 justify-content-center">
                        <div class="col-sm-2 text-start">
                            <button type="submit" class="btn btn-outline-primary">Create Competition!</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection