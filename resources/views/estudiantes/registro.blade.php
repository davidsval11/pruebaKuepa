@extends('layout.app')
@section('content')
<section class="vh-100">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center mt-5">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4" style="color:#f15a24">Registrarme</p>

                <form class="row g-3 needs-validation" novalidate method="POST" action="{{ route('estudiante.store') }}">
                  <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                  <input name="estado_llamada" type="hidden" value="1" />

                  <div class="col-md-12">
                    <label for="nombres" class="form-label">Nombres</label>
                    <input type="text" class="form-control" id="nombres" name="nombres" required>
                    <div class="invalid-feedback">
                      Por favor ingresa tu nombre.
                    </div>
                  </div>

                  <div class="col-md-12">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                    <div class="invalid-feedback">
                      Por favor ingresa tus apellidos.
                    </div>
                  </div>

                  <div class="col-md-12">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group has-validation">
                      <span class="input-group-text">@</span>
                      <input type="email" class="form-control" id="email" name="email" required>
                      <div class="invalid-feedback">
                        Por favor ingresa tu correo.
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <label for="tel" class="form-label">Telefono</label>
                    <input type="text" class="form-control tel" id="tel" name="tel" required>
                    <div class="invalid-feedback">
                      Por favor ingresa tu telefono.
                    </div>
                  </div>
                  <div class="col-md-12">
                    <label for="programa_id" class="form-label">Programa</label>
                    <select class="form-select" id="programa_id" name="programa_id" required>
                      <option selected disabled value="">Seleccione...</option>
                      @foreach ($programas as $programa)
                      <option value="{{ $programa->id }}">{{ $programa->nombre }}</option>
                      @endforeach
                    </select>
                    <div class="invalid-feedback">
                      Por favor selecciona una opcion.
                    </div>
                  </div>

                  <div class="col-12 d-grid gap-2">
                    <button class="btn btn-primary" type="submit" onclick="validar()">Registrarme...</button>
                  </div>
                </form>

              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-registration/draw1.png" class="img-fluid" alt="Sample image">

              </div>
            </div>
          </div>
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

  function validar() {
    var forms = document.querySelectorAll('.needs-validation')
    Array.prototype.slice.call(forms)
      .forEach(function(form) {
        form.addEventListener('submit', function(event) {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }

          form.classList.add('was-validated')
        }, false)
      })

  }
</script>
@endsection