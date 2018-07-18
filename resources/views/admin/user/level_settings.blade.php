@extends('layouts.admin.app')
@section('content')
 <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="page-title-box">
                                    <h4 class="page-title float-left">Change Driver levels</h4>
                                    <a class="float-right btn btn-primary" href="{{ route('admin.user.index') }}" >Back</a>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        @include('partials.flash')

                        <form method="post" action="{{ route('admin.user.lavelSettings') }}">
                           {{ csrf_field() }}
						
							<div class="row">
								<div class="col-12">
									<div class="card-box">
										<div class="form-group row">
											<label for="password" class="col-2 col-form-label">Set Tree Level</label>
											<div class="col-10">
												<input class="form-control" type="text"  name="level_number" onselectstart="return false" onpaste="return false;" onCopy="return false" onCut="return false"
													onDrag="return false" onDrop="return false" autocomplete=off onkeypress="return mask(this,event);" id="level_number"
													value="@if(isset($levels[0])) {{ $levels[0]->level_number }} @else 0 @endif" required>
													
											</div>
										</div>
										<div class="form-group row">
											<label for="status" class="col-2 col-form-label"></label>
											<div class="col-10">
												<input type="hidden" name="level_id" id="level_id" value="@if(isset($levels[0])) {{ $levels[0]->level_id }} @else 0 @endif">
												<input type="submit" name="submit" value="Update level" class="btn btn-primary">
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
<script>
function mask(textbox, e) {
	
		var charCode = (e.which) ? e.which : e.keyCode;
		if (charCode == 48) 
        {
            
			swal("Alert!", "Level Should Be More Than Zero!", "error");
            return false;
        }
		
		if (charCode == 46 || charCode > 31&& (charCode < 48 || charCode > 57)) 
        {
            
			swal("Alert!", "Only Numbers Allowed!", "error");
            return false;
        }
		else
        {
             return true;
        }
    }
	   </script>