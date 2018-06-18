@extends('layouts.app')
@section('link')
<script src='https://www.google.com/recaptcha/api.js'></script>
@endsection
@section('content')
 <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">

            <div class="account-bg">
                <div class="card-box mb-0">
                    <div class="text-center m-t-20">
                        <a href="#" class="logo">
                            <span><img style="width:50%;" src="{{ url('public/assets/images/logo3.jpg') }}"></span>

                        </a>
                    </div>
                    <div class="m-t-10 p-20">
                        <div class="row">
                            <div class="col-12 text-center">
                                <h6 class="text-muted text-uppercase m-b-0 m-t-0">Sign In</h6>
                            </div>
                        </div>
                        @include('partials.flash')
                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                            <div class="form-group row {{ $errors->has('email') ? ' parsley-error' : '' }}">
                                <div class="col-12">
                                    <input class="form-control" type="text" placeholder="Email" name="email" value="{{ old('email') }}" required="" >
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                </div>
                               
                            </div>

                            <div class="form-group row {{ $errors->has('email') ? ' parsley-error' : '' }}">
                                <div class="col-12">
                                    <input class="form-control" type="password" placeholder="Password" name="password" required="" >
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="checkbox checkbox-custom">
                                        <input id="checkbox-signup" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label for="checkbox-signup">
                                            Remember me
                                        </label>
                                    </div>
                                </div>
                            </div>

                             {!! app('captcha')->display() !!}

                            <div class="form-group text-center row m-t-10">
                                <div class="col-12">
                                    <button class="btn btn-success btn-block waves-effect waves-light" type="submit">Log In</button>
                                </div>
                            </div>
<!-- 
                            <div class="form-group row m-t-30 mb-0">
                                <div class="col-12">
                                    <a href="pages-recoverpw.html" class="text-muted"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
                                </div>
                            </div> -->

                           

                        </form>

                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- end card-box-->

           <!--  <div class="m-t-20">
                <div class="text-center">
                    <p class="text-white">Don't have an account? <a href="{{ route('register') }}" class="text-white m-l-5"><b>Sign Up</b></a></p>
                </div>
            </div> -->

        </div>
        <!-- end wrapper page -->
@endsection

@section('footer_script')


