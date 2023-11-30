{{-- @php
    print_r($students);
@endphp --}}
{{-- @include('partials._header') --}}
{{-- @include('partials._header',['title' => 'Student System']) --}}{{-- pwede ka magbato ng array --}}
{{-- @include('partials._header')
<ul> --}}
        {{-- @foreach ($students as $student)
           <li>{{$student->first_name}} {{$student->last_name}} {{$student->age}}</li>
        @endforeach --}}
        {{-- @foreach ($students as $student)
           <li>{{$student->gender}} {{$student->gender_count}}</li>
        @endforeach
    </ul>
@include('partials._footer') --}}
{{-- @dd(auth()->user()) --}}
{{-- @dd(auth()->user()->email) --}}{{-- ito yung user() yung user array na nasa function na store(); --}}
@include('partials._header')
@php 
    $array = array('templogo' => 'Reyniel Obut Web App');
@endphp
<x-nav :data="$array"/>{{-- this is how you call components. parang include din. pwede ka din magbato ng data--}}

    <header class="max-w-lg mx-auto mt-5">
        <a href="#">
            <h1 class="text-4x1 font-bold text-white text-center">Student List</h1>
        </a>
    </header>
    <section class="mt-5">
        <div class="overflow-x-auto relative">
            <table class="w-96 mx-auto text-sm text-left text-gray-500">
                <thead class="text-xs text gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="py-3 px-6">

                        </th>
                        <th scope="col" class="py-3 px-6">
                            First Name
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Last Name
                        </th>
                        <th scope="col" class="py-3 px-6">
                            gender
                        </th>
                        <th scope="col" class="py-3 px-6">
                            age
                        </th>
                        <th scope="col" class="py-3 px-6">
                            email
                        </th>
                        <th scope="col" class="py-3 px-6">

                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr class="bg-gray-800 border-b text-white">
                            @php
                                $default_profile = "https://api.dicebear.com/7.x/initials/svg?seed=".$student->first_name."-".$student->last_name;
                            @endphp
                            <td>
                                <img class="rounded-full mx-1 my-1" src="{{$student->student_image ? asset("storage/student/thumbnail/".$student->student_image) : $default_profile}}" alt="avatar">
                                
                            </td>
                            <td class="py-4 px-6">
                                {{$student->first_name}}
                            </td>
                            <td class="py-4 px-6">
                                {{$student->last_name}}
                            </td>
                            <td class="py-4 px-6">
                                {{$student->gender}}
                            </td>
                            <td class="py-4 px-6">
                                {{$student->age}}
                            </td>
                            <td class="py-4 px-6">
                                {{$student->email}}
                            </td>
                            <td class="py-4 px-6">
                                <a href="/student/{{$student->id}}" class="bg-sky-600 hover:bg-sky-400 text-white hover:text-gray-600 px-4 py-1 rounded">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mx-auto max-w-lg pt-6 p-4">
                {{$students->links()}}
            </div>
            
        </div>
    </section>
@include('partials._footer')