<?php
    class UsersController extends AppController {
        public $uses = array(
            'CursoUser',
            'User'
        );

        public function isAuthorized($user) {
            // Permitir acceso a acciones sin estar logueado
            if (in_array($this->action, array('login', 'logout'))) {
                return true;
            }
    
            // Permitir acceso a otros usuarios logueados
            return !empty($user);
        }

        public $helpers = array('Html', 'Form');
        public $components = array('Session','Flash','Auth');

        public function login() {
            $this->layout = false;
            if ($this->request->is('post')) {
                if ($this->Auth->login()) {
                    $userId = $this->Auth->user('id');
                    $user = $this->User->findById($userId);
                    if($user['User']['estado'] == 1)
                        return $this->redirect(array('controller' => 'cursos', 'action' => 'index'));
                    else
                        $this->Session->setFlash('El usuario se encuentra deshabilitado', 'default', array('class' => 'alert alert-info'));
                } else {
                    $this->Session->setFlash('Email o clave incorrectos', 'default', array('class' => 'alert alert-danger'));
                }
            }
        }
    
        public function logout() {
            return $this->redirect($this->Auth->logout());
        }

        public function index() {
            $this->set('usuarios', $this->User->find('all'));
        }

        public function agregarUser() {
            if ($this->request->is('post')) {
                $this->User->create();
                if ($this->User->save($this->request->data)) {
                    $this->Session->setFlash('Usuario creado exitosamente.', 'default', array('class' => 'alert alert-success'));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('No ha sido posible crear el usuario. Por favor intente nuevamente', 'default', array('class' => 'alert alert-danger'));
                }
            }
        }

        public function editarUser($id = null) {
            if($this->Auth->User('perfil') == 1){
                if(!$id) {
                    throw new NotFoundException('Datos Inválidos');
                }
                $usuario = $this->User->findById($id);

                if (!$usuario) {
                    throw new NotFoundException('El usuario no existe');
                }
                if($this->request->is(array('post', 'put'))) {
                    $inscrito = $this->CursoUser->find('first',array(
                        'recursive' => -1,
                        'conditions' => [
                            'id_user' => $id
                        ]
                    ));
                    
                    if(!empty($inscrito) && $this->request->data['User']['estado'] == 2){
                        $this->Session->setFlash('No es posible deshabilitar el usuario debido a que se encuentra inscrito en uno o más cursos. Por favor remueva al alumno de los cursos correspondientes y vuelva a intentarlo.', 'default', array('class' => 'alert alert-danger'));
                        return $this->redirect(array('action' => 'editarUser', $id));
                    } elseif(!empty($inscrito) && $this->request->data['User']['perfil'] == 1){
                        $this->Session->setFlash('No es posible establecer el perfil del usuario como administrador debido a que se encuentra inscrito en uno o más cursos. Los alumnos no tienen los permisos designados para ser administradores.', 'default', array('class' => 'alert alert-danger'));
                        return $this->redirect(array('action' => 'editarUser', $id));
                    } elseif($this->Auth->User('id') == $id && $this->request->data['User']['estado'] == 2) {
                        $this->Session->setFlash('No es posible deshabilitar el usuario que actualmente ha iniciado sesión', 'default', array('class' => 'alert alert-danger'));
                        return $this->redirect(array('action' => 'editarUser', $id));
                    } elseif($this->Auth->User('id') == $id && $this->request->data['User']['perfil'] == 2) {
                        $this->Session->setFlash('No es posible cambiar el perfil del usuario que actualmente ha iniciado sesión', 'default', array('class' => 'alert alert-danger'));
                        return $this->redirect(array('action' => 'editarUser', $id));
                    } else {
                        if(empty($this->request->data['User']['password']))
                            unset($this->request->data['User']['password']);
                        
                        $this->User->id = $id;
                        if($this->User->save($this->request->data)) {
                            $this->Session->setFlash('El usuario ha sido modificado exitosamente', 'default', array('class' => 'alert alert-success'));
                            return $this->redirect(array('action' => 'index'));
                        }
                    }

                    $this->Session->setFlash('No ha sido posible modificar el usuario', 'default', array('class' => 'alert alert-danger'));
                }

                if(!$this->request->data){
                    $this->request->data = $usuario;
                }
            }
        }

        public function eliminarUser($id) {
            if($this->request->is('get')) {
                throw new MethodNotAllowedException('INCORRECTO');
            }

            $inscrito = $this->CursoUser->find('first',array(
                'recursive' => -1,
                'conditions' => [
                    'id_user' => $id
                ]
            ));

            if(!empty($inscrito)){
                $this->Session->setFlash('No es posible eliminar el usuario debido a que se encuentra inscrito en uno o más cursos. Por favor remueva al alumno de los cursos correspondientes y vuelva a intentarlo.', 'default', array('class' => 'alert alert-danger'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->User->delete($id);
            $this->Session->setFlash('El usuario ha sido eliminado', 'default', array('class' => 'alert alert-success'));
            return $this->redirect(array('action' => 'index'));
                

            $this->Session->setFlash('No ha sido posible eliminar el usuario', 'default', array('class' => 'alert alert-danger'));
        }
    }
?>