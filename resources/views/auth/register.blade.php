@extends('layouts.app')
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
                                <h6 class="text-muted text-uppercase m-b-0 m-t-0">Sign Up</h6>
                            </div>
                        </div>
                        @include('partials.flash')
                        <form class="form-horizontal" method="POST" action="{{ route('register') }}" autocomplete="off">
                        {{ csrf_field() }}

                        <input type="hidden" name="ref_code" value="{{ $ref_code }}">

                           <div class="form-group row">
                                <div class="col-6">
                                    <input class="form-control" type="text" name="first_name" required="" placeholder="First name" value="{{ old('first_name') }}" autocomplete="off">
                                   
                                </div>
                                <div class="col-6">
                                    <input class="form-control" type="text" name="last_name" required="" placeholder="Last Name" value="{{ old('last_name') }}" autocomplete="off">
                                   
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control" type="email" required="" placeholder="Email" name="email" value="{{ old('email') }}" autocomplete="off">
                              
                                </div>
                            </div>
                             <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control" type="password" required="" placeholder="Password" name="password" autocomplete="off">
                                </div>
                            </div>

                             <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control" type="password" name="password_confirmation"  required="" placeholder="Confirm Password" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                   <input class="form-control" type="text" required="" placeholder="City" name="city" value="{{ old('city') }}" autocomplete="off">
                                </div>
                            </div>

                             <div class="form-group row">
                              <div class="col-12">
                                 <input class="form-control" type="text" required="" placeholder="Address" name="address" value="{{ old('address') }}" autocomplete="off">
                              </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-6">
                                   <input class="form-control" type="text" required="" placeholder="Postcode" name="postcode" value="{{ old('postcode') }}" autocomplete="off">
                                </div>
                                <div class="col-6">
                                   <input class="form-control" type="text" required="" placeholder="Telephone number" name="telephone" value="{{ old('telephone') }}" autocomplete="off">
                                </div>
                            </div>

                           <!--  <div class="form-group row">
                                <div class="col-12">
                                    <div class="checkbox checkbox-primary">
                                        <input id="checkbox-signup" type="checkbox" checked="checked">
                                        <label for="checkbox-signup">I accept <a href="#">Terms and Conditions</a></label>
                                    </div>
                                </div>
                            </div> -->

                            <div class="form-group row text-center m-t-10">
                                <div class="col-12">
                                    <button class="btn btn-success btn-block waves-effect waves-light" type="submit">Join Now</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
            <!-- end card-box-->

            <div class="m-t-20">
                <div class="text-center">
                    <p class="text-white">Already have account? <a href="{{ route('login') }}" class="text-white m-l-5"><b>Sign In</b> </a></p>
                </div>
            </div>

        </div>
@endsection
