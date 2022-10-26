<?php

class CartController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = $this->model('Cart');
    }

    public function index($errors = [])
    {
        $session = new Session();

        if ($session->getLogin())
        {
            $user_id = $session->getUserId();
            $cart = $this->model->getCart($user_id);

            $data= [
                'titulo' =>'Carrito',
                'menu' => true,
                'user_id' => $user_id,
                'data' => $cart,
                'errors' => $errors,
            ];
            $this->view('carts/index', $data);

        } else {
            header('location:' . ROOT);
        }
    }

    public function addProduct($product_id, $user_id)
    {
        //var_dump($product_id, $user_id);

        $errors = [];

        if ($this->model->verifyProduct($product_id, $user_id) == false)
        {
            if ($this->model->addProduct($product_id, $user_id) == false)
            {
                array_push($errors,'Error al insertar al carrito');
            }
        }
        $this->index($errors);
    }
    public function update()
    {
        if (isset($_POST['rows']) && isset($_POST['user_id']))
        {
            //var_dump($_POST); var_dump(exit());

            $errors = [];
            $rows = $_POST['rows'];
            $user_id = $_POST['user_id'];

            for ($i =0; $i<$rows; $i++)
            {
                $product_id = $_POST['i'.$i];
                $quantity = $_POST['c'.$i];
                if (! $this->model->update($user_id, $product_id, $quantity))//si ha ido mal la negacion del principio hace
                {
                    array_push($errors, 'Error al actualizar el producto');
                }
            }
            $this->index($errors);
        }
    }
    public function delete($product, $user)
    {
        $errors =[];

        if (! $this->model->delete($product, $user))
        {
            array_push($errors,'error de delete');
        }
    }
    public function checkout()
    {
        $session = new Session();

        if (! $session->getLogin())
        {
            $user = $session->getUser();

            $data = [
                'titulo' => 'Carrito | Datos de envio',
                'subtitle' => 'Checkout | Verificar diceccion de envio',
                'menu' => true,
                'data' => $user,
            ];
            $this->view('carts/address', $data);
        }
        else
        {
            $data = [
                'titulo' => 'Carrito | checkout',
                'subtitle' => 'Checkout | iniciar sesion',
                'menu' => true
            ];

            $this->view('carts/checkout', $data);
        }
    }
    public function paymentmode()//solo se llega aqui por $_post por lo tanto hay que validar los datos del formulario checkout.
    {
        $data = [
            'titulo' => 'Carrito | Forma de pago',
            'subtitle' => 'Checkout | forma de pago',
            'menu' => true,
        ];

        $this->view('cars/paymentmode', $data);
    }
    public function verify()
    {
        //var_dump($_POST);
        $session = new Session();

        $user = $session->getUser();
        $cart =$this->model->getCart($user->id);
        $payment =$_POST['payment'] ?? '';

        $data =[
            'titulo' => 'CArrito | Vrificar los datos',
            'menu' => true,
            'payment' => $payment,
            'user' => $user,
            'data' => $cart,
        ];
        $this->view('carts/verify', $data);
    }
    public function thanks()
    {
        $session = new Session();
        $user = $session->getUser();

        if ($this->model->closeCart($user->id, 1))//estado del carrito a 1. no es necesario ya que no hay stock
        {
            $data = [
                'titulo' => 'CArrito | Agradecimientos',
                'data' => $user,
                'menu' => true,

            ];
            $this->view('carts/thanks', $data);
        }
        else
        {
            $data = [
                'titulo' => 'Error actualizando carrito',
                'menu' => false,
                'subtitle' => 'error al actualizar los productos de carrito',
                'text' => 'error al actualizar el carrito. priebe mas tarde o comuniquese con nuestro soporte',
                'color' => 'alert-danger',
                'url'=> 'login',
                'colorButton' => 'alert-danger',
                'textButton' => 'Regresar',
                'data' => $user,


            ];
            $this->view('carts/thanks', $data);
        }


    }
}
