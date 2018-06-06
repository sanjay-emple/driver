@extends('layouts.admin.app')
@section('content')
<div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="page-title-box">
                                    <h4 class="page-title float-left">Invite</h4>
                                    <div class="clearfix"></div>    
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        @include('partials.flash')
                        <!-- end row -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card-box">

                                    <h4 class="header-title m-t-0 m-b-30">Invite another Driver</h4>

                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-6">
                                            <form method="post" action="{{ route('invite.invitestore') }}" enctype="multipart/form-data">
                                             {{ csrf_field() }}

                                              <fieldset class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" class="form-control" name="name" id="name"> 
                                                </fieldset>

                                                 <fieldset class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" class="form-control" name="email" id="email"> 
                                                </fieldset>

                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div><!-- end col -->

                                    </div><!-- end row -->
                                </div>
                            </div><!-- end col -->
                        </div>
                        <!-- end row -->
                        
                        
                    </div> <!-- container -->
                </div> <!-- content -->
            </div>

@endsection