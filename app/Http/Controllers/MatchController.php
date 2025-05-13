<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Games;
use App\Models\Match;
use Illuminate\Http\Request;
use Illuminate\Routing\Attributes\Middleware;


class MatchController extends Controller
{
    public function index()
    {
        $matches = Games::with(['homeTeam', 'awayTeam'])->get();
        return view('matches.index', compact('matches'));
    }

    public function create()
    {
        $teams = Team::all();
        return view('matches.create', compact('teams'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'home_team_id' => 'required|different:away_team_id|exists:teams,id',
            'away_team_id' => 'required|exists:teams,id',
            'match_date' => 'required|date',
        ]);

        Games::create($request->only('home_team_id', 'away_team_id', 'match_date'));

        return redirect()->route('matches.index')->with('success', 'Match scheduled.');
    }

    public function show(Games $match)
    {
        return view('matches.show', compact('match'));
    }

    public function edit(Games $match)
    {
        $teams = Team::all();
        return view('matches.edit', compact('match', 'teams'));
    }

    public function update(Request $request, Games $match)
    {
        $request->validate([
            'home_team_id' => 'required|different:away_team_id|exists:teams,id',
            'away_team_id' => 'required|exists:teams,id',
            'match_date' => 'required|date',
        ]);

        $match->update($request->only('home_team_id', 'away_team_id', 'match_date'));

        return redirect()->route('matches.index')->with('success', 'Match updated.');
    }

    public function destroy(Games $match)
    {
        $match->delete();
        return redirect()->route('matches.index')->with('success', 'Match deleted.');
    }
}