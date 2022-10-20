
<?php include_once dirname(__DIR__) . ROOT . 'header.php'?><!--tarjeta que muetra los productos-->

<h2 class="text-center"><?= $data['subtitle']?></h2>
<img src="<?= ROOT?>img/ </a>">
<h4>Precio:</h4>
<p> <?= number_format($data['data']->price, 2)?>eur</p>
<?= html_entity_decode($data['data']->description)?>
<?php if ($data['data']->type==1): ?>
    <h4>A quien va dirigido:</h4>
    <p><?= $data['data']->people?></p>
    <h4>Objetivos:</h4>
    <p><?= $data['data']->objectives?></p>
    <h4>Que es necesario conocer:</h4>
    <?php if ($data['data']->type==2): ?>
        <p>Author: <?= $data['data']->author?></p>
    <?php endif;?>
    <a href="<?= ROOT?>shop" class="btn btn-succes">Volver al listado de productos </a>
<?php include_once dirname(__DIR__) . ROOT . 'footer.php'?>