<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return User[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response
     */
    public function index()
    {
        return $users = User::all();
    }

    public function indexTeachers()
    {
        return $teachers = Teacher::all;
    }

    public function indexStudents()
    {
        return $students = Student::all;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|object
     */
    public function store(CreateUserRequest $request)
    {
        $validatedData = $request->validated();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'birth' => $request->birth,
            'sex' => $request->sex
        ]);

        switch($request->user_type){
            case 'student':
                $userT = Student::create([
                    'entry' => $request->entry,
                    'grade' => $request->grade,
                    'parallel' => $request->parallel,
                    'user_id' => $request->user_id,
                ]);
            case 'teacher':
                $userT = Teacher::create([
                    'employment_date' => $request->employment_date,
                    'layoff_date' => $request->layoff_date,
                    'user_id' => $request->user_id,
                ]);
        }

        return response()->json([$user, $userT])->setStatusCode(200,'Successful user creation');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return User
     */
    public function showUser(User $user)
    {
        return $user;
    }

    public function showTeacher(Teacher $teacher)
    {
        return $teacher;
    }

    public function showStudent(Student $student)
    {
        return $student;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|object
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $validator = $request->validated();

        if ($validator->fails()) {
            return response($validator->messages(), 200);
        }

        $user = User::find($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'birth' => $request->birth,
            'sex' => $request->sex
        ]);

        switch($request->user_type){
            case 'student':
                $userT = Student::query()->where(['user_id' => $user->id])->first();
                $userT->update([
                    'entry' => $request->entry,
                    'grade' => $request->grade,
                    'parallel' => $request->parallel,
                    'user_id' => $request->user_id,
                ]);

            case 'teacher':
                $userT = Teacher::query()->where(['user_id' => $user->id])->first();
                $userT->update([
                    'employment_date' => $request->employment_date,
                    'layoff_date' => $request->layoff_date,
                    'user_id' => $request->user_id,
                ]);
        }

        return response()->json([$user, $userT])->setStatusCode(200,'Successful user creation');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response('User successfully deleted', 200);
    }
}
