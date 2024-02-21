<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Competition;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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

 
}
