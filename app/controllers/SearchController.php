<?php

class SearchController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = $this->model('Search');
    }

    public function products()//Productos enviados por GET siempre transformarlos a minusculas a la hora de hacer inserciones a la base de datos
    {
        $search = $_POST['search'] ?? '';

        if (!$search != '')
        {
            $dataSearch = $this->model->getProducts($search);

            $data = [
               'titulo' => 'Buscador de productos',
               'subtitle' => 'Resultado de la buscqueda',
                'data' =>$dataSearch,
                'menu' => true,
            ];
            $this->view('search/search', $data);
        }
        else
        {
            header('location:'.ROOT);
        }
    }
}