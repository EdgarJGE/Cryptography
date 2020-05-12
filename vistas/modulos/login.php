<body class="hold-transition login-page">

  <div class="login-box">

    <div class="login-logo">

      <img src="vistas/img/plantilla/logo.png" class="img-responsive" width="100" height="100">
      <a href=""><b>Hospital</b>Files</a>

    </div>

    <!-- /.login-logo -->
    <div class="card">

      <div class="card-body login-card-body">

        <p class="login-box-msg">Ingresar al sistema</p>

        <form method="post">

          <div class="input-group mb-3">

            <input type="text" class="form-control" placeholder="Usuario" name="ingUsuario" required>

            <div class="input-group-append">

              <div class="input-group-text">

                <span class="fas fa-user"></span>

              </div>

            </div>

          </div>

          <div class="input-group mb-3">

            <input type="password" class="form-control" placeholder="Contraseña" name="ingPassword" required>

            <div class="input-group-append">

              <div class="input-group-text">

                <span class="fas fa-lock"></span>

              </div>

            </div>

          </div>

          <div class="row">

            <!-- /.col -->
            <div class="col-4">

              <button type="submit" class="btn btn-primary btn-block">Ingresar</button>

            </div>
            <!-- /.col -->
          </div>

          <?php

            $login = new ControladorUsuarios();
            $login -> ctrIngresoUsuario();
          
          ?>

        </form>

      </div>
      
    </div>

  </div>

</body>
