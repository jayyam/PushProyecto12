<?php include_once dirname(__DIR__) . ROOT . 'header.php'?>

<div class="card" id="container"><!--GEnerame un carrito o una tienda sin necesidad de haber iniciado sesion. Solo para pagar-->
    <nav aria-label="breadcrumb">
        <ol>
            <li class="breadcrumb">Iniciar sesion</li>
            <li class="breadcrumb"><a href="#">Datos de envio</a></li>
            <li class="breadcrumb"><a href="#"></a>Forma de pago</li>
            <li class="breadcrumb"><a href="#"></a>Verifica los datos</li>
        </ol>
    </nav>
    <h2><?= $data['subtitle']?></h2>
    <form class="text-end">
        <div class="form-group text-left">
            <label for="user">Usuario:</label>
            <input type="text" name="user" class="form-control"
                   placeholder="Escribe el correo electrónico"
                   value="<?= isset($data['data']) ? $data['data']['user'] : '' ?>"
            >
        </div>
        <div class="form-group text-left">
            <label for="password">Clave de acceso:</label>
            <input type="password" name="password" class="form-control"
                   placeholder="Escribe la contraseña"
                   value="<?= isset($data['data']) ? $data['data']['password'] : '' ?>"<!--ternario sin modificar-->
            >
        </div>
        <div class="form-group text-left">
            <a href="<?= ROOT ?>cart/address" class="btn btn-success">Enviar</a>
        </div>

    </form>
</div>









<?php include_once dirname(__DIR__) . ROOT . 'footer.php'?>

