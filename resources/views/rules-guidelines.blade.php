@extends('layouts.' . (auth()->user()->role ?? 'student'))

@section('page-title', 'Rules & Guidelines')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center mb-4">
            <i class="fas fa-book text-uc-green text-2xl mr-3"></i>
            <h1 class="text-3xl font-bold text-uc-green">University Registrar Rules & Guidelines</h1>
        </div>
        <p class="text-gray-600 text-lg">Welcome to the Grade Completion Portal system. Please review the following rules and guidelines.</p>
    </div>

    <!-- About INC Grades Section -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold text-uc-green mb-4 flex items-center">
            <i class="fas fa-info-circle mr-3"></i>
            About Completion of Requirements for Removal of Incomplete (INC) Grades
        </h2>
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded">
            <p class="text-gray-800 font-medium">
                All INC Grade not completed within a term shall be converted to NG (No Grade) with Zero (0) credit.
            </p>
        </div>
    </div>

    <!-- Rules for Grade Completion Section -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold text-blue-600 mb-4 flex items-center">
            <i class="fas fa-clipboard-list mr-3"></i>
            Rules for Grade Completion of Requirements
        </h2>
        
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
            <p class="text-blue-800 font-semibold mb-2">The following shall be observed for completion of requirements for removal of INC Grade:</p>
        </div>

        <div class="space-y-4">
            <div class="flex items-start space-x-3">
                <div class="flex-shrink-0 w-6 h-6 bg-uc-green rounded-full flex items-center justify-center mt-1">
                    <span class="text-white text-sm font-bold">1</span>
                </div>
                <p class="text-gray-700 leading-relaxed">
                    <strong>Courses of all programs,</strong> with an INC Grade may be completed within one term after an INC Grade.
                </p>
            </div>

            <div class="flex items-start space-x-3">
                <div class="flex-shrink-0 w-6 h-6 bg-uc-green rounded-full flex items-center justify-center mt-1">
                    <span class="text-white text-sm font-bold">2</span>
                </div>
                <p class="text-gray-700 leading-relaxed">
                    <strong>Thesis 1, Dissertation Writing 1, and Project Study 1</strong> may be completed within one term after an INC Grade.
                </p>
            </div>

            <div class="flex items-start space-x-3">
                <div class="flex-shrink-0 w-6 h-6 bg-uc-green rounded-full flex items-center justify-center mt-1">
                    <span class="text-white text-sm font-bold">3</span>
                </div>
                <p class="text-gray-700 leading-relaxed">
                    <strong>Thesis Research Writing 1 of BS Architecture</strong> may be completed one school year after enrollment term.
                </p>
            </div>

            <div class="flex items-start space-x-3">
                <div class="flex-shrink-0 w-6 h-6 bg-uc-green rounded-full flex items-center justify-center mt-1">
                    <span class="text-white text-sm font-bold">4</span>
                </div>
                <p class="text-gray-700 leading-relaxed">
                    All INC Grade not completed within a term shall be converted to <strong>NG (No Grade) with Zero (0) credit.</strong>
                </p>
            </div>

            <div class="flex items-start space-x-3">
                <div class="flex-shrink-0 w-6 h-6 bg-uc-green rounded-full flex items-center justify-center mt-1">
                    <span class="text-white text-sm font-bold">5</span>
                </div>
                <p class="text-gray-700 leading-relaxed">
                    <strong>Thesis 2, Dissertation Writing 2, and Project Study 2</strong> shall be defended within the term the student is enrolled in the said course.
                </p>
            </div>
        </div>
    </div>

    <!-- Additional Information Section -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold text-uc-green mb-4 flex items-center">
            <i class="fas fa-exclamation-triangle mr-3"></i>
            Important Notes
        </h2>
        <div class="space-y-4">
            <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded">
                <h3 class="font-bold text-red-800 mb-2">Grade Conversion Policy</h3>
                <p class="text-red-700">
                    Students must complete all requirements within the specified timeframe to avoid automatic conversion to NG (No Grade).
                </p>
            </div>
            
            <div class="bg-green-50 border-l-4 border-green-400 p-4 rounded">
                <h3 class="font-bold text-green-800 mb-2">Grade Completion Application</h3>
                <p class="text-green-700">
                    Students must submit a Grade Completion Application through the registrar system to request completion of INC grades.
                </p>
            </div>
            
            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded">
                <h3 class="font-bold text-blue-800 mb-2">Faculty Responsibility</h3>
                <p class="text-blue-700">
                    Faculty members are responsible for evaluating and approving grade completion requests within the academic guidelines.
                </p>
            </div>
        </div>
    </div>

    <!-- Contact Information Section -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold text-uc-green mb-4 flex items-center">
            <i class="fas fa-phone mr-3"></i>
            Contact Information
        </h2>
        <div class="grid md:grid-cols-2 gap-6">
            <div class="bg-uc-bg border border-uc-green rounded-lg p-4">
                <h3 class="font-bold text-uc-green mb-2">Registrar Office</h3>
                <p class="text-gray-700 mb-1"><i class="fas fa-map-marker-alt w-4 mr-2"></i>University of the Cordilleras</p>
                <p class="text-gray-700 mb-1"><i class="fas fa-phone w-4 mr-2"></i>(074) 442-3316</p>
                <p class="text-gray-700"><i class="fas fa-envelope w-4 mr-2"></i>registrar@uc.edu.ph</p>
            </div>
            
            <div class="bg-uc-bg border border-uc-green rounded-lg p-4">
                <h3 class="font-bold text-uc-green mb-2">Office Hours</h3>
                <p class="text-gray-700 mb-1"><i class="fas fa-clock w-4 mr-2"></i>Monday - Friday: 8:00 AM - 5:00 PM</p>
                <p class="text-gray-700 mb-1"><i class="fas fa-clock w-4 mr-2"></i>Saturday: 8:00 AM - 12:00 PM</p>
                <p class="text-gray-700"><i class="fas fa-times w-4 mr-2"></i>Sunday: Closed</p>
            </div>
        </div>
    </div>

    <!-- Footer Note -->
    <div class="bg-uc-green text-white rounded-lg shadow-md p-6 text-center">
        <p class="text-lg font-semibold mb-2">
            <i class="fas fa-university mr-2"></i>
            University of the Cordilleras
        </p>
        <p class="text-green-100">
            For any questions or clarifications regarding these rules and guidelines, please contact the Registrar Office.
        </p>
    </div>
</div>
@endsection
