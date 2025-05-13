<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::with('players')->get();
        return view('teams.index', compact('teams'));
    }

    public function create()
    {
        return view('teams.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:teams',
            'founded_year' => 'required|integer|min:1800|max:' . date('Y'),
        ]);

        Team::create($request->only('name', 'founded_year'));

        return redirect()->route('teams.index')->with('success', 'Team created.');
    }

    public function show(Team $team)
    {
        return view('teams.show', compact('team'));
    }

    public function edit(Team $team)
    {
        return view('teams.edit', compact('team'));
    }

    public function update(Request $request, Team $team)
    {
        $request->validate([
            'name' => 'required|string|unique:teams,name,' . $team->id,
            'founded_year' => 'required|integer|min:1800|max:' . date('Y'),
        ]);

        $team->update($request->only('name', 'founded_year'));

        return redirect()->route('teams.index')->with('success', 'Team updated.');
    }

    public function destroy(Team $team)
    {
        $team->delete();
        return redirect()->route('teams.index')->with('success', 'Team deleted.');
    }
}