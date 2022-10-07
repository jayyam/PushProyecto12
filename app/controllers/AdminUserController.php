<?php

class AdminUserController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = $this->model('Admin');
    }

    public function index()
    {
        $session = new Session();

        $users = $this->model->getUsers();

        if ($session->getLogin())
        {
            $data = [
                'titulo' => 'Admninistracion  de usuarios',
                'menu' => false,
                'admin' => true,
                'users' => $users,
                ];
        }
        else {
            header('LOCATION:' . ROOT . 'admin');
        }

        $this->view('admin/users/index', $data);
    }
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            print 'procesando datos';
            $errors = [];
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password1 = $_POST['password1'] ?? '';
            $password2 = $_POST['password2'] ?? '';

            $dataForm=[
                'name' => $name,
                'email' => $email,
                'password' => $password1,
            ];
            if (empty($name)) {
                array_push($errors, 'El nombre de usuario es requerido');
            }
            if (empty($email)) {
                array_push($errors, 'El correo electrónico de usuario es requerido');
            }
            if (empty($password1)) {
                array_push($errors, 'La clave de acceso es requerida');
            }
            if (empty($password2)) {
                array_push($errors, 'La verificación de clave es requerida');
            }
            if ($password1 != $password2) {
                array_push($errors, 'Las claves no coinciden');
            }
            if ( ! $errors)
            {
                if ($this->model->createAdminUser($dataForm))
                {
                    header("location:".ROOT.'adminUser');
                }
                else
                {
                    $data = [
                        'titulo' => 'Error en la creacion de usuario',
                        'menu' => false,
                        'errors' => [],
                        'subtitle' => 'Error al crear unsuario administrador',
                        'texto' => 'Se ha producido error creando usuario administrador',
                        'color' => 'alert-danger',
                        'url' => 'adminUser',
                        'colorButtom' => 'btn-danger',
                        'textButton' => 'Volver'];
                }
                $this->view('admin/index2', $data);
            }
            else
            {

                $data = [
                    'titulo' => 'Administración de Usuarios - Alta',
                    'menu' => false,
                    'admin' => true,
                    'errors' => $errors,
                    'data' => $dataForm,
                ];

                $this->view('admin/users/create', $data);

            }
        }
        else
        {
        $data = ['titulo' => 'Admninistracion  de usuarios - Alta',
            'menu' => false,
            'admin' => true,
            'data' => [],

        ];
        $this->view('admin/users/create', $data);
    }
        }


    public function update($id)
    {
        print'Modificacion de usuario' .$id;

        if ($_SERVER['REQUEST_METHOD'] == $_POST)
        {

        }
        else
        {
            $user =$this->model->getUserById($id);

            $data = ['titulo' => 'Admninistracion  de usuarios - Editar',
                'menu' => false,
                'admin' => true,
                'data' => $user,
            ];

            $this->view('admin/users/update', $data);
        }
    }

    public function delete()
    {
        print'eliminacion de usuario de usuario';
    }

}