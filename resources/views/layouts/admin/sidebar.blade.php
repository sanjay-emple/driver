<div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <ul>
                            <li class="has_sub">
                                <a href="{{ route('dashboard') }}" class="waves-effect"><i class="zmdi zmdi-view-dashboard"></i><span> Dashboard </span> </a>
                            </li>
                            @if(auth()->check() and auth()->user()->id == 1)
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-assignment-account"></i> <span> Driver Management </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="{{ route('admin.user.index') }}">Driver List</a></li>
                                    <li><a href="{{ route('admin.invite.index') }}">Invite</a></li>
                                    <li><a href="{{ route('admin.user.changepassword.form') }}">Change Password</a></li>
                                </ul>
                            </li>
                            @else

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-assignment-account"></i> <span> Profile Management </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                <li><a href="{{ route('user.edit') }}">Change Profile</a></li>
                                <li><a href="{{ route('user.changepassword.form') }}">Change Password</a></li>

                                <li><a href="{{ route('invite.inviteform') }}">Invite</a></li>

                                </ul>
                            </li>

                            @endif 
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>

                </div>

            </div>