@extends('cms.templates.cms_template')

@section('page-title', 'IRIS | Edit Page')

@section('styles')
	<style type="text/css">
		.code-like {
			padding: 0 5px;
			border:1px solid #ccc;
			margin: 0 5px;
			color: red;
			background-color: #eee;
			border-radius: 5px;
			-webkit-border-radius: 5px;
			-moz-border-radius: 5px;
		}
	</style>
@endsection

@section('content')
	<div class="portlet box purple col-lg-12 col-md-12 col-xs-12">
	    <div class="portlet-title">
	        <h3><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Content</h3>
	    </div>
	    <div class="portlet-body">
	    	<ul class="nav nav-tabs">
				<li class="active"> <a href="#reply-message-tab" data-toggle="tab"><strong>Reply</strong></a> </li>
				<li> <a href="#thank-you-message-tab" data-toggle="tab"><strong>Thank You</strong></a> </li>
				<li> <a href="#recipient-tab" data-toggle="tab"><strong>Recipient</strong></a> </li>
			</ul>
			<div class="tab-content">
				<!-- REPLY MESSAGE -->
				<div class="tab-pane fade active in" id="reply-message-tab">
					<br />
					<div class="form-group">
						<p><strong>Note: </strong>This email can be used if you want to reply on a certain inquiries.</p>
						<form method="POST" action="{{ url('/admin/moderator_edit/update_reply') }}">
							<input type="hidden" name="mail-reply-id" value="{{$data['default-reply-message']['id']}}">
							{{ csrf_field() }}
							@if(count($errors) > 0) 
								@if($errors->first('default-reply-message'))
									<div class="alert alert-danger">
										{{ $errors->first('default-reply-message') }}
									</div>
								@endif
							@endif
							<textarea class="form-control" id="default-reply-message" name="default-reply-message">
								{!! $data['default-reply-message']['content'] !!}
							</textarea>
							<br />
							<button type="submit" class="btn purple">Update</button>
						</form>
					</div>
					<input type="hidden" id="reply_updated" value="{{ session('reply_updated') }}" />
				</div>
				<!-- THANK YOU MESSAGE -->
				<div class="tab-pane fade" id="thank-you-message-tab">
					<br />
					<div class="form-group">
						<p><strong>Note:</strong> This email will be sent automatically after a User inquires on your website.</p>
						<form method="POST" action="{{ url('/admin/moderator_edit/update_thankyou') }}">
							<input type="hidden" name="mail-thankyou-id" value="{{$data['default-thankyou-message']['id']}}">
							{{ csrf_field() }}
							@if(count($errors) > 0) 
								@if($errors->first('default-thankyou-message'))
									<div class="alert alert-danger">
										{{ $errors->first('default-thankyou-message') }}
									</div>
								@endif
							@endif
							<textarea class="form-control" id="default-thankyou-message" name="default-thankyou-message">
								{!! $data['default-thankyou-message']['content'] !!}
							</textarea>
							<br />
							<button type="submit" class="btn purple">Update</button>
						</form>	
					</div>
					<input type="hidden" id="thankyou_updated" value="{{ session('thankyou_updated') }}" />
				</div>
				<!-- RECIPIENTS -->
				<div class="tab-pane fade" id="recipient-tab">
					<br />
					<div class="form-group">
						<p><strong>Note:</strong> Add recipient with semicolon<strong class="code-like">;</strong>in between of each email. When add recipient is selected, it will send emails to all stated recipients.</p>
						<form method="POST" action="{{ url('/admin/moderator_edit/update_recipient') }}">
							<input type="hidden" name="mail-recipient-id" value="{{$data['default-recipient']['id']}}">
							{{ csrf_field() }}
							@if(count($errors) > 0) 
								@if($errors->first('default-recipient'))
									<div class="alert alert-danger">
										{{ $errors->first('default-recipient') }}
									</div>
								@endif
							@endif
							<textarea class="form-control" id="default-recipient" name="default-recipient">
								{!! $data['default-recipient']['content'] !!}
							</textarea>
							<br />
							
							<label>
								<input type="radio" name="allow-recipient" value="1" 
									@if($data['allow-recipient']['content'] == '1')
									checked
									@endif
								><small>Add Recipient</small>
							</label>
							&nbsp;
							<label>
								<input type="radio" name="allow-recipient" value="0" 
									@if($data['allow-recipient']['content'] == '0')
									checked
									@endif
								><small>Remove Recipient</small>
							</label>
							<br />
							<br />
							<button type="submit" class="btn purple">Update</button>
						</form>	
					</div>
					<input type="hidden" id="recipient_updated" value="{{ session('recipient_updated') }}" />
				</div>
			</div>
	    </div>

	<!-- end-portlet-box -->   
	</div>
	<div class="clearfix"></div>
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
			CKEDITOR.replace( 'default-reply-message', toolbar_group);
			CKEDITOR.replace( 'default-thankyou-message', toolbar_group);
			CKEDITOR.replace( 'default-recipient', toolbar_group);
			/*
			|-----------------
			| SESSION FLASHER
			|-----------------
			*/
			var reply_updated = $('#reply_updated').val().trim();
	        if(reply_updated=='1'){
	            toastr['success']('', 'Reply message has been changed!');
	        }
			var thankyou_updated = $('#thankyou_updated').val().trim();
	        if(thankyou_updated=='1'){
	            toastr['success']('', 'Thank You message has been changed!');
	        }
	        var recipient_updated = $('#recipient_updated').val().trim();
	        if(recipient_updated=='1'){
	            toastr['success']('', 'Recipient emails has been changed!');
	        }
		});
	</script>
@endsection
