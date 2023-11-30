<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;
// use Illuminate\Http\Request;
use Illuminate\Routing\RouteRegistrar;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//kinds of Route availables
// Route::get();//read
// Route::post();//create
// Route::put();//update
// Route::patch();
// Route::delete();//delete
// Route::options();

// Route::match(['get', 'post'], '/', function(){
//     return 'POST and GET is allowed';
// });

// Route::any('/', function(){
//     return 'Welcome';
// });

// Route::any('/', function(){
//     return view('welcome');
// });

// Route::view('/welcome', 'welcome');

// Route::get('/', function(){
//     return 'redirected';
// });
// Route::redirect('/welcome', '/');

// Route::get('/', function(){
//     return 'redirected';
// });
// Route::permanentRedirect('/welcome', '/');

//THIS WILL RESULT ERROR need to remove comment use Illuminate\Http\Request; and put comment to use GuzzleHttp\Psr7\Request;
// Route::get('/', function(){
//     return 'Welcome!';
// });
// Route::get('/users', function(Request $request){
//     dd($request);
//     return null;
// });

// Route::get('/', function(){
//     return 'Welcome!';
// });
// Route::get('/get-text', function(){
//     //200 is a kind of "http status code."
//     return response('Hello Reyniel', 200)
//                     ->header('Content-Type', 'text/plain');
// });

// Route::get('/', function(){
//     return 'Welcome!';
// });
// Route::get('/user/{id}/{group}', function($id, $group){//ang pagpasa ng parameters sa url is lalagyan lang ng open&close {} tapos ilalagay mo sa loob ng function with $ sign.
//     //200 is a kind of "http status code."
//     return response($id.'-'.$group, 200);
// });

//Paano magreturn ng json data
// Route::get('/request-json', function(){
//     return response()->json(['name' => 'Reyniel', 'age' => '28']);
// });

//Paano magdownload
// Route::get('/request-download', function(){
//     $path = public_path().'/sample.txt';
//     $name = 'sample.txt';
//     $headers = array(
//         'Content-type : application/text-plain',
//     );
//     return response()->download($path, $name, $headers);
// });

/* Route::get('/', function () {
    return view('welcome');
}); */

// Route::get('/users', [UserController::class, 'index']);
// Route::get('/users', [UserController::class, 'index'])->name('login'); //alias

// Route::get('/user/{id}', [UserController::class, 'show']);

// Route::get('/user/{id}', [UserController::class, 'show'])->middleware('auth'); // middleware

// Route::get('/students/{id}', [StudentController::class, 'show']);
// Route::get('/students', [StudentController::class, 'index']);



/* SAMPLE */
// Common routes naming
// index - Show all data or student
// show - Show a single data or student
// create - Show a form to add a new user
// store - store a data
// edit - Show form to a data
// update - update a data
// destroy - delete a data

// Route::get('/',[StudentController::class, 'index']);


//ITO YUNG NORMAL NA ROUTE
/* Route::get('/',[StudentController::class, 'index'])->middleware('auth');
Route::get('/register',[UserController::class, 'register']);
Route::get('/login',[UserController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login/process',[UserController::class, 'process']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/store', [UserController::class, 'store']);
Route::get('/add/student',[StudentController::class, 'create']);
Route::post('/add/student', [StudentController::class, 'store']);
Route::get('/student/{id}', [StudentController::class, 'show']);
Route::put('/student/{student}', [StudentController::class, 'update']);
Route::delete('/student/{student}', [StudentController::class, 'destroy']); */

//GANTO MAGGROUP NG ROUTE MAS MALINIS TINGNAN
Route::controller(StudentController::class)->group(function(){
    Route::get('/', 'index')->middleware('auth');
    Route::get('/add/student', 'create');
    Route::post('/add/student', 'store');
    Route::get('/student/{id}', 'show');
    Route::put('/student/{student}', 'update');
    Route::delete('/student/{student}', 'destroy');
});
Route::controller(UserController::class)->group(function(){
    Route::get('/register', 'register');
    Route::get('/login', 'login')->name('login')->middleware('guest');
    Route::post('/login/process', 'process');
    Route::post('/logout', 'logout');
    Route::post('/store', 'store');
});
