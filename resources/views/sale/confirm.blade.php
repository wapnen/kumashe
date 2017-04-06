@extends('layouts.app')
@section('content')
	<section>
		<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="panel panel-primary">
					<div class="panel-heading">
						Confirmation
					</div>
					<div class="panel-body bg-success">
						<div class="jumbotron ">
						  <h1>Congratulations!</h1>
						  <p class="text-info">Your payment is successful. You will receive your order within 72 Hours. Thank you for shopping at Kumashe</p>
						  <p><a class="btn btn-primary btn-lg" href="/invoice/{{$transaction->id}}" role="button">Invoice</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</section>
@endsection