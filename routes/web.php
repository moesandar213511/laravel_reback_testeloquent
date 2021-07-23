<?php

use Illuminate\Support\Facades\Route;
use App\User;
use App\Post;
use App\City;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// For single session
Route::get('/','SessionController@index');
Route::get('setSingle','SessionController@setSingle');
Route::get('getSingle','SessionController@getSingle');
Route::get('deleteSession','SessionController@deleteSession');

// For multiple session
Route::get('setMultiple','SessionController@setMultiple');
Route::get('getMultiple','SessionController@getMultiple');

Route::get('user/insert',function(){
	// $user  = new User();

	// $user->name = "Moe Lay";
	// $user->email = "moe@gmail.com";
	// $user->password = Hash::make('moe123');
	// $user->save();
	
	$pass = Hash::make('myaly123');
	User::create([ // associative array style
		'name' => 'Ei Lay',
		'email' => 'eilay@gmail.com',
		'password' => $pass
	]);
});

Route::get('post/insert',function(){
	Post::create([
		'user_id' => 1,
		'title' => "Title 4",
		'content' => "This is fifth post of our website"
	]);
});
Route::get('posts',function(){
	$posts = Post::all();
	foreach($posts as $post){
		echo "The author is ".$post->user->name."<br>";
		echo $post->title." and ".$post->content."<br><br>";
	}
});

// One to One relation (user and post table)
Route::get('post/{id}/show',function($id){
	$show = Post::find($id);
	echo $show->title." and ".$show->content;

	//dd($show->user);
	echo " => ".$show->user->name;
});

// hasMany relation (user and post table)
Route::get('user/{id}/posts',function($id){
	$userdata = User::where('id',$id)->firstOrFail();
	echo "The author is ".$userdata->name."<br>";

	//dd($userdata->posts);
	foreach($userdata->posts as $post){
		echo($post->title." and ".$post->content)."<br>";
	}

});

// hasOne relation (user, post and city)
Route::get('user/{id}/city', function($id){
	$user = User::where('id',$id)->firstOrFail();
	//dd($user);
	echo $user->name;
	echo " => ".($user->city->name);
});

// Many to Many relation (user, role and role_user)
Route::get('user/{id}/role',function($id){
	$user = User::findOrFail($id);
	echo $user->name." => ";
	foreach ($user->roles as $role) {
		echo $role->rank.", ";
	}
});

// hasManyThrough relation (city, post and user table)
Route::get('city/{id}/posts',function ($id){
	$city = City::findOrFail($id);
	echo $city->name."<br>";
	foreach ($city->posts as $post) {
	 	echo $post->title." and ".$post->content."<br>";
	 } 
});

// polymorphic relation (comment for user)
Route::get('user/{id}/comments',function($id){
	$user = User::findOrFail($id);
	echo $user->name." => ";

	foreach ($user->comments as $comment) {
		return $comment->content;
	}
});

// polymorphic relation (comment for post)
Route::get('post/{id}/comments',function ($id){
	$post = Post::find($id);
	echo $post->title." and ".$post->content."<br>";

	foreach ($post->comments as $comment) {
		echo "Feedback is ".$comment->content."<br>";
	}
});