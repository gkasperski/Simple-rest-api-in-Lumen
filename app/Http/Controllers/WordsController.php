<?php
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Sets;
use App\Words;

use Auth;
 
class WordsController extends Controller
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
    public function index($id)
    {
        try {
            $words = Words::where('set_id', $id)->get();
            return response()->json(['status' => 'success','result' => $words]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'fail']);

        }
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
            'word' => 'required',
            'translation' => 'required',
            'set_id' => 'required'
         ]);
        if(Words::create($request->all())){
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
        $word = Words::where('id', $id)->get();
        return response()->json($word);
        
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
            'word' => 'filled',
            'translation' => 'filled'
        ]);

        $word = Words::find($id);
        if($word->fill($request->all())->save()){
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
        if(Words::destroy($id)){
            return response()->json(['status' => 'success']);
        }
    }
}