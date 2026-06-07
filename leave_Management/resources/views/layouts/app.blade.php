<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>

        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>
            Employee Leave Management System
        </title>

        <link rel="dns-prefetch" href="//fonts.bunny.net">

        <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

        @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    </head>


    <body>

        <div id="app">

            <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">

                <div class="container">

                    <a class="navbar-brand fw-bold" href="/">

                        Leave Management System

                    </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent">

                        <span class="navbar-toggler-icon"></span>

                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">

                        <ul class="navbar-nav me-auto">

                            @auth

                                {{-- Employee --}}

                                @if (auth()->user()->role === 'employee')
                                    <li class="nav-item">

                                        <a class="nav-link" href="{{ route('employee.leave.index') }}">

                                            Dashboard

                                        </a>

                                    </li>

                                    <li class="nav-item">

                                        <a class="nav-link" href="{{ route('employee.leave.index') }}">

                                            My Leaves

                                        </a>

                                    </li>

                                    <li class="nav-item">

                                        <a class="nav-link" href="{{ route('employee.leave.create') }}">

                                            Apply Leave

                                        </a>

                                    </li>
                                @endif

                                {{-- Manager --}}

                                @if (auth()->user()->role === 'manager')
                                    <li class="nav-item">

                                        <a class="nav-link" href="{{ route('manager.dashboard') }}">

                                            Dashboard

                                        </a>

                                    </li>

                                    <li class="nav-item">

                                        <a class="nav-link" href="{{ route('manager.leave.index') }}">

                                            Leave Requests

                                        </a>

                                    </li>
                                @endif

                                {{-- Admin --}}

                                @if (auth()->user()->role === 'admin')
                                    <li class="nav-item">

                                        <a class="nav-link" href="{{ route('admin.dashboard') }}">

                                            Dashboard

                                        </a>

                                    </li>

                                    <li class="nav-item">

                                        <a class="nav-link" href="{{ route('users.index') }}">

                                            Users

                                        </a>

                                    </li>

                                    <li class="nav-item">

                                        <a class="nav-link" href="{{ route('leave-types.index') }}">

                                            Leave Types

                                        </a>

                                    </li>

                                    <li class="nav-item">

                                        <a class="nav-link" href="{{ route('reports.index') }}">

                                            Reports

                                        </a>

                                    </li>

                                    <li class="nav-item">

                                        <a class="nav-link" href="{{ route('audit-logs.index') }}">

                                            Audit Logs

                                        </a>

                                    </li>
                                @endif

                            @endauth

                        </ul>

                        <ul class="navbar-nav ms-auto">

                            @guest

                                <li class="nav-item">

                                    <a class="nav-link" href="{{ route('login') }}">

                                        Login

                                    </a>

                                </li>
                            @else
                                <li class="nav-item dropdown">

                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown">

                                        {{ Auth::user()->name }}

                                        <span class="badge bg-light text-dark ms-1">

                                            {{ ucfirst(Auth::user()->role) }}

                                        </span>

                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end">

                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">

                                            Logout

                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">

                                            @csrf

                                        </form>

                                    </div>

                                </li>

                            @endguest

                        </ul>

                    </div>

                </div>

            </nav>

            <main class="py-4">

                <div class="container">

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show">

                            {{ session('success') }}

                            <button type="button" class="btn-close" data-bs-dismiss="alert">
                            </button>

                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">

                            {{ session('error') }}

                            <button type="button" class="btn-close" data-bs-dismiss="alert">
                            </button>

                        </div>
                    @endif

                </div>

                @yield('content')

            </main>

        </div>
        @stack('scripts')
    </body>

</html>
