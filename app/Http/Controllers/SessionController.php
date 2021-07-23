<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index(Request $request){
    	echo json_encode($request->session()->all()); // output all session
    	return view('session');
    }
    // store data in the session 
    public function setSingle(Request $request){
    	//$request->session()->put('name','Moe Lay'); //store data in the session using put method
    	session(['name' => 'Ei Lay']); //store data in the session using session helper
    	return redirect('/')->with('status','Set single session successfully');
    }
    // get data in the session 
    public function getSingle(Request $request){
    	//$name = $request->session()->get('name');
    	$name = session('age');
    	return redirect('/')->with('status',$name);
    }
    // delete data in the session
    public function deleteSession(Request $request){
    	$request->session()->flush();
    	return view('session');
    }

    // set multiple data in the session
    public function setMultiple(Request $request){
    	$request -> session() -> put(['name'=>'Mya Lay', 'age'=>24, 'Nationality' =>'Burmese']);
    	return view('session');
    }
}
