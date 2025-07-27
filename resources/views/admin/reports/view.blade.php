@extends('layouts.admin')

@section('page-title', 'Report Viewer')

@section('content')
<!-- Page Header -->
<div class="bg-white rounded-lg shadow-sm p-6 mb-6">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $report->name }}</h1>
            <p class="text-gray-600">{{ $report->description }}</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <div class="flex gap-2">
                <a href="{{ route('admin.reports.download', $report->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                    <i class="fas fa-download mr-2"></i>Download
                </a>
                <a href="{{ route('admin.reports') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Reports
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Report Info -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Report Information</h3>
        <div class="space-y-3">
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">Type:</span>
                <span class="text-sm font-medium text-gray-800">{{ $report->type }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">Format:</span>
                <span class="text-sm font-medium text-gray-800">{{ strtoupper($report->format) }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">Status:</span>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                    {{ $report->status === 'completed' ? 'bg-green-100 text-green-800' : 
                       ($report->status === 'processing' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                    {{ ucfirst($report->status) }}
                </span>
            </div>
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">File Size:</span>
                <span class="text-sm font-medium text-gray-800">{{ $report->file_size ?? 'N/A' }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">Generated:</span>
                <span class="text-sm font-medium text-gray-800">{{ $report->created_at->format('M j, Y g:i A') }}</span>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Parameters</h3>
        <div class="space-y-3">
            @if($report->parameters)
                @foreach($report->parameters as $key => $value)
                <div class="flex justify-between">
                    <span class="text-sm text-gray-600">{{ ucfirst(str_replace('_', ' ', $key)) }}:</span>
                    <span class="text-sm font-medium text-gray-800">{{ $value }}</span>
                </div>
                @endforeach
            @else
                <p class="text-sm text-gray-500">No parameters available</p>
            @endif
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
        <div class="space-y-2">
            @if($report->status === 'completed' && $report->file_path)
                <a href="{{ route('admin.reports.download', $report->id) }}" class="block w-full text-center bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                    <i class="fas fa-download mr-2"></i>Download Report
                </a>
            @endif
            <button onclick="window.print()" class="block w-full text-center bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors duration-200">
                <i class="fas fa-print mr-2"></i>Print Preview
            </button>
            <button onclick="confirmDelete()" class="block w-full text-center bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors duration-200">
                <i class="fas fa-trash mr-2"></i>Delete Report
            </button>
        </div>
    </div>
</div>

<!-- Report Content -->
<div class="bg-white rounded-lg shadow-sm p-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Report Content</h3>
    
    @if($report->status === 'completed' && $report->data)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Data Item
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Value
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($report->data as $key => $value)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ ucfirst(str_replace('_', ' ', $key)) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ is_array($value) ? json_encode($value) : $value }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @elseif($report->status === 'processing')
        <div class="text-center py-12">
            <i class="fas fa-spinner fa-spin text-4xl text-blue-600 mb-4"></i>
            <h3 class="text-lg font-medium text-gray-900">Report is being processed</h3>
            <p class="mt-2 text-sm text-gray-500">Please check back in a few moments...</p>
        </div>
    @elseif($report->status === 'failed')
        <div class="text-center py-12">
            <i class="fas fa-exclamation-triangle text-4xl text-red-600 mb-4"></i>
            <h3 class="text-lg font-medium text-gray-900">Report generation failed</h3>
            <p class="mt-2 text-sm text-gray-500">Please try generating the report again.</p>
        </div>
    @else
        <div class="text-center py-12">
            <i class="fas fa-file-alt text-4xl text-gray-400 mb-4"></i>
            <h3 class="text-lg font-medium text-gray-900">No report content available</h3>
            <p class="mt-2 text-sm text-gray-500">Report data is not available for viewing.</p>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
function confirmDelete() {
    if (confirm('Are you sure you want to delete this report? This action cannot be undone.')) {
        fetch('{{ route("admin.reports.delete", $report->id) }}', {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Report deleted successfully!');
                window.location.href = '{{ route("admin.reports") }}';
            } else {
                alert('Error deleting report: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(error => {
            alert('Error deleting report: ' + error.message);
        });
    }
}
</script>
@endpush
