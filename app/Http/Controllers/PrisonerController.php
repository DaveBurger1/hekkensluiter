<?php

namespace App\Http\Controllers;

use App\Models\Prisoner;
use Illuminate\Http\Request;

class PrisonerController extends Controller
{
    public function index()
    {
        $prisoners = Prisoner::all();
        return view('app.prisoners.index', ['prisoners' => $prisoners]);
    }

    public function create()
    {
        return view('app.prisoners.edit');
    }

    public function store(Request $request)
    {
        $prisoner = Prisoner::find($request->id);
        $prisoner->profile->fill($request->all());
        $prisoner->profile->save();
        return to_route('prisoners.show', ['prisoner' => $prisoner]);
    }

    public function show(string $id)
    {
        $prisoner = Prisoner::find($id);
        return view('app.prisoners.show', ['profile' => $prisoner->profile, 'prisoner' => $prisoner]);
    }

    public function edit(string $id)
    {
        $prisoner = Prisoner::find($id);
        return view('app.prisoners.edit', ['profile' => $prisoner->profile, 'prisoner' => $prisoner]);
    }

    public function update(Request $request, string $id)
    {
        return to_route('prisoners.show', ['id' => $id]);
    }

    public function destroy(string $id)
    {
        Prisoner::find($id)->delete();
        return to_route('prisoners.index');
    }
}