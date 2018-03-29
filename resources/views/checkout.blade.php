<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				@if (count($errors))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
			</div>
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading">Pagar con tarjeta</div>
					<div class="panel-body">
						<form action="{{url('/send-payment')}}" method="POST">
							{{ csrf_field() }}
						<div class="form-inline">
							<div class="radio">
							  <label>
							    <input type="radio" name="card_name" value="VISA" checked>
							    VISA
							  </label>
							</div>&nbsp;
							<div class="radio">
							  <label>
							    <input type="radio" name="card_name" value="MASTERCARD">
							    Mastercard
							  </label>
							</div>&nbsp;
							<div class="radio">
							  <label>
							    <input type="radio" name="card_name" value="AMEX">
							    American
							  </label>
							</div>
						</div><br/>
						<div class="form-group">
							<div class="input-group card">
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-credit-card"
									aria-hidden="true">
									</span>
								</div>
								<input class="form-control"
								name="card_number" type="text" maxlength="19"
								placeholder="Número de la tarjeta" />
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-lock"
									aria-hidden="true">
									</span>
								</div>
								<input class="form-control"
								name="card_cvc" type="text" maxlength="4"
								placeholder="Código de seguridad" />
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"
										aria-hidden="true">
									</span>
								</div>
								<input class="form-control" name="expiration_date"
								type="text" maxlength="7"
								placeholder="Fecha de expiración: AAAA/MM" />
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-user" aria-hidden="true">
									</span>
								</div>
								<input class="form-control" name="payer_name"
								type="text" maxlength="50"
								placeholder="Nombre en la tarjeta" />
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-eye-open" aria-hidden="true">
									</span>
								</div>
								<input class="form-control" name="payer_dni"
								type="text" maxlength="50"
								placeholder="Documento" />
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-envelope"
									aria-hidden="true">
									</span>
								</div>
								<input class="form-control" name="payer_email"
								type="email" maxlength="80"
								placeholder="Correo del titular" />
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-map-marker"
									aria-hidden="true">
									</span>
								</div>
								<input class="form-control" name="payer_address"
								type="text" maxlength="80"
								placeholder="Dirección del titular" />
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-phone" aria-hidden="true">
									</span>
								</div>
								<input class="form-control"
								name="payer_phone" type="text" maxlength="11"
								placeholder="Teléfono del titular" />
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<span>No. de cuotas</span>
								</div>
								<select name="installments" class="form-control">
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="12">12</option>
									<option value="24">24</option>
									<option value="36">36</option>
									<option value="48">48</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<button class="btn btn-primary">
								Pagar
							</button>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>