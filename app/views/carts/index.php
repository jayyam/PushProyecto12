<?php include_once dirname(__DIR__) . ROOT . 'header.php'?>

<?php $verify = false; $subtotal =0; $send = 0; $discount =0; $user_id =$data['user_id'] ?>
<h2c class="text-center" >Carrito de la compra</h2c>

<form action="<?= ROOT?>cart/update" method="POST">
    <table>
        <tr>
            <th width="">producto</th>
            <th width="">descripcion</th>
            <th width="">CAnt.</th>
            <th width="">Precio</th>
            <th width="">Subtotal</th>
            <th width="">&nbsp</th>
            <th width="">Borrar</th>
        </tr>
        <?php foreach ($data['data'] as $key => $value): ?>
        <tr>
            <td><img src="<?= ROOT?>img/"> </td>

            <td><br><?= $value->name?></br> <?= substr(html_entity_decode($value->description), 0, 200)?> </td>

            <td input type="number" name="c<?= $key?>" class="text-rigth"
                      value="<?= number_format($value->quantity, 2)?>"
                      min="1" max="99"
                input type="hidden" name="i<?=$key?> value=<?= $value->product?>">
            ></td>

            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <?php endforeach;?>
    </table>


</form>
<?php include_once dirname(__DIR__) . ROOT . 'footer.php'?>