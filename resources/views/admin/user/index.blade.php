@extends('layouts.admin.app')
@section('content')

 <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="page-title-box">
                                    <h4 class="page-title float-left">Driver Lists</h4>
                              
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        @include('partials.flash')

                        <div class="row">
                            <div class="col-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Driver Number</th>
                                            <th>Email</th>
                                            <th>Telephone Number</th>
                                          <!--   <th>Driver status</th> -->
                                            <th>Status</th>
                                            <th>Created at</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> <!-- end row -->


                        
                        <!-- end row -->
                    </div> <!-- container -->
                </div> <!-- content -->
 </div>
@endsection
@section('footer_script')

<script src="{{ url('public/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('public/assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

<script type="text/javascript">
$('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('ajax.get.users') }}",
        columns: [
            {data: 'DT_Row_Index', orderable: false, searchable: false},
            {data: 'name', name: 'name'},
            {data: 'driver_num', name: 'driver_num'},
            {data: 'email', name: 'email'},
            {data: 'telephone', name: 'telephone'},
            /*{data: 'driver_status', name: 'driver_status'},*/
            {data: 'active', name: 'active'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
       
        ],
        language: {
              "decimal": "",
              "emptyTable": "No data available in table",
              "info": "Showing _START_ to _END_ of _TOTAL_ entries",
              "infoEmpty": "Showing 0 to 0 of 0 entries",
              "infoFiltered": "(filtered from _MAX_ total entries)",
              "infoPostFix": "",
              "thousands": ",",
              "lengthMenu": "Show _MENU_ entries",
              "loadingRecords": "Loading...",
              "processing": "<div class='text-blue'><i class='fa fa-cog fa-5x fa-spin'></i><p>Working, Please wait ..</p></div>",
              "search": "Search:",
              "zeroRecords": "No matching records found",
              "paginate": {
                  "first": "First",
                  "last": "Last",
                  "next": "Next",
                  "previous": "Previous"
              },
              "aria": {
                  "sortAscending": ": activate to sort column ascending",
                  "sortDescending": ": activate to sort column descending"
              }
       }
    });
	/*
		FunctionBy:		Sanay
	*/
	function deleteDriver(id,name)
	{
		if (id == '0') {
			swal({
				  title: "Alert!",
				  text: "Entry can not be deleted Because, Child driver is exist!",
				  icon: "error",
				  button: "Ok!",
				});
                return false;
		}
		else
		{
			swal({
				title: "Are you sure to delete," +name+ " ?",
				//text: "Once deleted, you will not be able to recover this imaginary file!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					$.ajax({
						type: "POST",
						url: '{{ URL::route('deleteDriver') }}',
						data: {
							"_token": "{{ csrf_token() }}",
							"id": id
						},
						success: function (data) {
							
							if(data == 1){
								location.reload();
							}else{
								alert('Something went wrong');
							}
						
						}
					});
				
				} else {
					return false;
				}
			});
		}
		
		
	}
</script>

@endsection