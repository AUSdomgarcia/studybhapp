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
				<div class="tab-pane fade active in" id="reply-message-tab">
					Reply
				</div>
				<div class="tab-pane fade" id="thank-you-message-tab">
					Thank you
				</div>
				<div class="tab-pane fade" id="recipient-tab">
					Recipient
				</div>
			</div>
	    </div>

	<!-- end-portlet-box -->   
	</div>
	<div class="clearfix"></div>
@endsection


@section('scripts')
	
@endsection
