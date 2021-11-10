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
                                    <input type="text" value="{{ Request()->nombres }}" name="nombres"
                                        class="form-control form-control-sm">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for=""><i class="fas fa-user"></i> Apellidos</label>
                                    <input type="text" value="{{ Request()->apellidos }}" name="apellidos"
                                        class="form-control form-control-sm">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for=""><i class="fas fa-envelope"></i> Email</label>
                                    <input type="text" value="{{ Request()->email }}" name="email"
                                        class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for=""><i class="fas fa-mobile"></i> Telefono</label>
                                    <input type="text" value="{{ Request()->tel }}" name="tel"
                                        class="tel form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label" for=""><i class="fas fa-graduation-cap"></i>
                                        Programa</label>
                                    <select class="form-select form-select-sm" value="{{ Request()->programa_id }}"
                                        name="programa_id">
                                        <option selected disabled value="">Seleccione...</option>
                                        @foreach ($programas as $programa)
                                            <option value="{{ $programa->id }}">{{ $programa->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary mt-4"><i class="fa fa-search"></i>Estudiantes</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="list-group">
                            @foreach ($estudiantes as $estudiante)
                                <a class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w200 justify-content-between">
                                        <h5 class="mb-1"><i
                                                class="{{ $estudiante->estado_llamada == 1 ? 'fas fa-times-circle text-danger' : 'fas fa-check-circle text-success' }}"></i>
                                            {{ $estudiante->nombres }} {{ $estudiante->apellidos }}</h5>
                                        <small>{{ $estudiante->tel }} <i
                                                id="icon_ll{{ $estudiante->id }}"></i></small>
                                    </div>
                                    <p class="mb-1"><i class="fas fa-envelope"></i> {{ $estudiante->email }}
                                    </p>
                                    <small><i class="fas fa-graduation-cap"></i>
                                        {{ $estudiante->programa->nombre }}.</small>
                                    <div class="col-md-6">
                                        <input name="_token" id="_token" type="hidden" value="{{ csrf_token() }}" />
                                        <input id="ruta_update" type="hidden" value="{{ route('estudiante.update') }}" />                                        
                                        <label for="estado_llamada" class="form-label">Estado: </label>
                                        @if ($estudiante->estado_llamada == 1)
                                            <select class="form-select" id="estado_llamada" name="estado_llamada"
                                                onblur="llamar({{ $estudiante->id }})">
                                                <option selected disabled value="">Seleccione...</option>
                                                <option value="1">Sin Llamar</option>
                                                <option value="2">Llamado</option>
                                            </select>                                    											
										@else
											<label for="estado_llamada" class="form-label">Llamado</label>		
										
										@endif
									
                                    </div>
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
    </section>
@endsection

@section('scripts')
    <script>
        function llamar(id) {
            let ruta = $("#ruta_update").val();
            let datos = {
                id: id,
                estado_llamada: $("#estado_llamada").val(),
                _token: $('#_token').val(),
            };
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
