<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Competition;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Faker\Factory as Faker;
use Carbon\Carbon;

class CompetitionController extends Controller
{
    public function index()
    {
        $competitions = Competition::all();
        
        if (Auth::user()->is_admin) {
            // Admin view
            return view('admin.competitions.index', compact('competitions'));
        } else {
            // Regular user view
            return view('competitions.index')
                ->with('competitions', $competitions);
        }

        
    }
    public function edit(string $id)
    {
        $competition = Competition::findOrFail($id);
        $teams = Team::all();
        $users = User::all();
        return view('admin.competitions.edit')
            ->with('competition',$competition)
            ->with('teams',$teams)
            ->with('users',$users);
    }

    public function store(Request $request)
    {
        $request->validate([
            'teamName 1' => ['required', 'string', 'max:255'],
            'teamName 2' => ['required', 'string', 'max:255'],
            'teamPoints 1' => ['required', 'integer'],
            'teamPoints 2' => ['required', 'integer'],
        ]);

        $competition = new Competition();
        $competition->team1_id = $request->input('team1_id');
        $competition->team2_id = $request->input('team2_id');
        $competition->team1_score = $request->input('team1_score');
        $competition->team2_score = $request->input('team2_score');


        $competition->save();
        return view('competitions.index')->with('succes', 'Compettion created succesfully');
    }

    public function update(Request $request, string $id)
    {
        $competition = Competition::findOrFail($id);
    
        $request->validate([
            'team1_id' => ['required'],
            'team2_id' => ['required'],
            'team1_score' => ['required'],
            'team2_score' => ['required'],
        ]);
    
        $competition->team1_id = $request->input('team1_id');
        $competition->team2_id = $request->input('team2_id');
        $competition->team1_score = $request->input('team1_score');
        $competition->team2_score = $request->input('team2_score');


        // Point assignation to the teams

        // Determines if the outcome is a tie or not

        if ($competition->team1_score > $competition->team2_score) {
            // The score of team 1 is higher, so make that the winning team (and the other the losing one)
            $winnerTeam = $competition->team1;
            $losingTeam = $competition->team2;
        } 
        else if ($competition->team1_score < $competition->team2_score) {
            // Same as above one, but reversed.
            $winnerTeam = $competition->team2;
            $losingTeam = $competition->team1;
        } 
        else {
            // Both scores must be equal at this point, so it's a tie
            $winnerTeam = null;
        }
    
        // Update points for the teams
        if ($winnerTeam) {
            $winnerTeam->points += 3;
            $winnerTeam->save();

        } 
        else {
            // The team winningteam isn't set, so the game is a tie.v Assign 1cpoint to each team
            $competition->team1->points += 1;
            $competition->team1->save();
    
            $competition->team2->points += 1;
            $competition->team2->save();
        }

    
        // Send the user back to the view
        $competitions = Competition::all();
        if (Auth::user()->is_admin) {
            $competition->save();
            return view('admin.competitions.index')
                ->with('success', 'Competition updated successfully')
                ->with('competitions', $competitions);
        } else {
            return view('competitions.index')->with('competitions', $competitions);
        }
    }

    public function autocreate() {
        $competitions = Competition::all();

        if(Auth::user()->is_admin) {
            $teams = Team::all();
            $generatedCompetitions = [];
            $faker = Faker::create();
        
            foreach ($teams as $team1) {
                foreach ($teams as $team2) {
                    if ($team1->id != $team2->id) {
                        $competition = new Competition();
                        $competition->team1_id = $team1->id;
                        $competition->team2_id = $team2->id;
                        $competition->team1_score = 0;
                        $competition->team2_score = 0;
                        $competition->field = $faker->word;
                        $competition->referee_id = User::inRandomOrder()->first()->id;
                        $competition->time = Carbon::now()->addDays(rand(1, 30));
                        $competition->save();
        
                        $generatedCompetitions[] = $competition;
                    }
                }
            }
        
            // Shuffling the generated competitions and taking the first 5
            $randomCompetitions = collect($generatedCompetitions)->shuffle()->take(10);
        
            // Hier instellen we $competitions op de willekeurig gegenereerde competities
            $competitions = $randomCompetitions;
        }
        
        // Hieronder ga je naar je view, ongeacht of de gebruiker een beheerder is of niet
        return view('admin.competitions.index', compact('competitions'));
        
        
    }

    public function destroyall() {


        if(Auth::user()->is_admin) {
            Competition::truncate();
            Competition::where('id', '>=', 0)->delete();
            $competitions = Competition::all();
            return view('admin.competitions.index')->with('competitions', $competitions);
        }
        else {
            return view('competitions.index');
        }

    }
}
