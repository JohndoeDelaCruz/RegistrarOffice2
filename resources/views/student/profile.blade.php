@extends('layouts.student')

@section('page-title', 'Profile')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Success Message -->
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6" role="alert">
            <div class="flex">
                <div class="py-1">
                    <svg class="fill-current h-6 w-6 text-green-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold">Success!</p>
                    <p class="text-sm">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Profile Header -->
    <div class="bg-white rounded-lg shadow-lg p-4 sm:p-6 mb-4 sm:mb-6">
        <div class="flex flex-col sm:flex-row items-center sm:items-start space-y-4 sm:space-y-0 sm:space-x-4 mb-4">
            <div class="w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center flex-shrink-0">
                <span class="text-xl sm:text-2xl font-bold text-white">{{ substr($student->name, 0, 1) }}</span>
            </div>
            <div class="text-center sm:text-left">
                <h1 class="text-xl sm:text-2xl font-bold text-gray-800">{{ $student->name }}</h1>
                <p class="text-gray-600">{{ $student->course }} - {{ $student->track }}</p>
                <p class="text-sm text-gray-500">Student ID: {{ $student->student_id }}</p>
            </div>
        </div>
    </div>

    <!-- Personal Information Form -->
    <div class="bg-white rounded-lg shadow-lg p-4 sm:p-6">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 space-y-2 sm:space-y-0">
            <h2 class="text-lg sm:text-xl font-bold text-gray-800">Personal Information</h2>
            <button id="editBtn" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition duration-200 text-sm sm:text-base">
                <i class="fas fa-edit mr-2"></i>Edit Profile
            </button>
        </div>

        <form id="profileForm" action="{{ route('student.profile.update') }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Basic Information -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-700 border-b border-gray-200 pb-2">Basic Information</h3>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <input type="text" name="name" value="{{ $student->name }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 disabled:bg-gray-100 disabled:cursor-not-allowed" 
                               disabled>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Student ID</label>
                        <input type="text" name="student_id" value="{{ $student->student_id }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed" 
                               disabled readonly>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <input type="email" name="email" value="{{ $student->email }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 disabled:bg-gray-100 disabled:cursor-not-allowed" 
                               disabled>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                        <input type="tel" name="phone" value="{{ $student->phone ?? '' }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 disabled:bg-gray-100 disabled:cursor-not-allowed" 
                               disabled>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                        <input type="date" name="date_of_birth" value="{{ $student->date_of_birth ?? '' }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 disabled:bg-gray-100 disabled:cursor-not-allowed" 
                               disabled>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                        <select name="gender" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 disabled:bg-gray-100 disabled:cursor-not-allowed" disabled>
                            <option value="">Select Gender</option>
                            <option value="Male" {{ ($student->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ ($student->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ ($student->gender ?? '') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                </div>

                <!-- Academic & Contact Information -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-700 border-b border-gray-200 pb-2">Academic & Contact Information</h3>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Course</label>
                        <input type="text" name="course" value="{{ $student->course }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed" 
                               disabled readonly>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Track</label>
                        <input type="text" name="track" value="{{ $student->track }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed" 
                               disabled readonly>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                        <textarea name="address" rows="3" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 disabled:bg-gray-100 disabled:cursor-not-allowed" 
                                  disabled>{{ $student->address ?? '' }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Emergency Contact Name</label>
                        <input type="text" name="emergency_contact_name" value="{{ $student->emergency_contact_name ?? '' }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 disabled:bg-gray-100 disabled:cursor-not-allowed" 
                               disabled>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Emergency Contact Phone</label>
                        <input type="tel" name="emergency_contact_phone" value="{{ $student->emergency_contact_phone ?? '' }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 disabled:bg-gray-100 disabled:cursor-not-allowed" 
                               disabled>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Relationship</label>
                        <input type="text" name="emergency_contact_relationship" value="{{ $student->emergency_contact_relationship ?? '' }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 disabled:bg-gray-100 disabled:cursor-not-allowed" 
                               placeholder="e.g., Parent, Guardian, Sibling"
                               disabled>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div id="formActions" class="justify-end space-x-3 mt-6 hidden">
                <button type="button" id="cancelBtn" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-200">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200">
                    <i class="fas fa-save mr-2"></i>Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript for Edit Functionality -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const editBtn = document.getElementById('editBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    const formActions = document.getElementById('formActions');
    const form = document.getElementById('profileForm');
    
    // Get all form inputs except readonly ones
    const editableInputs = form.querySelectorAll('input:not([readonly]), select, textarea');
    
    editBtn.addEventListener('click', function() {
        // Enable all editable inputs
        editableInputs.forEach(input => {
            input.disabled = false;
        });
        
        // Show form actions, hide edit button
        formActions.classList.remove('hidden');
        formActions.classList.add('flex');
        editBtn.classList.add('hidden');
    });
    
    cancelBtn.addEventListener('click', function() {
        // Disable all inputs
        editableInputs.forEach(input => {
            input.disabled = true;
        });
        
        // Reset form to original values
        form.reset();
        
        // Hide form actions, show edit button
        formActions.classList.add('hidden');
        formActions.classList.remove('flex');
        editBtn.classList.remove('hidden');
    });
});
</script>
@endsection
