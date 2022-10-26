<?php include_once (VIEWS .'header.php')?>
<?php $verify = false; $subtotal =0; $send = 0; $discount =0; $user_id =$data['user_id'] ?>
<h2 class="text-center" >Carrito de la compra</h2>
<form action="<?= ROOT?>cart/update" method="POST">
    <table class="table table-stripped" width="100%">
        <tr>
            <th width="12%">producto</th>
            <th width="58%">descripcion</th>
            <th width="1.8%">CAnt.</th>
            <th width="10.12%">Precio</th>
            <th width="10.12%">Subtotal</th>
            <th width="1%">&nbsp;</th>
            <th width="6.5%">Borrar</th>
        </tr>
        <?php foreach ($data['data'] as $key => $value): ?>
    </table>
    <hr>
    <table width="100%" class="text-end">
        <tr>
            <td><img src="<?= ROOT ?>img/<?= $value->image ?>" width="105" alt="<?= $value->name ?>"></td>

            <td><br><?= $value->name?></br> <?= substr(html_entity_decode($value->description), 0, 200)?> </td>

            <td input type="number" name="c<?= $key?>" class="text-rigth"
                      value="<?= number_format($value->quantity, 2)?>"
                      min="1" max="99"
                input type="hidden" name="i<?=$key?> value=<?= $value->product?>">
            ></td>

            <td class="text-end"><?= number_format($value->price, 2) ?> &euro;></td>
            <td class="text-end">
                <?= number_format($value->price * $value->quantity, 2) ?> &euro;
            </td>
            <td>&nbsp;</td>
            <td class="text-end">
            <a href="<?= ROOT ?>cart/delete/<?= $value->product ?>/<?= $data['user_id'] ?>"
               class="btn btn-danger"
            >Borrar</a></td>
        </tr>
        <?= $subtotal += $value->price*$value->quantity?>
        <?= $discount += $value->discount?>
        <?= $send += $value->send?>
        <?php endforeach;?>
        <?= $total = $subtotal - $discount + $send ?>
        <input type ="hidden" name="rows" value="<?=count($data['data'])?>">
        <input type ="hidden" name="user_id" value="<?=count($data['user_id'])?>">
        <hr>
            <table>
                <tr>
                    <td width="79.25%"></td>
                    <td width="11.55%">Subtotal:</td>
                    <td width="9.20%"><?= number_format($subtotal, 2) ?></td>
                </tr>
                <tr>
                    <td width="79.25%"></td>
                    <td width="11.55%">Descuento:</td>
                    <td width="9.20%"><?= number_format($discount, 2) ?></td>
                </tr>
                <tr>
                    <td width="79.25%"></td>
                    <td width="11.55%">Envío:</td>
                    <td width="9.20%"><?= number_format($send, 2) ?></td>
                </tr>
                <tr>
                    <td width="79.25%"></td>
                    <td width="11.55%">Total:</td>
                    <td width="9.20%"><?= number_format($total, 2) ?></td>
                </tr>
                <tr>
                    <td>
                        <a href="<?= ROOT?>shop" class="btn btn-info" role="button">
                            Seguir comprando
                        </a>
                    </td>
                    <td
                            input type="submit" class="btn btn-success" role="button" value="Recalcular">
                    </td>
                    <?php if($verify): ?>
                        <td>
                            <a href="<?= ROOT ?>cart/thanks" class="btn btn-success" role="button">
                                Pagar
                            </a>
                        </td>
                    <?php else: ?>
                        <td>
                            <a href="<?= ROOT ?>cart/checkout" class="btn btn-success" role="button">
                                Pagar
                            </a>
                        </td>
                    <?php endif; ?>
                </tr>
    </table>
</form>
<?php include_once dirname(__DIR__) . ROOT . 'footer.php'?>
