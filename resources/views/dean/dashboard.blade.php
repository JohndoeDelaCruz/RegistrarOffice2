@extends('layouts.dean')

@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">
    

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="bg-blue-100 p-3 rounded-full">
                    <i class="fas fa-users text-blue-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-800">Students</h3>
                    <p class="text-2xl font-bold text-blue-600">-</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="bg-green-100 p-3 rounded-full">
                    <i class="fas fa-chalkboard-teacher text-green-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-800">Faculty</h3>
                    <p class="text-2xl font-bold text-green-600">-</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="bg-purple-100 p-3 rounded-full">
                    <i class="fas fa-file-signature text-purple-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-800">Signatures</h3>
                    <p class="text-2xl font-bold text-purple-600">-</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="bg-orange-100 p-3 rounded-full">
                    <i class="fas fa-bullhorn text-orange-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-800">Announcements</h3>
                    <p class="text-2xl font-bold text-orange-600">-</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Quick Actions</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <a href="{{ route('dean.digital-signature') }}" class="flex items-center p-4 bg-purple-50 hover:bg-purple-100 rounded-lg transition-colors duration-200">
                <i class="fas fa-signature text-purple-600 text-xl mr-3"></i>
                <span class="font-medium text-gray-800">Manage Digital Signatures</span>
            </a>
            
            <a href="{{ route('dean.announcement') }}" class="flex items-center p-4 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors duration-200">
                <i class="fas fa-bullhorn text-blue-600 text-xl mr-3"></i>
                <span class="font-medium text-gray-800">Post Announcement</span>
            </a>
            
            <a href="{{ route('dean.profile') }}" class="flex items-center p-4 bg-green-50 hover:bg-green-100 rounded-lg transition-colors duration-200">
                <i class="fas fa-user text-green-600 text-xl mr-3"></i>
                <span class="font-medium text-gray-800">Update Profile</span>
            </a>
        </div>
    </div>
