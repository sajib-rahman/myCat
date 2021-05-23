<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cat;
use Illuminate\Http\Request;
const CATS ='/cats';
class CatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cats = Cat::all();
        return view('cats.index', compact('cats'));
    } 
       

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('cats.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'date_of_birth' => 'required'
            ]);
            $cats = new Cat([
            'name' => $request->get('name'),
            'date_of_birth' => $request->get('date_of_birth')
        ]);
        $cats->save();
        return redirect(CATS)->with('success', 'Cat Details Saved!');
    }
    public function show(Cat $cat_id)
    {
        $cat = Cat::find($cat_id);
        return view('cats.show', compact('cat'));
    } 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function edit($cat_id)
    {
        $cats = Cat::find($cat_id);
        return view('cats.edit', compact('cats'));

    }
    public function update(Request $request, $cat_id)
    {
        $request->validate([
            'name' => 'required',
            'date_of_birth' => 'required'
        ]);
        $cats = Cat::find($cat_id);

        $cats->name = $request->get('name');
        $cats->date_of_birth = $request->get('date_of_birth');

        $cats->save();
        return redirect(CATS)->with('success', 'Cat Updated!');
    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function destroy($cat_id)
    {
        $cats = Cat::find($cat_id);
        $cats->delete();
        return redirect(CATS)->with('success', 'Cat Deleted!');
    } 
}
