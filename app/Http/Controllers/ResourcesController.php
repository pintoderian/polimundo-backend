<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Resource;
use Illuminate\Http\Request;

class ResourcesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Resource::get();
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
            "person_id" => "required",
            "link" => "required",
            "other_link" => "required",
        ]);
        $person = Person::find($request->person_id);
        if(empty($person)){
            http_response_code(422);
            return [
                "message" => "error",
                "data" =>  "Person doesn't exist."
            ];
        }

        $resource = Resource::create($request->all());
        return [
            "message" => "success",
            "data" => $resource 
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
        return Resource::findOrFail($id);
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
            "person_id" => "required",
            "link" => "required",
            "other_link" => "required",
        ]);
        $person = Person::find($request->person_id);
        if(empty($person)){
            http_response_code(422);
            return [
                "message" => "error",
                "data" =>  "Person doesn't exist."
            ];
        }

        $resource = Resource::findOrFail($id);
        $resource->update($request->all());

        return [
            "message" => "success",
            "data" => $resource 
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
        $resource = Resource::findOrFail($id);
        $tmpResource = $resource;
        $resource->delete();

        return [
            "message" => $tmpResource->id. " removed."
        ];
    }
}
