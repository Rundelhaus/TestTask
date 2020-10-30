<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Schedule::all();
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
            'grade' => 'integer|required|min:1|max:11',
            'parallel' => 'required|size:1|string',
        ]);

        if ($validator->fails()) {
            return response($validator->messages(), 200);
        }

        $schedule = Mark::create([
            'grade' => $request->grade,
            'parallel' => $request->parallel,
        ]);

        return response()->json($schedule)->setStatusCode(200, 'Successful schedule creation');
    }

    /**
     * Display the specified resource.
     *
     * @param Schedule $schedule
     * @return void
     */
    public function show(Schedule $schedule)
    {
        return response()->json($schedule)->setStatusCode(200, 'Successful schedule output');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|object
     */
    public function update(Request $request, Schedule $schedule)
    {
        $validator = Validator::make($request->all(), [
            'grade' => 'integer|min:1|max:11',
            'parallel' => 'size:1|string',
        ]);

        if ($validator->fails()) {
            return response($validator->messages(), 200);
        }

        $schedule->update($request);

        return response()->json($schedule)->setStatusCode(200, 'Successful schedule creation');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return response('Mark successfully deleted', 200);
    }
}
