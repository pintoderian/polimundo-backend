<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class PersonsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Person::with('resources')->get();
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
            "email" => "required|email|unique:persons,email",
            "name" => "required",
            "last_name" => "required",
        ]);
        $person = Person::create($request->all());

        return [
            "message" => "success",
            "data" => $person 
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Person::with('resources')->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "email" => "required|unique:persons,email,".$id,
            "name" => "required",
            "last_name" => "required",
        ]);
        $person = Person::findOrFail($id);
        $person->update($request->all());

        return [
            "message" => "success",
            "data" => $person 
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $person = Person::findOrFail($id);
        $tmpPerson = $person;
        $person->delete();

        return [
            "message" => $tmpPerson->name. " removed."
        ];
    }
}
