<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class MarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Mark[]|\Illuminate\Database\Eloquent\Collection|Response
     */
    public function index()
    {
        return Mark::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse|Response|object
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'teacher_id' => 'integer|required|exists:teachers,id',
            'student_id' => 'integer|required|exists:students,id',
            'subject_id' => 'integer|required|exists:subjects,id',
            'mark' => 'integer|required|max:5|min:1'
        ]);

        if ($validator->fails()) {
            return response($validator->messages(), 200);
        }

        $mark = Mark::create([
            'teacher_id' => $request->teacher_id,
            'student_id' => $request->student_id,
            'subject_id' => $request->subject_id,
            'mark' => $request->mark
        ]);

        return response()->json($mark)->setStatusCode(200, 'Successful mark creation');
    }

    /**
     * Display the specified resource.
     *
     * @param Mark $mark
     * @return Mark|JsonResponse|object
     */
    public function show(Mark $mark)
    {
        return response()->json($mark)->setStatusCode(200, 'Successful mark output');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return bool|Application|ResponseFactory|JsonResponse|Response|object
     */
    public function update(Request $request, Mark $mark)
    {
        $validator = Validator::make($request->all(), [
            'teacher_id' => 'integer|exists:teachers,id',
            'student_id' => 'integer|exists:students,id',
            'subject_id' => 'integer|exists:subjects,id',
            'mark' => 'integer|max:5|min:1'
        ]);

        if ($validator->fails()) {
            return response($validator->messages(), 200);
        }

        $mark->update($request);
        return response()->json($mark)->setStatusCode(200, 'Successful mark update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Mark $mark)
    {
        $mark->delete();
        return response('Mark successfully deleted', 200);
    }
}
