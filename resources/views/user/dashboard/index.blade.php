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
                            <div class="col-xs-12 col-md-3 col-lg-6 col-xl-3">
                                <div class="card-box tilebox-one">
                                    <i class="icon-layers float-right text-muted"></i>
                                    <h6 class="text-muted text-uppercase m-b-20"> Your Status</h6>
                                    <h2 class="m-b-20 dash-title" >{{ ($user_obj->driver_status == 1) ? 'Active' : 'Inactive' }}</h2>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-3 col-lg-6 col-xl-3">
                                <div class="card-box tilebox-one">
                                    <i class="icon-layers float-right text-muted"></i>
                                    <h6 class="text-muted text-uppercase m-b-20"> Total Earning </h6>
                                    <h2 class="m-b-20 dash-title" data-plugin="counterup">0</h2>

                                </div>
                            </div>
                            @if($has_tree)
                            <div class="col-xs-12 col-md-3 col-lg-6 col-xl-3">
                                <div class="card-box tilebox-one">
                                    <i class="icon-layers float-right text-muted"></i>
                                    <h6 class="text-muted text-uppercase m-b-20">Parent</h6>
                                    <h2 class="m-b-20 dash-title" data-plugin="counterup">{{ parent(auth()->id()) }}</h2>
                                
                                </div>
                            </div>
                           @endif
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-box tilebox-one">
                                     <h6 class="text-muted text-uppercase m-b-20"> {{ fullname($loginid) }} Trees</h6>
                                      @if($user_tree_count = count($users_trees) > 0)
                                      @php $user_tree_chunks = array_chunk($users_trees,2); 
                                           $i=1; 
                                      @endphp
                                      @foreach($user_tree_chunks as $users)
									  @if($levels >= $i)
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
									  @endif
                                      @endforeach
                                      @endif
                                   
                                </div>
                            </div>
                        </div>
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

/*var $treeview = $("#treeview");
$treeview
  .jstree(options)
  .on('loaded.jstree', function() {
    $treeview.jstree('open_all');
  });*/

</script>

@endsection