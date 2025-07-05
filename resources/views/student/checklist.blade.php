@extends('layouts.student')

@section('page-title', 'Checklist')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    <!-- Header Section -->
    <div class="border-b border-gray-200 pb-4 mb-6">
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Trimester Program Checklist</h1>
                <p class="text-gray-600">{{ $student->course }} - {{ $student->track }}</p>
                <p class="text-sm text-gray-500">Student ID: {{ $student->student_id }} | {{ $student->name }}</p>
            </div>
            <div class="text-right">
                <div class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                    Current: 3rd Year - 3rd Trimester
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
                            <h3 class="text-lg font-semibold text-gray-700 mb-3 flex items-center">
                                <span class="{{ $config['badge'] }} text-white rounded-full w-6 h-6 flex items-center justify-center text-sm mr-2">{{ $trimester }}</span>
                                {{ $trimester == 1 ? 'First' : ($trimester == 2 ? 'Second' : 'Third') }} Trimester
                                @if($year == 3 && $trimester == 3)
                                    <span class="ml-2 text-sm text-yellow-600">(Current)</span>
                                @endif
                            </h3>
                            
                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                                    <thead class="{{ $year == 3 && $trimester == 3 ? 'bg-yellow-50' : 'bg-gray-100' }}">
                                        <tr>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Subject Code</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Subject Description</th>
                                            <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Units</th>
                                            <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Grade</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($subjects as $index => $subject)
                                            <tr class="{{ $index % 2 == 1 ? 'bg-gray-50' : '' }}">
                                                <td class="px-4 py-2 text-sm {{ $year == 3 && $trimester == 3 ? 'font-medium' : '' }}">{{ $subject->code }}</td>
                                                <td class="px-4 py-2 text-sm">{{ $subject->description }}</td>
                                                <td class="px-4 py-2 text-center text-sm">{{ $subject->units }}</td>                                <td class="px-4 py-2 text-center text-sm">
                                    @if($subject->grade_info)
                                        @if(in_array($subject->grade_info->grade, ['NFE', 'INC']))
                                            <span class="px-2 py-1 bg-red-100 text-red-800 rounded text-xs font-medium">
                                                {{ $subject->grade_info->grade }}
                                            </span>
                                        @else
                                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs font-medium">
                                                {{ $subject->grade_info->grade }}
                                            </span>
                                        @endif
                                    @else
                                        <span class="text-gray-400 text-xs">Not graded</span>
                                    @endif
                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-right mt-2">
                                <span class="text-sm font-medium">Total Units: {{ collect($subjects)->sum('units') }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        @else
            <div class="text-center py-8">
                <p class="text-gray-500">No subjects found for your course and track.</p>
                <p class="text-sm text-gray-400 mt-2">Course: {{ $student->course ?? 'Not set' }}</p>
                <p class="text-sm text-gray-400">Track: {{ $student->track ?? 'Not set' }}</p>
            </div>
        @endif
    </div>
</div>
@endsection
