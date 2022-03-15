<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catagory;
use Str;

class CatagoryController extends Controller
{
    public function index(){
        return view('catagory.index');
    }
    public function allData(){
        $data = Catagory::orderBy('id','DESC')->get();
        return response()->json($data);
    }
    public function store(Request $r)
    {
        $r->validate([
            'cat_name' => 'required',
        ],[
            'cat_name.required'=>'The Catagory name filed is required'
        ]);
         Catagory::create([
            'cat_name' => $r->input('cat_name'),
            'slug'=> Str::slug($r->input('cat_name'))
         ]);
         
    }
    public function edit($id){
        $data = Catagory::find($id);
        return response()->json($data);
    }
    public function update(Request $r, $id)
    {
        $r->validate([
            'cat_name' => 'required',
        ],[
            'cat_name.required'=>'The Catagory name filed is required'
        ]);
        Catagory::find($id)->update([
            'cat_name' => $r->input('cat_name'),
            'slug'=> Str::slug($r->input('cat_name'))
        ]);
    }
    public function destroy($id)
    {
        $data = Catagory::destroy($id);
        return response()->json($data);
    }
}
