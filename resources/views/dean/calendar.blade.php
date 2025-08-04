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

.calendar-container {
    max-width: 100%;
    overflow-x: auto;
}

@media (max-width: 768px) {
    .calendar-day {
        font-size: 0.875rem;
        min-height: 2.5rem;
    }
}
</style>

<script>
let currentMonth = 7; // August (0-based)
let currentYear = 2025;

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
        dayDiv.textContent = day;
        
        // Check if this is today
        const today = new Date();
        if (year === today.getFullYear() && month === today.getMonth() && day === today.getDate()) {
            dayDiv.classList.add('today');
        }
        
        dayDiv.onclick = () => selectDay(dayDiv);
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

// Add click events to existing calendar days
document.addEventListener('DOMContentLoaded', function() {
    const calendarDays = document.querySelectorAll('.calendar-day');
    calendarDays.forEach(day => {
        day.onclick = () => selectDay(day);
    });
});
</script>

@endsection
