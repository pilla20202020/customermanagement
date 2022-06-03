<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Main</li>

                <li>
                    <a href="{{route('dashboard')}}" class="waves-effect">
                        <i class="mdi mdi-speedometer"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow" aria-expanded="false">
                        <i class="mdi mdi-share-variant"></i>
                        <span>Admin</span>
                    </a>
                    <ul class="sub-menu mm-collapse" aria-expanded="true">
                        <li><a href="{{ route('user.index')}}" aria-expanded="false"><i class="fas fa-user"></i></i> Users</a></li>
                        <li><a href="{{ route('role.index')}}" aria-expanded="false"><i class="fa fa-tasks"></i> Roles</a></li>
                        <li><a href="{{ route('permission.index')}}" aria-expanded="false"><i class="fa fa-lock"></i> Permissions</a></li>
                        <li><a href="{{ route('room.index')}}" aria-expanded="false"><i class="fas fa-bed"></i> Rooms</a></li>
                    </ul>
                </li>

                <li class=""><a href="javascript: void(0);" class="has-arrow" aria-expanded="false" aria-expanded="false"><i class="fa fa-users"></i> Customers</a>
                    <ul class="sub-menu mm-collapse" aria-expanded="true">

                        {{-- <li><a href="{{route('vacancies.all_candidate_applications')}}" aria-expanded="false"><i class="fas fa-address-card"></i>All Applications</a></li> --}}
                        <li><a href="{{route('customer.index')}}"><i class="fas fa-hand-point-right"></i> View All Customers</a></li>
                        <li><a href="{{route('customer.create')}}"><i class="fas fa-hand-point-right"></i> Add Customers</a></li>
                        <li><a href="{{route('checkin.index')}}"><i class="fas fa-hand-point-right"></i> View Check-In</a></li>
                        <li><a href="{{route('checkin.create')}}"><i class="fas fa-hand-point-right"></i> Add Check-In</a></li>
                        {{-- <li><a href="#"><i class="fas fa-hand-point-right"></i> Rejected Candidates</a></li> --}}
                    </ul>
                </li>

                <li class=""><a href="javascript: void(0);" class="has-arrow" aria-expanded="false" aria-expanded="false"><i class="fa fa-file"></i> Reports</a>
                    <ul class="sub-menu mm-collapse" aria-expanded="true">

                        {{-- <li><a href="{{route('vacancies.all_candidate_applications')}}" aria-expanded="false"><i class="fas fa-address-card"></i>All Applications</a></li> --}}
                        <li><a href="{{route('report.index')}}"><i class="fas fa-hand-point-right"></i> Reports</a></li>
                    </ul>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
