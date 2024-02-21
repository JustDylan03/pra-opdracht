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
    public function create()
    {
        return view('teams.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'teamName' => ['required', 'string', 'max:255'],
        ]);
        $team = new Team();
        $team->name = $request->input('teamName');
        $team->points = 0;
        $team->creator_id = auth()->user()->id;
        $team->save();
        return redirect()->route('teams.index')->with('succes', 'Team made');
    }

    public function destroy(string $id)
    {
        $team = Team::findOrFail($id);
        $team->delete();
        $teams = Team::all();
        if(Auth::user()->is_admin) {
            return view('admin.teams.index')
                ->with('teams', $teams);
        }
        else {
            return view('teams.index')
                ->with('teams', $teams);
        }
    }
}
