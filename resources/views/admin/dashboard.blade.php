@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div style="padding: 40px 20px; max-width: 1400px; margin: 0 auto;">
    <!-- Page Header -->
    <div style="margin-bottom: 40px; text-align: center;">
        <h1 style="font-size: 2.5rem; font-weight: 700; color: #1e293b; margin-bottom: 12px;">
            📊 Admin Dashboard
        </h1>
        <p style="color: #64748b; font-size: 1.2rem;">Welcome back! Here's what's happening today.</p>
    </div>

    <!-- Main Stats Grid (4 cards in a row) -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 24px; margin-bottom: 50px;">
        <!-- Total Users -->
        <div style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border-radius: 20px; padding: 32px; color: white; box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4); transition: transform 0.3s;">
            <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 12px;">
                <div style="width: 70px; height: 70px; border-radius: 16px; background: rgba(255,255,255,0.2); display: flex; align-items: center; justify-content: center; font-size: 2.2rem;">
                    👥
                </div>
                <div>
                    <div style="font-size: 1rem; opacity: 0.9; margin-bottom: 6px;">Total Users</div>
                    <div style="font-size: 2.8rem; font-weight: 700;">{{ $totalUsers }}</div>
                </div>
            </div>
        </div>

        <!-- Total Jobs -->
        <div style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 20px; padding: 32px; color: white; box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4); transition: transform 0.3s;">
            <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 12px;">
                <div style="width: 70px; height: 70px; border-radius: 16px; background: rgba(255,255,255,0.2); display: flex; align-items: center; justify-content: center; font-size: 2.2rem;">
                    💼
                </div>
                <div>
                    <div style="font-size: 1rem; opacity: 0.9; margin-bottom: 6px;">Total Jobs</div>
                    <div style="font-size: 2.8rem; font-weight: 700;">{{ $totalJobs }}</div>
                </div>
            </div>
        </div>

        <!-- Total Applications -->
        <div style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); border-radius: 20px; padding: 32px; color: white; box-shadow: 0 6px 20px rgba(245, 158, 11, 0.4); transition: transform 0.3s;">
            <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 12px;">
                <div style="width: 70px; height: 70px; border-radius: 16px; background: rgba(255,255,255,0.2); display: flex; align-items: center; justify-content: center; font-size: 2.2rem;">
                    📄
                </div>
                <div>
                    <div style="font-size: 1rem; opacity: 0.9; margin-bottom: 6px;">Applications</div>
                    <div style="font-size: 2.8rem; font-weight: 700;">{{ $totalApplications }}</div>
                </div>
            </div>
        </div>

        <!-- Total Tests -->
        <div style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); border-radius: 20px; padding: 32px; color: white; box-shadow: 0 6px 20px rgba(139, 92, 246, 0.4); transition: transform 0.3s;">
            <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 12px;">
                <div style="width: 70px; height: 70px; border-radius: 16px; background: rgba(255,255,255,0.2); display: flex; align-items: center; justify-content: center; font-size: 2.2rem;">
                    📝
                </div>
                <div>
                    <div style="font-size: 1rem; opacity: 0.9; margin-bottom: 6px;">Tests Taken</div>
                    <div style="font-size: 2.8rem; font-weight: 700;">{{ $totalTests }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Two Column Layout: Chart + Side Stats -->
    <div style="display: grid; grid-template-columns: 1.2fr 450px; gap: 30px; margin-bottom: 40px;">
        
        <!-- LEFT: User Growth Bar Chart -->
        <div style="background: white; border-radius: 24px; padding: 40px; box-shadow: 0 6px 30px rgba(0,0,0,0.1);">
            <h2 style="font-size: 1.6rem; font-weight: 700; color: #1e293b; margin-bottom: 30px; display: flex; align-items: center; gap: 12px;">
                📈 User Growth This Month
            </h2>
            
            <!-- Bar Chart -->
            <div style="position: relative; height: 350px; display: flex; align-items: flex-end; justify-content: space-around; border-bottom: 3px solid #e2e8f0; padding: 0 30px;">
                @php
                    $maxValue = max($newUsersThisMonth, 50);
                    $barHeight = ($newUsersThisMonth / $maxValue) * 100;
                @endphp
                
                <!-- Week 1 Bar -->
                <div style="flex: 1; display: flex; flex-direction: column; align-items: center; gap: 12px;">
                    <div style="font-weight: 700; color: #3b82f6; font-size: 1.2rem;">{{ floor($newUsersThisMonth * 0.2) }}</div>
                    <div style="width: 80px; background: linear-gradient(to top, #3b82f6, #60a5fa); border-radius: 12px 12px 0 0; transition: all 0.5s;" 
                         data-height="{{ ($newUsersThisMonth * 0.2 / $maxValue) * 100 }}%"
                         onload="this.style.height = this.dataset.height">
                    </div>
                    <div style="font-size: 1rem; color: #64748b; font-weight: 600;">Week 1</div>
                </div>

                <!-- Week 2 Bar -->
                <div style="flex: 1; display: flex; flex-direction: column; align-items: center; gap: 12px;">
                    <div style="font-weight: 700; color: #3b82f6; font-size: 1.2rem;">{{ floor($newUsersThisMonth * 0.25) }}</div>
                    <div style="width: 80px; background: linear-gradient(to top, #3b82f6, #60a5fa); border-radius: 12px 12px 0 0; transition: all 0.5s;" 
                         data-height="{{ ($newUsersThisMonth * 0.25 / $maxValue) * 100 }}%"
                         onload="this.style.height = this.dataset.height">
                    </div>
                    <div style="font-size: 1rem; color: #64748b; font-weight: 600;">Week 2</div>
                </div>

                <!-- Week 3 Bar -->
                <div style="flex: 1; display: flex; flex-direction: column; align-items: center; gap: 12px;">
                    <div style="font-weight: 700; color: #3b82f6; font-size: 1.2rem;">{{ floor($newUsersThisMonth * 0.3) }}</div>
                    <div style="width: 80px; background: linear-gradient(to top, #3b82f6, #60a5fa); border-radius: 12px 12px 0 0; transition: all 0.5s;" 
                         data-height="{{ ($newUsersThisMonth * 0.3 / $maxValue) * 100 }}%"
                         onload="this.style.height = this.dataset.height">
                    </div>
                    <div style="font-size: 1rem; color: #64748b; font-weight: 600;">Week 3</div>
                </div>

                <!-- Week 4 Bar -->
                <div style="flex: 1; display: flex; flex-direction: column; align-items: center; gap: 12px;">
                    <div style="font-weight: 700; color: #3b82f6; font-size: 1.2rem;">{{ floor($newUsersThisMonth * 0.25) }}</div>
                    <div style="width: 80px; background: linear-gradient(to top, #3b82f6, #60a5fa); border-radius: 12px 12px 0 0; transition: all 0.5s;" 
                         data-height="{{ ($newUsersThisMonth * 0.25 / $maxValue) * 100 }}%"
                         onload="this.style.height = this.dataset.height">
                    </div>
                    <div style="font-size: 1rem; color: #64748b; font-weight: 600;">Week 4</div>
                </div>
            </div>

            <!-- Total Summary -->
            <div style="margin-top: 30px; padding: 24px; background: #f0f9ff; border-radius: 16px; text-align: center;">
                <div style="font-size: 1rem; color: #0369a1; font-weight: 600; margin-bottom: 6px;">Total New Users This Month</div>
                <div style="font-size: 2.5rem; font-weight: 700; color: #0284c7;">{{ $newUsersThisMonth }}</div>
            </div>
        </div>

        <!-- RIGHT: Side Stats -->
        <div style="display: flex; flex-direction: column; gap: 24px;">
            
            <!-- Applications This Week -->
            <div style="background: white; border-radius: 20px; padding: 32px; box-shadow: 0 6px 30px rgba(0,0,0,0.1); border-left: 5px solid #f59e0b;">
                <div style="display: flex; align-items: center; gap: 20px;">
                    <div style="width: 75px; height: 75px; border-radius: 16px; background: linear-gradient(135deg, #fef3c7, #fde68a); display: flex; align-items: center; justify-content: center; font-size: 2.5rem;">
                        📋
                    </div>
                    <div>
                        <div style="font-size: 1rem; color: #78716c; margin-bottom: 6px; font-weight: 500;">Applications This Week</div>
                        <div style="font-size: 2.5rem; font-weight: 700; color: #f59e0b;">{{ $applicationsThisWeek }}</div>
                    </div>
                </div>
            </div>

            <!-- Active Jobs -->
            <div style="background: white; border-radius: 20px; padding: 32px; box-shadow: 0 6px 30px rgba(0,0,0,0.1); border-left: 5px solid #10b981;">
                <div style="display: flex; align-items: center; gap: 20px;">
                    <div style="width: 75px; height: 75px; border-radius: 16px; background: linear-gradient(135deg, #d1fae5, #a7f3d0); display: flex; align-items: center; justify-content: center; font-size: 2.5rem;">
                        ✅
                    </div>
                    <div>
                        <div style="font-size: 1rem; color: #78716c; margin-bottom: 6px; font-weight: 500;">Active Jobs</div>
                        <div style="font-size: 2.5rem; font-weight: 700; color: #10b981;">{{ $activeJobs }}</div>
                    </div>
                </div>
            </div>

            <!-- Active Users Today -->
            <div style="background: white; border-radius: 20px; padding: 32px; box-shadow: 0 6px 30px rgba(0,0,0,0.1); border-left: 5px solid #8b5cf6;">
                <div style="display: flex; align-items: center; gap: 20px;">
                    <div style="width: 75px; height: 75px; border-radius: 16px; background: linear-gradient(135deg, #ede9fe, #ddd6fe); display: flex; align-items: center; justify-content: center; font-size: 2.5rem;">
                        🟢
                    </div>
                    <div>
                        <div style="font-size: 1rem; color: #78716c; margin-bottom: 6px; font-weight: 500;">Active Users Today</div>
                        <div style="font-size: 2.5rem; font-weight: 700; color: #8b5cf6;">{{ $activeUsersToday }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
// Animate bar chart on load
document.addEventListener('DOMContentLoaded', function() {
    const bars = document.querySelectorAll('[data-height]');
    setTimeout(() => {
        bars.forEach(bar => {
            bar.style.height = bar.dataset.height;
        });
    }, 100);
});
</script>

<style>
[style*="transition: transform"] {
    cursor: pointer;
}
[style*="transition: transform"]:hover {
    transform: translateY(-5px) !important;
}

@media (max-width: 1024px) {
    div[style*="grid-template-columns: 1.2fr 450px"] {
        grid-template-columns: 1fr !important;
    }
}
</style>
@endsection