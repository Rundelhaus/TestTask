<?php

namespace App\Http\Controllers;

use App\Models\ScheduleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ScheduleItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return ScheduleItem[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response
     */
    public function index()
    {
        return ScheduleItem::all();
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
            'subject_id' => 'integer|required|exists:subject,id',
            'schedule_id' => 'integer|required|exists:schedule,id',
            'item_start' => 'date|required',
        ]);

        if ($validator->fails()) {
            return response($validator->messages(), 200);
        }

        $scheduleItem = ScheduleItem::create([
            'subject_id' => $request->subject_id,
            'schedule_id' => $request->schedule_id,
            'item_start' => $request->item_start,
        ]);

        return response()->json($scheduleItem)->setStatusCode(200, 'Successful schedule item creation');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|object
     */
    public function show(ScheduleItem $scheduleItem)
    {
        return response()->json($scheduleItem)->setStatusCode(200, 'Successful mark output');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|object
     */
    public function update(Request $request, ScheduleItem $scheduleItem)
    {
        $validator = Validator::make($request->all(), [
            'subject_id' => 'integer|exists:subject,id',
            'schedule_id' => 'integer|exists:schedule,id',
            'item_start' => 'date',
        ]);

        if ($validator->fails()) {
            return response($validator->messages(), 200);
        }

        $scheduleItem->update($request);

        return response()->json($scheduleItem)->setStatusCode(200, 'Successful schedule item update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ScheduleItem $scheduleItem)
    {
        $scheduleItem->delete();
        return response('Schedule item successfully deleted', 200);
    }
}
