@extends('layout.app')
@section('content')
    <section class="vh-100">
        <div class="container h-100">
            <div class="col-lg-12">
                <div class="card text-black" style="border-radius: 10px;">
                    <div class="card-body">
                        <div class="col-md-12 col-lg-12">
                            <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Registro</p>
                            <form class="row g-3" method="POST" action="{{ route('estudiante.store') }}">
                                <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                                <input name="estado_llamada" type="hidden" value="1" />
                                <div class="col-md-6">
                                    <label for="nombres" class="form-label">Nombres</label>
                                    <input type="text" class="form-control" id="nombres" name="nombres" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="apellidos" class="form-label">Apellidos</label>
                                    <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text">@</span>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="tel" class="form-label">Telefono</label>
                                    <input type="text" class="form-control tel" id="tel" name="tel" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="programa_id" class="form-label">Programa</label>
                                    <select class="form-select" id="programa_id" name="programa_id" required>
                                        <option selected disabled value="">Seleccione...</option>
                                        @foreach ($programas as $programa)
                                            <option value="{{ $programa->id }}">{{ $programa->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 d-grid gap-2">
                                    <button class="btn btn-primary" type="submit">Enviar</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
    </section>
@endsection
