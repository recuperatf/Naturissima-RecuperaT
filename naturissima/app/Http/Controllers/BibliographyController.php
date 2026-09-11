<?php

namespace App\Http\Controllers;

use App\Bibliography;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class BibliographyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dir = '/';
        $recursive = false; // Get subdirectories also?
        $contents = collect(Storage::cloud()->listContents($dir, $recursive));
        //return $contents->where('type', '=', 'dir'); // directories
        $A_contents=$contents->where('type', '=', 'file'); // files
        return view('bibliography.bibliography_index')->with(compact('A_contents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bibliography  $bibliography
     * @return \Illuminate\Http\Response
     */
    public function show(Bibliography $bibliography)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bibliography  $bibliography
     * @return \Illuminate\Http\Response
     */
    public function edit(Bibliography $bibliography)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bibliography  $bibliography
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bibliography $bibliography)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bibliography  $bibliography
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bibliography $bibliography)
    {
        //
    }
}
