<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('public/adminLTE/plugins/fontawesome-free/css/all.min.css') }}" />
    <!-- pace-progress -->
    <link rel="stylesheet"
        href="{{ asset('public/adminLTE/plugins/pace-progress/themes/black/pace-theme-flat-top.css') }}" />
    <!-- DataTables -->
    <link rel="stylesheet"
        href="{{ asset('public/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('public/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('public/adminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('public/adminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <link rel="stylesheet"
        href="{{ asset('public/adminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('public/adminLTE/plugins/toastr/toastr.min.css') }}">
    <!-- adminlte-->
    <link rel="stylesheet" href="{{ asset('public/adminLTE/dist/css/adminlte.min.css') }}" />
    <style>
        .icon-container {
            width: 50px;
            height: 50px;
            position: relative;
            left: 15px;
            margin-right: 10px;
        }

        .icon-container img {
            height: 100%;
            width: 100%;
            border-radius: 50%;
        }

        .icon-container .status-circle {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            border: 2px solid white;
            bottom: 0;
            right: 0;
            position: absolute;
        }

        .share-list-scrollable {
            max-height: 300px;
            /* margin-bottom: 10px; */
            /* overflow: scroll; */
            -webkit-overflow-scrolling: touch;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini pace-primary">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" onclick="toggleSidebar()" href="#"
                        role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a type="submit" onclick="toggleDarkMode()" title="Toggle Dark Mode" class="nav-link border-0">
                        <i class="fas fa-sun"></i>
                    </a>
                </li>
                <li class="nav-item">

                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <a href="#" onclick="document.getElementById('logout-form').submit();" type="submit"
                            title="Sign Out" class="nav-link ">
                            <i class="fas fa-sign-out-alt"></i>
                        </a>
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/home" class="brand-link text-center">
                <span class="brand-text font-weight-light text-uppercase">Contact List System</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class='icon-container'>
                            <img
                                src="{{ Auth::user()->profileimg === null ? asset('public/adminLTE/dist/img/personplaceholder.png') : Auth::user()->profileimg }}" />
                            <div class='status-circle bg-success'>
                            </div>
                        </div>
                        <div class="info">
                            <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                            <a href="#" class="d-block text-sm">{{ Auth::user()->access_level }}</a>
                        </div>
                    </div>

                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        @if (Auth::user()->access_level === 'Admin')
                            <li class="nav-header">ADMIN SECTION</li>
                            <li class="nav-item">
                                <a href="{{ route('users.index') }}"
                                    class="nav-link {{ in_array(Route::currentRouteName(), ['users.index', 'users.edit']) ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Manage Users</p>
                                </a>
                            </li>
                        @endif
                        <li class="nav-header">NAVIGATION</li>
                        <li class="nav-item">
                            <a href="{{ route('home') }}"
                                class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user-circle"></i>
                                <p>My Profile</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('contacts.index') }}"
                                class="nav-link {{ in_array(Route::currentRouteName(), ['contacts.index', 'contacts.create', 'contacts.edit', 'contacts.shareContact']) ? 'active' : '' }}">
                                <i class="nav-icon fas fa-book"></i>
                                <p>My Contact List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('friends.index') }}"
                                class="nav-link {{ in_array(Route::currentRouteName(), ['friends.index']) ? 'active' : '' }}">
                                <i class="nav-icon fas fa-heart"></i>
                                <p>My Friends</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('friendRequests.index') }}"
                                class="nav-link {{ in_array(Route::currentRouteName(), ['friendRequests.index']) ? 'active' : '' }}">
                                <i class="nav-icon fas fa-paper-plane"></i>
                                <p>Friend Requests</p>
                                <span id="friendRequestCount" class="right d-none badge badge-danger">0</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('friends.findFriend') }}"
                                class="nav-link {{ in_array(Route::currentRouteName(), ['friends.findFriend']) ? 'active' : '' }}">
                                <i class="nav-icon fas fa-search"></i>
                                <p>Find Friends</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">
                                    @yield('title')
                                </h1>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->
                {{-- MAIN CONTENT --}}
                @yield('content')
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('public/adminLTE/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('public/adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('public/adminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('public/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('public/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('public/adminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('public/adminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('public/adminLTE/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('public/adminLTE/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('public/adminLTE/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('public/adminLTE/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('public/adminLTE/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('public/adminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- pace-progress -->
    <script src="{{ asset('public/adminLTE/plugins/pace-progress/pace.min.js') }}"></script>

    <script src="{{ asset('public/adminLTE/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('public/adminLTE/plugins/toastr/toastr.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('public/adminLTE/dist/js/adminlte.min.js') }}"></script>
    <script>
        let isSidebarToggled = false;

        isDarkMode();
        initDataTable();
        initFriendRequestCount();


        function initFriendRequestCount() {
            let count = 0;
            fetch('/friend-requests-count')
                .then((response) => response.json())
                .then((data) => {
                    count = data;
                    if (count.friendRequestsCount > 0) {

                        document.getElementById('friendRequestCount')
                            .classList.remove('d-none');
                        document.getElementById('friendRequestCount')
                            .innerText = count.friendRequestsCount;
                    }
                });

        }

        function initDataTable() {
            $("#datatable").DataTable();
            $("#datatable2").DataTable();
        }

        function isDarkMode() {
            let isDarkModeToggled = localStorage.getItem('isDarkModeToggle');
            isDarkModeToggled = JSON.parse(isDarkModeToggled);
            if (isDarkModeToggled) {
                document.querySelector('nav').classList.remove('navbar-light');
                document.querySelector('nav').classList.remove('navbar-white');
                document.querySelector('body').classList.add('dark-mode');
                document.querySelector('nav').classList.add('navbar-dark');
            } else {
                document.querySelector('body').classList.remove('dark-mode');
                document.querySelector('nav').classList.remove('navbar-dark');
                document.querySelector('nav').classList.add('navbar-light');
                document.querySelector('nav').classList.add('navbar-white');
            }
        }

        function checkAllFriends() {
            const checkboxes = document.querySelectorAll('input[name="friends[]"]');
            checkboxes.forEach((cb) => {
                cb.checked = !cb.checked;
            });
        }

        function toggleSidebar() {
            isSidebarToggled = !isSidebarToggled;
            if (isSidebarToggled) {
                document.querySelector('.icon-container').classList.add('d-none');
            } else {
                document.querySelector('.icon-container').classList.remove('d-none');
            }
        }

        function toggleDarkMode() {
            let isDarkModeToggled = localStorage.getItem('isDarkModeToggle');
            isDarkModeToggled = JSON.parse(isDarkModeToggled);
            if (isDarkModeToggled) {
                localStorage.removeItem('isDarkModeToggle');
                document.querySelector('body').classList.remove('dark-mode');
                document.querySelector('nav').classList.remove('navbar-dark');
                document.querySelector('nav').classList.add('navbar-light');
                document.querySelector('nav').classList.add('navbar-white');
            } else {
                localStorage.setItem('isDarkModeToggle', true);
                document.querySelector('nav').classList.remove('navbar-light');
                document.querySelector('nav').classList.remove('navbar-white');
                document.querySelector('body').classList.add('dark-mode');
                document.querySelector('nav').classList.add('navbar-dark');
            }

        }

        function confirmAction(e, form) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(form).submit();
                }
            })
        }

        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif
    </script>
</body>

</html>
