<?php
// SDK de Mercado Pago
require __DIR__ . '/vendor/autoload.php';
//require_once './vendor/autoload.php';
/* recibimos los parametros */

$titulo = "Dispositivo móvil de Tienda e-commerce";
$precio = $_POST["precio"];
$unidad = $_POST["unidad"];
$picture = $_POST["picture"];
$cantidad = 1;


// Agrega credenciales
//MercadoPago\SDK::setAccessToken('TEST-562013120781246-092114-0f2597ea4215ce1d3680a94d4a3daf96__LB_LA__-7586171');
MercadoPago\SDK::setIntegratorId('dev_24c65fb163bf11ea96500242ac130004');
MercadoPago\SDK::setAccessToken('APP_USR-1159009372558727-072921-8d0b9980c7494985a5abd19fbe921a3d-617633181');
// Crea un objeto de preferencia
// Crea un ítem en la preferencia
$payer = new MercadoPago\Payer();
$payer->name = "Lalo";
$payer->surname = "Landa";
$payer->email = "test_user_58295862@testuser.com";
$payer->date_created = "2018-06-02T12:58:41.425-04:00";
$payer->phone = array(
    "area_code" => "52",
    "number" => "5549737300"
);

$payer->address = array(
    "street_name" => "Insurgentes Sur",
    "street_number" => 1602,
    "zip_code" => "03940"
);
$preference = new MercadoPago\Preference();
$item = new MercadoPago\Item();
$url = "https://gldeleon-mp-commerce-php.herokuapp.com";
$item->id = "1234";
$item->title = $titulo;
$item->quantity = $cantidad;
$item->unit_price = $precio;
$item->picture_url = $picture;
$item->currency_id = "MXN";
$preference->items = [$item];
//$preference->external_reference = "pruebamercadopago";
$preference->external_reference = "gldeleon@live.com.mx";
$preference->notification_url = "https://gldeleon-mp-commerce-php.herokuapp.com/pago.php";
$preference->email = "gldeleon@live.com.mx";
$preference->back_urls = array(
    "success" => "/success.php",
    "failure" => "/failure.php",
    "pending" => "/pending.php"
);
$preference->payment_methods = array(
    "excluded_payment_methods" => array(
        array("id" => "amex")
    ),
    "excluded_payment_types" => array(
        array("id" => "atm")
    ),
    "installments" => 6
);
$preference->payer = $payer;
$preference->auto_return = "approved";
$preference->save();
//var_dump($preference);
?>
<html lang="en"><head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

        <title>Prueba mercadopago</title>

        <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/checkout/">

        <!-- Bootstrap core CSS -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://www.mercadopago.com/v2/security.js" view=""></script>


        <!-- Custom styles for this template -->
        <link href="form-validation.css" rel="stylesheet">
    </head><link type="text/css" rel="stylesheet" id="dark-mode-general-link"><link type="text/css" rel="stylesheet" id="dark-mode-custom-link"><style type="text/css" id="dark-mode-custom-style"></style>

    <body class="bg-light" cz-shortcut-listen="true">

        <div class="container">
            <div class="py-5 text-center">
                <h2>Carrito prueba mercadopago</h2>
                <p class="lead">A continuacion tu pago sera procesado por MercadoPago!</p>
            </div>

            <div class="row">
                <div class="col-md-4 order-md-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">En tu carrito</span>
                        <span class="badge badge-secondary badge-pill">1</span>
                    </h4>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Nombre</h6>
                                <small class="text-muted"><?php echo $titulo; ?></small>
                            </div>
                            <span class="text-muted">$ <?php echo $precio; ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total </span>
                            <strong>$ <?php echo $precio; ?></strong>
                        </li>
                    </ul>
                </div>
                <div class="col-md-8 order-md-1">
                    <h4 class="mb-3"></h4>
                    <form class="needs-validation" action="/pago.php" method="post" novalidate="">
                        <div class="row">
                            <div class="jumbotron">

                                <p class="lead">Al dar clic en pagar se te redirigirá a mercadopago.</p>
                                <hr class="my-4">
                                <p>La forma mas segura de pagar.</p>
                                <p class="lead">
                                    <a class="btn btn-primary btn-lg" target="_blank" href="https://www.mercadopago.com.mx/" role="button">Mas Informacion</a>
                                </p>
                            </div>
                        </div>

                        <hr class="mb-4">
                        <script
                            src="https://www.mercadopago.com.mx/integrations/v1/web-payment-checkout.js"
                            data-preference-id="<?php echo $preference->id; ?>">
                        </script>
                        <!--<button class="btn btn-primary btn-lg btn-block" type="submit">Continuar al pago</button>-->
                        <div>
                        </div>
                    </form>
                </div>
            </div>

            <footer class="my-5 pt-5 text-muted text-center text-small">
                <p class="mb-1">© Prueba MercadoPago 2020</p>
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="#">Privacy</a></li>
                    <li class="list-inline-item"><a href="#">Terms</a></li>
                    <li class="list-inline-item"><a href="#">Support</a></li>
                </ul>
            </footer>
        </div>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
        <script src="../../assets/js/vendor/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script src="../../assets/js/vendor/holder.min.js"></script>
        <script>
                                // Example starter JavaScript for disabling form submissions if there are invalid fields
                                (function () {
                                    'use strict';

                                    window.addEventListener('load', function () {
                                        // Fetch all the forms we want to apply custom Bootstrap validation styles to
                                        var forms = document.getElementsByClassName('needs-validation');

                                        // Loop over them and prevent submission
                                        var validation = Array.prototype.filter.call(forms, function (form) {
                                            form.addEventListener('submit', function (event) {
                                                if (form.checkValidity() === false) {
                                                    event.preventDefault();
                                                    event.stopPropagation();
                                                }
                                                form.classList.add('was-validated');
                                            }, false);
                                        });
                                    }, false);
                                })();
        </script>


    </body>
</html>

