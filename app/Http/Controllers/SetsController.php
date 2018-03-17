<?php
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Sets;
use Auth;
 
class SetsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sets = Auth::user()->sets()->get();
        return response()->json(['status' => 'success','result' => $sets]);
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required'
         ]);
        if(Auth::user()->sets()->create($request->all())){
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'fail']);
        }
 
    }
 
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sets = Sets::where('id', $id)->get();
        return response()->json($sets);
        
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'filled'
        ]);

        $set = Sets::find($id);
        if($set->fill($request->all())->save()){
           return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'failed']);
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Sets::destroy($id)){
            return response()->json(['status' => 'success']);
        }
    }
}