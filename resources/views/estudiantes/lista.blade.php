@extends('layout.app')
@section('content')
<section class="vh-100">
	<div class="container h-100">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Estudiantes</h3>
			</div>
			<div class="card-body">
				<form action="{{ route('estudiante.index') }}" method="GET">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label class="form-label" for=""><i class="fas fa-user"></i> Nombres</label>
								<input type="text" value="{{ Request()->nombres }}" name="nombres" class="form-control form-control-sm">
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label class="form-label" for=""><i class="fas fa-user"></i> Apellidos</label>
								<input type="text" value="{{ Request()->apellidos }}" name="apellidos" class="form-control form-control-sm">
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label class="form-label" for=""><i class="fas fa-envelope"></i> Email</label>
								<input type="text" value="{{ Request()->email }}" name="email" class="form-control form-control-sm">
							</div>
						</div>
					</div>
					<div class="row mt-2">
						<div class="col-md-3">
							<div class="form-group">
								<label class="form-label" for=""><i class="fas fa-mobile"></i> Telefono</label>
								<input type="text" value="{{ Request()->tel }}" name="tel" class="tel form-control form-control-sm">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label class="form-label" for=""><i class="fas fa-graduation-cap"></i> Programa</label>
								<select class="form-select form-select-sm" value="{{ Request()->programa_id }}" name="programa_id">
									<option selected disabled value="">Seleccione...</option>
									@foreach ($programas as $programa)
									<option value="{{ $programa->id }}">{{ $programa->nombre }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-2">
							<button class="btn btn-primary mt-4"><i class="fa fa-search"></i> Buscar</button>
						</div>
					</div>
				</form>
			</div>

			<div class="row mt-2">
				<div class="col-md-12">

					<div class="list-group">
						@foreach ($estudiantes as $estudiante)
						<a onclick="abrirModal(JSON.stringify('{{$estudiante}}'))" class="list-group-item list-group-item-action flex-column align-items-start">
							<div class="d-flex w-100 justify-content-between">
								<h5 class="mb-1" style="color:#f15a24"><i class="fas fa-user"></i> {{ $estudiante->nombres }} {{ $estudiante->apellidos }}</h5>
								<small>{{ $estudiante->tel }} <i id="icon_ll{{ $estudiante->id }}" class="{{ $estudiante->estado_llamada == 1 ? 'fas fa-times-circle text-danger' : 'fas fa-check-circle text-success'}}"></i></small>
							</div>
							<p class="mb-1"><i class="fas fa-envelope"></i> {{ $estudiante->email }}</p>
							<small><i class="fas fa-graduation-cap"></i> {{ $estudiante->programa->nombre }}.</small>
						</a>
						@endforeach
					</div>


					<div class="d-flex justify-content-center mt-4">
						{{ $estudiantes->appends(request()->input())->render() }}
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="ModalData" tabindex="-1" role="dialog" aria-labelledby="ModalDataLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header modal-secondary">
					<h5 class="modal-title" id="ModalDataLabel"></h5>
				</div>
				<div class="modal-body">
					<input name="_token" id="_token" type="hidden" value="{{ csrf_token() }}" />
					<input id="ruta_update" type="hidden" value="{{ route('estudiante.update') }}" />
					<input name="id" type="hidden" value="" id="id_upd" />

					<div class="col-md-12">
						<label for="nombres" class="form-label">Nombres</label>
						<input type="text" class="form-control" id="nombres" name="nombres" disabled>
					</div>

					<div class="col-md-12">
						<label for="apellidos" class="form-label">Apellidos</label>
						<input type="text" class="form-control" id="apellidos" name="apellidos" disabled>
					</div>

					<div class="col-md-12">
						<label for="email" class="form-label">Email</label>
						<div class="input-group has-validation">
							<span class="input-group-text">@</span>
							<input type="email" class="form-control" id="email" name="email" disabled>
						</div>
					</div>
					<div class="col-md-12">
						<label for="tel" class="form-label">Telefono</label>
						<input type="text" class="form-control tel" id="tel" name="tel" disabled>
					</div>
					<div class="col-md-12">
						<label for="programa_id" class="form-label">Programa</label>
						<select class="form-select" id="programa_id" name="programa_id" disabled>
							<option selected disabled value="">Seleccione...</option>
							@foreach ($programas as $programa)
							<option value="{{ $programa->id }}">{{ $programa->nombre }}</option>
							@endforeach
						</select>
					</div>

					<div class="col-md-12">
						<label for="estado_llamada" class="form-label">Estado llamada</label>
						<select class="form-select" id="estado_llamada" name="estado_llamada">
							<option selected disabled value="">Seleccione...</option>
							<option value="1">Sin llamar</option>
							<option value="2">Llamado</option>
						</select>
					</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<button type="button" class="btn btn-primary" onclick="guardarLlamado()">Guardar</button>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection

@section('scripts')
<script>
	$(document).ready(function() {
		$('.tel').mask('(000) 000 0000');
	});

	function abrirModal(datos) {
		let est = JSON.parse(datos);
		let estfin = JSON.parse(est);

		$("#nombres").val(estfin.nombres);
		$("#apellidos").val(estfin.apellidos);
		$("#email").val(estfin.email);
		$("#tel").val(estfin.tel);
		$("#programa_id").val(estfin.programa_id);
		$("#estado_llamada").val(estfin.estado_llamada);
		$("#id_upd").val(estfin.id);


		$("#ModalDataLabel").html(estfin.nombres + " " + estfin.apellidos);
		$("#ModalData").modal("show");
	}

	function guardarLlamado() {
		let ruta = $("#ruta_update").val();
		let datos = {
			id: $("#id_upd").val(),
			estado_llamada: $("#estado_llamada").val(),
			_token: $('#_token').val(),
		};
		console.log(ruta);
		$.ajax({
			type: "PUT",
			url: ruta,
			data: datos, // Adjuntar los campos
			success: function(data) {
				if (datos.estado_llamada == 1) {
					$("#icon_ll" + datos.id).removeClass('fa-check-circle text-success');
					$("#icon_ll" + datos.id).addClass('fa-times-circle text-danger');
				}
				if (datos.estado_llamada == 2) {
					$("#icon_ll" + datos.id).removeClass('fa-times-circle text-danger');
					$("#icon_ll" + datos.id).addClass('fa-check-circle text-success');
				}

				Swal.fire({
					icon: 'success',
					title: data.msg,
				});
				$("#ModalData").modal("hide");
			}
		});
	}
</script>
@endsection