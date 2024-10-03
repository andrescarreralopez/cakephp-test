<?php
    class CursosController extends AppController {
        public $uses = array(
            'Curso',
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
        public $components = array('Session');

        public function index() {
            $user = $this->Auth->User();
            if($user['perfil'] != 1){
                $cursos = $this->Curso->find('all',array(
                    'fields' => ['Curso.*'],
                    'conditions' => [
                        'CursoUser.id_user' => $user['id']
                    ],
                    'joins' => [
                        ['table' => 'curso_users',
                        'alias' => 'CursoUser',
                        'conditions' => ['Curso.id = CursoUser.id_curso']]
                    ]
                ));
                
            } else {
                $cursos = $this->Curso->find('all');
            }
            $this->set('cursos', $cursos);
            $this->set('user', $user);
        }

        public function agregarCurso() {
            if($this->request->is('post')) {
                $this->Curso->create();
                if($this->Curso->save($this->request->data)) {
                    $this->Session->setFlash('El curso ha sido ingresado exitosamente', 'default', array('class' => 'alert alert-success'));
                    return $this->redirect(array('action' => 'index'));
                }

                $this->Session->setFlash('No ha sido posible ingresar el curso', 'default', array('class' => 'alert alert-danger'));
            }
        }

        public function editarCurso($id = null) {
            if(!$id) {
                throw new NotFoundException('Datos Inválidos');
            }
            $curso = $this->Curso->findById($id);

            if (!$curso) {
                throw new NotFoundException('El curso no existe');
            }
            if($this->request->is(array('post', 'put'))) {
                $this->Curso->id = $id;
                if($this->Curso->save($this->request->data)) {
                    $this->Session->setFlash('El curso ha sido modificado exitosamente', 'default', array('class' => 'alert alert-success'));
                    return $this->redirect(array('action' => 'index'));
                }

                $this->Session->setFlash('No ha sido posible modificar el curso', 'default', array('class' => 'alert alert-danger'));
            }

            if(!$this->request->data){
                $this->request->data = $curso;
            }
        }

        public function eliminarCurso($id) {
            if($this->request->is('get')) {
                throw new MethodNotAllowedException('INCORRECTO');
            }
            $alumnos = $this->CursoUser->find('first',array(
                'recursive' => -1,
                'conditions' => [
                    'id_curso' => $id
                ]
            ));
            if(!empty($alumnos)){
                $this->Session->setFlash('No es posible eliminar el curso debido a que existen alumnos inscritos', 'default', array('class' => 'alert alert-info'));
            } else {
                $this->Curso->delete($id);
                $this->Session->setFlash('El curso ha sido eliminado', 'default', array('class' => 'alert alert-success'));
            }
            return $this->redirect(array('action' => 'index'));
                

            $this->Session->setFlash('No ha sido posible eliminar el curso', 'default', array('class' => 'alert alert-danger'));
        }

        public function listaAlumnos($id) {
            if(!$id) {
                throw new NotFoundException('Datos Inválidos');
            }
            $curso = $this->Curso->findById($id);

            $alumnos = $this->CursoUser->find('all',array(
                'recursive' => -1,
                'fields' => ['CursoUser.*', 'User.id', 'User.nombre', 'User.username', 'User.estado'],
                'conditions' => [
                    'id_curso' => $curso['Curso']['id']
                ],
                'joins' => [
                    ['table' => 'users',
                    'alias' => 'User',
                    'conditions' => ['CursoUser.id_user = User.id']]
                ]
            ));
            
            $idsAlumnos = Hash::extract($alumnos, '{n}.User.id');

            $alumnosPendientes = $this->User->find('list',array(
                'recursive' => -1,
                'fields' => ['User.id', 'User.nombre'],
                'conditions' => [
                    'User.id !=' => $idsAlumnos,
                    'User.perfil' => '2',
                    'User.estado' => '1'
                ]
            ));

            $user = $this->Auth->User();
            $this->set(compact('curso', 'alumnos', 'alumnosPendientes','user'));
        }

        public function agregarAlumnoCurso() {
            if($this->request->is('post')) {
                $this->CursoUser->create();
                if($this->CursoUser->save($this->request->data)) {
                    $this->Session->setFlash('El alumno ha sido inscrito en el curso exitosamente', 'default', array('class' => 'alert alert-success'));
                    return $this->redirect(array('action' => 'listaAlumnos', $this->request->data['CursoUser']['id_curso']));
                }

                $this->Session->setFlash('No ha sido posible inscribir al alumno. Por favor intente nuevamente', 'default', array('class' => 'alert alert-danger'));
            }
        }

        public function removerAlumno($idCursoUser, $idCurso) {
            if($this->request->is('get')) {
                throw new MethodNotAllowedException('INCORRECTO');
            }
            $this->CursoUser->delete($idCursoUser);
            $this->Session->setFlash('El alumno ha sido removido del curso exitosamente', 'default', array('class' => 'alert alert-success'));
            return $this->redirect(array('action' => 'listaAlumnos', $idCurso));
                

            $this->Session->setFlash('No ha sido posible remover al alumno. Por favor intente nuevamente', 'default', array('class' => 'alert alert-danger'));
        }
    }
?>