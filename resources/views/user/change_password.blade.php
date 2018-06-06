@extends('layouts.admin.app')
@section('content')
 <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="page-title-box">
                                    <h4 class="page-title float-left">Change Password</h4>
                                    <a class="float-right btn btn-primary" href="{{ route('admin.user.index') }}" >Back</a>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        @include('partials.flash')

                        <form method="post" action="{{ route('user.changepassword') }}">
                           {{ csrf_field() }}

                            <div class="row">
                               <div class="col-12">
                                   <div class="card-box">

                                        <div class="form-group row">
                                           <label for="current_password" class="col-2 col-form-label">Current password</label>
                                           <div class="col-10">
                                               <input class="form-control" type="password"  name="current_password" id="current_password" required>
                                           </div>
                                        </div>
                                      

                                         <div class="form-group row">
                                           <label for="password" class="col-2 col-form-label">Password</label>
                                           <div class="col-10">
                                               <input class="form-control" type="password"  name="password" id="password" required>
                                           </div>
                                       </div>

                                        <div class="form-group row">
                                           <label for="password_confirmation" class="col-2 col-form-label">Confirm Password</label>
                                           <div class="col-10">
                                               <input class="form-control" type="password"  name="password_confirmation" id="password_confirmation" required>
                                           </div>
                                       </div>

                                       <div class="form-group row">
                                           <label for="status" class="col-2 col-form-label"></label>
                                           <div class="col-10">
                                              <input type="submit" name="submit" value="Change Password" class="btn btn-primary">
                                           </div>
                                       </div>
                                   
                                   </div>
                               </div>
                           </div> 
                        </form>
                        <!-- end row -->
                    </div> <!-- container -->
                </div> <!-- content -->
 </div>
@endsection
@section('footer_script')

@endsection