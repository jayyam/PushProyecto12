<?php

class AdminProductController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = $this->model('AdminProduct');
    }

    public function index()
    {
        $session = new Session();

        if ($session->getLogin()) {

            $products = $this->model->getProducts();
            $type = $this->model->getConfig('productType');

            $data = [
                'titulo' => 'Administración de Productos',
                'menu' => false,
                'admin' => true,
                'type' => $type,
                'products' => $products,
            ];

            $this->view('admin/products/index', $data);

        } else {
            header('location:' . ROOT . 'admin');
        }
    }

    public function create()
    {
        $errors = [];
        $dataForm = [];
        $type = $this->model->getConfig('productType');
        $status = $this->model->getConfig('productStatus');
        $catalogue = $this->model->getCatalogue();

        if ($_SERVER['REQUEST_METHOD']=='POST')
        {
            //Recibimos informacion del form
            $typeconfig = $_POST['typeConfig'] ?? '';
            $name = addslashes(htmlentities($_POST['name'] ?? ''));
            $description = addslashes(htmlentities($_POST['description'] ?? ''));
            $price = Validate::number($_POST['price'] ?? '');
            $discount = Validate::number($_POST['discount'] ?? '');
            $send = Validate::number($_POST['send'] ?? '');
            $image =$_POST['image'] ?? '';
            $published =$_POST['published'] ?? '';
            $relation1 =$_POST['relation1'] ?? '';
            $relation2 =$_POST['relation2'] ?? '';
            $relation3 =$_POST['relation3'] ?? '';
            $mostSold =$_POST['mostSold'] ?? '';
            $new =$_POST['new'] ?? '';
            $statusConfig =$_POST['statusConfig'] ?? '';
            //books
            $author = addslashes(htmlentities($_POST['author'] ?? ''));
            $publisher = addslashes(htmlentities($_POST['publisher'] ?? ''));
            $pages = Validate::number($_POST['type'] ?? '');
            //courses
            $people = addslashes(htmlentities($_POST['type'] ?? ''));
            $objetives = addslashes(htmlentities($_POST['type'] ?? ''));
            $necesites =addslashes(htmlentities($_POST['type'] ?? ''));

            // VALIDANDO LA INFORMACION -- FUNCIONES A USAR

            //validaciones de cadenas de caracteres
            //escapeshellcmd() --> Bypass(Escapa)cadenas de caracteres especiales que vienen de consola de comandos
            //addslashes() --> Bypass(escapa) las comllias que pueda llevar DENTRO las cadenas de caracteres
            //htmlentities() --> transforma los caracteres especiales de html a entidades, traduciendolas a su correspondiente simbolo

            //validaciones habituales
            //if(empty($variable)){array_push($errors, 'mensaje de error');} //si no existe variable

            if (empty($name)) {
                array_push($errors, 'El nombre del producto es requerido');
            }
            if (empty($description)) {
                array_push($errors, 'La descripción del producto es requerida');
            }
            if ( ! is_numeric($price)) {
                array_push($errors, 'El precio del producto debe de ser un número');
            }
            if ( ! is_numeric($discount)) {
                array_push($errors, 'El descuento del producto debe de ser un número');
            }
            if (! is_numeric($send)) {
                array_push($errors, 'Los gastos de envío del producto deben de ser numéricos');
            }
            if (is_numeric($price) && is_numeric($discount) && $price < $discount)
            {
                array_push($errors, 'El descuento no puede ser mayor que el precio');
            }
            if (! Validate::date($published))
            {
                array_push($errors, 'La fecha o su formato no es correcto');
            }
            elseif (Validate::dateDif($publisher))
            {
                array_push($errors, 'La fecha de publicacion no puede ser anterior asu creacion');
            }
            if ($type == 1) {
                if (empty($people)) {
                    array_push($errors, 'El público objetivo del curso es obligatorio');
                }
                if (empty($objetives)) {
                    array_push($errors, 'Los objetivos del curso son necesarios');
                }
                if (empty($necesites)) {
                    array_push($errors, 'Los requisitos del curso son necesarios');
                }
            }
            elseif ($type == 2)
            {
                if (empty($author)) {
                    array_push($errors, 'El autor del libro es necesario');
                }
                if (empty($publisher)) {
                    array_push($errors, 'La editorial del libro es necesaria');
                }
                if ( ! is_numeric($pages)) {
                    $pages = 0;
                    array_push($errors, 'La cantidad de páginas de un libro debe de ser un número');
                }
            }
            else
            {
                array_push($errors, 'Debes seleccionar un tipo válido');
            }

            $image = strtolower($image);

            if (is_uploaded_file($_FILES['image']['tmp_name']))
            {
                move_uploaded_file($_FILES['image']['tmp_name'],'img/'.$image);
                Validate::resizeImage($image, newWidth: 240);
            }
            else
            {
                array_push($errors, 'Error al subir el archivo de imagen');
            }

            //CREANDO ARRAY DE DATOS

            $dataForm = [
                'type'  => $type,
                'name'  => $name,
                'description' => $description,
                'author'    => $author,
                'publisher' => $publisher,
                'people'    => $people,
                'objetives' => $objetives,
                'necesites' => $necesites,
                'price' => $price,
                'discount' => $discount,
                'send' => $send,
                'pages' => $pages,
                'published' => $published,
                'image' => $image,
                'mostSold' => $mostSold,
                'new' => $new,
                'relation1' => $relation1,
                'relation2' => $relation2,
                'relation3' => $relation3,
                'status' => $status,

            ];

            var_dump($dataForm);
        }
        if (!$errors)
        {
            //enviamos la informacion al modelo
        }

        $data = [
            'titulo' => 'Administración de Productos - Alta',
            'menu' => false,
            'admin' => true,
            'type' => $type,
            'errors' => $errors,
            'data' => $dataForm,
        ];

        $this->view('admin/products/create', $data);
    }

    public function update($id)
    {

    }

    public function delete($id)
    {

    }
}
