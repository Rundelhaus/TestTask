<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Subject[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response
     */
    public function index()
    {
        return Subject::all();
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
            'teacher_id' => 'integer|required|exists:teachers,id',
            'hours' => 'integer|required',
        ]);

        if ($validator->fails()) {
            return response($validator->messages(), 200);
        }

        $subject = Mark::create([
            'name' => $request->name,
            'teacher_id' => $request->teacher_id,
            'hours' => $request->hours,
        ]);

        return response()->json($subject)->setStatusCode(200, 'Successful subject creation');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|object
     */
    public function show(Subject $subject)
    {
        return response()->json($subject)->setStatusCode(200, 'Successful subject output');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|object
     */
    public function update(Request $request, Subject $subject)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'teacher_id' => 'integer|exists:teachers,id',
            'hours' => 'integer',
        ]);

        if ($validator->fails()) {
            return response($validator->messages(), 200);
        }

        $subject->update($request);

        return response()->json($subject)->setStatusCode(200, 'Successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return response('Subject successfully deleted', 200);
    }
}
