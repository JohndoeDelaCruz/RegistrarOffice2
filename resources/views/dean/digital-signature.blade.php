@extends('layouts.dean')

@section('page-title', 'Digital Signature')

@section('content')
<div class="space-y-6">

    <!-- Signature Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Upload Signature -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">
                <i class="fas fa-upload text-purple-600 mr-2"></i>
                Upload Digital Signature
            </h2>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center">
                <i class="fas fa-cloud-upload-alt text-gray-400 text-4xl mb-4"></i>
                <p class="text-gray-600 mb-2">Drop your signature file here or click to browse</p>
                <p class="text-sm text-gray-500">Supported formats: PNG, JPG, PDF</p>
                <button class="mt-4 bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition-colors duration-200">
                    Choose File
                </button>
            </div>
        </div>

        <!-- Current Signature -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">
                <i class="fas fa-pen-fancy text-purple-600 mr-2"></i>
                Current Signature
            </h2>
            <div class="bg-gray-50 rounded-lg p-8 text-center border">
                <i class="fas fa-signature text-gray-400 text-4xl mb-4"></i>
                <p class="text-gray-600 mb-2">No signature uploaded</p>
                <p class="text-sm text-gray-500">Upload a digital signature to get started</p>
            </div>
            <div class="mt-4 flex space-x-3">
                <button class="flex-1 bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                    Preview
                </button>
                <button class="flex-1 bg-red-100 text-red-700 px-4 py-2 rounded-lg hover:bg-red-200 transition-colors duration-200">
                    Remove
                </button>
            </div>
        </div>
    </div>

    <!-- Pending Approvals -->
    <div class="bg-white rounded-lg shadow-md">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-800">
                <i class="fas fa-clock text-orange-600 mr-2"></i>
                Pending Signature Requests
            </h2>
            <p class="text-gray-600 mt-1">Documents awaiting your digital signature approval</p>
        </div>
        <div class="p-6">
            <div class="text-center py-12">
                <i class="fas fa-inbox text-gray-400 text-5xl mb-4"></i>
                <h3 class="text-lg font-semibold text-gray-600 mb-2">No Pending Requests</h3>
                <p class="text-gray-500">All signature requests have been processed</p>
            </div>
        </div>
    </div>

    <!-- Signature History -->
    <div class="bg-white rounded-lg shadow-md">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-800">
                <i class="fas fa-history text-blue-600 mr-2"></i>
                Signature History
            </h2>
            <p class="text-gray-600 mt-1">Recent documents you have signed</p>
        </div>
        <div class="p-6">
            <div class="text-center py-12">
                <i class="fas fa-file-signature text-gray-400 text-5xl mb-4"></i>
                <h3 class="text-lg font-semibold text-gray-600 mb-2">No Signature History</h3>
                <p class="text-gray-500">Your signature history will appear here</p>
            </div>
        </div>
    </div>

    <!-- Empty Content Notice -->
    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
        <div class="flex items-center">
            <i class="fas fa-info-circle text-yellow-600 text-xl mr-3"></i>
            <div>
                <h3 class="text-lg font-semibold text-yellow-800">Digital Signature System</h3>
                <p class="text-yellow-700 mt-1">This is an empty digital signature management template. Functionality for uploading, managing, and approving digital signatures will be implemented in future updates.</p>
            </div>
        </div>
    </div>
</div>
@endsection
