@extends('layouts.base')
@section('title', 'Sms')


@section('content')

   <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Send SMS.
      </h1>
    </section>
<form action="{{ action('SmsController@store') }}" id="order_form" method="POST">
		@csrf
    <section class="content">
			<div class="box box-solid">
	    		<div class="container-fluid">
	    			<h3>Sms Details:*</h3>
	    		</div>
			<div class="box-body">
			    <div class="row">
					<div class="col-sm-8">
						<label for="import_details">Recipient(s)*:</label>
        <select class="selectpicker form-control" id="number2-multiple" data-live-search="true" title="Select contacts" data-hide-disabled="true" data-actions-box="true" name="recipients[]" multiple required>
							@foreach($contacts as $contact)
							<option value="{{ $contact->phone_no }}"> {{ $contact->name }}, {{ $contact->phone_no }} </option>
							@endforeach
						</select>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-8">
						<label for="import_details">Sms body:*</label>
						<small>Available tags: [name]</small>
						<textarea class="form-control" rows="10" name="message" id="message" style="resize:vertical;" required></textarea>
					</div>
				</div>
				
					
				<div class="row">
					<br>
					<div class="container-fluid">
						<button class="btn btn-primary pull-right btn_save">Send</button>
					</div>
				</div>
			</div>
		</div> <!--box end-->
    </section>
</form>





@endsection
