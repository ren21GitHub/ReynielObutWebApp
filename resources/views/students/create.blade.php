@include('partials._header')
<header class="max-w-lg mx-auto">
    <a href="#">
        <h1 class="text-4x1 font-bold text-white text-center">{{$title}}</h1>
    </a>
</header>
<main class="bg-white max-w-lg mx-auto p-8 my-10 rounded-lg shadow-2x1">
    <section>
        <h3 class="font-bold text-2x1">Fill up details.</h3>
        <p class="text-gray-600 pt-2"> <a href="/" class="text-purple-400 font-bold">Back</a></p>
    </section>
<section class="mt-10">
    <form action="/add/student" method="POST" class="flex flex-col" enctype="multipart/form-data">
        @csrf{{-- Cross-Site Request Forgery --}}
        <div class="mb-6 pt-3 rounded bg-gray-200">
            <label for="first_name" class="block text-gray-700 text-sm font-bold mb-2 ml-3">First Name</label>
            <input type="text" name="first_name" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-400 px-3" value={{old('first_name')}}>
            @error('first_name')
                <p class="text-red-500 text-xs p-1">
                    {{$message}}
                </p>
            @enderror
        </div>
        <div class="mb-6 pt-3 rounded bg-gray-200">
            <label for="last_name" class="block text-gray-700 text-sm font-bold mb-2 ml-3">Last Name</label>
            <input type="text" name="last_name" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-400 px-3" value={{old('last_name')}}>
            @error('last_name')
                <p class="text-red-500 text-xs p-1">
                    {{$message}}
                </p>
            @enderror
        </div>
        <div class="mb-6 pt-3 rounded bg-gray-200">
            <label for="gender" class="block text-gray-700 text-sm font-bold mb-2 ml-3">Gender</label>
            <select name="gender" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-400 px-3">
                <option value=""{{old('gender') == "" ? 'selected' : ''}}>Please Select Gender</option>
                <option value="male"{{old('gender') == "male" ? 'selected' : ''}}>Male</option>
                <option value="female"{{old('gender') == "female" ? 'selected' : ''}}>Female</option>
            </select>
            @error('gender')
                <p class="text-red-500 text-xs p-1">
                    {{$message}}
                </p>
            @enderror
        </div>
        <div class="mb-6 pt-3 rounded bg-gray-200">
            <label for="age" class="block text-gray-700 text-sm font-bold mb-2 ml-3">Age</label>
            <input type="number" name="age" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-400 px-3" value={{old('age')}}>
            @error('age')
                <p class="text-red-500 text-xs p-1">
                    {{$message}}
                </p>
            @enderror
        </div>
        <div class="mb-6 pt-3 rounded bg-gray-200">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2 ml-3">Email</label>
            <input type="email" name="email" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-400 px-3" value={{old('email')}}>
            @error('email')
                <p class="text-red-500 text-xs p-1">
                    {{$message}}
                </p>
            @enderror
        </div>
        <div class="mb-6 pt-3 rounded bg-gray-200">
            <label for="student_image" class="block text-gray-700 text-sm font-bold mb-2 ml-3">Student Image</label>
            <input type="file" name="student_image" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-400 px-3">
            @error('student_image')
                <p class="text-red-500 text-xs p-1">
                    {{$message}}
                </p>
            @enderror
        </div>
        <button class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 rounded shadow-lg hover:shadow-xl transition duration-200" type="submit">Add Student</button>
    </form>
</section>
</main>
@include('partials._footer')