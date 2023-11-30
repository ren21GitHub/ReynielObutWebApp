<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class StudentController extends Controller
{
    public function index()
    {
        //$data = Students::all();
        // $data = Students::where('id', 93)->get();
        /* $data = Students::where('first_name', 'like', '%ren%')->get();//lahat ng first_name na may ren igeget niya. good for filtering */
        // $data = Students::where('age', '=', 19)->get();
        // $data = Students::where('age', '<=', 19)->orderBy('first_name', 'asc')->get();// asc for ascending, desc for descending
        // $data = Students::where('age', '<=', 19)->orderBy('first_name', 'asc')->limit(7)->get();//limit() for limitation
        // $data = Students::where('gender', 'male')->get();
        // $data = DB::table('students')->select(DB::raw('count(*) as gender_count, gender'))->groupBy('gender')->get();
        // $data = Students::where('id', 101)->firstOrFail();//not existing kasi 100 lang yung id so not existing yung pang 101 na id kaya not found yung result
        /* $data = Students::where('id', 100)->firstOrFail()->get();//so dahil true yung sagot sa firstOrFail() kaya ginet natin yung lahat*/
        
        // return view('students.index',['students' => $data]);

        /* $data = array("students" => DB::table('students')->orderBy('created_at', 'desc')->simplePaginate(10));//or you can use also paginate() */
        $data = array("students" => DB::table('students')->orderBy('id', 'desc')->simplePaginate(10));//or you can use also paginate()
        return view('students.index', $data)->with('title', ''); 
    }

    public function show($id)
    {
        $data = Students::findOrFail($id);
        // dd($data);
        return view('students.edit',['student' => $data])->with('title', 'Edit Student');
    }

    public function store(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            "first_name" => ['required', 'min:4'],
            "last_name" => ['required', 'min:4'],
            "gender" => ['required', 'min:4'],
            "age" => ['required', 'min:2'],
            "email" => ['required', 'email' , Rule::unique('students', 'email')],//yung students tumutukoy sa students table sa database tapos yung column na email
        ]);
        if($request->hasFile('student_image')){//student_image ay galing sa name ng input
            $request->validate([
                "student_image" => 'mimes:jpeg,png,bmp,tiff | max:4096'
            ]);

            $filenameWithExtension = $request->file("student_image");

            $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);

            $extension = $request->file("student_image")->getClientOriginalExtension();

            $filenameToStore = $filename .'_'.time().'.'.$extension;

            $smallThumbnail = $filename .'_'.time().'.'.$extension;

            $request->file('student_image')->storeAs('public/student', $filenameToStore);

            $request->file("student_image")->storeAs('public/student/thumbnail', $smallThumbnail);

            $thumbNail = 'storage/student/thumbnail/' .$smallThumbnail;

            $this->createThumbnail($thumbNail, 150, 93);

            $validated['student_image'] = $filenameToStore;
        }
        
        Students::create($validated);//Students na model

        return redirect('/')->with('message', 'New student was added successfully!');
    }

    public function create()
    {
        return view('students.create')->with('title', 'Add New Student');
    }

    public function update(Request $request, Students $student)
    {
        // dd($request);//pang testing lang kung nagpapasa yung data
        $validated = $request->validate([
            "first_name" => ['required', 'min:4'],
            "last_name" => ['required', 'min:4'],
            "gender" => ['required'],
            "age" => ['required'],
            "email" => ['required', 'email'],
        ]);

        if($request->hasFile('student_image')){//student_image ay galing sa name ng input
            $request->validate([
                "student_image" => 'mimes:jpeg,png,bmp,tiff | max:4096'
            ]);

            $filenameWithExtension = $request->file("student_image");

            $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);

            $extension = $request->file("student_image")->getClientOriginalExtension();

            $filenameToStore = $filename .'_'.time().'.'.$extension;

            $smallThumbnail = $filename .'_'.time().'.'.$extension;

            $request->file('student_image')->storeAs('public/student', $filenameToStore);

            $request->file("student_image")->storeAs('public/student/thumbnail', $smallThumbnail);

            $thumbNail = 'storage/student/thumbnail/' .$smallThumbnail;

            $this->createThumbnail($thumbNail, 150, 93);

            $validated['student_image'] = $filenameToStore;
        }
        
        $student->update($validated);
            // return back()->with('message', 'Data was succesfully updated.');
        return redirect('/')->with('message', 'Data was succesfully updated.');
            // dd($request);
    }

    public function destroy(Students $student)
    {
        // dd($request);
        $student->delete();
        return redirect('/')->with('message', 'Deleted succesfully.');
    }

    public function createThumbnail($path, $width, $heigth)
    {
        $img = Image::make($path)->resize($width, $heigth, function($constraint){
            $constraint->aspectRatio();
        });
        $img->save($path);
    }
}
 