<?php

function ItemsInCar()
{
    include_once '../conexion.php';

    $admin = $_SESSION['DLV']['admin'];
    $UserID = UserID($admin);
    $ClientData = ClientData($UserID);
    $id_cliente = $ClientData[0]['Id'];
    $cantidad = MyGlobalCar($id_cliente);

    echo $cantidad;
}

function mis_carritos()
{
    include_once '../conexion.php';
    $admin = $_SESSION['DLV']['admin'];
    $UserID = UserID($admin);
    $AdminLevel = AdminLevel($UserID);
    $ClientData = ClientData($UserID);
    $id_cliente = $ClientData[0]['Id'];
    $back_btn = "<button class='back-button' onclick=history.back()><i class='fa-solid fa-arrow-left'></i></button>";
    $MyCars = MyCars($id_cliente);
    $respuesta =
        [
            'titulo' => $back_btn . 'MIS CARRITOS',
            'contenido' => '',
            'comprar' => ''
        ];

    if ($MyCars) {
        foreach ($MyCars as $car) {
            $id_comercio = $car['Id_comercio'];
            $id_usuario = $car['Id_usuario'];
            $razon_social = $car['Razon_social'];
            $cantidad = $car['SUM(c.Cantidad)'];
            $foto = SearchProfilePhoto($id_usuario);

            $respuesta['contenido'] .=
                "<a href='mi_carrito?comercio=$id_comercio'>
            <div class='card-product'>
               <div class='product-img-car'>
                  <img class='product-img' src='$foto' alt='$razon_social'>
               </div>
               <div class='card-product-title'>
                   $razon_social <span class='badge  bg-primary'>$cantidad</span>
               </div>
           </div>
           </a>
            ";
        }
    } else {
        $respuesta['contenido'] = EmptyPage('Aún No Eliges Tus Productos Favoritos');
        $respuesta['comprar'] = "<a href='comprar' class='fill-car'>Agregar Productos</a>";
    }

    echo json_encode($respuesta);
}

function mi_carrito()
{
    include_once '../conexion.php';
    $admin = $_SESSION['DLV']['admin'];
    $UserID = UserID($admin);
    $AdminLevel = AdminLevel($UserID);
    $ClientData = ClientData($UserID);
    $id_cliente = $ClientData[0]['Id'];
    $back_btn = "<button class='back-button' onclick=history.back()><i class='fa-solid fa-arrow-left'></i></button>";
    $respuesta =
        [
            'titulo' => $back_btn . 'MI CARRITO',
            'contenido' => '',
            'comprar' => ''
        ];

    if (isset($_POST['id_comercio'])) {
        $id_comercio = $_POST['id_comercio'];
        $InsideMyCar = InsideMyCar($id_cliente, $id_comercio);
        $subtotal = 0;
        $alicuota = 0;
        $total = 0;

        if ($InsideMyCar) {
            foreach ($InsideMyCar as $item) {
                $id_producto = $item['Id_producto'];
                $id_comercio = $item['Id_comercio'];
                $codigo = $item['Codigo'];
                $descripcion = $item['Descripcion'];
                $psiva = $item['Psiva'];
                $pciva = $item['Pciva'];
                $iva = $pciva - $psiva;
                $cantidad = $item['Cantidad'];
                $foto = SearchProductPhoto($id_comercio, $codigo);
                $subtotal += $psiva * $cantidad;
                $alicuota += $iva * $cantidad;
                $total += $pciva * $cantidad;

                

                $respuesta['contenido'] .=
                "
                <div class='card-product'>
                 <div class='product-img-car'>
                     <img class='product-img' src='$foto' alt='$descripcion'>
                 </div>
                     <div class='card-product-title'>
                        $descripcion
                     </div>
                     <div class='card-product-price'>
                         <p class='card-product-main-price'>$. $pciva</p>
                         <p class='card-product-text'>$. $psiva</p>
                         <p class='card-product-text'>I.V.A $. $iva</p>
                     </div>
        
                 <div id='plus_less_$codigo' codigo='$codigo' class='card-product-buttons'>
                 <button id='restar_car' codigo='$codigo' producto='$id_producto' comercio='$id_comercio' class='less-button'>
                 <i class='fa-solid fa-circle-minus'></i>
                 </button>
                <span id='span_quantity_$codigo' class='span-quantity'>$cantidad</span>
                <button id='sumar_car' codigo='$codigo' producto='$id_producto' comercio='$id_comercio' class='plus-button'>
                <i class='fa-solid fa-circle-plus'></i>
                </button>
                </div>
             </div>
             ";
            }

            $respuesta['contenido'] .=
            "
                    <div class='container-amount'>
                    <div class='amount-item'>
                        <p class='amount'>Subtotal:</p> <p class='amount'>$.$subtotal</p>
                    </div>
                    <div class='amount-item'>
                       <p class='amount'>I.V.A:</p> <p class='amount'>$.$alicuota</p>
                    </div>
                    <div class='amount-item'>
                      <p class='amount'>Total:</p> <p class='amount'>$.$total</p>
                    </div>
                    <div class='amount-footer'>
                      <button class='confirm-button' id='agregar_pedido' cliente='$id_cliente' comercio='$id_comercio'>Confirmar</button>
                    </div>
                    </div>";
        } else {
            $respuesta['contenido'] = EmptyPage('Carrito Vació');
            $respuesta['comprar'] = "<a href='comprar' class='fill-car'>Agregar Productos</a>";
        }

        echo json_encode($respuesta);
    }
}
