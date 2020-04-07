<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <img src={{url('/img/Hm-logo-02.png')}} class="navbar-brand-img" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src={{url('/img/Hm-logo-02.png')}}>
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('beneficiaries.index') }}">
                        <i class="fas fa-user-friends text-primary"></i> {{ __('Beneficiaries') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('insurees.index') }}">
                        <i class="fas fa-user-shield text-primary"></i> {{ __('Insurees') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('insurers.index') }}">
                        <i class="fas fa-shield-alt text-primary"></i> {{ __('Insurers') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('services.index') }}">
                        <i class="fas fa-procedures text-primary"></i> {{ __('Services') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('invoices.index') }}">
                        <i class="fas fa-file-invoice-dollar text-primary"></i> {{ __('Invoices') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('calls.index') }}">
                        <i class="fas fa-phone text-primary"></i> {{ __('Calls') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('payments.index') }}">
                        <i class="fas fa-dollar-sign text-primary"></i> {{ __('Payments') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('items.index') }}">
                        <i class="fas fa-prescription-bottle text-primary"></i> {{ __('Items') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('charts.index') }}">
                        <i class="fas fa-chart-line text-primary"></i> {{ __('Stats') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('categories.index') }}">
                        <i class="fas fa-cube text-primary"></i> {{ __('Categories') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
