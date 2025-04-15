<!DOCTYPE html>
<html>
<head>
    <title>User Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .collapse-toggle {
            cursor: pointer;
        }
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .filter-input {
            max-width: 300px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>User Management</h1>
        <div>
            <a href="{{ route('admin.users.create') }}" class="btn btn-success">Create New User</a>
            <a href="{{ url('/admin/dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="mb-4">
        <input type="text" class="form-control filter-input" id="classFilter" placeholder="Filter by class code...">
    </div>

    @foreach($groupedUsers as $classCode => $classUsers)
        <div class="card mb-4 class-group" data-class="{{ strtolower($classCode ?? 'unassigned') }}">
            <div class="card-header bg-dark text-white collapse-toggle" data-bs-toggle="collapse" data-bs-target="#group-{{ $loop->index }}" aria-expanded="true">
                <span>Class Code: {{ $classCode ?? 'Unassigned' }}</span>
                <span class="badge bg-light text-dark">{{ $classUsers->count() }} Users</span>
            </div>
            <div id="group-{{ $loop->index }}" class="collapse show">
                <div class="card-body p-0">
                    <table class="table table-bordered mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Student ID</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($classUsers as $user)
                                <tr>
                                    <td>{{ $user->full_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->student_id }}</td>
                                    <td>{{ $user->is_admin ? 'Admin' : 'Student' }}</td>
                                    <td>
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('classFilter').addEventListener('input', function () {
        const filter = this.value.toLowerCase();
        document.querySelectorAll('.class-group').forEach(group => {
            const classCode = group.getAttribute('data-class');
            group.style.display = classCode.includes(filter) ? '' : 'none';
        });
    });
</script>
</body>
</html>
