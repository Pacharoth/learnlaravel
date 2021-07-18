<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    //list all course
    public function index(){
        return response(Course::paginate(5),200);
    }
    //store
    public function store(Request $request,$topic){
        $request->validate([
            'name'=>'required|string',
            'description'=>'string',
        ]);
        $course = Course::create([
            'topic_id'=>$topic,
            'user_id'=>Auth::id(),
            $request->all()
        ]);
        return response($course,200);
    }
    //list specific topic
    public function showCourseTopic($topic){
        $course = Course::where('topic_id',$topic)->with('user')->get();
        return response($course,200);
    }
    //delete all in that topic
    public function destroyCourseTopic($topic){
        $course = Course::where([
            ['topic_id','=',$topic],
            ['user_id','=',Auth::id()]
        ])->delete();
        return response($course,200);
    }
    //show specific course
    public function showSpecificCourse($topic,$acourse){
        $course= Course::where([
            ['topic_id','=',$topic],
            ['id','=',$acourse]
        ])->get();
        return response($course,200);
    }
    //update specific course
    public function updateSpecificCourse(Request $request,$topic,$acourse){
        $course = Course::where([
            ['topic_id','=',$topic],
            ['id','=',$acourse]
        ])->get();
        $course->update($request->all());
        return $course;
    }
    //delete specific course
    public function destroySpecificCourse($topic,$acourse){
        $course= Course::where([
            ['topic_id','=',$topic],
            ['id','=',$acourse]
        ])->delete();
        return response($course,200);
    }
    //get Owner Course
    public function getOwnerCourse(){
        return Course::where('user_id',Auth::id())->get();
    }
}
