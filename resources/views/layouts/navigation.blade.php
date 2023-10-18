<!-- Sidebar -->

<head>
    <script src="https://kit.fontawesome.com/b31d358d35.js" crossorigin="anonymous"></script>
</head>
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
            <a href="{{ route('profile.show') }}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-item">
                <a href="{{ route('users.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        {{ __('Users') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('artist') }}" class="nav-link">
                    <i class="nav-icon far fa-address-card"></i>
                    <p>
                        {{ __('Artists') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">

                <a href="{{ route('artwork') }}" class="nav-link">
                    <i class="nav-icon fas fa-palette"></i>
                    <p>
                        {{ __('Artwork') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">

                <a href="{{ route('loan') }}" class="nav-link">
                    <i class="nav-icon fas fa-landmark"></i>
                    <p>
                        {{ __('Loans') }}

                    </p>
                </a>
            </li>

            <li class="nav-item">

                <a href="{{ route('acquisition') }}" class="nav-link">
                    <i class="nav-icon fas fa-money-bill"></i>
                    <p>
                        {{ __('Acquisition') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">

                <a href="{{ route('restoration') }}" class="nav-link">
                    <i class="nav-icon fas fa-recycle"></i>
                    <p>
                        {{ __('Restorations') }}

                    </p>
                </a>
            </li>

            <li class="nav-item">

                <a href="{{ route('reservation') }}" class="nav-link">
                    <i class="nav-icon fa-regular fa-bookmark"></i>
                    <p>
                        {{ __('Reservation') }}

                    </p>
                </a>
            </li>

            <li class="nav-item">

                <a href="{{ route('bibliography') }}" class="nav-link">
                    <i class="nav-icon fas fa-book"></i>
                    <p>
                        {{ __('Bibliography') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('exhibition') }}" class="nav-link">
                    <i class="nav-icon fas fa-store"></i>
                    <p>
                        {{ __('Exhibition') }}

                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('image') }}" class="nav-link">
                    <i class="nav-icon fas fa-images"></i>
                    <p>
                        {{ __('Images') }}

                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('stats') }}" class="nav-link">
                    <i class="nav-icon fa-solid fa-chart-simple"></i>
                    <p>
                        {{ __('Statistics') }}

                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('material') }}" class="nav-link">
                    <i class="nav-icon fa-solid fa-hammer"></i>
                    <p>
                        {{ __('Materials') }}

                    </p>
                </a>
            </li>
            @if (auth()->user()->role == 'superadmin')
                <li class="nav-item">
                    <a href="{{ route('inventory_notice') }}" class="nav-link">
                        <i class="fa fa-history" aria-hidden="true"></i>
                        <p>
                            {{ __('Inventory Notices') }}

                        </p>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
