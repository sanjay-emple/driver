@extends('layouts.admin.app')
@section('link')
<link rel="Stylesheet" type="text/css" href="{{url('public/assets/plugins/croppie/croppie.css')}}" />
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
<!-- 
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <div class="upload-button">
                                    <a href="javascript:void(0);" class="btn btn-default" id="btn_talent_profile_picture" ><i class="fa fa-pencil"></i> Change</a>
                                </div>
                            </div> 
                        </div>
 -->
                        <form method="post" action="{{ route('user.store') }}">
                           {{ csrf_field() }}
                           
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
                                           <label for="driver_status" class="col-2 col-form-label">Status</label>
                                           <div class="col-10">
                                               <select class="form-control" name="driver_status"  id="driver_status" required>
                                                   <option value="1" {{ $user->driver_status == 1 ? 'selected=selected' : '' }}>Active</option>
                                                   <option value="0" {{ $user->driver_status == 0 ? 'selected=selected' : '' }}>Inactive</option>
                                               </select>
                                           </div>
                                       </div>

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



    <div class="modal fade" id="change_profile_pic" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog"  role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Change profile Image</h4>
                </div>
                <div class="modal-body">
                    <div id="upload-demo"></div>
                    <div class="alert alert-danger" id="warning">The image is small and may appear blurry.</div>
                    <input type="file" id="upload" value="Select image file" accept="image/*" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button class="btn btn-info upload-result" id="savedata">Crop and save</button>
                </div>
            </div>
        </div>
    </div>


 </div>
@endsection
@section('footer_script')
<script src="{{url('public/assets/plugins/croppie/croppie.js')}}"></script>
<script type="text/javascript">
     var FileUpload = (function () {
           $("#warning").hide();
           function output(node) {
               var existing = $('#result .croppie-result');
               if (existing.length > 0) {
                   existing[0].parentNode.replaceChild(node, existing[0]);
               }
               else {
                   $('#result')[0].appendChild(node);
               }
           }

           function demoUpload() {
               var $uploadCrop;
               function readFile(input) {
                   if (input.files && input.files[0]) {
                       var reader = new FileReader();

                       reader.onload = function (e) {
                           $uploadCrop.croppie('bind', {
                               url: e.target.result
                           });

                           var image = new Image();
                           image.src = reader.result;
                           image.onload = function () {
                               if (image.width <= 200) {
                                   $("#warning").show();
                               }
                           };

                           $('.upload-demo').addClass('ready');
                       }
                       reader.readAsDataURL(input.files[0]);
                   }
                   else {
                       alert("Sorry - you're browser doesn't support the FileReader API");
                   }
               }

               $uploadCrop = $('#upload-demo').croppie({
                   viewport: {
                       width: 200,
                       height: 200,
                       type: 'circle'
                   },
                   boundary: {
                       width: 300,
                       height: 300
                   },
                   exif: true
               });
               $('#upload').on('change', function () {
                   readFile(this);
               });

               $('.upload-result').on('click', function (ev) {

                   var img = $(".cr-image").attr('src');
                   if (img == undefined) {
                       alert("Please select the image file first.");
                   } else {
                       $uploadCrop.croppie('result', {
                           type: 'canvas',
                           size: 'viewport'
                       }).then(function (resp) {
                     
                          var action_url = base_url +'/userimageupload';
                           

                           $.ajax({
                               type: 'POST',
                               url: action_url,
                               data: {image:"image=" + resp},
                               success: function (result) {
                                   $("#profile_images img").attr('src', resp);
                                   $('#change_profile_pic').modal('hide');
                               },
                               complete:function()
                               {
                                   $("#profile_images img").attr('src', resp);
                                   $('#change_profile_pic').modal('hide');
                               }
                           });
                       });
                   }
               });
           }
           function init() {
               demoUpload();
           }
           return {
               init: init
           };
       })();

       FileUpload.init();

    $(document).ready(function(){
       
       $('#upload').css("visibility", "hidden");
        $("#btn_talent_profile_picture").click(function () {
               $('#change_profile_pic').modal('show');
           });
           $('#btn_talent_profile_picture').click(function (e) {
               e.preventDefault();
               $('#upload').trigger('click');
           });  
    });




</script>



@endsection