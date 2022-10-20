<?php

class ShopController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = $this->model('Shop');//cada control lleva asociado un modelo
    }
    public function index()
    {
        $session = new Session();

        if ($session->getLogin())
        {

            $data = [
                'titulo' => 'Bienvenid@ a nuestra tienda',
                'menu' => true,
                'subtitle' => 'Articulos mas vendidos'
                ''=>'',
                ''=>'',
                ''=>'',

            ];
            $this->view('shop/index', $data);
        }
        else
        {
            header('location:' . ROOT);
        }
    }
    public function show($id)
    {
        var_dump($id);

        $product =$this->model->getProductById($id);

        $data = [
            'titulo' => 'Detalle de product',
            'menu' => true,
            'subtitle' => $product->name,
            'errors' => [],
            'data' => $product,
        ];

    }

    public function getProductById($id)
    {
        $sql = 'SELECT * FROM products WHERE id=:$id';
        $query = $this->db->prepare($sql);
        $query->execute([':id' => $id]);

        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function whoami()
    {

    }
    public function contact()
    {

    }

}
