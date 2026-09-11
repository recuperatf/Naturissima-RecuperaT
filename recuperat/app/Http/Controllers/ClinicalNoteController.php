<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClinicalNoteController extends Controller
{
    public function create(){
    	return view('notes.create');
    }
    public function store(Request $request){
    	dd($request->all());
    }
}
