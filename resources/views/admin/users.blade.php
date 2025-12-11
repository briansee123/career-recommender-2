<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Quicksand', sans-serif;
            background: #f1f5f9;
            color: #334155;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* HEADER */
        header {
            background: #0f172a;
            padding: 14px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .header-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            font-size: 1.4rem;
            color: #fff;
        }
        .logo .title {
            background: linear-gradient(90deg, #3b82f6, #8b5cf6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .user-menu {
            position: relative;
            display: inline-block;
        }
        .user-icon {
            width: 40px;
            height: 40px;
            background: #3b82f6;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            cursor: pointer;
            transition: 0.2s;
        }
        .user-icon:hover { background: #2563eb; }
        .dropdown {
            position: absolute;
            top: 50px;
            right: 0;
            background: #1e293b;
            border-radius: 12px;
            min-width: 180px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.4);
            overflow: hidden;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 1000;
        }
        .dropdown.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        .dropdown a {
            display: block;
            padding: 12px 16px;
            color: #e2e8f0;
            text-decoration: none;
            font-size: 0.95rem;
            transition: 0.2s;
        }
        .dropdown a:hover { background: #334155; }
        .dropdown a.logout { color: #f87171; border-top: 1px solid #334155; }

        /* MAIN LAYOUT */
        .main-layout {
            display: flex;
            flex: 1;
            overflow: hidden;
        }

        /* SIDEBAR */
        .sidebar {
            width: 260px;
            background: #1e40af;
            padding: 24px 0;
            border-right: 1px solid #1d4ed8;
            flex-shrink: 0;
        }
        .sidebar-header {
            padding: 0 24px 16px;
            font-size: 1.1rem;
            font-weight: 700;
            color: #e0e7ff;
            border-bottom: 1px solid #1d4ed8;
            margin-bottom: 16px;
        }
        .sidebar-menu {
            list-style: none;
        }
        .sidebar-menu li {
            margin-bottom: 4px;
        }
        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 24px;
            color: #dbeafe;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .sidebar-menu a:hover {
            background: #1d4ed8;
            color: white;
        }
        .sidebar-menu a.active {
            background: #1d4ed8;
            color: white;
            border-left: 4px solid #60a5fa;
        }
        .sidebar-menu i {
            width: 20px;
            font-size: 1.1rem;
        }

        /* CONTENT */
        .content {
            flex: 1;
            padding: 32px;
            overflow-y: auto;
            background: #f8fafc;
        }
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 16px;
        }
        .page-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #1e293b;
        }
        .search-add {
            display: flex;
            gap: 12px;
            align-items: center;
        }
        .search-box {
            position: relative;
            display: flex;
            align-items: center;
        }
        .search-box input {
            padding: 10px 14px 10px 40px;
            border: 1.5px solid #cbd5e1;
            border-radius: 12px;
            font-size: 1rem;
            width: 280px;
            background: white;
            transition: all 0.3s;
        }
        .search-box input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }
        .search-box i {
            position: absolute;
            left: 12px;
            color: #64748b;
        }

        .add-btn {
            background: #3b82f6;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: 0.2s;
        }
        .add-btn:hover {
            background: #2563eb;
        }

        /* TABLE */
        .table-container {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        thead {
            background: #f1f5f9;
        }
        th {
            padding: 16px 20px;
            text-align: left;
            font-weight: 600;
            color: #475569;
            font-size: 0.95rem;
            border-bottom: 1px solid #e2e8f0;
        }
        td {
            padding: 16px 20px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }
        .user-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1rem;
        }
        .user-name {
            font-weight: 600;
            color: #1e293b;
        }
        .user-email {
            font-size: 0.85rem;
            color: #64748b;
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }
        .status.active { background: #dcfce7; color: #166534; }
        .status.inactive { background: #fef3c7; color: #713f12; }

        .action-btn {
            background: none;
            border: none;
            font-size: 1.1rem;
            cursor: pointer;
            padding: 6px;
            border-radius: 6px;
            transition: 0.2s;
        }
        .action-btn.delete { color: #ef4444; }
        .action-btn.delete:hover { background: #fee2e2; }

        /* MODAL */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            backdrop-filter: blur(5px);
        }
        .modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .modal-content {
            background: white;
            padding: 30px;
            border-radius: 20px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #e2e8f0;
        }
        .modal-header h2 {
            color: #1e293b;
            font-size: 1.5rem;
        }
        .close {
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }
        .close:hover {
            color: #3b82f6;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #475569;
            font-weight: 600;
            font-size: 0.95rem;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 1.5px solid #cbd5e1;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s;
        }
        .form-group input:focus, .form-group select:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        .form-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            margin-top: 25px;
        }
        .btn-submit, .btn-cancel {
            padding: 12px 30px;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn-submit {
            background: #3b82f6;
            color: white;
            border: none;
        }
        .btn-submit:hover {
            background: #2563eb;
        }
        .btn-cancel {
            background: #f1f5f9;
            color: #475569;
            border: 1px solid #cbd5e1;
        }
        .btn-cancel:hover {
            background: #e2e8f0;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 8px;
            padding: 20px;
            background: white;
            border-top: 1px solid #e2e8f0;
        }
        .pagination a, .pagination span {
            padding: 8px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            text-decoration: none;
            color: #64748b;
            font-weight: 600;
            transition: 0.2s;
        }
        .pagination a:hover {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }
        .pagination .active {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }

        @media (max-width: 992px) {
            .main-layout { flex-direction: column; }
            .sidebar { width: 100%; }
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <header>
        <div class="header-container">
            <div class="logo">
                <span class="title">CAREER PATH RECOMMENDER</span>
            </div>
            <div class="user-menu">
                <div class="user-icon" onclick="toggleDropdown()">
                    <i class="fas fa-user"></i>
                </div>
                <div class="dropdown" id="user-dropdown">
                    <a href="{{ route('admin.dashboard') }}">Homepage</a>
                    <a href="{{ route('admin.profile') }}">My Profile</a>
                    <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                        @csrf
                        <a href="#" onclick="event.preventDefault(); this.closest('form').submit();" class="logout">Log Out</a>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- MAIN LAYOUT -->
    <div class="main-layout">
        <!-- SIDEBAR -->
        <aside class="sidebar">
            <div class="sidebar-header">Admin Panel</div>
            <ul class="sidebar-menu">
                <li><a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="{{ route('admin.users') }}" class="active"><i class="fas fa-users"></i> Edit Users</a></li>
                <li><a href="{{ route('admin.questions') }}"><i class="fas fa-question-circle"></i> Edit Test Questions</a></li>
                <li><a href="{{ route('admin.jobs') }}"><i class="fas fa-briefcase"></i> Edit Jobs</a></li>
            </ul>
        </aside>

        <!-- CONTENT -->
        <main class="content">
            <div class="page-header">
                <h1 class="page-title">User Management</h1>
                <div class="search-add">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search users..." id="search-input">
                    </div>
                    <button class="add-btn" onclick="openAddModal()">
                        <i class="fas fa-plus"></i> Add New User
                    </button>
                </div>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Date Created</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $index => $user)
                        <tr>
                            <td>{{ $users->firstItem() + $index }}</td>
                            <td class="user-cell">
                                <div class="user-avatar">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="user-name">{{ $user->name }}</div>
                                    <div class="user-email">{{ $user->email }}</div>
                                </div>
                            </td>
                            <td>{{ $user->created_at->format('d/m/Y') }}</td>
                            <td>{{ $user->is_admin ? 'Admin' : 'User' }}</td>
                            <td><span class="status {{ $user->status }}">{{ ucfirst($user->status) }}</span></td>
                            <td class="action-cell">
                                <button class="action-btn delete" onclick="deleteUser({{ $user->id }})" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="pagination">
                    {{ $users->links('pagination::simple-default') }}
                </div>
            </div>
        </main>
    </div>

    <!-- ADD USER MODAL -->
    <div id="addModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Add New User</h2>
                <span class="close" onclick="closeModal()">&times;</span>
            </div>
            <form id="addUserForm">
                @csrf
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select name="is_admin" required>
                        <option value="0">User</option>
                        <option value="1">Admin</option>
                    </select>
                </div>
                <div class="form-actions">
                    <button type="button" class="btn-cancel" onclick="closeModal()">Cancel</button>
                    <button type="submit" class="btn-submit">Add User</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleDropdown() {
            document.getElementById('user-dropdown').classList.toggle('show');
        }

        window.addEventListener('click', function(e) {
            if (!e.target.closest('.user-menu')) {
                document.getElementById('user-dropdown').classList.remove('show');
            }
        });

        function openAddModal() {
            document.getElementById('addModal').classList.add('show');
        }

        function closeModal() {
            document.getElementById('addModal').classList.remove('show');
        }

        // Add User
        document.getElementById('addUserForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch('{{ route("admin.users.create") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('User created successfully!');
                    location.reload();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error creating user');
            });
        });

        // Delete User
        function deleteUser(id) {
            if (!confirm('Are you sure you want to delete this user?')) return;
            
            fetch(`/admin/users/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    location.reload();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error deleting user');
            });
        }

        // Search
        document.getElementById('search-input').addEventListener('input', function() {
            const query = this.value.toLowerCase();
            document.querySelectorAll('tbody tr').forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });
        });
    </script>
</body>
</html>