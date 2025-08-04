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

    <!-- Calendar Component -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="calendar-container">
            <!-- Calendar Navigation -->
            <div class="flex items-center justify-between mb-6">
                <button onclick="changeMonth(-1)" class="flex items-center px-4 py-2 bg-uc-green text-white rounded-lg hover:bg-uc-green/90 transition-colors">
                    <i class="fas fa-chevron-left mr-2"></i>
                    Previous
                </button>
                <h3 id="currentMonth" class="text-2xl font-bold text-gray-800">August 2025</h3>
                <button onclick="changeMonth(1)" class="flex items-center px-4 py-2 bg-uc-green text-white rounded-lg hover:bg-uc-green/90 transition-colors">
                    Next
                    <i class="fas fa-chevron-right ml-2"></i>
                </button>
            </div>

            <!-- Calendar Grid -->
            <div class="calendar-grid">
                <!-- Days of Week Header -->
                <div class="grid grid-cols-7 gap-1 mb-4">
                    <div class="text-center py-3 font-semibold text-gray-600 bg-gray-50 rounded">Sun</div>
                    <div class="text-center py-3 font-semibold text-gray-600 bg-gray-50 rounded">Mon</div>
                    <div class="text-center py-3 font-semibold text-gray-600 bg-gray-50 rounded">Tue</div>
                    <div class="text-center py-3 font-semibold text-gray-600 bg-gray-50 rounded">Wed</div>
                    <div class="text-center py-3 font-semibold text-gray-600 bg-gray-50 rounded">Thu</div>
                    <div class="text-center py-3 font-semibold text-gray-600 bg-gray-50 rounded">Fri</div>
                    <div class="text-center py-3 font-semibold text-gray-600 bg-gray-50 rounded">Sat</div>
                </div>
                
                <!-- Calendar Days -->
                <div id="calendarDays" class="grid grid-cols-7 gap-1">
                    <!-- Current month days for August 2025 -->
                    <div class="calendar-day other-month">28</div>
                    <div class="calendar-day other-month">29</div>
                    <div class="calendar-day other-month">30</div>
                    <div class="calendar-day other-month">31</div>
                    <div class="calendar-day">1</div>
                    <div class="calendar-day">2</div>
                    <div class="calendar-day">3</div>
                    <div class="calendar-day today">4</div>
                    <div class="calendar-day">5</div>
                    <div class="calendar-day">6</div>
                    <div class="calendar-day">7</div>
                    <div class="calendar-day">8</div>
                    <div class="calendar-day">9</div>
                    <div class="calendar-day">10</div>
                    <div class="calendar-day">11</div>
                    <div class="calendar-day">12</div>
                    <div class="calendar-day">13</div>
                    <div class="calendar-day">14</div>
                    <div class="calendar-day">15</div>
                    <div class="calendar-day">16</div>
                    <div class="calendar-day">17</div>
                    <div class="calendar-day">18</div>
                    <div class="calendar-day">19</div>
                    <div class="calendar-day">20</div>
                    <div class="calendar-day">21</div>
                    <div class="calendar-day">22</div>
                    <div class="calendar-day">23</div>
                    <div class="calendar-day">24</div>
                    <div class="calendar-day">25</div>
                    <div class="calendar-day">26</div>
                    <div class="calendar-day">27</div>
                    <div class="calendar-day">28</div>
                    <div class="calendar-day">29</div>
                    <div class="calendar-day">30</div>
                    <div class="calendar-day">31</div>
                    <div class="calendar-day other-month">1</div>
                    <div class="calendar-day other-month">2</div>
                    <div class="calendar-day other-month">3</div>
                    <div class="calendar-day other-month">4</div>
                    <div class="calendar-day other-month">5</div>
                    <div class="calendar-day other-month">6</div>
                    <div class="calendar-day other-month">7</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Today's Date Highlight -->
    <div class="bg-uc-green/10 border border-uc-green/20 rounded-lg p-4">
        <div class="flex items-center">
            <div class="bg-uc-green text-white rounded-full p-3 mr-4">
                <i class="fas fa-calendar-day text-xl"></i>
            </div>
            <div>
                <h4 class="font-semibold text-gray-800">Today</h4>
                <p class="text-uc-green font-medium">{{ now()->format('l, F j, Y') }}</p>
            </div>
        </div>
    </div>

    <!-- Recent Activities -->
    @if(isset($applications) && $applications->count() > 0)
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">
            <i class="fas fa-history text-gray-600 mr-2"></i>
            Recent Application Reviews
        </h3>
        <div class="space-y-3 max-h-96 overflow-y-auto">
            @foreach($applications->take(10) as $application)
            <div class="flex items-start p-3 rounded-lg {{ $application->dean_status === 'approved' ? 'bg-green-50 border border-green-200' : 'bg-red-50 border border-red-200' }}">
                <div class="flex-shrink-0 mr-3">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center {{ $application->dean_status === 'approved' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                        <i class="fas {{ $application->dean_status === 'approved' ? 'fa-check' : 'fa-times' }} text-sm"></i>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium text-gray-900">
                            {{ $application->student ? $application->student->name : 'Unknown Student' }} - {{ $application->subject ? $application->subject->code : 'Unknown Subject' }}
                        </p>
                        <span class="text-xs text-gray-500">
                            {{ $application->dean_reviewed_at ? $application->dean_reviewed_at->format('M j, Y g:i A') : 'Unknown Date' }}
                        </span>
                    </div>
                    <p class="text-xs {{ $application->dean_status === 'approved' ? 'text-green-700' : 'text-red-700' }} mt-1">
                        <i class="fas {{ $application->dean_status === 'approved' ? 'fa-check-circle' : 'fa-times-circle' }} mr-1"></i>
                        {{ $application->dean_status === 'approved' ? 'Approved' : 'Rejected' }}
                        @if($application->dean_remarks)
                            - {{ Str::limit($application->dean_remarks, 50) }}
                        @endif
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @else
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="text-center py-8">
            <div class="bg-gray-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-calendar-alt text-gray-400 text-2xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-800 mb-2">No Application Reviews Yet</h3>
            <p class="text-gray-600">Your application review history will appear here once you start reviewing applications.</p>
        </div>
    </div>
    @endif

</div>

<style>
.calendar-day {
    min-height: 3rem;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
    border-radius: 0.375rem;
    font-weight: 500;
    border: 1px solid #e5e7eb;
    background-color: #ffffff;
    position: relative;
    padding: 0.25rem;
}

.calendar-day:hover {
    background-color: #f3f4f6;
    border-color: #d1d5db;
}

.calendar-day.today {
    background-color: #10b981;
    color: white;
    font-weight: bold;
    border-color: #059669;
}

.calendar-day.other-month {
    color: #d1d5db;
    background-color: #f9fafb;
}

.calendar-day.selected {
    background-color: #3b82f6;
    color: white;
    border-color: #2563eb;
}

.calendar-day.has-events {
    border-color: #10b981;
    background-color: #f0f9ff;
}

.calendar-day.has-events:hover {
    background-color: #e0f7fa;
    transform: scale(1.02);
}

.day-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
    height: 100%;
    justify-content: space-between;
}

.day-number {
    font-weight: 600;
    font-size: 0.875rem;
}

.events-container {
    display: flex;
    gap: 2px;
    margin-top: 2px;
    flex-wrap: wrap;
    justify-content: center;
}

.event-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    font-size: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.event-approved {
    background-color: #10b981;
}

.event-rejected {
    background-color: #ef4444;
}

.event-more {
    background-color: #6b7280;
    color: white;
    font-weight: bold;
    width: 8px;
    height: 8px;
    font-size: 6px;
}

.calendar-container {
    max-width: 100%;
    overflow-x: auto;
}

@media (max-width: 768px) {
    .calendar-day {
        font-size: 0.875rem;
        min-height: 2.5rem;
        padding: 0.125rem;
    }
    
    .day-number {
        font-size: 0.75rem;
    }
    
    .event-dot {
        width: 4px;
        height: 4px;
    }
    
    .event-more {
        width: 6px;
        height: 6px;
        font-size: 5px;
    }
}

/* Static calendar days styling */
.calendar-day:not(.has-events) {
    flex-direction: column;
    justify-content: center;
}
</style>

<script>
let currentMonth = 7; // August (0-based)
let currentYear = 2025;

// Application data from the server
const applications = {!! json_encode($applications ? $applications->map(function($app) {
    return [
        'id' => $app->id,
        'student_name' => $app->student ? $app->student->name : 'Unknown Student',
        'subject_code' => $app->subject ? $app->subject->code : 'Unknown Subject',
        'dean_status' => $app->dean_status,
        'dean_reviewed_at' => $app->dean_reviewed_at ? $app->dean_reviewed_at->format('Y-m-d') : null,
        'dean_reviewed_at_display' => $app->dean_reviewed_at ? $app->dean_reviewed_at->format('M j, Y g:i A') : 'Unknown Date',
        'dean_remarks' => $app->dean_remarks
    ];
}) : []) !!};

function changeMonth(direction) {
    currentMonth += direction;
    
    if (currentMonth > 11) {
        currentMonth = 0;
        currentYear++;
    } else if (currentMonth < 0) {
        currentMonth = 11;
        currentYear--;
    }
    
    generateCalendar(currentYear, currentMonth);
}

function generateCalendar(year, month) {
    const monthNames = [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
    ];
    
    // Update header
    document.getElementById('currentMonth').textContent = monthNames[month] + ' ' + year;
    
    // Generate calendar days
    const firstDay = new Date(year, month, 1);
    const lastDay = new Date(year, month + 1, 0);
    const daysInMonth = lastDay.getDate();
    const startingDayOfWeek = firstDay.getDay(); // 0 = Sunday
    
    const calendarContainer = document.getElementById('calendarDays');
    calendarContainer.innerHTML = '';
    
    // Add empty cells for days before the first day of the month
    for (let i = 0; i < startingDayOfWeek; i++) {
        const prevMonthDay = new Date(year, month, 0 - (startingDayOfWeek - 1 - i));
        const dayDiv = document.createElement('div');
        dayDiv.className = 'calendar-day other-month';
        dayDiv.textContent = prevMonthDay.getDate();
        dayDiv.onclick = () => selectDay(dayDiv);
        calendarContainer.appendChild(dayDiv);
    }
    
    // Add days of the current month
    for (let day = 1; day <= daysInMonth; day++) {
        const dayDiv = document.createElement('div');
        dayDiv.className = 'calendar-day';
        
        // Create day content container
        const dayContent = document.createElement('div');
        dayContent.className = 'day-content';
        
        // Add day number
        const dayNumber = document.createElement('div');
        dayNumber.className = 'day-number';
        dayNumber.textContent = day;
        dayContent.appendChild(dayNumber);
        
        // Check if this is today
        const today = new Date();
        if (year === today.getFullYear() && month === today.getMonth() && day === today.getDate()) {
            dayDiv.classList.add('today');
        }
        
        // Check for applications on this day
        const dayDate = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
        const dayApplications = applications.filter(app => app.dean_reviewed_at === dayDate);
        
        if (dayApplications.length > 0) {
            dayDiv.classList.add('has-events');
            
            // Add event indicators
            const eventsContainer = document.createElement('div');
            eventsContainer.className = 'events-container';
            
            dayApplications.slice(0, 3).forEach(app => {
                const eventDot = document.createElement('div');
                eventDot.className = `event-dot ${app.dean_status === 'approved' ? 'event-approved' : 'event-rejected'}`;
                eventDot.title = `${app.student_name} - ${app.subject_code} (${app.dean_status})`;
                eventsContainer.appendChild(eventDot);
            });
            
            if (dayApplications.length > 3) {
                const moreDot = document.createElement('div');
                moreDot.className = 'event-dot event-more';
                moreDot.textContent = '+';
                moreDot.title = `${dayApplications.length - 3} more events`;
                eventsContainer.appendChild(moreDot);
            }
            
            dayContent.appendChild(eventsContainer);
            
            // Add click handler for viewing events
            dayDiv.onclick = () => {
                selectDay(dayDiv);
                showDayEvents(dayApplications, day, monthNames[month], year);
            };
        } else {
            dayDiv.onclick = () => selectDay(dayDiv);
        }
        
        dayDiv.appendChild(dayContent);
        calendarContainer.appendChild(dayDiv);
    }
    
    // Fill remaining cells with next month's days
    const totalCells = calendarContainer.children.length;
    const remainingCells = 42 - totalCells; // 6 rows × 7 days = 42 cells
    
    for (let day = 1; day <= remainingCells; day++) {
        const dayDiv = document.createElement('div');
        dayDiv.className = 'calendar-day other-month';
        dayDiv.textContent = day;
        dayDiv.onclick = () => selectDay(dayDiv);
        calendarContainer.appendChild(dayDiv);
    }
}

function selectDay(dayElement) {
    // Remove previous selection
    document.querySelectorAll('.calendar-day.selected').forEach(el => {
        el.classList.remove('selected');
    });
    
    // Add selection to clicked day (only if it's in current month)
    if (!dayElement.classList.contains('other-month')) {
        dayElement.classList.add('selected');
    }
}

function showDayEvents(dayApplications, day, month, year) {
    const modalHtml = `
        <div id="dayEventsModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full max-h-[80vh] overflow-hidden">
                <div class="bg-uc-green text-white p-4">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-bold">
                            <i class="fas fa-calendar-day mr-2"></i>
                            ${month} ${day}, ${year}
                        </h3>
                        <button onclick="closeDayEventsModal()" class="text-white hover:text-gray-200">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                </div>
                <div class="p-4 overflow-y-auto max-h-96">
                    <h4 class="font-semibold text-gray-800 mb-3">Application Reviews (${dayApplications.length})</h4>
                    <div class="space-y-3">
                        ${dayApplications.map(app => `
                            <div class="p-3 rounded-lg border ${app.dean_status === 'approved' ? 'bg-green-50 border-green-200' : 'bg-red-50 border-red-200'}">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <p class="font-medium text-gray-900">${app.student_name}</p>
                                        <p class="text-sm text-gray-600">${app.subject_code}</p>
                                        <p class="text-xs ${app.dean_status === 'approved' ? 'text-green-700' : 'text-red-700'} mt-1">
                                            ${app.dean_reviewed_at_display}
                                        </p>
                                        ${app.dean_remarks ? `<p class="text-xs text-gray-600 mt-1">"${app.dean_remarks}"</p>` : ''}
                                    </div>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium ${app.dean_status === 'approved' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">
                                        <i class="fas ${app.dean_status === 'approved' ? 'fa-check' : 'fa-times'} mr-1"></i>
                                        ${app.dean_status === 'approved' ? 'Approved' : 'Rejected'}
                                    </span>
                                </div>
                            </div>
                        `).join('')}
                    </div>
                </div>
            </div>
        </div>
    `;
    
    document.body.insertAdjacentHTML('beforeend', modalHtml);
}

function closeDayEventsModal() {
    const modal = document.getElementById('dayEventsModal');
    if (modal) {
        modal.remove();
    }
}

// Add click events to existing calendar days
document.addEventListener('DOMContentLoaded', function() {
    const calendarDays = document.querySelectorAll('.calendar-day');
    calendarDays.forEach(day => {
        if (!day.onclick) {
            day.onclick = () => selectDay(day);
        }
    });
    
    // Generate calendar for current month
    generateCalendar(currentYear, currentMonth);
});
</script>

@endsection
