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
                <p class="text-xs text-gray-500 mt-1">Academic Year 2024-2025</p>
            </div>
        </div>
    </div>

    <!-- Overall Progress -->
    <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mb-6">
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-center max-w-xs mx-auto">
            <div class="text-2xl font-bold text-blue-600">144</div>
            <div class="text-sm text-blue-800">Total Units</div>
        </div>
    </div>

    <!-- Trimester Program -->
    <div class="space-y-8">
        
        <!-- FIRST YEAR -->
        <div class="bg-gray-50 rounded-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-seedling text-green-500 mr-2"></i>
                FIRST YEAR (2022-2023)
            </h2>
            
            <!-- 1st Year - 1st Trimester -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-3 flex items-center">
                    <span class="bg-green-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm mr-2">1</span>
                    First Trimester
                </h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Subject Code</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Subject Description</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Units</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Grade</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr><td class="px-4 py-2 text-sm">GE 101</td><td class="px-4 py-2 text-sm">Understanding the Self</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                            <tr class="bg-gray-50"><td class="px-4 py-2 text-sm">GE 102</td><td class="px-4 py-2 text-sm">Mathematics in the Modern World</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                            <tr><td class="px-4 py-2 text-sm">GE 103</td><td class="px-4 py-2 text-sm">Purposive Communication</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                            <tr class="bg-gray-50"><td class="px-4 py-2 text-sm">CS 101</td><td class="px-4 py-2 text-sm">Introduction to Computing</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                            <tr><td class="px-4 py-2 text-sm">CS 102</td><td class="px-4 py-2 text-sm">Computer Programming 1</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                            <tr class="bg-gray-50"><td class="px-4 py-2 text-sm">PE 101</td><td class="px-4 py-2 text-sm">Physical Education 1</td><td class="px-4 py-2 text-center text-sm">2</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-right mt-2"><span class="text-sm font-medium">Total Units: 17</span></div>
            </div>

            <!-- 1st Year - 2nd Trimester -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-3 flex items-center">
                    <span class="bg-green-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm mr-2">2</span>
                    Second Trimester
                </h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Subject Code</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Subject Description</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Units</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Grade</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr><td class="px-4 py-2 text-sm">GE 104</td><td class="px-4 py-2 text-sm">Art Appreciation</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                            <tr class="bg-gray-50"><td class="px-4 py-2 text-sm">GE 105</td><td class="px-4 py-2 text-sm">Science, Technology and Society</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                            <tr><td class="px-4 py-2 text-sm">CS 103</td><td class="px-4 py-2 text-sm">Computer Programming 2</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                            <tr class="bg-gray-50"><td class="px-4 py-2 text-sm">CS 104</td><td class="px-4 py-2 text-sm">Discrete Mathematics</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                            <tr><td class="px-4 py-2 text-sm">CS 105</td><td class="px-4 py-2 text-sm">Web Development 1</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                            <tr class="bg-gray-50"><td class="px-4 py-2 text-sm">PE 102</td><td class="px-4 py-2 text-sm">Physical Education 2</td><td class="px-4 py-2 text-center text-sm">2</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-right mt-2"><span class="text-sm font-medium">Total Units: 17</span></div>
            </div>

            <!-- 1st Year - 3rd Trimester -->
            <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-3 flex items-center">
                    <span class="bg-green-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm mr-2">3</span>
                    Third Trimester
                </h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Subject Code</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Subject Description</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Units</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Grade</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr><td class="px-4 py-2 text-sm">GE 106</td><td class="px-4 py-2 text-sm">Ethics</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                            <tr class="bg-gray-50"><td class="px-4 py-2 text-sm">GE 107</td><td class="px-4 py-2 text-sm">The Contemporary World</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                            <tr><td class="px-4 py-2 text-sm">CS 106</td><td class="px-4 py-2 text-sm">Data Structures and Algorithms</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                            <tr class="bg-gray-50"><td class="px-4 py-2 text-sm">CS 107</td><td class="px-4 py-2 text-sm">Computer Architecture</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                            <tr><td class="px-4 py-2 text-sm">CS 108</td><td class="px-4 py-2 text-sm">Database Management Systems</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                            <tr class="bg-gray-50"><td class="px-4 py-2 text-sm">PE 103</td><td class="px-4 py-2 text-sm">Physical Education 3</td><td class="px-4 py-2 text-center text-sm">2</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-right mt-2"><span class="text-sm font-medium">Total Units: 17</span></div>
            </div>
        </div>

        <!-- SECOND YEAR -->
        <div class="bg-gray-50 rounded-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-tree text-green-600 mr-2"></i>
                SECOND YEAR (2023-2024)
            </h2>
            
            <!-- 2nd Year - 1st Trimester -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-3 flex items-center">
                    <span class="bg-blue-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm mr-2">1</span>
                    First Trimester
                </h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Subject Code</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Subject Description</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Units</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Grade</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr><td class="px-4 py-2 text-sm">GE 201</td><td class="px-4 py-2 text-sm">Readings in Philippine History</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                            <tr class="bg-gray-50"><td class="px-4 py-2 text-sm">CS 201</td><td class="px-4 py-2 text-sm">Object-Oriented Programming</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                            <tr><td class="px-4 py-2 text-sm">CS 202</td><td class="px-4 py-2 text-sm">Information Management</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                            <tr class="bg-gray-50"><td class="px-4 py-2 text-sm">CS 203</td><td class="px-4 py-2 text-sm">Operating Systems</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                            <tr><td class="px-4 py-2 text-sm">CS 204</td><td class="px-4 py-2 text-sm">Web Development 2</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                            <tr class="bg-gray-50"><td class="px-4 py-2 text-sm">PE 201</td><td class="px-4 py-2 text-sm">Physical Education 4</td><td class="px-4 py-2 text-center text-sm">2</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-right mt-2"><span class="text-sm font-medium">Total Units: 17</span></div>
            </div>

            <!-- 2nd Year - 2nd Trimester -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-3 flex items-center">
                    <span class="bg-blue-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm mr-2">2</span>
                    Second Trimester
                </h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Subject Code</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Subject Description</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Units</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Grade</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr><td class="px-4 py-2 text-sm">GE 202</td><td class="px-4 py-2 text-sm">Life and Works of Rizal</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                            <tr class="bg-gray-50"><td class="px-4 py-2 text-sm">CS 205</td><td class="px-4 py-2 text-sm">Computer Networks</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                            <tr><td class="px-4 py-2 text-sm">CS 206</td><td class="px-4 py-2 text-sm">Software Engineering 1</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                            <tr class="bg-gray-50"><td class="px-4 py-2 text-sm">CS 207</td><td class="px-4 py-2 text-sm">Human Computer Interaction</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                            <tr><td class="px-4 py-2 text-sm">CS 208</td><td class="px-4 py-2 text-sm">Systems Analysis and Design</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                            <tr class="bg-gray-50"><td class="px-4 py-2 text-sm">NSTP 201</td><td class="px-4 py-2 text-sm">National Service Training Program 1</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-right mt-2"><span class="text-sm font-medium">Total Units: 18</span></div>
            </div>

            <!-- 2nd Year - 3rd Trimester -->
            <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-3 flex items-center">
                    <span class="bg-blue-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm mr-2">3</span>
                    Third Trimester
                </h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Subject Code</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Subject Description</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Units</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Grade</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr><td class="px-4 py-2 text-sm">GE 203</td><td class="px-4 py-2 text-sm">Gender and Society</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                            <tr class="bg-gray-50"><td class="px-4 py-2 text-sm">CS 209</td><td class="px-4 py-2 text-sm">Advanced Database Systems</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                            <tr><td class="px-4 py-2 text-sm">CS 210</td><td class="px-4 py-2 text-sm">Information Security</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                            <tr class="bg-gray-50"><td class="px-4 py-2 text-sm">CS 211</td><td class="px-4 py-2 text-sm">Programming Languages</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                            <tr><td class="px-4 py-2 text-sm">CS 212</td><td class="px-4 py-2 text-sm">Project Management</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                            <tr class="bg-gray-50"><td class="px-4 py-2 text-sm">NSTP 202</td><td class="px-4 py-2 text-sm">National Service Training Program 2</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-right mt-2"><span class="text-sm font-medium">Total Units: 18</span></div>
            </div>
        </div>

        <!-- THIRD YEAR -->
        <div class="bg-gray-50 rounded-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-graduation-cap text-purple-600 mr-2"></i>
                THIRD YEAR (2024-2025)
            </h2>
            
            <!-- 3rd Year - 1st Trimester -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-3 flex items-center">
                    <span class="bg-purple-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm mr-2">1</span>
                    First Trimester
                </h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Subject Code</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Subject Description</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Units</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Grade</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if($student->track == 'Web Technology Track')
                                <tr><td class="px-4 py-2 text-sm">CS 301</td><td class="px-4 py-2 text-sm">Advanced Web Development</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                                <tr class="bg-gray-50"><td class="px-4 py-2 text-sm">CS 302</td><td class="px-4 py-2 text-sm">Frontend Frameworks</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                                <tr><td class="px-4 py-2 text-sm">CS 303</td><td class="px-4 py-2 text-sm">Backend Development</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                                <tr class="bg-gray-50"><td class="px-4 py-2 text-sm">CS 304</td><td class="px-4 py-2 text-sm">API Development & Integration</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                                <tr><td class="px-4 py-2 text-sm">CS 305</td><td class="px-4 py-2 text-sm">Web Performance Optimization</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                            @else
                                <tr><td class="px-4 py-2 text-sm">CS 301</td><td class="px-4 py-2 text-sm">Network Security Fundamentals</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                                <tr class="bg-gray-50"><td class="px-4 py-2 text-sm">CS 302</td><td class="px-4 py-2 text-sm">Ethical Hacking & Penetration Testing</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                                <tr><td class="px-4 py-2 text-sm">CS 303</td><td class="px-4 py-2 text-sm">Digital Forensics</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                                <tr class="bg-gray-50"><td class="px-4 py-2 text-sm">CS 304</td><td class="px-4 py-2 text-sm">Incident Response & Management</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                                <tr><td class="px-4 py-2 text-sm">CS 305</td><td class="px-4 py-2 text-sm">Risk Assessment & Compliance</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                            @endif
                            <tr class="bg-gray-50"><td class="px-4 py-2 text-sm">GE 301</td><td class="px-4 py-2 text-sm">Environmental Science</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-right mt-2"><span class="text-sm font-medium">Total Units: 18</span></div>
            </div>

            <!-- 3rd Year - 2nd Trimester -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-3 flex items-center">
                    <span class="bg-purple-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm mr-2">2</span>
                    Second Trimester
                </h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Subject Code</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Subject Description</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Units</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Grade</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if($student->track == 'Web Technology Track')
                                <tr><td class="px-4 py-2 text-sm">CS 306</td><td class="px-4 py-2 text-sm">Mobile Web Development</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                                <tr class="bg-gray-50"><td class="px-4 py-2 text-sm">CS 307</td><td class="px-4 py-2 text-sm">Progressive Web Apps</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                                <tr><td class="px-4 py-2 text-sm">CS 308</td><td class="px-4 py-2 text-sm">Web Analytics & SEO</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                                <tr class="bg-gray-50"><td class="px-4 py-2 text-sm">CS 309</td><td class="px-4 py-2 text-sm">E-commerce Development</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                                <tr><td class="px-4 py-2 text-sm">CS 310</td><td class="px-4 py-2 text-sm">Content Management Systems</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                            @else
                                <tr><td class="px-4 py-2 text-sm">CS 306</td><td class="px-4 py-2 text-sm">Advanced Network Security</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                                <tr class="bg-gray-50"><td class="px-4 py-2 text-sm">CS 307</td><td class="px-4 py-2 text-sm">Cybersecurity Management</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                                <tr><td class="px-4 py-2 text-sm">CS 308</td><td class="px-4 py-2 text-sm">Malware Analysis</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                                <tr class="bg-gray-50"><td class="px-4 py-2 text-sm">CS 309</td><td class="px-4 py-2 text-sm">Security Architecture Design</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                                <tr><td class="px-4 py-2 text-sm">CS 310</td><td class="px-4 py-2 text-sm">Wireless & Mobile Security</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                            @endif
                            <tr class="bg-gray-50"><td class="px-4 py-2 text-sm">GE 302</td><td class="px-4 py-2 text-sm">Social Issues and Professional Practice</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-right mt-2"><span class="text-sm font-medium">Total Units: 18</span></div>
            </div>

            <!-- 3rd Year - 3rd Trimester (CURRENT) -->
            <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-3 flex items-center">
                    <span class="bg-yellow-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm mr-2">3</span>
                    Third Trimester (Current)
                </h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                        <thead class="bg-yellow-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Subject Code</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Subject Description</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Units</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Grade</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if($student->track == 'Web Technology Track')
                                <tr><td class="px-4 py-2 text-sm font-medium">CS 311</td><td class="px-4 py-2 text-sm">Full Stack Development Project</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                                <tr class="bg-gray-50"><td class="px-4 py-2 text-sm font-medium">CS 312</td><td class="px-4 py-2 text-sm">Web Capstone Project 1</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                                <tr><td class="px-4 py-2 text-sm font-medium">CS 313</td><td class="px-4 py-2 text-sm">Advanced JavaScript & Frameworks</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                                <tr class="bg-gray-50"><td class="px-4 py-2 text-sm font-medium">CS 314</td><td class="px-4 py-2 text-sm">DevOps & Cloud Deployment</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                                <tr><td class="px-4 py-2 text-sm font-medium">CS 315</td><td class="px-4 py-2 text-sm">Web Development Internship Prep</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                            @else
                                <tr><td class="px-4 py-2 text-sm font-medium">CS 311</td><td class="px-4 py-2 text-sm">Advanced Penetration Testing</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                                <tr class="bg-gray-50"><td class="px-4 py-2 text-sm font-medium">CS 312</td><td class="px-4 py-2 text-sm">Security Capstone Project 1</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                                <tr><td class="px-4 py-2 text-sm font-medium">CS 313</td><td class="px-4 py-2 text-sm">Cloud Security & Compliance</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                                <tr class="bg-gray-50"><td class="px-4 py-2 text-sm font-medium">CS 314</td><td class="px-4 py-2 text-sm">Security Operations Center (SOC)</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                                <tr><td class="px-4 py-2 text-sm font-medium">CS 315</td><td class="px-4 py-2 text-sm">Cybersecurity Internship Prep</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                            @endif
                            <tr class="bg-gray-50"><td class="px-4 py-2 text-sm font-medium">GE 303</td><td class="px-4 py-2 text-sm">Entrepreneurship</td><td class="px-4 py-2 text-center text-sm">3</td><td class="px-4 py-2 text-center text-sm text-gray-400">-</td></tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-right mt-2"><span class="text-sm font-medium">Total Units: 18</span></div>
            </div>
        </div>

    </div>
</div>
@endsection
