@extends('layouts.admin.app')
@section('content')
 <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="page-title-box">
                                    <h4 class="page-title float-left">Change Position</h4>
                                    <a class="float-right btn btn-primary" href="{{ route('admin.user.index') }}" >Back</a>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        @include('partials.flash')

                        <form method="post" action="{{ route('admin.change.position.store') }}">
                           {{ csrf_field() }}

                            <div class="row">
                               <div class="col-12">
                                   <div class="card-box">

                                      <div class="form-group row">
                                           <label for="from" class="col-2 col-form-label">From Postion</label>
                                           <div class="col-10">
                                               <select name="from" id="from" class="form-control" required="required">
                                                 <option value="">Select Driver</option>
                                                 @foreach($users as $user)
                                                  <option value="{{ $user->tree_id }}"> {{ ucfirst($user->first_name . ' '.$user->last_name).'  ('. $user->driver_num.')' }} </option>
                                                 @endforeach
                                               </select>
                                           </div>
                                       </div>

                                       <div class="form-group row">
                                           <label for="to" class="col-2 col-form-label">To Postion</label>
                                           <div class="col-10">
                                               <select name="to" id="to" class="form-control" required="required">
                                                 <option value="">Select Driver</option>
                                                 @foreach($users as $user)
                                                  <option value="{{ $user->tree_id }}"> {{ ucfirst($user->first_name . ' '.$user->last_name).'  ('. $user->driver_num.')' }} </option>
                                                 @endforeach
                                               </select>
                                           </div>
                                       </div>

                                       <div class="form-group row">
                                           <label for="status" class="col-2 col-form-label"></label>
                                           <div class="col-10">
                                              <input type="submit" name="submit" value="Change Position" class="btn btn-primary">
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