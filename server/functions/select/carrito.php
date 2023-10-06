<?php

function cantidad_productos_carrito()
{
    include_once '../conexion.php';
    
    $admin = $_SESSION['DLV']['admin'];
    $id_usuario = UserID($admin);
    $cedula = ClientCedula($id_usuario);
    $id_cliente = ClientID($cedula);
    if(isset($_POST['id_categoria']) && isset($_POST['id_comercio']))
    {
        $id_categoria = $_POST['id_categoria'];
        $id_comercio = $_POST['id_comercio'];
    
        $cantidad = MyGlobalCar($id_cliente, $id_comercio);
    
        echo $cantidad;
    }

}

function ver_mi_carrito()
{
    include_once '../conexion.php';

    if(isset($_POST['id_categoria']) && isset($_POST['id_comercio']))
    {
        $admin = $_SESSION['DLV']['admin'];
        $id_usuario = UserID($admin);
        $cedula = ClientCedula($id_usuario);
        $id_cliente = ClientID($cedula);
        $id_categoria = $_POST['id_categoria'];
        $id_comercio = $_POST['id_comercio'];
        $comercio_data = ComercioData($id_comercio);
        $rif_comercio = $comercio_data[0]['Rif'];
    
        $ruta = "../../server/images/products/$rif_comercio/productos/";
    
        $mycar = InsideMyCar($id_cliente, $id_comercio);
    
        if($mycar)
        {
            $subtotal = 0;
            $iva = 0;
            $total = 0;
            $carrito = 
            "
            <div class='lista-carrito'>
            ";
    
            foreach($mycar as $producto)
            {
                $id_producto = $producto['Id_producto'];
                $codigo = $producto['Codigo'];
                $foto = $ruta.$producto['Foto'].'.jpg';
                $descripcion = $producto['Descripcion'];
                $precio_civa = $producto['P_civa'];
                $precio_siva = $producto['P_siva'];
                $cantidad = $producto['Cantidad'];
    
                $carrito .= 
                "
                <div class='container unit-product-car'>
                <img align='left' class='img-unit-product-car' src='$foto' alt='foto'>
                <h6>$descripcion</h6> <span class='badge bg-primary'>$cantidad</span>
                <p class='precio-car'>$.$precio_civa</p>
                <p class='precio-car'>$.$precio_siva</p>
                <button class='btn btn-primary' id='restar_car' producto='$id_producto' codigo='$codigo' comercio='$id_comercio'>-</button>
                <button class='btn btn-primary' id='sumar_car' producto='$id_producto' codigo='$codigo' comercio='$id_comercio'>+</button>
                </div>";
            }
    
            $subtotal = SubtotalCar($id_cliente, $id_comercio);
            $iva = IvaCar($id_cliente, $id_comercio);
            $total = TotalCar($id_cliente, $id_comercio);
    
            $carrito .= 
            "
            </div>
            <div class='subtotal-div container d-flex'>
                <p class='flex-grow-1'>Subtotal:</p> <p>$.$subtotal</p>
            </div>
            <div class=' iva-div container d-flex'>
               <p class='flex-grow-1'>I.V.A:</p> <p>$.$iva</p>
            </div>
            <div class='total-div container d-flex'>
              <p class='flex-grow-1'>Total:</p> <p>$.$total</p>
            </div>
            <div class='text-center completar-div'>
            <button id='agregar_pedido' cliente='$id_cliente' comercio='$id_comercio' class='btn card-btn'>Confirmar</button>
            </div>
            ";
    
            echo $carrito;
        }
        else
        {
            $carrito = EmptyCar();
            echo $carrito;
        }
    }
    else
    {
        $carrito = EmptyCar();
        echo $carrito;
    }

}