@extends('layouts.admin.app')
@section('link')

@endsection
@section('content')
 <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="page-title-box">
                                    <h4 class="page-title float-left">Profile Image</h4>
                                    <a class="float-right btn btn-primary" href="{{ url('/dashboard') }}" >Back</a>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        @include('partials.flash')

                        <form method="post" action="{{ route('profile.image.store') }}" enctype="multipart/form-data">
                           {{ csrf_field() }}
                           
                           <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <div class="row">
                               <div class="col-12">
                                   <div class="card-box">
                                       <div class="form-group row">
                                           <label for="driver_status" class="col-2 col-form-label">Profile Image</label>
                                           <div class="col-10">
                                               <input type="file" name="photo">
                                           </div>
                                       </div>

                                       @if($user->profile_img != null and !empty($user->profile_img))
                                       <div class="form-group row">
                                           <label for="driver_status" class="col-2 col-form-label"></label>
                                           <div class="col-10">
                                              <img src="{{ url('public/uploads/profile_image/'.$user->profile_img) }}" width="75" height="75">
                                           </div>
                                       </div>
                                        @else
                                           <div class="form-group row">
                                           <label for="driver_status" class="col-2 col-form-label"></label>
                                           <div class="col-10">
                                             <img src="{{ url('public/assets/images/no_avatar.png')}}" alt="user"  width="128" height="128">
                                           </div>
                                       </div>
                                       @endif

                                       <div class="form-group row">
                                           <label for="status" class="col-2 col-form-label"></label>
                                           <div class="col-10">
                                              <input type="submit" name="submit" value="save" class="btn btn-primary">
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