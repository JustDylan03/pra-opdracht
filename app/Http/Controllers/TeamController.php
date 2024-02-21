<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::orderByRaw('creator_id = ? DESC', [Auth::user()->id])
            ->orderBy('name')
            ->get();

        if (Auth::user()->is_admin) {
            
            return view('admin.teams.index')->with('teams', $teams);
        } else {
            
            return view('teams.index')->with('teams', $teams);
        }
    }
}
