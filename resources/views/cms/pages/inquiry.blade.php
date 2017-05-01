@extends('cms.templates.cms_template')

@section('page-title', 'IRIS | Inquiry')

@include('modules.datatable');

@section('styles')
	<link href="{{ asset('admin_assets/custom/custom.css') }}" rel="stylesheet" type="text/css"/> <!--pointer-->
	<style type="text/css">
		i[disabled] {
		    cursor:not-allowed;
		    color: gray;
		}
		#inquiries-table, #thread-table {
			font-size: 13px;
		}
	</style>
@endsection

@section('content')
	<!-- Portlet Inquiries -->
	<div class="portlet box purple col-lg-12 col-md-12 col-xs-12">
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
		
			<table class="table" id="inquiries-table">
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
	</div>









	<!-- Reply Modal -->
	<div class="modal fade" id="show-reply-tool-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<form class="form-horizontal form-bordered" action="{{ url('/admin/inquiry/reply') }}" enctype="multipart/form-data"  method="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}" />
					<!--container-input-hidden-->
					<input type="hidden" name="mail-inquiry-id" id="mail-inquiry-id" value="" />
					<input type="hidden" name="mail-inquiry-email" id="mail-inquiry-email" value="" />
					
					<!-- Header -->
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
						<h4 class="modal-title"><i class="fa fa-mail-reply"></i> Reply</h4>
					</div>
					<!-- Body -->
					<div class="modal-body">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label col-md-2">Title <span class="font-red">*</span></label>
								<div class="col-md-10">
									<input type="text" class="form-control" id="mail-inquiry-title" name="mail-inquiry-title" value="">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2">Body <span class="font-red">*</span></label>
								<div class="col-md-10">
									<textarea class="form-control" id="mail-inquiry-body" name="mail-inquiry-body"></textarea>
								</div>
							</div>
						</div>
						<br class="clearfix">
					</div>
					<!-- Footer -->
					<div class="modal-footer">
						<input type="submit" class="btn purple" value="Send" id="show-reply-tool-send">
						<button type="button" class="btn default" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>
	<input type="hidden" id="reply_sent" value="{{ session('reply_sent') }}" />
	</div>








	<!-- See Message Modal -->
	<div class="modal fade" id="message-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<!--header-->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title"> <i class="fa fa-eye show-message"></i> Message</h4>
				</div>
				<!--body-->
				<div class="modal-body">
					<div class="inbox-view-info">
						<span class="bold" id="inquiry-name">NO_NAME_LOADED</span>
						&lt;<span id="inquiry-email">NO_EMAIL_LOADED</span>&gt;
						<span class="pull-right"><strong>Date: </strong><span id="inquiry-date"></span></span>
						<p>to <strong>me</strong></p>
					</div>
					<br />
					<div class="form-group">
						<strong>Given Address:</strong>
						<div class="inbox-view" id="inquiry-address"></div>
					</div>
					<div class="form-group">
						<strong>Given Question:</strong>
						<div class="inbox-view" id="inquiry-question"></div>
					</div>
				</div>
				<!--footer-->
				<div class="modal-footer">
					<input type="submit" class="btn purple" id="btn-reply-in-message-modal" data-id="" value="Reply">
					<button type="button" class="btn default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>









	<!-- Thread Modal -->
	<div class="modal fade" id="thread-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title"><i class="fa fa fa-list"></i> Thread - <small>Your message to user(s)</small></h4>
				</div>
				<div class="modal-body">
					<table class="table" id="thread-table">
						<thead>
							<tr>
								<th>User</th>
								<th>Title</th>
								<th>Message</th>
								<th>Date Created</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
		</div>
	</div>



@endsection

@section('scripts')
	<!-- ckeditor -->
	<script src="{{ asset('/ckeditor/ckeditor.js') }}"></script>
	<script src="{{ asset('/ckeditor/config.js') }}"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			/*
			|-------------
			| CKEDITOR
			|-------------
			*/
			CKEDITOR.replace( 'mail-inquiry-body', toolbar_group);
			/*
			|-------------
			| Data Table
			|-------------
			*/
			$('#inquiries-table').DataTable({
			    processing: false,
			    serverSide: true,
			    'order': [[ 4, 'desc' ]],
				'columnDefs': [
				    { 'orderable': false, 'targets': [0] }
				],
			    ajax: {
			    	url : '{{ url("/admin/inquiry/inbox") }}',
			    	data : function(res){
			    		// console.log(res);
			    		Metronic.blockUI({
							target: $('#inquiries-table'),
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
							return	'<a data-id="'+ full.id +'" class="fa fa-eye show-message"></a>'  + '&nbsp;&nbsp;' +
					      			'<a data-id="'+ full.id +'" class="fa fa fa-list show-thread"></a>' + '&nbsp;&nbsp;' +
									'<a data-id="'+ full.id +'" class="fa fa-mail-reply show-reply-tool"></a>';
					    }
			        },
			        { data: 'full_name', name: 'full_name' },
			        { data: 'email', name: 'email' , 'class' : 'mail-inquiry-email'},
			        { data: 'birthdate', name: 'birthdate', type:'date' },
			        { data: 'updated_at', name: 'updated_at', type:'date' }
			    ],
			    drawCallback : function(){
			    	Metronic.unblockUI($('#inquiries-table'))
			    }
			});
			/*
			|-------------
			| POST REPLY
			|-------------
			*/
			$('body').on('click', '.show-reply-tool', function(){
		    	var id = $(this).attr('data-id');
		    	var recipient = $(this).closest('tr').find('.mail-inquiry-email').text().trim();
		    	$('#mail-inquiry-id').val(id);
		    	$('#mail-inquiry-email').val(recipient);
		    	$('#show-reply-tool-modal').modal();
		    });
		    /*
			|------------
			| GET THREAD
			|------------
			*/
			$('body').on('click', '.show-thread', function(){
	        	var id = $(this).attr('data-id');
	        	// JQUERY GET
	        	$.get('{{ url('/admin/inquiry/thread') }}/' + id, function(data) {
	        		try {
	        			var table  = undefined;
	        			for(var i in data){
	        				table += 
	        				'<tr>' +
								'<td>'+
									data[i]['user']['email'] +
								'</td>' +
								'<td>' +
									data[i]['title'] +
								'</td>' +
								'<td>' +
									data[i]['message'] +
								'</td>' +
								'<td>' +
									data[i]['created_at'] +
								'</td>' +
							'</tr>';
	        			}
	        			$('#thread-table').dataTable().fnDestroy();
	        			$('#thread-table').find('tbody').html(table);
	        			$('#thread-table').dataTable();
	        			$('#thread-modal').modal();
	        		} catch(e) {
	        			if(e) throw new Error(e); // console.log(e);
	        		}
	        	});
	        });
	        /*
			|-----------------
			| GET PER MESSAGE
			|-----------------
			*/
			$('body').on('click', '.show-message', function(){
	        	var id = $(this).attr("data-id");
	        	$.get('{{ url('/admin/inquiry/show') }}/'+ id, function(data){
	        		var message = $('#message-modal');
 	        		message.find('#inquiry-name').html( data['full_name'] );
	        		message.find('#inquiry-email').html(data['email']);
	        		message.find('#btn-reply-in-message-modal').attr('data-id', data['id']);
	        		message.find('#inquiry-question').html(data['question']);
	        		message.find('#inquiry-date').html(data['created_at']);
	        		message.find('#inquiry-address').html(data['address']);
	        		message.modal();
		        });
			});
			/*
			|-----------------------------
			| #1 DYNAMIC_ID REPLY TRIGGER
			|-----------------------------
			*/
			$("#btn-reply-in-message-modal").click(function(){
				$('#message-modal').modal('hide');
				$(".show-reply-tool[data-id='" + $(this).attr('data-id') +"']").trigger("click");
	        });
		    
		    var reply_sent = $('#reply_sent').val().trim();
	        
	        if(reply_sent=='1'){
	            toastr['success']('', 'Message has been sent successfully!');
	        }

	     // end-of-doc-ready
		});
	</script>
@endsection