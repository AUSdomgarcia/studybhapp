@extends('cms.templates.cms_template')

@section('page-title', 'IRIS | Mailer')

@section('styles')
    @parent
    <style type="text/css">
        .clearfix {
            clear: both;
        }
        .error {
            padding: 3px;
            color: #f00;
            font-size: 12px;
        }
    </style>
@endsection

@section('content')
	
	<div id="generic" class="">
		<div class="container-fluid">
			<div class="row">
                <label class="col-xs-4 control-label">&nbsp;</label>
				<div class="col-xs-8">
                    <h2>Ask Us<span class="subheading">Tell us about your<br class="visible-xs"> concern</span></h2>
                    <small>We'll get back to you within 24-48 hours.</small>
                </div>
			</div>
            <br class="clearfix"/>

			<form action="{{ url('/user/send_inquiry') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                {{ csrf_field() }}

                <div class="row">
                	<!-- Full Name -->
                    <div class="form-group">
                        <label for="fullname" class="col-xs-4 control-label">Full Name <font color="red">*</font></label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" id="fullname" name="fullname">
                            @if($errors->first('fullname')) 
                            	<label id="email-error" class="error" for="email">
                            		{{ $errors->first('fullname') }}
                            	</label>  
                            @endif
                        </div>
                    </div>
                    <!-- Email -->
                    <div class="form-group">
                        <label for="email" class="col-xs-4 control-label">Email <font color="red">*</font></label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" id="email" name="email">
                            @if($errors->first('email')) 
                            	<label id="email-error" class="error" for="email">
                            		{{ $errors->first('email') }}
                            	</label>  
                            @endif
                        </div>
                    </div>
                    <!-- Birthday -->
                    <div class="form-group">
                        <label for="birthday" class="col-xs-4 control-label">Birthday <font color="red">*</font></label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" autocomplete="off" id="birthday" name="birthday" >
                            @if($errors->first('birthday')) 
                            	<label id="email-error" class="error" for="email">
                            		{{ $errors->first('birthday') }}
                            	</label>
                            @endif
                        </div>
                    </div>
                    <!-- Complete Address -->
                    <div class="form-group">
                        <label for="address" class="col-xs-4 control-label">Complete Address <em>(optional)</em></label>
                        <div class="col-xs-8">
                            <textarea class="form-control" id="address" name="address" rows="4"></textarea>
                            @if($errors->first('address')) 
                            	<label id="email-error" class="error" for="email">
                            		{{ $errors->first('address') }}
                            	</label> 
                            @endif
                        </div>
                    </div>
                	<!-- Question -->
                    <div class="form-group">
                        <label for="questions" class="col-xs-4 control-label">Questions <font color="red">*</font></label>
                        <div class="col-xs-8">
                            <textarea class="form-control" id="questions" name="questions" rows="8"></textarea>
                            @if($errors->first('questions')) 
                            	<label id="email-error" class="error" for="email">
                            		{{ $errors->first('questions') }}
                            	</label>  
                            @endif
                        </div>
                    </div>
                    <!-- Question -->
                    <div class="form-group">
                        <div class="col-xs-offset-4 col-xs-8">
                            <button type="submit" name="submit" class="btn btn-default btn-lg btn-block green">Send</button>
                        </div>
                    </div>
                </div>
			</form>
		</div><!-- .container -->
    </div>
    <input type="hidden" id="send_success" value="{{ session('send_success') }}" />

@endsection

