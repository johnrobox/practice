<?php
/***
 * View Reservation List of a user
 * Author : John Robert Jerodiaz
 */
App::uses('AppController', 'Controller');
App::uses('ApiCommonController', 'Controller');
class ReservationsListController extends AppController {
 	public $uses = array(
 		'User',
 		'Teacher',
 		'LessonSchedule',
 		'UsersFavorite'
 	);

  public function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow('index');
  }

  /***
   * View reservation list of a user
   * @return type array
  */
  public function index() {
    $this->autoRender = false;    
    $data = json_decode($this->request->input(), true);
    $apiCommon = new ApiCommonController();

    if (!$data) {
    	$response['error']['message'] = __('Invalid request');
    } else if (!isset($data['users_api_token']) || empty($data['users_api_token'])) {
    	$response['error']['message'] = __('users_api_token is required');
    } else if (!$apiCommon->validateToken($data['users_api_token'])) {
    	$response['error']['message'] = __('Invalid users_api_token');
    } else {
      $userOwnId = $apiCommon->findApiToken($data['users_api_token']);    
      $response = array();
      
      $conditionArray = array(
        'LessonSchedule.status ='  => 1, 
        'LessonSchedule.user_id' => $userOwnId['id'],
        'LessonSchedule.lesson_time !=' => '',
          array('or' => array(
          	'LessonSchedule.lesson_time >=' => date('Y-m-d H:i:s', strtotime('-25 minute')),
            array(
            	'LessonSchedule.status' => 3,
            	'LessonSchedule.apology_show' => 1
            )
          )
      	)
      );
      $sort = array(
          '(Select count(*) from users_lesson_notes where teacher_id = LessonSchedule.id) DESC'
      );
      $reservation = $this->LessonSchedule->find('all', array(
        'conditions'=> $conditionArray,
        'order' => $sort
          
     	 ));
      if ($reservation) {
        $response['reservations'] = array();
        foreach($reservation as $key=>$row) {
          if (!empty($row['Teacher']['image'])) {
            $teacherImage = FULL_BASE_URL .'/instructor/img/uploads/'.$row['Teacher']['image'];
          } else {
            $teacherImage = FULL_BASE_URL .'/instructor/img/no_profile_img.jpg';
          }
   	    $content = array(
                'teacher' => array(
                  'teachers_id' => intval($row['Teacher']['id']),
                  'teachers_name' => $row['Teacher']['name'].'('.$row['Teacher']['jp_name'].')',
                  'favorite' => $this->checkFavorite($row['Teacher']['id'],$row['User']['id']),
                  'main_image'    =>  $teacherImage
                ),
                'begin_at' => $row['LessonSchedule']['lesson_time']
              );
            array_push($response['reservations'], $content);
        }   
      } else {
        die();
      }
  	}
    echo json_encode($response);
  }
      
  
  
  public function checkFavorite($teacherId, $userId) {
    $checkFavorite = $this->UsersFavorite->find('first', array(
      'conditions' => array(
        'UsersFavorite.teacher_id' => $teacherId,
        'UsersFavorite.user_id' => $userId
      )
    ));
    if ($checkFavorite) {
      return true;
    } else {
      return false;
    }
  }
}