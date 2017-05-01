@extends('cms.templates.cms_template')

@section('page-title', 'IRIS | Edit Page')

@section('content')
	<div class="portlet box purple col-lg-12 col-md-12 col-xs-12">
	    <div class="portlet-title">
	        <h3>Edit Content</h3>
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

			<div class="content">
				test
			</div>
	    </disv>

	<!-- end-portlet-box -->   
	</div>
	<div class="clearfix"></div>
@endsection