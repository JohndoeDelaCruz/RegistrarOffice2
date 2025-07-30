@extends('layouts.admin')

@section('page-title', 'Reports & Analytics')

@section('content')
<!-- Page Header -->
<div class="bg-white rounded-lg shadow-sm p-6 mb-6">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Reports & Analytics</h1>
            <p class="text-gray-600">Generate comprehensive reports and view system analytics</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <div class="flex gap-2">
                <button id="custom-report-btn" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors duration-200">
                    <i class="fas fa-chart-line mr-2"></i>Custom Report
                </button>
                <button id="export-all-btn" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors duration-200">
                    <i class="fas fa-download mr-2"></i>Export All
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Quick Report Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow-sm p-6 cursor-pointer hover:shadow-md transition-shadow duration-200">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Grade Analysis</h3>
                <p class="text-sm text-gray-600 mt-1">Completion & approval rates</p>
            </div>
            <div class="bg-green-100 p-3 rounded-full">
                <i class="fas fa-chart-bar text-green-600 text-xl"></i>
            </div>
        </div>
        <div class="mt-4">
            <button class="generate-quick-report-btn text-green-600 hover:text-green-800 text-sm font-medium" data-report-type="grade_completion">Generate Report →</button>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-sm p-6 cursor-pointer hover:shadow-md transition-shadow duration-200">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">System Performance</h3>
                <p class="text-sm text-gray-600 mt-1">Response times & errors</p>
            </div>
            <div class="bg-yellow-100 p-3 rounded-full">
                <i class="fas fa-tachometer-alt text-yellow-600 text-xl"></i>
            </div>
        </div>
        <div class="mt-4">
            <button class="generate-quick-report-btn text-yellow-600 hover:text-yellow-800 text-sm font-medium" data-report-type="system_usage">Generate Report →</button>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-sm p-6 cursor-pointer hover:shadow-md transition-shadow duration-200">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Dean Approvals</h3>
                <p class="text-sm text-gray-600 mt-1">Processing times & trends</p>
            </div>
            <div class="bg-purple-100 p-3 rounded-full">
                <i class="fas fa-stamp text-purple-600 text-xl"></i>
            </div>
        </div>
        <div class="mt-4">
            <button class="generate-quick-report-btn text-purple-600 hover:text-purple-800 text-sm font-medium" data-report-type="approval_tracking">Generate Report →</button>
        </div>
    </div>
</div>

<!-- Report Filters -->
<div class="bg-white rounded-lg shadow-sm p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Report Parameters</h3>
    <form id="report-form" method="POST" action="{{ route('admin.reports.generate') }}">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Report Type</label>
                <select name="report_type" id="report_type" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Select Report Type</option>
                    <option value="grade_completion">Grade Completion Report</option>
                    <option value="approval_tracking">Approval Tracking Report</option>
                    <option value="system_usage">System Usage Report</option>
                    <option value="security_audit">Security Audit Report</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Date Range</label>
                <select name="date_range" id="date_range" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="today">Today</option>
                    <option value="week">This Week</option>
                    <option value="month" selected>This Month</option>
                    <option value="quarter">This Quarter</option>
                    <option value="year">This Year</option>
                    <option value="custom">Custom Range</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Format</label>
                <select name="format" id="format" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="html" selected>HTML Document</option>
                    <option value="pdf">PDF Document</option>
                    <option value="excel">Excel Spreadsheet</option>
                    <option value="csv">CSV File</option>
                    <option value="json">JSON Data</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Actions</label>
                <div class="flex gap-2">
                    <button type="submit" id="generate-report-btn" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200 flex-1">
                        <i class="fas fa-chart-line mr-2"></i>Generate
                    </button>
                    <button type="button" id="preview-report-btn" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors duration-200">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Analytics Dashboard -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <!-- Grade Distribution Chart -->
    <div class="bg-white rounded-lg shadow-sm p-6" id="grade-distribution-card">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Grade Distribution</h3>
            <div class="flex gap-2">
                <button onclick="maximizeChart('grade-distribution')" class="text-gray-500 hover:text-gray-700 transition-colors duration-200" title="Maximize">
                    <i class="fas fa-expand-alt"></i>
                </button>
                <button onclick="downloadChart('grade-distribution')" class="text-gray-500 hover:text-gray-700 transition-colors duration-200" title="Download">
                    <i class="fas fa-download"></i>
                </button>
            </div>
        </div>
        <div class="h-64 bg-gray-50 rounded-lg p-4 flex items-center justify-center">
            <canvas id="gradeDistributionChart" width="400" height="400"></canvas>
        </div>
        <div class="mt-4 space-y-2">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <div class="w-3 h-3 bg-red-500 rounded-full mr-2"></div>
                    <span class="text-sm text-gray-600">INC (Incomplete)</span>
                </div>
                <span class="text-sm font-medium text-gray-800" id="inc-percentage">45%</span>
            </div>
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <div class="w-3 h-3 bg-yellow-500 rounded-full mr-2"></div>
                    <span class="text-sm text-gray-600">NFE (No Final Exam)</span>
                </div>
                <span class="text-sm font-medium text-gray-800" id="nfe-percentage">30%</span>
            </div>
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <div class="w-3 h-3 bg-orange-500 rounded-full mr-2"></div>
                    <span class="text-sm text-gray-600">NG (No Grade)</span>
                </div>
                <span class="text-sm font-medium text-gray-800" id="ng-percentage">25%</span>
            </div>
        </div>
    </div>
</div>

<!-- Chart Maximize Modal -->
<div id="chartModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-xl p-6 m-4 w-full max-w-6xl max-h-screen overflow-auto">
        <div class="flex justify-between items-center mb-4">
            <h3 id="modalTitle" class="text-xl font-semibold text-gray-800"></h3>
            <div class="flex gap-2">
                <button onclick="downloadModalChart()" class="text-gray-500 hover:text-gray-700 transition-colors duration-200" title="Download">
                    <i class="fas fa-download"></i>
                </button>
                <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700 transition-colors duration-200" title="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="h-96 bg-gray-50 rounded-lg p-4">
            <canvas id="modalChart" class="w-full h-full"></canvas>
        </div>
        <div id="modalStats" class="mt-4"></div>
    </div>
</div>

<!-- Recent Reports -->
<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-800">Recent Reports</h3>
            <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">View All →</button>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Report Name
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Type
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Generated
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Size
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($recentReports as $report)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="bg-blue-100 p-2 rounded-full mr-3">
                                <i class="fas fa-file-alt text-blue-600"></i>
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-900">{{ $report['name'] }}</div>
                                <div class="text-sm text-gray-500">{{ $report['description'] }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $report['type_color'] }}-100 text-{{ $report['type_color'] }}-800">
                            {{ $report['type'] }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                        <div>{{ $report['created_at']->format('M j, Y') }}</div>
                        <div class="text-xs">{{ $report['created_at']->format('g:i A') }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                        {{ $report['file_size'] }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        @if($report['status'] === 'completed')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check mr-1"></i>Ready
                            </span>
                        @elseif($report['status'] === 'processing')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                <i class="fas fa-spinner fa-spin mr-1"></i>Processing
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                <i class="fas fa-times mr-1"></i>Failed
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                        <div class="flex justify-center space-x-2">
                            @if($report['status'] === 'completed')
                            <button class="download-report-btn text-blue-600 hover:text-blue-900 transition-colors duration-200" title="Download" data-report-id="{{ $report['id'] ?? $loop->index }}">
                                <i class="fas fa-download"></i>
                            </button>
                            <button class="view-report-btn text-green-600 hover:text-green-900 transition-colors duration-200" title="View" data-report-id="{{ $report['id'] ?? $loop->index }}">
                                <i class="fas fa-eye"></i>
                            </button>
                            @endif
                            <button class="delete-report-btn text-red-600 hover:text-red-900 transition-colors duration-200" title="Delete" data-report-id="{{ $report['id'] ?? $loop->index }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                        <i class="fas fa-chart-bar text-4xl mb-4"></i>
                        <p class="text-lg font-medium">No reports generated yet</p>
                        <p>Generate your first report using the options above</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Report Statistics -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Report Generation</h3>
        <div class="space-y-2">
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">Total Reports:</span>
                <span class="text-sm font-medium text-gray-800">{{ $reportStats['total'] }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">This Month:</span>
                <span class="text-sm font-medium text-gray-800">{{ $reportStats['this_month'] }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">Average Size:</span>
                <span class="text-sm font-medium text-gray-800">{{ $reportStats['avg_size'] }}</span>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Popular Reports</h3>
        <div class="space-y-2">
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">Grade Analysis:</span>
                <span class="text-sm font-medium text-gray-800">28 downloads</span>
            </div>
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">Approval Tracking:</span>
                <span class="text-sm font-medium text-gray-800">19 downloads</span>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">System Health</h3>
        <div class="space-y-2">
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">Database Status:</span>
                <span class="text-sm font-medium text-green-600">Healthy</span>
            </div>
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">Storage Space:</span>
                <span class="text-sm font-medium text-gray-800">78% Used</span>
            </div>
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">Last Backup:</span>
                <span class="text-sm font-medium text-gray-800">2 hours ago</span>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Chart.js CDN - using a more stable version -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // CSRF token for AJAX requests
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    // Chart instances for downloading and maximizing
    let gradeDistributionChart;
    let modalChart;
    let currentModalChartType = null;

    // Initialize charts with a delay to ensure DOM and Chart.js are ready
    setTimeout(function() {
        initializeCharts();
    }, 500);

    function initializeCharts() {
        // Check if Chart.js is loaded
        if (typeof Chart === 'undefined') {
            console.error('Chart.js not loaded, retrying...');
            setTimeout(initializeCharts, 1000); // Retry after 1 second
            return;
        }

        console.log('Chart.js loaded, initializing charts...');

        // Check if canvas elements exist
        const gradeCtx = document.getElementById('gradeDistributionChart');
        
        console.log('Grade Distribution Canvas:', gradeCtx);

        // Simple grade distribution data for testing
        const simpleGradeData = {
            labels: ['INC (Incomplete)', 'NFE (No Final Exam)', 'NG (No Grade)'],
            datasets: [{
                data: [45, 30, 25],
                backgroundColor: ['#EF4444', '#F59E0B', '#F97316'],
                borderColor: ['#DC2626', '#D97706', '#EA580C'],
                borderWidth: 2,
                hoverOffset: 4
            }]
        };

        // Initialize Grade Distribution Pie Chart
        if (gradeCtx) {
            console.log('Creating pie chart...');
            try {
                gradeDistributionChart = new Chart(gradeCtx.getContext('2d'), {
                    type: 'doughnut',
                    data: simpleGradeData,
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                titleColor: 'white',
                                bodyColor: 'white',
                                callbacks: {
                                    label: function(context) {
                                        const label = context.label || '';
                                        const value = context.parsed;
                                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        const percentage = Math.round((value / total) * 100);
                                        return `${label}: ${value} (${percentage}%)`;
                                    }
                                }
                            }
                        }
                    }
                });
                console.log('Pie chart created successfully!');
                
                // Update the percentage displays
                document.getElementById('inc-percentage').textContent = '45%';
                document.getElementById('nfe-percentage').textContent = '30%';
                document.getElementById('ng-percentage').textContent = '25%';
                
            } catch (error) {
                console.error('Error creating pie chart:', error);
            }
        } else {
            console.error('Grade distribution canvas not found');
        }
    }

    function generateGradeDistributionData(gradeData) {
        // Default data if no grade data is provided
        let incCount = 45;
        let nfeCount = 30;
        let ngCount = 25;

        // Use actual data if available
        if (gradeData && gradeData.length > 0) {
            incCount = gradeData.find(g => g.current_grade === 'INC')?.count || 0;
            nfeCount = gradeData.find(g => g.current_grade === 'NFE')?.count || 0;
            ngCount = gradeData.find(g => g.current_grade === 'NG')?.count || 0;
        }

        console.log('Grade counts:', { incCount, nfeCount, ngCount }); // Debug log

        const data = {
            labels: ['INC (Incomplete)', 'NFE (No Final Exam)', 'NG (No Grade)'],
            datasets: [{
                data: [incCount, nfeCount, ngCount],
                backgroundColor: [
                    '#EF4444', // Red for INC
                    '#F59E0B', // Yellow for NFE
                    '#F97316'  // Orange for NG
                ],
                borderColor: [
                    '#DC2626',
                    '#D97706',
                    '#EA580C'
                ],
                borderWidth: 2,
                hoverOffset: 4
            }]
        };

        console.log('Generated pie chart data:', data); // Debug log
        return data;
    }

    function updateGradePercentages(gradeData) {
        const total = gradeData.datasets[0].data.reduce((a, b) => a + b, 0);
        if (total > 0) {
            const incPercentage = Math.round((gradeData.datasets[0].data[0] / total) * 100);
            const nfePercentage = Math.round((gradeData.datasets[0].data[1] / total) * 100);
            const ngPercentage = Math.round((gradeData.datasets[0].data[2] / total) * 100);

            document.getElementById('inc-percentage').textContent = `${incPercentage}%`;
            document.getElementById('nfe-percentage').textContent = `${nfePercentage}%`;
            document.getElementById('ng-percentage').textContent = `${ngPercentage}%`;
        }
    }

    // Maximize chart functionality
    window.maximizeChart = function(chartType) {
        console.log('Maximizing chart:', chartType);
        const modal = document.getElementById('chartModal');
        const modalTitle = document.getElementById('modalTitle');
        const modalCanvas = document.getElementById('modalChart');
        const modalStats = document.getElementById('modalStats');
        
        if (!modal || !modalTitle || !modalCanvas || !modalStats) {
            console.error('Modal elements not found');
            return;
        }
        
        currentModalChartType = chartType;
        
        if (chartType === 'grade-distribution') {
            modalTitle.textContent = 'Grade Distribution Analysis';
            
            // Destroy existing modal chart if any
            if (modalChart) {
                modalChart.destroy();
                modalChart = null;
            }
            
            // Simple data for modal chart
            const modalGradeData = {
                labels: ['INC (Incomplete)', 'NFE (No Final Exam)', 'NG (No Grade)'],
                datasets: [{
                    data: [45, 30, 25],
                    backgroundColor: ['#EF4444', '#F59E0B', '#F97316'],
                    borderColor: ['#DC2626', '#D97706', '#EA580C'],
                    borderWidth: 2,
                    hoverOffset: 4
                }]
            };
            
            // Create maximized grade distribution chart
            const ctx = modalCanvas.getContext('2d');
            modalChart = new Chart(ctx, {
                type: 'doughnut',
                data: modalGradeData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Grade Completion Application Breakdown',
                            font: {
                                size: 16
                            }
                        },
                        legend: {
                            display: true,
                            position: 'bottom'
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleColor: 'white',
                            bodyColor: 'white',
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.parsed;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = Math.round((value / total) * 100);
                                    return `${label}: ${value} (${percentage}%)`;
                                }
                            }
                        }
                    }
                }
            });
            
            // Add detailed stats using simple data
            const data = [45, 30, 25]; // INC, NFE, NG
            const total = data.reduce((a, b) => a + b, 0);
            modalStats.innerHTML = `
                <div class="grid grid-cols-3 gap-6">
                    <div class="bg-red-50 p-4 rounded-lg text-center">
                        <div class="flex items-center justify-center mb-2">
                            <div class="w-4 h-4 bg-red-500 rounded-full mr-2"></div>
                            <span class="font-medium">INC (Incomplete)</span>
                        </div>
                        <p class="text-2xl font-bold text-red-600">${data[0]}</p>
                        <p class="text-sm text-gray-600">${Math.round((data[0] / total) * 100)}% of total</p>
                    </div>
                    <div class="bg-yellow-50 p-4 rounded-lg text-center">
                        <div class="flex items-center justify-center mb-2">
                            <div class="w-4 h-4 bg-yellow-500 rounded-full mr-2"></div>
                            <span class="font-medium">NFE (No Final Exam)</span>
                        </div>
                        <p class="text-2xl font-bold text-yellow-600">${data[1]}</p>
                        <p class="text-sm text-gray-600">${Math.round((data[1] / total) * 100)}% of total</p>
                    </div>
                    <div class="bg-orange-50 p-4 rounded-lg text-center">
                        <div class="flex items-center justify-center mb-2">
                            <div class="w-4 h-4 bg-orange-500 rounded-full mr-2"></div>
                            <span class="font-medium">NG (No Grade)</span>
                        </div>
                        <p class="text-2xl font-bold text-orange-600">${data[2]}</p>
                        <p class="text-sm text-gray-600">${Math.round((data[2] / total) * 100)}% of total</p>
                    </div>
                </div>
            `;
        }
        
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
        
        console.log('Chart maximized successfully');
    };

    // Download chart functionality
    window.downloadChart = function(chartType) {
        console.log('Downloading chart:', chartType);
        let chart;
        let filename;
        
        if (chartType === 'grade-distribution') {
            chart = gradeDistributionChart;
            filename = 'grade-distribution.png';
        }
        
        if (chart) {
            try {
                const url = chart.toBase64Image('image/png', 1.0);
                const link = document.createElement('a');
                link.download = filename;
                link.href = url;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
                
                showAlert('success', `Chart downloaded as ${filename}`);
                console.log('Chart downloaded successfully');
            } catch (error) {
                console.error('Error downloading chart:', error);
                showAlert('error', 'Error downloading chart');
            }
        } else {
            console.error('Chart not found for download');
            showAlert('error', 'Chart not available for download');
        }
    };

    // Download modal chart
    window.downloadModalChart = function() {
        console.log('Downloading modal chart');
        if (modalChart && currentModalChartType) {
            const filename = 'grade-distribution-full.png';
            
            try {
                const url = modalChart.toBase64Image('image/png', 1.0);
                const link = document.createElement('a');
                link.download = filename;
                link.href = url;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
                
                showAlert('success', `Full chart downloaded as ${filename}`);
                console.log('Modal chart downloaded successfully');
            } catch (error) {
                console.error('Error downloading modal chart:', error);
                showAlert('error', 'Error downloading chart');
            }
        } else {
            console.error('Modal chart not available');
            showAlert('error', 'Chart not available for download');
        }
    };

    // Close modal
    window.closeModal = function() {
        console.log('Closing modal');
        const modal = document.getElementById('chartModal');
        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
        
        if (modalChart) {
            modalChart.destroy();
            modalChart = null;
        }
        currentModalChartType = null;
        console.log('Modal closed successfully');
    };

    // Close modal on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });

    // Close modal on backdrop click
    document.getElementById('chartModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
    
    // Quick generate report buttons
    document.querySelectorAll('.generate-quick-report-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const reportType = this.getAttribute('data-report-type');
            generateQuickReport(reportType, this);
        });
    });

    // Main report form submission
    document.getElementById('report-form').addEventListener('submit', function(e) {
        e.preventDefault();
        generateReport();
    });

    // Preview report button
    document.getElementById('preview-report-btn').addEventListener('click', function() {
        showAlert('info', 'Preview functionality would show a report preview here.');
    });

    // Custom report button
    document.getElementById('custom-report-btn').addEventListener('click', function() {
        fetch('{{ route("admin.reports.custom-report") }}', {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            showAlert('info', data.message);
        })
        .catch(error => {
            showAlert('error', 'Error opening custom report builder.');
        });
    });

    // Export all button
    document.getElementById('export-all-btn').addEventListener('click', function() {
        fetch('{{ route("admin.reports.export-all") }}', {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            showAlert('success', data.message);
        })
        .catch(error => {
            showAlert('error', 'Error exporting reports.');
        });
    });

    // Download report buttons
    document.querySelectorAll('.download-report-btn').forEach(button => {
        button.addEventListener('click', function() {
            const reportId = this.getAttribute('data-report-id');
            downloadReport(reportId);
        });
    });

    // View report buttons
    document.querySelectorAll('.view-report-btn').forEach(button => {
        button.addEventListener('click', function() {
            const reportId = this.getAttribute('data-report-id');
            viewReport(reportId);
        });
    });

    // Delete report buttons
    document.querySelectorAll('.delete-report-btn').forEach(button => {
        button.addEventListener('click', function() {
            const reportId = this.getAttribute('data-report-id');
            if (confirm('Are you sure you want to delete this report?')) {
                deleteReport(reportId);
            }
        });
    });

    function generateQuickReport(reportType, button) {
        const originalText = button.innerHTML;
        button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Generating...';
        button.disabled = true;

        fetch('{{ route("admin.reports.quick-generate") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                report_type: reportType
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert('success', data.message);
                setTimeout(() => {
                    location.reload(); // Refresh to show new report in the table
                }, 1500);
            } else {
                showAlert('error', data.error || 'Error generating report.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('error', 'Network error generating report.');
        })
        .finally(() => {
            button.innerHTML = originalText;
            button.disabled = false;
        });
    }

    function generateReport() {
        const formData = new FormData(document.getElementById('report-form'));
        const reportType = formData.get('report_type');
        
        if (!reportType) {
            showAlert('warning', 'Please select a report type.');
            return;
        }

        const button = document.getElementById('generate-report-btn');
        const originalText = button.innerHTML;
        button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Generating...';
        button.disabled = true;

        fetch('{{ route("admin.reports.generate") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                report_type: formData.get('report_type'),
                date_range: formData.get('date_range'),
                format: formData.get('format')
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert('success', data.message);
                setTimeout(() => {
                    location.reload(); // Refresh to show new report in the table
                }, 1500);
            } else {
                showAlert('error', data.error || 'Error generating report.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('error', 'Network error generating report.');
        })
        .finally(() => {
            button.innerHTML = originalText;
            button.disabled = false;
        });
    }

    function downloadReport(reportId) {
        // Redirect to download URL
        window.location.href = `{{ route("admin.reports.download", ":id") }}`.replace(':id', reportId);
    }

    function viewReport(reportId) {
        // Redirect to the report view page
        window.location.href = `{{ route("admin.reports.view", ":id") }}`.replace(':id', reportId);
    }

    function deleteReport(reportId) {
        fetch(`{{ route("admin.reports.delete", ":id") }}`.replace(':id', reportId), {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert('success', data.message);
                setTimeout(() => {
                    location.reload(); // Refresh to remove deleted report from table
                }, 1500);
            } else {
                showAlert('error', 'Error deleting report.');
            }
        })
        .catch(error => {
            showAlert('error', 'Error deleting report.');
        });
    }

    function showAlert(type, message) {
        // Create alert element
        const alertDiv = document.createElement('div');
        alertDiv.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg max-w-sm ${getAlertClasses(type)}`;
        alertDiv.innerHTML = `
            <div class="flex items-center">
                <i class="fas ${getAlertIcon(type)} mr-3"></i>
                <span>${message}</span>
                <button class="ml-auto text-xl leading-none" onclick="this.parentElement.parentElement.remove()">
                    &times;
                </button>
            </div>
        `;

        document.body.appendChild(alertDiv);

        // Auto remove after 5 seconds
        setTimeout(() => {
            if (alertDiv.parentElement) {
                alertDiv.remove();
            }
        }, 5000);
    }

    function getAlertClasses(type) {
        const classes = {
            success: 'bg-green-100 border border-green-400 text-green-700',
            error: 'bg-red-100 border border-red-400 text-red-700',
            warning: 'bg-yellow-100 border border-yellow-400 text-yellow-700',
            info: 'bg-blue-100 border border-blue-400 text-blue-700'
        };
        return classes[type] || classes.info;
    }

    function getAlertIcon(type) {
        const icons = {
            success: 'fa-check-circle',
            error: 'fa-exclamation-circle',
            warning: 'fa-exclamation-triangle',
            info: 'fa-info-circle'
        };
        return icons[type] || icons.info;
    }
});
</script>
@endpush
