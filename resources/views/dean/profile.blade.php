@extends('layouts.dean')

@section('page-title', 'Profile')

@section('content')
<div class="space-y-6">

    <!-- Profile Form -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-6">
            <i class="fas fa-user-edit text-purple-600 mr-2"></i>
            Personal Information
        </h2>
        
        <form class="space-y-6">
            <!-- Profile Picture Section -->
            <div class="flex items-center space-x-6">
                <div class="w-24 h-24 bg-gradient-to-br from-dean-purple to-purple-700 rounded-full flex items-center justify-center">
                    <span class="text-3xl font-bold text-white">D</span>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Profile Picture</h3>
                    <p class="text-gray-600 text-sm mb-3">Upload a professional photo</p>
                    <button type="button" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors duration-200 text-sm">
                        Change Photo
                    </button>
                </div>
            </div>

            <!-- Basic Information -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">First Name *</label>
                    <input type="text" id="first_name" name="first_name" value="" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Enter first name">
                </div>
                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Last Name *</label>
                    <input type="text" id="last_name" name="last_name" value="" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Enter last name">
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                    <input type="email" id="email" name="email" value="" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Enter email address">
                </div>
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                    <input type="tel" id="phone" name="phone" value="" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Enter phone number">
                </div>
            </div>

            <!-- Professional Information -->
            <div class="border-t border-gray-200 pt-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Professional Information</h3>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <label for="employee_id" class="block text-sm font-medium text-gray-700 mb-2">Employee ID</label>
                        <input type="text" id="employee_id" name="employee_id" value="" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Enter employee ID">
                    </div>
                    <div>
                        <label for="department" class="block text-sm font-medium text-gray-700 mb-2">Department</label>
                        <input type="text" id="department" name="department" value="" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Enter department">
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <label for="position" class="block text-sm font-medium text-gray-700 mb-2">Position</label>
                        <input type="text" id="position" name="position" value="Dean" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Enter position">
                    </div>
                    <div>
                        <label for="office_location" class="block text-sm font-medium text-gray-700 mb-2">Office Location</label>
                        <input type="text" id="office_location" name="office_location" value="" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Enter office location">
                    </div>
                </div>
            </div>

            <!-- Address Information -->
            <div class="border-t border-gray-200 pt-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Address Information</h3>
                
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Street Address</label>
                    <input type="text" id="address" name="address" value="" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Enter street address">
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-4">
                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700 mb-2">City</label>
                        <input type="text" id="city" name="city" value="" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Enter city">
                    </div>
                    <div>
                        <label for="state" class="block text-sm font-medium text-gray-700 mb-2">State/Province</label>
                        <input type="text" id="state" name="state" value="" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Enter state">
                    </div>
                    <div>
                        <label for="zip_code" class="block text-sm font-medium text-gray-700 mb-2">ZIP Code</label>
                        <input type="text" id="zip_code" name="zip_code" value="" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Enter ZIP code">
                    </div>
                </div>
            </div>

            <!-- Emergency Contact -->
            <div class="border-t border-gray-200 pt-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Emergency Contact</h3>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <label for="emergency_contact_name" class="block text-sm font-medium text-gray-700 mb-2">Contact Name</label>
                        <input type="text" id="emergency_contact_name" name="emergency_contact_name" value="" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Enter emergency contact name">
                    </div>
                    <div>
                        <label for="emergency_contact_phone" class="block text-sm font-medium text-gray-700 mb-2">Contact Phone</label>
                        <input type="tel" id="emergency_contact_phone" name="emergency_contact_phone" value="" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Enter emergency contact phone">
                    </div>
                </div>

                <div>
                    <label for="emergency_contact_relationship" class="block text-sm font-medium text-gray-700 mb-2">Relationship</label>
                    <input type="text" id="emergency_contact_relationship" name="emergency_contact_relationship" value="" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Enter relationship">
                </div>
            </div>

            <!-- Form Actions -->
            <div class="border-t border-gray-200 pt-6">
                <div class="flex justify-end space-x-3">
                    <button type="button" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                        Cancel
                    </button>
                    <button type="submit" class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors duration-200">
                        Update Profile
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Account Settings -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-6">
            <i class="fas fa-cog text-purple-600 mr-2"></i>
            Account Settings
        </h2>
        
        <div class="space-y-4">
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                <div>
                    <h3 class="font-semibold text-gray-800">Change Password</h3>
                    <p class="text-gray-600 text-sm">Update your account password</p>
                </div>
                <button class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors duration-200">
                    Change
                </button>
            </div>
            
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                <div>
                    <h3 class="font-semibold text-gray-800">Two-Factor Authentication</h3>
                    <p class="text-gray-600 text-sm">Add an extra layer of security to your account</p>
                </div>
                <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors duration-200">
                    Enable
                </button>
            </div>
        </div>
    </div>

    
</div>
@endsection
