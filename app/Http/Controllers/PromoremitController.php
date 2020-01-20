<?php

namespace App\Http\Controllers;

use App\promoremit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PromoremitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['promoremit'] = promoremit::paginate(10);

        //return response()->json($datos);
        //echo json_encode($datos);

        return view('promoremit.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('promoremit.crear');
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
     * @param  \App\promoremit  $promoremit
     * @return \Illuminate\Http\Response
     */
    public function show(promoremit $promoremit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\promoremit  $promoremit
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $promoremit = promoremit::findOrFail($id);

        echo json_encode($promoremit);
        // compact() crea un conjunto de informacino a traves de una variable
        return view('promoremit.editar', compact('promoremit'));
        
        //return response()->json($promoremit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\promoremit  $promoremit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, promoremit $promoremit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\promoremit  $promoremit
     * @return \Illuminate\Http\Response
     */
    public function destroy(promoremit $promoremit)
    {
        //
    }
}
