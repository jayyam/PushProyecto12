<?php include_once(VIEWS . 'header.php') ?>
<div class="card" id="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Iniciar sesion</a></li>
            <li class="breadcrumb-item"><a href="#">DAtos de envio</a></li>
            <li class="breadcrumb-item"><a href="#"></a>Forma de pago</li>
            <li class="breadcrumb-item"><a href="#">Verifica los datos</a></li>
            <li class="breadcrumb-item">Gracias</li>
        </ol>
    </nav>
    <!--cabecera-->
    <div class="card-header">
        <h1><?= $data['titulo'] ?></h1>
        <p>Por favor, elija la forma de pago</p>
    </div>
    <!--cuerpo-->
    <h2>Estimado/a <?= $data['data']->first_name ?>:</h2>
    <h4>¡Gracias por visitarnos y hacer su compra! Estamos contentos de que haya encontrado lo que buscaba. Nuestro objetivo es que siempre esté satisfecho, avísenos de su nivel de satisfacción. Esperamos volver a verle pronto.</h4>
    <h3>¡Que tenga un gran día!</h3>
    <br>
    &nbsp;
    <br>
    <h3>Atentamente:</h3>
    <br>
    <h3>Sus amigos de TiendaMVC</h3>
    <br>
    <div class="form-group text-left">
        <a href="<?= ROOT ?>shop" class="btn btn-success" role="button">Regresar a la tienda</a>
    </div>
<?php include_once(VIEWS . 'footer.php') ?>
