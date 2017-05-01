@extends('cms.templates.cms_template')

@section('page-title', 'IRIS | Edit Page')

@section('content')
	<div class="portlet box purple col-lg-12 col-md-12 col-xs-12">
	    <div class="portlet-title">
	        <h3><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Content</h3>
	    </div>
	    <div class="portlet-body">
	    	<ul class="nav nav-tabs">
				<li class="active"> <a href="#reply-message-tab" data-toggle="tab">Reply Message</a> </li>
				<li> <a href="#thank-you-message-tab" data-toggle="tab">Thak You Message</a> </li>
				<li> <a href="#recipient-tab" data-toggle="tab">Recipient</a> </li>
			</ul>
			<div class="tab-content">
				<!-- REPLY MESSAGE -->
				<div class="tab-pane fade active in" id="reply-message-tab">
					<br />
					<div class="form-group">
						<form method="POST" action="{{ url('/admin/moderator_edit/update_reply') }}">
							<input type="hidden" name="mail-reply-id" value="{{$data['default-reply-message']['id']}}">
							{{ csrf_field() }}
							<p><strong>Note: </strong>You can change "reply message" whatever you desire to make it more personal.</p>
							@if(count($errors) > 0) 
								<small class="error"> * {{ $errors->first('default-reply-message') }} </small>
								<br /><br />
							@endif
							<textarea class="form-control" id="default-reply-message" name="default-reply-message">
								{!! $data['default-reply-message']['content'] !!}
							</textarea>
							<br />
							<button type="submit" class="btn purple">Update</button>
						</form>
					</div>
				</div>
				<!-- THANK YOU MESSAGE -->
				<div class="tab-pane fade" id="thank-you-message-tab">
					<br />
					<div class="form-group">
						<form method="POST" action="{{ url('/admin/moderator_edit/update_thankyou') }}">
							<input type="hidden" name="mail-thankyou-id" value="{{$data['default-thankyou-message']['id']}}">
							{{ csrf_field() }}
							<p><strong>Note: </strong>You can change "thank you message" whatever you desire to make it more personal.</p>
							@if(count($errors) > 0) 
								<small class="error"> * {{ $errors->first('default-thankyou-message') }} </small>
								<br /><br />
							@endif
							<textarea class="form-control" id="default-thankyou-message" name="default-thankyou-message">
								{!! $data['default-thankyou-message']['content'] !!}
							</textarea>
							<br />
							<button type="submit" class="btn purple">Update</button>
						</form>	
					</div>
				</div>
				<div class="tab-pane fade" id="recipient-tab">
					<label>Default Recipient</label>
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
		});
	</script>
@endsection
