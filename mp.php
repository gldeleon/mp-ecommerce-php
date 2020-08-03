<?php

namespace mp;

use MercadoPago\SDK;

class mp extends MercadoPago {

    //private $collector_id = 617633181;
    //private $public_Key = "APP_USR-d81f7be9-ee11-4ff0-bf4e-20c36981d7bf";
    private $access_token = "APP_USR-1159009372558727-072921-8d0b9980c7494985a5abd19fbe 921a3d-617633181";
    public $titulo = "";
    public $cantidad = 0;
    public $precio_unitario = 0;
    public $articulos = [];

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function setCantidad($cant) {
        $this->cantidad = $cant;
    }

    public function setPrecioU($precioU) {
        $this->precio_unitario = $precioU;
    }

    public function setArticulos($articulos) {
        $this->articulos = $articulos;
    }

    public function cobro() {

        // Agrega credenciales
        MercadoPago\SDK::setAccessToken($this->access_token);

        // Crea un objeto de preferencia
        $preference = new \MercadoPago\Preference();

        // Crea un ítem en la preferencia
        $item = new MercadoPago\Item();
        $item->title = $this->titulo;
        $item->quantity = $this->cantidad;
        $item->unit_price = $this->precio_unitario;
        $preference->items = $this->articulos;
        return $preference->save();
    }

}
