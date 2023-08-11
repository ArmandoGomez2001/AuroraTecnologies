<!DOCTYPE html>
<html>
<head>
  <!-- ... otros metadatos y estilos ... -->
  <!-- SweetAlert2 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
</head>
<body>
  <!-- ... tu contenido ... -->

  <!-- SweetAlert2 y jQuery -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>

  <!-- ... otros scripts ... -->
</body>
</html>

<div id="changePasswordModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cambiar contraseña</h5>
                <button type="button" aria-label="Close" class="close outline-none" data-dismiss="modal">×</button>
            </div>
            <form method="POST" id='changePasswordForm'>
            <div class="modal-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="alert alert-danger d-none" id=""></div>
                    <input type="hidden" name="is_active" value="1">
                    <input type="hidden" name="user_id" id="editPasswordValidationErrorsBox">
                    {{csrf_field()}}
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label>Contraseña Actual:</label><span
                                class="required confirm-pwd"></span><span class="required">*</span>
                        <div class="input-group">
                            <input class="form-control input-group__addon" id="pfCurrentPassword" type="password"
                                   name="password_current" required>
                            <div class="input-group-append input-group__icon">
                                <span class="input-group-text changeType">
                                    <i class="icon-ban icons"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <label>Nueva Contraseña:</label><span
                                class="required confirm-pwd"></span><span class="required">*</span>
                        <div class="input-group">
                            <input class="form-control input-group__addon" id="pfNewPassword" type="password"
                                   name="password" required>
                            <div class="input-group-append input-group__icon">
                                <span class="input-group-text changeType">
                                    <i class="icon-ban icons"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <label>Confirmar Contraseña:</label><span
                                class="required confirm-pwd"></span><span class="required">*</span>
                        <div class="input-group">
                            <input class="form-control input-group__addon" id="pfNewConfirmPassword" type="password"
                                   name="password_confirmation" required>
                            <div class="input-group-append input-group__icon">
                                <span class="input-group-text changeType">
                                    <i class="icon-ban icons"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary" id="btnPrPasswordEditSave" data-loading-text="<span class='spinner-border spinner-border-sm'></span> Processing...">Save</button>
                    <button type="button" class="btn btn-light ml-1" data-dismiss="modal">Cancel
                    </button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
      $("#changePasswordForm").on("submit", function(event) {
        event.preventDefault(); // Prevent the default form submission
  
        // Show SweetAlert2
        Swal.fire({
          title: 'Guardando...',
          html: 'Espere un momento mientras se procesa...',
          icon: 'info',
          showCancelButton: false,
          showConfirmButton: false,
          allowOutsideClick: false,
          didOpen: () => {
            Swal.showLoading();
  
            // Here you can add any additional actions you want to perform after the modal is shown.
            // For example, you can trigger form submission after showing the modal.
            // Uncomment the following line if you want to automatically submit the form after showing the modal.
            // $("#changePasswordForm").submit();
          },
        });
  
        // Here, you should add the actual logic to process and save the new password.
        // You can use AJAX to send the form data to the server.
  
        // For this example, I will simulate a 2-second delay to simulate a save operation.
        setTimeout(function() {
          Swal.fire({
            title: 'Contraseña cambiada',
            text: 'La contraseña se ha cambiado correctamente.',
            icon: 'success',
            timer: 1500, // Duration of the notification in milliseconds
            timerProgressBar: true,
          }).then(() => {
            // Close the modal after the successful save
            $("#changePasswordModal").modal("hide");
          });
        }, 2000); // Simulated save operation (2 seconds)
      });
    });
  </script>
  
  
  
  
<?php


