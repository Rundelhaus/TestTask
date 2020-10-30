<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return School[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response
     */
    public function index()
    {
        return School::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|object
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|required',
            'address' => 'string|required',
            'foundation_date' => 'date|required',
            'closing_date' => 'date',
            'students_number' => 'integer|required'
        ]);

        if ($validator->fails()) {
            return response($validator->messages(), 200);
        }

        $school = School::create([
            'name' => $request->name,
            'address' => $request->address,
            'foundation_date' => $request->foundation_date,
            'closing_date' => $request->closing_date,
            'students_number' => $request->students_number
        ]);

        return response()->json($school)->setStatusCode(200, 'Successful school creation');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|object
     */
    public function show(School $school)
    {
        return response()->json($school)->setStatusCode(200, 'Successful school output');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|object
     */
    public function update(Request $request, School $school)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'address' => 'string',
            'foundation_date' => 'date',
            'closing_date' => 'date',
            'students_number' => 'integer'
        ]);

        if ($validator->fails()) {
            return response($validator->messages(), 200);
        }

        $school->update($request);

        return response()->json($school)->setStatusCode(200, 'Successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        $school->delete();
        return response('School successfully deleted', 200);
    }
}
