@extends('layouts.admin')

@section('title', 'Job Management')

@section('content')
<div style="flex: 1; padding: 32px; overflow-y: auto;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <h1 style="font-size: 1.8rem; font-weight: 700; color: #e2e8f0;">Job Management</h1>
        <button onclick="openAddModal()" style="background: #10b981; color: white; border: none; padding: 12px 24px; border-radius: 12px; font-weight: 600; cursor: pointer;">
            <i class="fas fa-plus"></i> Add Job
        </button>
    </div>

    @if(session('success'))
    <div style="background: #10b981; color: white; padding: 12px 20px; border-radius: 12px; margin-bottom: 20px;">
        {{ session('success') }}
    </div>
    @endif

    <div style="background: #1e293b; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.2);">
        <table style="width: 100%; border-collapse: collapse;">
            <thead style="background: #334155;">
                <tr>
                    <th style="padding: 16px; text-align: left; color: #e2e8f0;">Title</th>
                    <th style="padding: 16px; text-align: left; color: #e2e8f0;">Company</th>
                    <th style="padding: 16px; text-align: left; color: #e2e8f0;">Location</th>
                    <th style="padding: 16px; text-align: left; color: #e2e8f0;">Type</th>
                    <th style="padding: 16px; text-align: left; color: #e2e8f0;">Status</th>
                    <th style="padding: 16px; text-align: center; color: #e2e8f0;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jobs as $job)
                <tr style="border-bottom: 1px solid #334155;">
                    <td style="padding: 16px; color: #e2e8f0; font-weight: 600;">{{ $job->title }}</td>
                    <td style="padding: 16px; color: #94a3b8;">{{ $job->company }}</td>
                    <td style="padding: 16px; color: #94a3b8;">{{ $job->location }}</td>
                    <td style="padding: 16px; color: #94a3b8;">{{ $job->job_type }}</td>
                    <td style="padding: 16px;">
                        <span style="background: {{ $job->status == 'active' ? '#10b981' : ($job->status == 'inactive' ? '#f59e0b' : '#ef4444') }}; color: white; padding: 4px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 600;">
                            {{ ucfirst($job->status) }}
                        </span>
                    </td>
                    <td style="padding: 16px; text-align: center;">
                        <button onclick='openEditModal(@json($job))' style="background: #3b82f6; color: white; border: none; padding: 6px 12px; border-radius: 8px; cursor: pointer; margin-right: 5px;">
                            <i class="fas fa-edit"></i>
                        </button>
                        <form action="{{ route('admin.jobs.delete', $job->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete this job?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: #ef4444; color: white; border: none; padding: 6px 12px; border-radius: 8px; cursor: pointer;">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding: 40px; text-align: center; color: #64748b;">No jobs found. Add one!</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        <div style="padding: 20px;">
            {{ $jobs->links() }}
        </div>
    </div>
</div>

<!-- Job Modal -->
<div id="jobModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.7); align-items: center; justify-content: center; z-index: 1000; overflow-y: auto; padding: 20px;">
    <div style="background: #1e293b; border-radius: 20px; padding: 30px; max-width: 600px; width: 100%; max-height: 90vh; overflow-y: auto;">
        <h2 id="modalTitle" style="color: #e2e8f0; margin-bottom: 20px;">Add Job</h2>
        <form id="jobForm" method="POST">
            @csrf
            <input type="hidden" id="jobMethod" name="_method" value="POST">
            <div style="margin-bottom: 15px;">
                <label style="display: block; color: #e2e8f0; margin-bottom: 5px;">Job Title *</label>
                <input type="text" name="title" id="title" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #334155; background: #0f172a; color: #e2e8f0;">
            </div>
            <div style="margin-bottom: 15px;">
                <label style="display: block; color: #e2e8f0; margin-bottom: 5px;">Company *</label>
                <input type="text" name="company" id="company" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #334155; background: #0f172a; color: #e2e8f0;">
            </div>
            <div style="margin-bottom: 15px;">
                <label style="display: block; color: #e2e8f0; margin-bottom: 5px;">Location *</label>
                <input type="text" name="location" id="location" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #334155; background: #0f172a; color: #e2e8f0;">
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                <div>
                    <label style="display: block; color: #e2e8f0; margin-bottom: 5px;">Min Salary</label>
                    <input type="number" name="salary_min" id="salary_min" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #334155; background: #0f172a; color: #e2e8f0;">
                </div>
                <div>
                    <label style="display: block; color: #e2e8f0; margin-bottom: 5px;">Max Salary</label>
                    <input type="number" name="salary_max" id="salary_max" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #334155; background: #0f172a; color: #e2e8f0;">
                </div>
            </div>
            <div style="margin-bottom: 15px;">
                <label style="display: block; color: #e2e8f0; margin-bottom: 5px;">Job Type *</label>
                <select name="job_type" id="job_type" required style="...">
    <!-- Values must match: 'full-time', 'part-time', 'contract', 'internship' -->
    <option value="full-time">Full Time</option>
    <option value="part-time">Part Time</option>
    <option value="contract">Contract</option>
    <option value="internship">Internship</option>
</select>
            </div>
            <div style="margin-bottom: 15px;">
                <label style="display: block; color: #e2e8f0; margin-bottom: 5px;">Description *</label>
                <textarea name="description" id="description" required rows="4" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #334155; background: #0f172a; color: #e2e8f0; resize: vertical;"></textarea>
            </div>
            <div style="margin-bottom: 15px;">
                <label style="display: block; color: #e2e8f0; margin-bottom: 5px;">Requirements</label>
                <textarea name="requirements" id="requirements" rows="3" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #334155; background: #0f172a; color: #e2e8f0; resize: vertical;"></textarea>
            </div>
            <div style="margin-bottom: 15px;">
                <label style="display: block; color: #e2e8f0; margin-bottom: 5px;">Status *</label>
                <select name="status" id="status" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #334155; background: #0f172a; color: #e2e8f0;">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                    <option value="blocked">Blocked</option>
                </select>
            </div>
            <div style="display: flex; gap: 10px; margin-top: 20px;">
                <button type="submit" style="flex: 1; background: #10b981; color: white; border: none; padding: 12px; border-radius: 8px; font-weight: 600; cursor: pointer;">Save</button>
                <button type="button" onclick="closeModal()" style="flex: 1; background: #64748b; color: white; border: none; padding: 12px; border-radius: 8px; font-weight: 600; cursor: pointer;">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
function openAddModal() {
    document.getElementById('modalTitle').textContent = 'Add New Job';
    document.getElementById('jobForm').action = "{{ route('admin.jobs.create') }}";
    document.getElementById('jobMethod').value = 'POST';
    document.getElementById('jobForm').reset();
    document.getElementById('jobModal').style.display = 'flex';
}

function openEditModal(job) {
    document.getElementById('modalTitle').textContent = 'Edit Job';
    document.getElementById('jobForm').action = `/admin/jobs/${job.id}`;
    document.getElementById('jobMethod').value = 'PUT';
    document.getElementById('title').value = job.title;
    document.getElementById('company').value = job.company;
    document.getElementById('location').value = job.location;
    document.getElementById('salary_min').value = job.salary_min || '';
    document.getElementById('salary_max').value = job.salary_max || '';
    document.getElementById('job_type').value = job.job_type;
    document.getElementById('description').value = job.description;
    document.getElementById('requirements').value = job.requirements || '';
    document.getElementById('status').value = job.status;
    document.getElementById('jobModal').style.display = 'flex';
}

function closeModal() {
    document.getElementById('jobModal').style.display = 'none';
}
</script>
@endsection