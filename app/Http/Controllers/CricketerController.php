<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cricketer;

class CricketerController extends Controller
{
    public function index(){
        return view('cricketer.index');
    }
    public function allData(){
        $data = Cricketer::orderBy('id','DESC')->get();
        return response()->json($data);
    }
    public function store(Request $r)
    {
        $r->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        Cricketer::create([
            'name' => $r->input('name'),
            'email' => $r->input('email'),
         ]);
    }
    public function edit($id){
        $data = Cricketer::find($id);
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
        $data = Cricketer::destroy($id);
        return response()->json($data);
    }
}
