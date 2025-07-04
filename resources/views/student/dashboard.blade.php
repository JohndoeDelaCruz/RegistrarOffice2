@extends('layouts.student')

@section('page-title', 'Student Dashboard')

@section('content')
@isset($student)
    <!-- Welcome Card -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <h2 class="text-xl font-semibold text-uc-green mb-2">Welcome, {{ $student->name }}!</h2>
        <p class="text-gray-600 mb-2">{{ $student->course }} - {{ $student->track }}</p>
        <p class="text-sm text-gray-500">Student ID: {{ $student->student_id }}</p>
    </div>

    <!-- Track Information -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Track Information</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="text-sm font-medium text-gray-600">Course</label>
                <p class="text-gray-800">{{ $student->course }}</p>
            </div>
            <div>
                <label class="text-sm font-medium text-gray-600">Specialization Track</label>
                <p class="text-gray-800">{{ $student->track }}</p>
            </div>
            <div>
                <label class="text-sm font-medium text-gray-600">Student ID</label>
                <p class="text-gray-800">{{ $student->student_id }}</p>
            </div>
            <div>
                <label class="text-sm font-medium text-gray-600">Email</label>
                <p class="text-gray-800">{{ $student->email }}</p>
            </div>
        </div>
    </div>
@else
    <div class="bg-white rounded-lg shadow-sm p-6">
        <p class="text-gray-600">No student information available.</p>
    </div>
@endisset
@endsection
