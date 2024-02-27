<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Goal;
use \Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; 
use App\Models\Competition;
use App\Models\User;


class GoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $goals = Goal::all();
        if (Auth::user()->is_admin) {
            return view('admin.goals.index', compact('goals'));
        } 
        else {
            return view('goals.index', compact('goals'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        if(Auth::user()->is_admin) {
            $players = User::all();
            $competitions = Competition::all();
            return view('admin.goals.create')
                ->with('players',$players)
                ->with('competitions',$competitions);
        }
        else {
            $goals = Goal::all();
            return view('goals.index')
            ->with('goals',$goals);
        }


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'player' => ['required'],
            'competition' => ['required'],
            'minute' => ['required','integer'],
        ]);

        $goal = new Goal();
        $goal->player_id = $request->input('player');
        $goal->competition_id = $request->input('competition');
        $goal->minute = $request->input('minute');


        
        
        if(Auth::user()->is_admin) {
            $goal->save();
            $goals = Goal::all();
            return view('admin.goals.index')
                ->with('succes', 'Compettion created succesfully')
                ->with('goals',$goals);
        }
        else {
            $goals = Goal::all();
            return view('goals.index')
                ->with('goals', $goals);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $goal = Goal::findOrFail($id);
        if(Auth::user()->is_admin) {
            return view('admin.goals.detail')
                ->with('goal',$goal);
        }
        return view('goals.detail')
            ->with('goal',$goal);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(Auth::user()->is_admin) {
            $goal = Goal::findOrFail($id);
            $players = User::all();
            $competitions = Competition::all();
            return view('admin.goals.edit')
                ->with('goal',$goal)
                ->with('players',$players)
                ->with('competitions',$competitions);
        }
        else {
            $goals = Goal::all();
            return view('goals.index')
                ->with('goals',$goals);
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $goal = Goal::findOrFail($id);

        $request->validate([
            'player' => ['required'],
            'competition' => ['required'],
            'minute' => ['required','integer']
        ]);

        $goal->player_id = $request->input('player');
        $goal->competition_id = $request->input('competition');
        $goal->minute = $request->input('minute');
        
        if(Auth::user()->is_admin) {
            $goal->save();
            $goals = Goal::all();
            return view('admin.goals.index')
                ->with('succes', 'Compettion created succesfully')
                ->with('goals',$goals);
        }
        else {
            $goals = Goal::all();
            return view('goals.index')
                ->with('goals', $goals);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function apiSelectGoals($competitionId): JsonResponse
    {
        $goals = Goal::select(
            'goals.id',
            'goals.competition_id',
            'goals.minute',
            'goals.player_id',
            'teams.id as player_team',
            'users.name as player_name'
        )
            ->leftJoin('teams', 'teams.id', '=', 'goals.competition_id')
            ->leftJoin('users', 'users.id', '=', 'goals.player_id')
            ->where('goals.competition_id', $competitionId)
            ->get();
    
        return response()->json($goals);
    }
}
