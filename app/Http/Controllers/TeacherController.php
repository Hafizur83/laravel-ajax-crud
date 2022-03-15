<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;

class TeacherController extends Controller
{
    public function index(){
        return view('teacher.index');
    }
    public function allData(){
        $data = Teacher::orderBy('id','DESC')->get();
        return response()->json($data);
    }
    public function store(Request $r)
    {
        $r->validate([
            'name' => 'required',
            'cat_id' => 'required',
            'gender' => 'required',
        ],[
            'cat_id.required'=>'The Post type filed is required'
        ]);
        Teacher::create([
            'name' => $r->input('name'),
            'cat_id' => $r->input('cat_id'),
            'gender' => $r->input('gender'),
         ]);
    }
    public function edit($id){
        $data = Teacher::find($id);
        return response()->json($data);
    }
    public function update(Request $r, $id)
    {
        $r->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        Cricketer::find($id)->update([
            'name' => $r->input('name'),
            'email' => $r->input('email'),
        ]);
    }
    public function destroy($id)
    {
        $data = Teacher::destroy($id);
        return response()->json($data);
    }
}
