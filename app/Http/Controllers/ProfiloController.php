<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profilo;
use Illuminate\Support\Facades\Auth;
use \Carbon;


class ProfiloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $profilo = Profilo::where('i_user_id', Auth::id())->first();
        $data['regioni'] = \App\Istat::getRegioneDDL();
        if ($profilo){
            $data['profilo'] = $profilo;
            $data['provinciaDDL'] = \App\Istat::getProvinciaDDL($profilo->t_regione_nascita);
            $data['comuneDDL'] = \App\Istat::getComuneDDL($profilo->t_provincia_nascita);
            $data['provinciaResDDL'] = \App\Istat::getProvinciaDDL($profilo->t_regione_res);
            $data['comuneResDDL'] = \App\Istat::getComuneDDL($profilo->t_provincia_res);
            return view('profilo.edit', $data); 
        } else {
            
            return view('profilo.create', $data); 
        }   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\StoreProfiloPost $request)
    {
        // request all
        $input = $request->except('_token');
        $profilo = new Profilo();
        foreach ($input as $k => $v) {
            $profilo->$k = $v;
        }
        $profilo->i_user_id = Auth::id();
        $profilo->d_privacy = Carbon::now();
        $profilo->save();
        return redirect()->route('profilo.edit', [$profilo])->with('success', __('generic.success.store'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Http\Requests\StoreProfiloPost $request, $id)
    {
        $input = $request->except('_token');
        $profilo = Profilo::find($id);
        foreach ($input as $k => $v) {
            $profilo->$k = $v;
        }
        $profilo->i_user_id = Auth::id();
        $profilo->save();
        return redirect()->route('profilo.edit', [$profilo])->with('success', __('generic.success.update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
