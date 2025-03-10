<div class="main-menu" style="background-color:#1C1C1C !important">

            <!--- Menu -->
            <div data-simplebar>
                <ul class="app-menu">

                    <li class="menu-title">Menu</li>

                        <li class="menu-title">Tasks</li>
                        <li class="menu-item">
                            <a href="{{url('tasks')}}" class="menu-link waves-effect waves-light ">
                                <span class="menu-icon"><i class='bx bxs-cart-alt'></i></span>
                                <span class="menu-text"> View Tasks </span>
                            </a>
                        </li>

                        <!-- Navbar -->
                        @if(auth()->check())

                            @if(auth()->user()->roles->contains('id', 1))


                            {{-- Start Users View --}}
                            <li class="menu-title">User Settings</li>
                            <li class="menu-item">
                                <a href="#users" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                                    <span class="menu-icon"><i class="fa fa-users"></i></span>
                                    <span class="menu-text"> Users </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="users">
                                    <ul class="sub-menu">
                                        <li class="menu-item">
                                            <a href="{{url('users')}}" class="menu-link">
                                                <span class="menu-text">View Users</span>
                                            </a>
                                        </li>
                                        <li class="menu-item">
                                            <a href="{{url('users/create')}}" class="menu-link">
                                                <span class="menu-text">Add Users</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            {{-- Start Roles View --}}
                            <li class="menu-item">
                                <a href="#roles" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                                    <span class="menu-icon"><i class="bx bx-badge"></i></span>
                                    <span class="menu-text"> Roles </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="roles">
                                    <ul class="sub-menu">
                                        <li class="menu-item">
                                            <a href="{{ url('roles') }}" class="menu-link">
                                                <span class="menu-text">View Roles</span>
                                            </a>
                                        </li>
                                        <li class="menu-item">
                                            <a href="{{url('roles/create')}}" class="menu-link">
                                                <span class="menu-text">Add Role</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            {{-- End Roles View --}}

                            {{-- Start Permissions View --}}
                            <li class="menu-item">
                                <a href="#permissions" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                                    <span class="menu-icon"><i class="bx bx-user-check"></i></span>
                                    <span class="menu-text"> Permissions </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="permissions">
                                    <ul class="sub-menu">
                                        <li class="menu-item">
                                            <a href="{{ url('permissions') }}" class="menu-link">
                                                <span class="menu-text">View Permissions</span>
                                            </a>
                                        </li>
                                        <li class="menu-item">
                                            <a href="{{url('permissions/create')}}" class="menu-link">
                                                <span class="menu-text">Add Permissions</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            {{-- End Permissions View --}}

                            {{-- Start Manager View --}}
                            <li class="menu-item">
                                <a href="#admin" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                                    <span class="menu-icon"><i class="fa fa-user"></i></span>
                                    <span class="menu-text"> Managers</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="admin">
                                    <ul class="sub-menu">
                                        <li class="menu-item">
                                            <a href="{{ url('admins') }}" class="menu-link">
                                                <span class="menu-text">View Manager</span>
                                            </a>
                                        </li>
                                        <li class="menu-item">
                                            <a href="{{url('admins/create')}}" class="menu-link">
                                                <span class="menu-text">Add Manager</span>
                                            </a>
                                        </li>
                                        {{-- Start Partner's Employees View --}}
                                        <li class="menu-item">
                                            <a href="#admin-employees" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                                                <span class="menu-icon"><i class="bx bx-user"></i></span>
                                                <span class="menu-text"> Manager's Employees  </span>
                                                <span class="menu-arrow"></span>
                                            </a>
                                            <div class="collapse" id="admin-employees">
                                                <ul class="sub-menu">
                                                    <li class="menu-item">
                                                        <a href="{{ url('admin-employees') }}" class="menu-link">
                                                            <span class="menu-text">View Employees</span>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="{{url('admin-employees/create')}}" class="menu-link">
                                                            <span class="menu-text">Add Employee</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        {{-- End Partner's Employees View --}}
                                    </ul>
                                </div>
                            </li>
                            {{-- End Manager View --}}

                            {{-- Start Partners View --}}

                            {{-- End Partners View --}}

                            {{-- End Super Manager Views --}}
                            @elseif(auth()->user()->roles->contains('id', 2))

                             {{-- Start Manager View --}}
                              <li class="menu-title">User Settings</li>
                             <li class="menu-item">
                                <a href="#admin" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                                    <span class="menu-icon"><i class="fa fa-user"></i></span>
                                    <span class="menu-text"> Managers</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="admin">
                                    <ul class="sub-menu">

                                        {{-- Start Manager's Employees View --}}
                                        <li class="menu-item">
                                            <a href="#admin-employees" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                                                <span class="menu-icon"><i class="bx bx-user"></i></span>
                                                <span class="menu-text"> Manager's Employees  </span>
                                                <span class="menu-arrow"></span>
                                            </a>
                                            <div class="collapse" id="admin-employees">
                                                <ul class="sub-menu">
                                                    <li class="menu-item">
                                                        <a href="{{ url('admin-employees') }}" class="menu-link">
                                                            <span class="menu-text">View Employees</span>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="{{url('admin-employees/create')}}" class="menu-link">
                                                            <span class="menu-text">Add Employee</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            {{-- End Manager View --}}

                            @elseif(auth()->user()->roles->contains('id', 3))


                             {{-- Employees View --}}
                            @elseif(auth()->user()->roles->contains('id', 6))

                            {{-- Start Sales View --}}
                            <li class="menu-title">Tasks</li>
                            <li class="menu-item">
                                <a href="{{url('tasks')}}" class="menu-link waves-effect waves-light ">
                                    <span class="menu-icon"><i class='bx bxs-cart-alt'></i></span>
                                    <span class="menu-text"> View Tasks </span>
                                </a>
                            </li>
                            {{-- Start End View --}}

                            {{-- Start Employee View --}}
                            <li class="menu-item">
                                <a href="{{url('home')}}" class="menu-link waves-effect waves-light">
                                    <span class="menu-icon"><i class="bx bx-user"></i></span>
                                    <span class="menu-text"> Employee </span>
                                </a>
                            </li>

                            {{-- End Employee View --}}
                            @endif
                    @endauth
                </ul>
            </div>
        </div>
