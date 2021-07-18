<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;


class TopicController extends Controller
{

    //list item
    public function index(){
        return Topic::paginate(5);
    }
    //store
    public function store(Request $request){
        $request->validate([
            'name'=>'required|string',
            'description'=>'string',
        ]);

        $topic = Topic::create($request->all());
        return $topic;
    }

    //show specific
    public function show($id){
        return Topic::find($id);
    }
    //update topic
    public function update(Request $request,$id){
        $topic = Topic::find($id);
        $topic->update($request->all());
        return $topic;
    }
    //Delete Topic
    public function destroy($id){
        return Topic::destroy($id);
    }
}
