@extends('layouts.dean')

@section('page-title', 'Calendar')

@section('content')
<div class="space-y-6">

    <!-- Calendar Header -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-bold text-gray-800 mb-2">
                    <i class="fas fa-calendar text-uc-green mr-2"></i>
                    Calendar
                </h2>
                <p class="text-gray-600">Manage your schedule and events</p>
            </div>
            <div class="bg-uc-green/10 border border-uc-green/20 rounded-lg px-4 py-2">
                <span class="text-sm font-medium text-uc-green">{{ now()->format('F j, Y') }}</span>
            </div>
        </div>
    </div>

    <!-- Empty State -->
    

</div>
@endsection
