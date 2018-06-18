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
                                    <h4 class="page-title float-left">Change Profile</h4>
                                    <a class="float-right btn btn-primary" href="{{ route('admin.user.index') }}" >Back</a>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        @include('partials.flash')

                        <form method="post" action="{{ route('admin.user.store') }}" enctype="multipart/form-data">
                           {{ csrf_field() }}
                           
                           <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <div class="row">
                               <div class="col-12">
                                   <div class="card-box">
                                       <div class="form-group row">
                                           <label for="first_name" class="col-2 col-form-label">First Name</label>
                                           <div class="col-10">
                                               <input class="form-control" type="text" value="{{ $user->first_name }}" name="first_name" id="first_name" required>
                                           </div>
                                       </div>

                                        <div class="form-group row">
                                           <label for="last_name" class="col-2 col-form-label">Last Name</label>
                                           <div class="col-10">
                                               <input class="form-control" type="text" value="{{ $user->last_name }}" name="last_name" id="last_name" required>
                                           </div>
                                       </div>

                                       <div class="form-group row">
                                           <label for="email" class="col-2 col-form-label">Email</label>
                                           <div class="col-10">
                                               <input class="form-control" type="email" value="{{ $user->email }}" name="email" id="email" required>
                                           </div>
                                       </div>

                                       <div class="form-group row">
                                           <label for="city" class="col-2 col-form-label">City</label>
                                           <div class="col-10">
                                               <input class="form-control" type="text" value="{{ $user->city }}" name="city" id="city" required>
                                           </div>
                                       </div>

                                       <div class="form-group row">
                                           <label for="address" class="col-2 col-form-label">Address</label>
                                           <div class="col-10">
                                               <input class="form-control" type="text" value="{{ $user->address }}" name="address" id="address" required>
                                           </div>
                                       </div>
                                       <div class="form-group row">
                                           <label for="postcode" class="col-2 col-form-label">postcode</label>
                                           <div class="col-10">
                                               <input class="form-control" type="text" value="{{ $user->postcode }}" name="postcode" id="postcode" required>
                                           </div>
                                       </div>

                                       <div class="form-group row">
                                           <label for="telephone" class="col-2 col-form-label">Telephone Number</label>
                                           <div class="col-10">
                                               <input class="form-control" type="text" value="{{ $user->telephone }}" name="telephone" id="telephone" required>
                                           </div>
                                       </div>

                                       <div class="form-group row">
                                           <label for="status"  class="col-2 col-form-label">Status</label>
                                           <div class="col-10">
                                               <select class="form-control" name="status" id="status" required>
                                                   <option value="1" {{ $user->active == 1 ? 'selected=selected' : '' }}>Active</option>
                                                   <option value="0" {{ $user->active == 0 ? 'selected=selected' : '' }}>Inactive</option>
                                               </select>
                                           </div>
                                       </div>

                                       <div class="form-group row">
                                           <label for="driver_status" class="col-2 col-form-label">Driver Status</label>
                                           <div class="col-10">
                                               <select class="form-control" name="driver_status"  id="driver_status" required>
                                                   <option value="1" {{ $user->driver_status == 1 ? 'selected=selected' : '' }}>Active</option>
                                                   <option value="0" {{ $user->driver_status == 0 ? 'selected=selected' : '' }}>Inactive</option>
                                               </select>
                                           </div>
                                       </div>

                                       <div class="form-group row">
                                           <label for="driver_status" class="col-2 col-form-label">Profile Photo</label>
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