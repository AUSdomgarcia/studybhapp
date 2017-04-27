@extends('cms.templates.cms_template')

@section('page-title', 'IRIS | Inquiry')

@section('styles')
	<link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/global/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') }}">
		
	<link href="{{ asset('admin_assets/custom/custom.css') }}" rel="stylesheet" type="text/css"/> <!--pointer-->

	<style type="text/css">
		i[disabled] {
		    cursor:not-allowed;
		    color: gray;
		}
	</style>

@endsection

@section('content')

	<div class="portlet box purple col-lg-6 col-md-12 col-xs-12">
            <div class="portlet-title">
                <h3>Inquiries</h3>
            </div>
            <div class="portlet-body">
            	@if (count($errors) > 0)
				    <div class="alert alert-danger">
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li>{{ $error }}</li>
				            @endforeach
				        </ul>
				    </div>
				@endif
			
				<table class="table" id="inquiries-datatable">
					<thead>
						<tr>
							<th style="width: 60px !important; ">Actions</th>
							<th>Full Name</th>
							<th>Email</th>
							<th>Birthdate</th>
							<th>Date Created</th>
						</tr>
					</thead>
				</table>

            <div class="clearfix"></div>
            </div>
		</div><!-- .container -->
@endsection

@section('scripts')
	<script type="text/javascript" src="{{ asset('admin_assets/global/plugins/datatables/media/js/jquery.dataTables.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('admin_assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('admin_assets/global/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('admin_assets/global/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('admin_assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') }}"></script>
	
	<script type="text/javascript">
		$(document).ready(function(){
			/*
			|-------------
			| Data Table
			|-------------
			*/
			$('#inquiries-datatable').DataTable({
			    processing: false,
			    serverSide: true,
			    "order": [[ 4, "desc" ]],
				"columnDefs": [
				    { "orderable": false, "targets": [0] }
				],
			    ajax: {
			    	url : "{{ url('/admin/inquiry/inbox') }}",
			    	data : function(res){
			    		console.log(res);
			    		Metronic.blockUI({
							target: $('#inquiries-datatable'),
							animate: true,
							overlayColor: 'none'
						});
			    	}
			    },
			    columns: [
			        { 
			        	data: 'id', 
			        	name: 'id',
			        	render: function ( data, type, full, meta ) {
					      	return '<a data-id="'+ full.id +'" class="fa fa-eye view-mail-inquiry"></a>' +
									'<a data-id="'+ full.id +'" class="fa fa-mail-reply mail-inquiry-reply"></a>' +
									'<a data-id="'+ full.id +'" class="fa fa-envelope view-mail-inquiry-thread"></a>';
					    }
			        },
			        { data: 'full_name', name: 'full_name' },
			        { data: 'email', name: 'email' , 'class' : 'mail-inquiry-email'},
			        { data: 'birthdate', name: 'birthdate', type:'date' },
			        { data: 'updated_at', name: 'updated_at', type:'date' }
			    ],
			    drawCallback : function(){
			    	Metronic.unblockUI($('#inquiries-datatable'))
			    }
			});
		});
	</script>
@endsection

