<?php include_once (VIEWS . 'header.php')?>

<div class="card" id="container"><!--GEnerame un carrito o una tienda sin necesidad de haber iniciado sesion. Solo para pagar-->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Iniciar sesion</li>
            <li class="breadcrumb-item"><a href="#">Datos de envio</a></li>
            <li class="breadcrumb-item"><a href="#">Forma de pago</a></li>
            <li class="breadcrumb-item"><a href="#">Verifica los datos</a></li>
        </ol>
    </nav>
    <h2><?= $data['subtitle']?></h2>
    <form class="text-end">
        <div class="form-group">
            <label for="user">Correo lectronico:</label>
            <input type="email" name="email" class="form-control"
                   placeholder="Escribe el correo electrónico"
>
        </div>
        <div class="form-group">
            <label for="password">Clave de acceso:</label>
            <input type="password" name="password" class="form-control"
                   placeholder="Escribe la contraseña"
            >
        </div>
        <div class="form-group text-left">
            <a href="<?= ROOT ?>cart/address" class="btn btn-success">Enviar</a>
        </div>

    </form>
</div>
<?php include_once dirname(__DIR__) . ROOT . 'footer.php'?>

