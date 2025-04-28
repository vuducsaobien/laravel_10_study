<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel App')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
            padding-top: 20px;
            position: fixed;
            width: 250px;
            z-index: 1000;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            padding: 10px 15px;
            display: block;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .sidebar a.active {
            background-color: #007bff;
        }
        .main-content {
            padding: 20px;
            margin-left: 250px;
        }
        .user-info {
            color: #fff;
            padding: 15px;
            border-bottom: 1px solid #495057;
            margin-bottom: 20px;
        }
        .user-info p {
            margin: 0;
            font-size: 14px;
        }
        .user-info .email {
            color: #17a2b8;
            font-weight: bold;
        }
        .alert {
            margin-bottom: 20px;
        }
        .navbar-toggler {
            display: none;
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: relative;
                min-height: auto;
            }
            .main-content {
                margin-left: 0;
            }
            .navbar-toggler {
                display: block;
                position: absolute;
                top: 10px;
                right: 10px;
            }
            .sidebar.collapsed {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar" id="sidebar">
                <button class="navbar-toggler" type="button" onclick="toggleSidebar()">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="user-info">
                    <p>Đang đăng nhập với:</p>
                    <p class="email">{{ auth()->user()->email }}</p>
                </div>
                <h4 class="text-white text-center mb-4">Menu</h4>
                <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
                    Users
                </a>
                <a href="{{ route('posts.index') }}" class="{{ request()->routeIs('posts.*') ? 'active' : '' }}">
                    Posts
                </a>
                <form action="{{ route('logout') }}" method="POST" class="mt-4">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100">Logout</button>
                </form>
            </div>

            <!-- Main content -->
            <div class="col-md-10 main-content">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('collapsed');
        }
    </script>
    @yield('scripts')
</body>
</html> 