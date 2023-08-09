<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bienvenido | EcoMeter </title>
    <link href="{{ asset('assets/css/home.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" type="text/css" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="home.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>
  <body>
    
    <nav class="navbar navbar-light bg-primary static-top">
      <div class="container d-flex justify-content-end">
          @if (Route::has('login'))
              <div class="d-flex align-items-center">
                  @auth
                      <a href="{{ url('/home') }}" class="text-sm text-gray-700 mx-2">Home</a>
                  @else
                      <button type="button" class="btn btn-secondary mx-2" id="loginButton">Log in</button>
                      <script>
                          $(document).ready(function() {
                              $("#loginButton").on("click", function() {
                                  window.location.href = "{{ route('login') }}";
                              });
                          });
                      </script>
                      @if (Route::has('register'))
                          <button class="btn btn-dark mx-2" id="registerButton">Register</button>
                          <script>
                              $(document).ready(function() {
                                  $("#registerButton").on("click", function() {
                                      window.location.href = "{{ route('register') }}";
                                  });
                              });
                          </script>
                      @endif
                  @endauth
              </div>
          @endif   
      </div>
  </nav>
  
      <!-- Masthead-->
      <header class="masthead" style="background-image: url('img/bg-showcase-1.jpg'); background-size: cover; background-position: center;">
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <div class="text-center text-white">
                        <!-- Page heading -->
                        <h1 class="mb-5">Medición Inteligente para un Hogar Eficiente</h1>
              
                    </div>
                </div>
            </div>
        </div>
    </header>
    
      <!-- Icons Grid-->
      <section class="features-icons bg-light text-center">
          <div class="container">
              <div class="row">
                  <div class="col-lg-4">
                      <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                          <div class="features-icons-icon d-flex"><i class="bi-lightning-charge-fill m-auto text-primary"></i></div>
                          <h3>Descubre Tu Consumo</h3>
                          <p class="lead mb-0"> Nuestro diseño te permite visualizar tu consumo energético de manera clara y ordenada. Con gráficos fáciles de entender, sabrás exactamente cómo estás usando la energía.</p>
                      </div>
                  </div>
                  <div class="col-lg-4">
                      <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                          <div class="features-icons-icon d-flex"><i class="bi-stopwatch m-auto text-primary"></i></div>
                          <h3>Monitoriza en Tiempo Real </h3>
                          <p class="lead mb-0">Con un diseño que se actualiza en tiempo real, podrás ver cómo cambia tu consumo a medida que tomas medidas para ser más eficiente.</p>
                      </div>
                  </div>
                  <div class="col-lg-4">
                      <div class="features-icons-item mx-auto mb-0 mb-lg-3">
                          <div class="features-icons-icon d-flex"><i class="bi-pencil-square m-auto text-primary"></i></div>
                          <h3>Registra tus Datos Sin Esfuerzo</h3>
                          <p class="lead mb-0"> Con solo unos clics, podrás registrar tus datos diarios de consumo. Nuestro diseño orientado a la facilidad hace que este proceso sea rápido y cómodo.</p>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <!-- Image Showcases-->
      <section class="showcase">
          <div class="container-fluid p-0">
              <div class="row g-0">
                  <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('img/bg-showcase-4.jpg')"></div>
                  <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                      <h2>Cuida el Medio Ambiente</h2>
                      <p class="lead mb-0">Nuestra plataforma de medición de energía no solo te ayuda a controlar y optimizar tu consumo, sino que también te convierte en un defensor activo del medio ambiente. Al reducir tu consumo innecesario y adoptar prácticas más eficientes, estás desempeñando un papel crucial en la conservación de los recursos naturales y la reducción de emisiones nocivas. Cada pequeño esfuerzo cuenta, y juntos, podemos marcar la diferencia para las generaciones futuras.</p>
                  </div>
              </div>
              <div class="row g-0">
                  <div class="col-lg-6 text-white showcase-img" style="background-image: url('img/bg-showcase-2.jpg')"></div>
                  <div class="col-lg-6 my-auto showcase-text">
                      <h2>Facilidad de uso</h2>
                      <p class="lead mb-0">Descubre la comodidad de una plataforma que hace que la gestión de tu energía sea más fácil que nunca. Nuestra interfaz intuitiva te guía a través de tus datos de consumo de manera sencilla, permitiéndote tomar el control de tu hogar de forma eficiente. Sin complicaciones ni confusión, solo simplicidad en cada paso hacia un estilo de vida más sostenible y consciente.</p>
                  </div>
              </div>
              <div class="row g-0">
                  <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('img/bg-showcase-3.jpg')"></div>
                  <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                      <h2>Visualiza tu Impacto</h2>
                      <p class="lead mb-0">Con nuestra página de medición de energía, podrás ver en tiempo real cómo tu comportamiento y hábitos afectan tu consumo energético. Observa gráficos interactivos que te muestran tus patrones de uso y cómo pequeños cambios pueden hacer una gran diferencia en tu huella energética. Con esta perspectiva única, estarás empoderado para tomar decisiones informadas que no solo te benefician, sino que también contribuyen a la preservación del medio ambiente.</p>
                  </div>
              </div>
          </div>
      </section>
      <!-- Testimonials-->
      <section class="testimonials text-center bg-light">
          <div class="container">
              <h2 class="mb-5">Opiniones de nuestros clientes..</h2>
              <div class="row">
                  <div class="col-lg-4">
                      <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                          <img class="img-fluid rounded-circle mb-3" src="{{ asset('img/testimonials-1.jpg') }}" alt="..." />
                          <h5>Margaret E.</h5>
                          <p class="font-weight-light mb-0">"Esto es fantastico! He ahorrado mucho dinero!"</p>
                      </div>
                  </div>
                  <div class="col-lg-4">
                      <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                          <img class="img-fluid rounded-circle mb-3" src="{{ asset('img/testimonials-2.jpg') }}" alt="..." />
                          <h5>Fred S.</h5>
                          <p class="font-weight-light mb-0">"EcoMeter es asombroso. Lo he estado usando para ahorrar el uso de energia de mi cuarto y no puedo estar mas feliz por su sencillo uso."</p>
                      </div>
                  </div>
                  <div class="col-lg-4">
                      <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                          <img class="img-fluid rounded-circle mb-3" src="{{ asset('img/testimonials-3.jpg') }}" alt="..." />
                          <h5>Sarah W.</h5>
                          <p class="font-weight-light mb-0">"Muchas gracias por ayudarme con esta aplicacion!"</p>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <!-- Call to Action-->
     
      <!-- Footer-->
      <footer class="footer bg-light">
          <div class="container">
              <div class="row">
                  <div class="col-lg-6 h-100 text-center text-lg-start my-auto">
                      <ul class="list-inline mb-2">
                        <li class="list-inline-item"><a href="#!">Sobre nosotros</a></li>
                        <li class="list-inline-item">⋅</li>
                        <li class="list-inline-item"><a href="#!">Contactanos</a></li>
                        <li class="list-inline-item">⋅</li>
                        <li class="list-inline-item"><a href="#!">Terminos de uso</a></li>
                        <li class="list-inline-item">⋅</li>
                        <li class="list-inline-item"><a href="#!">Politica de privacidad</a></li>
                      </ul>
                      <p class="text-muted small mb-4 mb-lg-0">&copy; Aurora Technologies 2023. All Rights Reserved.</p>
                  </div>
                  <div class="col-lg-6 h-100 text-center text-lg-end my-auto">
                      <ul class="list-inline mb-0">
                          <li class="list-inline-item me-4">
                              <a href="#!"><i class="bi-facebook fs-3"></i></a>
                          </li>
                          <li class="list-inline-item me-4">
                              <a href="#!"><i class="bi-twitter fs-3"></i></a>
                          </li>
                          <li class="list-inline-item">
                              <a href="#!"><i class="bi-instagram fs-3"></i></a>
                          </li>
                      </ul>
                  </div>
              </div>
          </div>
      </footer>
      <!-- Bootstrap core JS-->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
      <!-- Core theme JS-->
      <script src="js/scripts.js"></script>
      <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
      <!-- * *                               SB Forms JS                               * *-->
      <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
      <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
      <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>

        </div>
      </div>
    </div>
  </body>
</html>