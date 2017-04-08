@extends('admin.layouts.app')
@section('content')
	<section>
		<div class="container">
			<div class="step-one">
				<h2 class="heading">Transactions </h2>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>#Ref</th>
								<th>Buyer class</th>
								<th>Buyer ID</th>
								<th>Payment Status</th>
								<th>Total</th>
								<th>Details</th>
							</tr>
						</thead>
						<tbody>
							@foreach($transactions as $transaction)
								<tr>
									<td>{{$transaction->id}}</td>
									<td>{{$transaction->type}}</td>
									<td>{{$transaction->user_id}}</td>
									<td>{{$transaction->status}}</td>
									<td>{{$transaction->total}}</td>
									<td><a href="/transaction/{{$transaction->id}}" class="btn btn-primary"><i class = "fa fa-eye"></i></a></td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
@endsection