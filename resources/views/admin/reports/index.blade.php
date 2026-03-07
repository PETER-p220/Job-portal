@extends('admin.layout')

@section('title', 'Reports & Analytics')

@section('content')
    <!-- Header -->
    <div class="p-8">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Reports & Analytics</h1>
                <p class="mt-2 text-gray-600">Comprehensive insights into your job board performance</p>
            </div>
            <div class="flex items-center space-x-4">
                <select id="periodFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <option value="30">Last 30 days</option>
                    <option value="7">Last 7 days</option>
                    <option value="3">Last 3 months</option>
                    <option value="12">Last year</option>
                </select>
                <button onclick="exportReport()" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003 3v-1m-6 0L4 12m8 8v8l-4-4m0 0l-4-4"></path>
                    </svg>
                    Export Report
                </button>
            </div>
        </div>

        <!-- Overview Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-500 rounded-lg p-3">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A9.002 9.002 0 0112 21a9.002 9.002 0 01-9-7.745M21 13.255A9.002 9.002 0 0012 3a9.002 9.002 0 00-9 10.255M12 3v18"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Jobs</p>
                        <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Job::count() }}</p>
                        <p class="text-xs text-green-600 mt-1">+12% from last month</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-green-500 rounded-lg p-3">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A9.002 9.002 0 0112 21a9.002 9.002 0 01-9-7.745M21 13.255A9.002 9.002 0 0012 3a9.002 9.002 0 00-9 10.255M12 3v18"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Total Jobs</p>
                            <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Job::count() }}</p>
                            <p class="text-xs text-green-600 mt-1">+12% from last month</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-green-500 rounded-lg p-3">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Total Users</p>
                            <p class="text-2xl font-bold text-gray-900">{{ \App\Models\User::count() }}</p>
                            <p class="text-xs text-green-600 mt-1">+8% from last month</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-yellow-500 rounded-lg p-3">
                        <div class="flex-shrink-0 bg-purple-500 rounded-lg p-3">
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-yellow-500 rounded-lg p-3">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Job Postings Chart -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Job Postings Trend</h3>
                    <div class="h-64">
                        <canvas id="jobPostingsChart"></canvas>
                    </div>
                </div>

                <!-- User Activity Chart -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">User Activity</h3>
                    <div class="h-64">
                        <canvas id="userActivityChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Detailed Tables -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Popular Jobs -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Most Popular Jobs</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Job Title</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Views</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applications</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($recentJobs as $job)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $job->title }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $job->views ?? 0 }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $job->applications ?? 0 }}</td>
                                    </tr>
                                @endforeach
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-xl shadow-sm border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Recent Activity</h3>
                </div>
                <div class="p-6 space-y-4">
                    @foreach($recentJobs as $job)
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm text-gray-900">New job posted: <span class="font-medium">{{ $job->title }}</span></p>
                                <p class="text-xs text-gray-500">{{ $job->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @endforeach
                    
                    @foreach($recentUsers as $user)
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm text-gray-900">New user registration: <span class="font-medium">{{ $user->name }}</span></p>
                                <p class="text-xs text-gray-500">{{ $user->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @endforeach
                    
                    @foreach($recentJobs->take(3) as $job)
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                <div class="w-2 h-2 bg-yellow-500 rounded-full"></div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm text-gray-900">Job application submitted for <span class="font-medium">{{ $job->title }}</span></p>
                                <p class="text-xs text-gray-500">{{ $job->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Chart data from Laravel
console.log('Job Type Labels:', @json($jobTypeLabels));
console.log('Job Type Data:', @json($jobTypeData));
console.log('User Month Labels:', @json($userMonthLabels));
console.log('User Month Data:', @json($userMonthData));

const jobTypeLabels = @json($jobTypeLabels);
const jobTypeData = @json($jobTypeData);
const userMonthLabels = @json($userMonthLabels);
const userMonthData = @json($userMonthData);

// Check if data exists
if (jobTypeLabels.length === 0 || jobTypeData.length === 0) {
    console.error('No job type data available');
    document.getElementById('jobPostingsChart').parentElement.innerHTML = 
        '<div class="text-center text-gray-500 py-8">No job data available</div>';
} else {
    // Job Postings Chart
    const jobPostingsCtx = document.getElementById('jobPostingsChart');
    if (jobPostingsCtx) {
        try {
            new Chart(jobPostingsCtx.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: jobTypeLabels,
                    datasets: [{
                        data: jobTypeData,
                        backgroundColor: [
                            '#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6', 
                            '#EC4899', '#6B7280', '#F97316', '#14B8A6', '#0EA5E9'
                        ],
                        borderWidth: 2,
                        borderColor: '#ffffff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                font: { size: 12 }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.parsed || 0;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                                    return `${label}: ${value} (${percentage}%)`;
                                }
                            }
                        }
                    }
                }
            });
        } catch (error) {
            console.error('Error creating job postings chart:', error);
        }
    }
}

// Check if user data exists
if (userMonthLabels.length === 0 || userMonthData.length === 0) {
    console.error('No user activity data available');
    document.getElementById('userActivityChart').parentElement.innerHTML = 
        '<div class="text-center text-gray-500 py-8">No user activity data available</div>';
} else {
    // User Activity Chart
    const userActivityCtx = document.getElementById('userActivityChart');
    if (userActivityCtx) {
        try {
            new Chart(userActivityCtx.getContext('2d'), {
                type: 'line',
                data: {
                    labels: userMonthLabels,
                    datasets: [{
                        label: 'New Users',
                        data: userMonthData,
                        borderColor: '#3B82F6',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: true }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { stepSize: 1 }
                        }
                    }
                }
            });
        } catch (error) {
            console.error('Error creating user activity chart:', error);
        }
    }
}

// Export functionality
function exportReport() {
    const period = document.getElementById('periodFilter').value;
    const format = period === '30' ? 'Last 30 Days' : 
                  period === '7' ? 'Last 7 Days' : 
                  period === '3' ? 'Last 3 Months' : 'Last Year';
    
    // Create CSV data
    const csvContent = [
        ['Metric', 'Value', 'Period'],
        ['Total Jobs', '{{ $totalJobs }}', format],
        ['Active Jobs', '{{ $activeJobs }}', format],
        ['Total Users', '{{ $totalUsers }}', format],
        ['Admin Users', '{{ $adminUsers }}', format],
        ['Applications', '{{ \App\Models\Application::count() }}', format],
        ['Revenue', '${{ number_format(\App\Models\Job::sum('salary') ?? 0, 2) }}', format]
    ].map(row => row.join(',')).join('\n');
    
    // Download CSV
    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = `job-portal-report-${format}.csv`;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    
    // Show success message
    const successDiv = document.createElement('div');
    successDiv.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50';
    successDiv.innerHTML = `
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L4 5H4a1 1 0 00-1-1V4a1 1 0 001 1h12a1 1 0 001 1v10m-6 0a1 1 0 001 1h-1m-6 0L4 12m8 8v8l-4-4m0 0l-4-4"></path>
            </svg>
            Report exported successfully!
        </div>
    `;
    document.body.appendChild(successDiv);
    
    setTimeout(() => {
        document.body.removeChild(successDiv);
    }, 3000);
}
</script>
@endsection
