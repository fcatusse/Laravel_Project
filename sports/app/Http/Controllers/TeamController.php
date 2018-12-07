<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use App\Player;
use App\Data;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::all();
        return view('admin/team/index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data_countries = Data::getCountries();
        return view('admin/team/create', compact('data_countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'country' => 'required',
            'matchs_won' => 'required',
            'matchs_lose' => 'required',
            'matchs_null' => 'required',
        ]);

        // Voir le model fillable
        Team::create(request()->all());
        $teams = new Team();
        $teams = Team::all();
        return view('admin/team/index', compact('teams'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $team = Team::find($id);
        $data_countries = Data::getCountries();
        return view('admin/team/edit', compact('team','data_countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'country' => 'required',
            'matchs_won' => 'required',
            'matchs_lose' => 'required',
            'matchs_null' => 'required',
        ]);
        $team = Team::find($id);
        $team->name = $request->name;
        $team->country = $request->country;
        $team->matchs_won = $request->matchs_won;
        $team->matchs_lose = $request->matchs_lose;
        $team->matchs_null = $request->matchs_null;
        $team->save();
        $teams = Team::all();
        return view('admin/team/index', compact('teams'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $team = Team::find($id);
        $team->delete();
        $teams = Team::all();
        return view('admin/team/index', compact('teams'));
    }

    /**
     * Display stats of a team.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function stats($id)
    {
        $players = Player::with('team')->find(4);
        dd($players->team->name);
    }

}
