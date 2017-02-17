<?php

App::uses('AppController', 'Controller');

class ReservationsListController extends AppController{
    
    public $uses = array('User', 'Teacher', 'LessonSchedule','UsersFavorite');
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->autoRender = false;
        if(!$this->Auth->user('id')){
            $referrerUser=Router::fullbaseUrl().$_SERVER['REQUEST_URI'];
            $this->Session->write('referrer-user',$referrerUser);
            return $this->redirect('/login');
        }
        $this->notFound = __('Invalid Request.');
    }
    
    public function index() {
        
        $response = array();
        $data = json_decode($this->request->input(), true);
        
        if(!empty($data)){
            
            foreach($data as $key => $value){
                $this->request->data[$key] = $value;
            }
            
            if(isset($this->request->data['users_api_token'])){
                $userToken = $this->request->data['users_api_token'];
                $checkApiToken = $this->User->find('first', array(
                    'conditions' => array(
                        'User.api_token' => $userToken
                        ),
                    'fields' => 'User.id'));
                if($checkApiToken){
                    $userOwnId = $checkApiToken['User']['id'];
                    $reservation = $this->LessonSchedule->find('all',
                           array(
                                'joins' => array(
                                    array(
                                        'table' => 'users',
                                        'alias' => 'UserJoin',
                                        'conditions' => array(
                                            'UserJoin.id = LessonSchedule.user_id'
                                            )
                                        ),
                                    array(
                                        'table' => 'teachers',
                                        'alias' => 'TeacherJoin',
                                        'conditions' => array(
                                            'TeacherJoin.id = LessonSchedule.teacher_id'
                                            )
                                        )
                                 ),
                                 'conditions' => array(
                                                         'LessonSchedule.status !=' => '0',
                                                         'LessonSchedule.user_id' => $userOwnId,
                                                         'LessonSchedule.lesson_time !=' =>  ''
                                                     ),
                                 'fields' => array('UserJoin.*','LessonSchedule.*','TeacherJoin.*'),
                                 'oreder' => ('LessonSchedule.lesson_time asc, LessonShedule.id desc')
                        )
                    );

                    if($reservation){
                        $response['reservations'] = array();
                        foreach($reservation as $key=>$row){
                            $content = array(
                                'teacher' => array(
                                    'teachers_id' => $row['TeacherJoin']['id'],
                                    'teacher_name' => $row['TeacherJoin']['name'],
                                    'teacher_favorite' => $this->checkFavorite($row['TeacherJoin']['id'],$row['UserJoin']['id']),
                                    'main_image'    =>  'https://nativecamp.net'.$row['TeacherJoin']['image']
                                ),
                                'begin_at' => $row['LessonSchedule']['lesson_time']

                            );
                            array_push($response['reservations'], $content);
                        }
                    }else{
                        $response = 'none';
                    }
                }else{
                    $response['error'] = 'Invalid token.';
                }
            }else{
                $response['error'] = $this->notFound;
            }
             
        }else{
            $response['error'] = $this->notFound;
        }
        echo json_encode($response);       
    }
    
    
    
    public function checkFavorite($teacherId, $userId){
        
        $checkFavorite = $this->UsersFavorite->find('first', array(
            'conditions' => array(
                'UsersFavorite.teacher_id' => $teacherId,
                'UsersFavorite.user_id' => $userId
            )
        ));
        if($checkFavorite){
            return true;
        }else{
            return false;
        }
    }
    
  
            
    
}