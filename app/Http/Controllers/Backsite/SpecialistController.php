<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;
use App\Http\Requests\Specialist\StoreSpecialistRequest;
use App\Http\Requests\Specialist\UpdateSpecialistRequest;
use App\Models\MasterData\Specialist;
use Illuminate\Http\Request;
use Auth;

class SpecialistController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $specialist = Specialist::orderBy('created_at', 'desc')->get();
        return view('pages.backsite.master-data.specialist.index', compact('specialist'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSpecialistRequest $request)
    {
        $data = $request->all();

        // re format before push to table
        $data['price'] = str_replace(',', '', $data['price']);
        $data['price'] = str_replace('IDR ', '', $data['price']);

        // store to database
        $specialist = Specialist::create($data);

        alert()->success('Success Message', 'Successfully added new specialist');
        return redirect()->route('backsite.specialist.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Specialist $specialist)
    {

        return view('pages.backsite.master-data.specialist.show', compact('specialist'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Specialist $specialist)
    {

        return view('pages.backsite.master-data.specialist.edit', compact('specialist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSpecialistRequest $request, Specialist $specialist)
    {
        // get all request from frontsite
        $data = $request->all();


        $data['price'] = str_replace(',', '', $data['price']);
        $data['price'] = str_replace('IDR ', '', $data['price']);

        // update to database
        $specialist->update($data);

        alert()->success('Success Message', 'Successfully updated specialist');
        return redirect()->route('backsite.specialist.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Specialist $specialist)
    {

        $specialist->forceDelete();

        alert()->success('Success Message', 'Successfully deleted specialist');
        return back();
    }
}
