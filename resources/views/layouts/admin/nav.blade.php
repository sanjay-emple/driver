 <nav class="navbar-custom">

                    <ul class="list-inline float-right mb-0">
                       
                        <li class="list-inline-item dropdown notification-list">
                            <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                               aria-haspopup="false" aria-expanded="false">

                                @if(auth()->check() and auth()->user()->profile_img != null and !empty(auth()->user()->profile_img) )
                                <img src="{{ url('public/uploads/profile_image/'.auth()->user()->profile_img) }}" alt="user" class="rounded-circle">
                                @else
                                <img src="{{ url('public/assets/images/no_avatar.png')}}" alt="user" class="rounded-circle">
                                @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5 class="text-overflow"><small>Hi ! {{ auth()->user()->fullname()}} </small> </h5>
                                </div>

                               
                                <!-- item-->
                                 <a href="{{ route('profile.image.form') }}" class="dropdown-item notify-item">
                                    <i class="zmdi zmdi-assignment-account"></i> <span>Profile Image</span> 
                                </a>

                                <a href="{{ route('logout') }}" class="dropdown-item notify-item">
                                    <i class="zmdi zmdi-power"></i> <span>Logout</span> 
                                </a>

                            </div>
                        </li>

                    </ul>

                    <ul class="list-inline menu-left mb-0">
                        <li class="float-left">
                            <button class="button-menu-mobile open-left waves-light waves-effect">
                                <i class="zmdi zmdi-menu"></i>
                            </button>
                        </li>
                    </ul>

                </nav>