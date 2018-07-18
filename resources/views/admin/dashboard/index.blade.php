@extends('layouts.admin.app')
@section('link')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jstree/3.3.5/themes/default/style.min.css" />
<style type="text/css">
    .ja_tree_wrapper
    {
        border: 1px solid #ccc;
        margin: 10px 0;
        padding: 5px 0;

    }
    .dash-title
    {
        font-size: 20px;
    }
</style>
@endsection
@section('content')
 <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">

                        <div class="row">
							<div class="col-xl-12">
								<div class="page-title-box">
                                    <h4 class="page-title float-left">Dashboard</h4>
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div>
                        <!-- end row -->
                        <div class="row">
                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                                <div class="card-box tilebox-one">
                                    <i class="icon-layers float-right text-muted"></i>
                                    <h6 class="text-muted text-uppercase m-b-20"> Total Drivers</h6>
                                    <h2 class="m-b-20 dash-title" data-plugin="counterup">{{ count($users_trees) }}</h2>

                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                                <div class="card-box tilebox-one">
                                    <i class="icon-layers float-right text-muted"></i>
                                    <h6 class="text-muted text-uppercase m-b-20"> Total Earning </h6>
                                    <h2 class="m-b-20 dash-title" data-plugin="counterup">0</h2>

                                </div>
                            </div>
                        </div>
						
						@php $users_trees_arr = buildTree($drivers); @endphp
						
						<div class="row">
                            <div class="col-md-12">
                                <div class="card-box tilebox-one">
                                     <h6 class="text-muted text-uppercase m-b-20"> {{ fullname($loginid) }} Trees (Admin)</h6>
                                      @if($user_tree_count = count($users_trees) > 0)
											@php $user_tree_chunks = array_chunk($users_trees,2);
												$i=1; 
											@endphp
											@foreach($user_tree_chunks as $users)
												<p>Tree {{ $i}}</p>
												<div class="ja_tree_wrapper" >
													<div class="row">
														<div class="col-md-12">
															<div class="user_tree">
																<ul>
																	@foreach($users as $user)
																		@include('admin.tree.recursive',$user)
																	@endforeach
																</ul>
															</div>
														</div>
													</div>
												</div>
												@php $i++; @endphp
											@endforeach
										@endif
                                   
                                </div>
                            </div>
                        </div>
                        <!--
                        <div class="row">
                            <div class="col-md-6 ">
                                <form >
                                <div class="form-group row">
                                           <label for="first_name" class="col-3 col-form-label">Select Driver</label>
                                           <div class="col-9">
                                              <select class="form-control" id="driver" name="user_id" onchange="this.form.submit()">
                                               <option value="">Select Driver</option>
                                                  @foreach($users_arr as $user_arr)
                                                      <option value="{{ $user_arr['id'] }}"  {{ $user_arr['id'] == $tree_user_id ? "selected=selected" : "" }} > {{ ucfirst($user_arr['first_name'].' '.$user_arr['last_name']) }} </option>
                                                  @endforeach
                                                  </select>
                                           </div>
                                       </div>
                                </form>
                            </div>
                        </div>
					
                      @if($tree_user_id != null and !empty($tree_user_id) )
                      @php $users_trees = buildTree($drivers,$tree_user_id); @endphp
                      @if(!empty($users_trees))
                       <div class="row">
                            <div class="col-md-12">
                                <div class="card-box tilebox-one">
                                     <h6 class="text-muted text-uppercase m-b-20"> {{ fullname($tree_user_id) }} Trees</h6>
										@if($user_tree_count = count($users_trees) > 0)
											@php $user_tree_chunks = array_chunk($users_trees,2);
												$i=1; 
											@endphp
											@foreach($user_tree_chunks as $users)
												<p>Tree {{ $i}}</p>
												<div class="ja_tree_wrapper" >
													<div class="row">
														<div class="col-md-12">
															<div class="user_tree">
																<ul>
																	@foreach($users as $user)
																		@include('admin.tree.recursive',$user)
																	@endforeach
																</ul>
															</div>
														</div>
													</div>
												</div>
												@php $i++; @endphp
											@endforeach
										@endif
									</div>
								</div>
							</div>
                      @else
                       <p>Tree not found</p>
                      @endif

                      @endif
                 -->
                    <!-- end row -->

                    </div> <!-- container -->

                </div> <!-- content -->



            </div>
@endsection

@section('footer_script')
<script src="//cdnjs.cloudflare.com/ajax/libs/jstree/3.3.5/jstree.min.js"></script>
<script type="text/javascript">

$(function() {
    $('.user_tree').jstree();
});

</script>

@endsection