@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <p>Complete the form below to create a new order.<BR />The item with the most stock has been preselect to keep it even. It is shown in bold.</p>
					
					@if(session('status'))
					<div class="alert alert-success">
					 	{{ session('status') }}
					</div>
					@endif
					
					@if( isset($PromoBoxes) && !empty($PromoBoxes))

					<form role="form" method="POST" action="{{ url('/home/') }}">
					
					
						{{ csrf_field() }}
						
						<table class="table table-striped">
							<thead>
							  <tr>
								<!--<th>#.</th>-->
								<th>SKU</th>
								<th>Box Description</th>
								<th>Qty</th>
								<th>Choice</th>
							  </tr>
							</thead>
							<tbody>
							  @foreach($PromoBoxes AS $i=>$pb)
							  <tr @if($pb->sku == $pre_select->sku) style="font-weight:bold;" @endif>
								<!-- <td>{{ $i + 1 }}</td> -->
								<td>{{ $pb->sku }}</td>
								<td>{{ $pb->description }}</td>
								<td>{{ $pb->qty }}</td>
								<td><input type="radio" name="selectedPromoBox" aria-label="select" value="{{ $pb->sku }}"@if($pb->sku == $pre_select->sku) checked="checked"@endif></td>
							  </tr>
							  @endforeach
							</tbody>
						</table>
						
						<p>The button adds sample data for testing. <button id="prefill" type="button" class="btn btn-primary">Prefill</button> </p> 
						
						<div class="form-group">
							<label for="inputFirstName">First Name</label>
							<input type="text" class="form-control" id="inputFirstName" placeholder="First Name" name="first_name" value="{{ old('first_name') }}">
						</div>
						
						@if( $errors->has('first_name') )
						<div class="alert alert-danger">
						 	{{ $errors->first('first_name') }}
						</div>
						@endif

						<div class="form-group">
							<label for="inputSurname">Surname</label>
							<input type="text" class="form-control" id="inputSurname" placeholder="Surname" name="surname" value="{{ old('surname') }}">
						</div>
						
						@if( $errors->has('surname') )
						<div class="alert alert-danger">
						 	{{ $errors->first('surname') }}
						</div>
						@endif
						
						<div class="form-group">
							<label for="inputEmail1">Email address</label>
							<input type="email" class="form-control" id="inputEmail1" placeholder="Email" name="email" value="{{ old('email') }}">
						</div>
						
						@if( $errors->has('email') )
						<div class="alert alert-danger">
						 	{{ $errors->first('email') }}
						</div>
						@endif
						
						<div class="form-group">
							<label for="inputAddress1">Address line 1</label>
							<input type="text" class="form-control" id="inputAddress1" placeholder="Address" name="address_line1" value="{{ old('address_line1') }}">
						</div>
						
						@if( $errors->has('address_line1') )
						<div class="alert alert-danger">
						 	{{ $errors->first('address_line1') }}
						</div>
						@endif

						<div class="form-group">
							<label for="inputCity">City</label>
							<input type="text" class="form-control" id="inputCity" placeholder="City" name="city" value="{{ old('city') }}">
						</div>
						
						@if( $errors->has('city') )
						<div class="alert alert-danger">
						 	{{ $errors->first('city') }}
						</div>
						@endif
  
						<div class="form-group">
							<label for="inputPost_code">Post code</label>
							<input type="text" class="form-control" id="inputPost_code" placeholder="Post code" name="post_code" value="{{ old('post_code') }}">
						</div>
						
						@if( $errors->has('post_code') )
						<div class="alert alert-danger">
						 	{{ $errors->first('post_code') }}
						</div>
						@endif
						
						<button type="submit" class="btn btn-default">Submit</button>
					</form>
					
					<script>
					
						jQuery(function($){
							
							
							$('#prefill').click(function(){	
									$("input[name=first_name]").val('Matthew');
									$("input[name=surname]").val('Bull');
									$("input[name=email]").val('matthew@matthewbullweb.co.uk');
									$("input[name=address_line1]").val('1 road');
									$("input[name=city]").val('nowhere');
									$("input[name=post_code]").val('WS22 5YU');
							});
							
						});
					</script>
					
					
					@endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
