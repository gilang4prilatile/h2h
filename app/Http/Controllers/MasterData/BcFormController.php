<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Requests\StoreBcFormRequest;
use App\Http\Requests\UpdateBcFormRequest;
use App\Models\BcForm;

class BcFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreBcFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBcFormRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BcForm  $bcForm
     * @return \Illuminate\Http\Response
     */
    public function show(BcForm $bcForm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BcForm  $bcForm
     * @return \Illuminate\Http\Response
     */
    public function edit(BcForm $bcForm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBcFormRequest  $request
     * @param  \App\Models\BcForm  $bcForm
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBcFormRequest $request, BcForm $bcForm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BcForm  $bcForm
     * @return \Illuminate\Http\Response
     */
    public function destroy(BcForm $bcForm)
    {
        //
    }
}
