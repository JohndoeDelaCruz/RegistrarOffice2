@extends('layouts.faculty')

@section('page-title', 'Student Checklist - ' . $student->name)

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    <!-- Header Section -->
    <div class="border-b border-gray-200 pb-4 mb-6">
        <div class="flex justify-between items-start">
            <div>
                <div class="flex items-center gap-4 mb-2">
                    <a href="{{ route('faculty.students-checklist') }}" 
                       class="text-blue-500 hover:text-blue-600 transition-colors duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>Back to Students List
                    </a>
                </div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Student Checklist</h1>
                <p class="text-gray-600">{{ $student->course }} - {{ $student->track }}</p>
                <p class="text-sm text-gray-500">Student ID: {{ $student->student_id }} | {{ $student->name }}</p>
                <p class="text-sm text-gray-500">Email: {{ $student->email }}</p>
            </div>
            <div class="text-right">
                <div class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                    Faculty View
                </div>
                <p class="text-xs text-gray-500 mt-1">Academic Year {{ $currentAcademicYear->year ?? '2024-2025' }}</p>
            </div>
        </div>
    </div>

    <!-- Overall Progress -->
    <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mb-6">
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-center max-w-xs mx-auto">
            <div class="text-2xl font-bold text-blue-600">{{ $totalUnits }}</div>
            <div class="text-sm text-blue-800">Total Units</div>
        </div>
    </div>

    <!-- Trimester Program -->
    <div class="space-y-8">
        @if(isset($subjectsByYear) && count($subjectsByYear) > 0)
            @foreach($subjectsByYear as $year => $trimesters)
                @php
                    $yearConfig = [
                        1 => ['name' => 'FIRST YEAR', 'icon' => 'fas fa-seedling', 'color' => 'text-green-500', 'badge' => 'bg-green-500', 'academic_year' => '2022-2023'],
                        2 => ['name' => 'SECOND YEAR', 'icon' => 'fas fa-tree', 'color' => 'text-green-600', 'badge' => 'bg-blue-500', 'academic_year' => '2023-2024'],
                        3 => ['name' => 'THIRD YEAR', 'icon' => 'fas fa-graduation-cap', 'color' => 'text-purple-600', 'badge' => 'bg-purple-500', 'academic_year' => '2024-2025'],
                    ];
                    $config = $yearConfig[$year] ?? ['name' => 'YEAR ' . $year, 'icon' => 'fas fa-book', 'color' => 'text-gray-600', 'badge' => 'bg-gray-500', 'academic_year' => '2024-2025'];
                @endphp
                
                <div class="bg-gray-50 rounded-lg p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="{{ $config['icon'] }} {{ $config['color'] }} mr-2"></i>
                        {{ $config['name'] }} ({{ $config['academic_year'] }})
                    </h2>
                    
                    @foreach($trimesters as $trimester => $subjects)
                        <div class="mb-6">
                            <div class="flex items-center mb-3">
                                <span class="w-8 h-8 rounded-full {{ $config['badge'] }} text-white text-sm font-bold flex items-center justify-center mr-3">
                                    {{ $trimester }}
                                </span>
                                <h3 class="text-lg font-semibold text-gray-700">
                                    @if($trimester == 1) First Trimester
                                    @elseif($trimester == 2) Second Trimester  
                                    @elseif($trimester == 3) Third Trimester
                                    @else {{ $trimester }} Trimester
                                    @endif
                                </h3>
                            </div>
                            
                            <div class="overflow-x-auto">
                                <table class="w-full border border-gray-200 rounded-lg">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="text-left py-2 px-4 border-b font-medium text-gray-700">SUBJECT CODE</th>
                                            <th class="text-left py-2 px-4 border-b font-medium text-gray-700">SUBJECT DESCRIPTION</th>
                                            <th class="text-center py-2 px-4 border-b font-medium text-gray-700">UNITS</th>
                                            <th class="text-center py-2 px-4 border-b font-medium text-gray-700">GRADE</th>
                                            <th class="text-center py-2 px-4 border-b font-medium text-gray-700">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($subjects as $subject)
                                            <tr class="border-b border-gray-100">
                                                <td class="py-2 px-4 font-medium">{{ $subject->code }}</td>
                                                <td class="py-2 px-4">{{ $subject->description }}</td>
                                                <td class="py-2 px-4 text-center">{{ $subject->units }}</td>
                                                <td class="py-2 px-4 text-center">
                                                    @if($subject->grade_info)
                                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-sm font-medium">
                                                            {{ $subject->grade_info->grade }}
                                                        </span>
                                                    @else
                                                        <span class="px-2 py-1 bg-gray-100 text-gray-500 rounded text-sm">
                                                            Not Taken
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="py-2 px-4 text-center">
                                                    <button class="text-blue-500 hover:text-blue-600 text-sm font-medium">
                                                        <i class="fas fa-edit mr-1"></i>Edit Grade
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            @php
                                $trimesterUnits = collect($subjects)->sum('units');
                            @endphp
                            <div class="text-right mt-2 text-sm font-medium text-gray-600">
                                Total Units: {{ $trimesterUnits }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        @else
            <div class="text-center py-8">
                <i class="fas fa-exclamation-circle text-4xl text-gray-300 mb-4"></i>
                <p class="text-gray-500">No subjects found for this student.</p>
            </div>
        @endif
    </div>
</div>
@endsection
