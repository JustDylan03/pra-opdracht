@extends('layouts.base')
@section('content')
<div class="container text-center">
    <div class="row">
        <div class="col-12 mx-auto">
            <div class="my-4 p-3">
            <h1 class="h1" >Create new Team</h1>
                <form action="{{ route('teams.store') }}" method="POST"">
                    
                    @csrf
                    <div class="row mb-3 justify-content-center">
                        <label for="teamName" class="col-sm-2 col-form-label text-end">Team Name</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" placeholder="Name of your team" name="teamName" id="teamName">
                        </div>
                    </div>
                    <div class="row mb-3 justify-content-center">
                        <div class="col-sm-2 text-start">
                            <button type="submit" class="btn btn-outline-primary">Create team!</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection