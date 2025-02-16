<aside class="sidebar">
    <button type="button" class="sidebar-close-btn">
        <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>
    <div>
        <a href="{{ route('dashboard') }}" class="sidebar-logo">
            <img src="{{ asset('assets/images/logo.png') }}" alt="site logo" class="light-logo">
            <img src="{{ asset('assets/images/logo-light.png') }}" alt="site logo" class="dark-logo">
            <img src="{{ asset('assets/images/logo-icon.png') }}" alt="site logo" class="logo-icon">
        </a>
    </div>
    <div class="sidebar-menu-area">
        <ul class="sidebar-menu" id="sidebar-menu">
            <li>
                <a href="{{ route('dashboard') }}">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="flowbite:users-group-outline" class="menu-icon"></iconify-icon>
                    <span>Employees</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('department.index') }}"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                            Department</a>
                    </li>
                    <li>
                        <a href="{{ route('designation.index') }}"><i
                                class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Designations</a>
                    </li>
                    <li>
                        <a href="{{ route('employee.index') }}"><i class="ri-circle-fill circle-icon text-info-main w-auto"></i> Manage Employee</a>
                    </li>
                    <li>
                        <a href="{{ route('employee.create') }}"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i>
                            Add Employee</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="flowbite:calendar-month-outline" class="menu-icon"></iconify-icon>
                    <span>Leave Management</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('designation.index') }}"><i
                                class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Leave Application</a>
                    </li>
                    <li>
                        <a href="{{ route('leave-types.index') }}"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                            Leave Types</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</aside>
