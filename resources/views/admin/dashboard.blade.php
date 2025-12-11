@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="dashboard-content">
    <h1 class="page-title">Admin Dashboard</h1>
    <div class="breadcrumb">
        <a href="{{ route('admin.dashboard') }}">Home</a> / Dashboard
    </div>

    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon users"><i class="fas fa-users"></i></div>
            <div class="stat-info">
                <h3>{{ $totalUsers }}</h3>
                <p>Total Users</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon jobs"><i class="fas fa-briefcase"></i></div>
            <div class="stat-info">
                <h3>{{ $totalJobs }}</h3>
                <p>Total Jobs</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon apps"><i class="fas fa-file-alt"></i></div>
            <div class="stat-info">
                <h3>{{ $totalApplications }}</h3>
                <p>Applications</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon active"><i class="fas fa-check-circle"></i></div>
            <div class="stat-info">
                <h3>{{ $testsTaken }}</h3>
                <p>Tests Taken</p>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="charts-row">
        <div class="chart-card">
            <h3 class="chart-title"><i class="fas fa-chart-line"></i> User Growth</h3>
            <div class="chart-placeholder">
                <i class="fas fa-chart-line" style="font-size: 3rem; margin-bottom: 10px; display: block;"></i>
                <p>{{ $newUsersThisMonth }} new users this month</p>
            </div>
        </div>
        <div class="chart-card">
            <h3 class="chart-title"><i class="fas fa-chart-bar"></i> Job Applications</h3>
            <div class="chart-placeholder">
                <i class="fas fa-file-alt" style="font-size: 3rem; margin-bottom: 10px; display: block;"></i>
                <p>{{ $applicationsThisWeek }} applications this week</p>
            </div>
        </div>
    </div>
</div>

<style>
    .dashboard-content { flex: 1; padding: 32px; overflow-y: auto; }
    .page-title { font-size: 1.8rem; font-weight: 700; color: #e2e8f0; margin-bottom: 8px; }
    .breadcrumb { color: #94a3b8; font-size: 0.95rem; margin-bottom: 24px; }
    .breadcrumb a { color: #3b82f6; text-decoration: none; }
    .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px; margin-bottom: 32px; }
    .stat-card { background: #1e293b; border-radius: 16px; padding: 24px; display: flex; align-items: center; gap: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.2); transition: transform 0.3s ease; }
    .stat-card:hover { transform: translateY(-6px); }
    .stat-icon { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; color: white; }
    .stat-icon.users { background: #3b82f6; }
    .stat-icon.jobs { background: #10b981; }
    .stat-icon.apps { background: #f59e0b; }
    .stat-icon.active { background: #8b5cf6; }
    .stat-info h3 { font-size: 2rem; font-weight: 700; color: #e2e8f0; margin-bottom: 4px; }
    .stat-info p { color: #94a3b8; font-size: 0.95rem; }
    .charts-row { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 32px; }
    .chart-card { background: #1e293b; border-radius: 16px; padding: 24px; box-shadow: 0 4px 12px rgba(0,0,0,0.2); }
    .chart-title { font-size: 1.2rem; font-weight: 600; color: #e2e8f0; margin-bottom: 16px; display: flex; align-items: center; gap: 8px; }
    .chart-placeholder { height: 200px; background: #0f172a; border-radius: 12px; display: flex; flex-direction: column; align-items: center; justify-content: center; color: #64748b; text-align: center; }
    @media (max-width: 992px) { .charts-row { grid-template-columns: 1fr; } }
</style>
@endsection