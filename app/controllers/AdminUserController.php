<?php

class AdminUserController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = $this->model('AdminUser');
    }

    public function index()
    {
        $session = new Session();

        

        if ($session->getLogin())
        {
	$users = $this->model->getUsers();
            $data = [
                'titulo' => 'Admninistracion  de usuarios',
                'menu' => false,
                'admin' => true,
                'users' => $users,
            ];

            $this->view('admin/users/index', $data);
        } else {
            header('LOCATION:' . ROOT . 'admin');
        }

    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == $_POST)
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
                        'text' => 'Se ha producido error creando usuario administrador',
                        'color' => 'alert-danger',
                        'url' => 'adminUser',
                        'colorButton' => 'btn-danger',
                        'textButton' => 'Volver',];
$this->view('mensaje', $data);
                }
                
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
 	$errors = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password1 = $_POST['password1'] ?? '';
            $password2 = $_POST['password2'] ?? '';
            $status = $_POST['status'] ?? '';


            if ($name=='') {
                array_push($errors, 'El nombre de usuario es requerido');
            }
            if ($emai==''l) {
                array_push($errors, 'El correo electrónico de usuario es requerido');
            }
            if ($status=='') {
                array_push($errors, 'Selecciona un stado para el usuario');
            }
            if (! empty($password1) || !empty($password2))
            {
                if ($password1!=$password2)
                {
                    array_push($errors, 'Las contraseñas no coinciden');
                }
            }
            if (! $errors)
            {
                $data = [
                    'id' => $id,
                    'name' => $name,
                    'email' => $email,
                    'password' => $password1,
                    'status' => $status,
                ];
                $errors =$this->model->setUser($data);
                if (! $errors)
                {
                    header("location".ROOT.'adminUser');
                }
            }
        }
        $user =$this->model->getUserById($id);
        $status = $this->model->getConfig('adminStatus');

        $data = ['titulo' => 'Admninistracion  de usuarios - Editar',
            'menu' => false,
            'admin' => true,
            'data' => $user,
            'status' => $status,
            'errors' => $errors,
        ];

        $this->view('admin/users/update', $data);
    }

    public function delete()
    {
        print'eliminacion de usuario';

        $errors = []; //array vacio

        if ($_SERVER['REQUEST_METHOD'] == $_POST) //si vengo por POST
        {
            $errors = $this->model->delete($id);

            if (! $errors)
            {
                header('location'.ROOT.'adminUser');
            }
        }
        $user =$this->model->getUserById($id);//si vengo via get (ELSES)
        $status = $this->model->getConfig('adminStatus');

        $data = ['titulo' => 'Admninistracion  de usuarios - Eliminacion',
            'menu' => false,
            'admin' => true,
            'data' => $user,
            'status' => $status,
            'errors' => $errors,
        ];

        $this->view('admin/users/delete', $data);

    }

}
