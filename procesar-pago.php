<?php
// SDK de Mercado Pago
require __DIR__ . '/vendor/autoload.php';
//require_once './vendor/autoload.php';
/* recibimos los parametros */

$titulo = $_POST["titulo"];
$precio = $_POST["precio"];
$unidad = array($_POST["unidad"]);
$cantidad = 1;


// Agrega credenciales
//MercadoPago\SDK::setAccessToken('TEST-562013120781246-092114-0f2597ea4215ce1d3680a94d4a3daf96__LB_LA__-7586171');
MercadoPago\SDK::setIntegratorId('dev_24c65fb163bf11ea96500242ac130004');
MercadoPago\SDK::setAccessToken('APP_USR-1159009372558727-072921-8d0b9980c7494985a5abd19fbe 921a3d-617633181');
// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();
// Crea un ítem en la preferencia
$payer = new MercadoPago\Payer();
$payer->name = "Lalo";
$payer->surname = "Landa";
$payer->email = "charles@hotmail.com";
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

$item = new MercadoPago\Item();
$item->title = $titulo;
$item->quantity = $cantidad;
$item->unit_price = $precio;
$preference->items = [$item];
$preference->back_urls = array(
    "success" => "/success.php",
    "failure" => "/failure.php",
    "pending" => "/pending.php"
);
$preference->auto_return = "approved";
$preference->save();
//var_dump($preference);
?>


<div>
    <h2>Procesar pago</h2>
    <form action="/" method="POST">
        <script
            src="https://www.mercadopago.com.mx/integrations/v1/web-payment-checkout.js"
            data-preference-id="<?php echo $preference->id; ?>">
        </script>
    </form>
</div>