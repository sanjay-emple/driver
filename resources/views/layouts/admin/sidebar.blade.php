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
                                <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-assignment-account"></i> <span> User Management </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="{{ route('admin.user.index') }}">User List</a></li>
                                    <li><a href="{{ route('admin.invite.index') }}">Invite</a></li>
                
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