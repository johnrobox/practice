<?php
App::uses('AppController', 'Controller');
class LessonReservationController extends AppController {
	public $uses = array('User','Teacher', 'LessonSchedule');

	public function beforeFilter() {
		parent::beforeFilter();
		if(!$this->Auth->user('id')){
			$referrerUser=Router::fullbaseUrl().$_SERVER['REQUEST_URI'];
			$this->Session->write('referrer-user',$referrerUser);
			return $this->redirect('/login');
		}
	}

	// 予約一覧
  // month in format 'Ym'
	public function index($month = null) {
    $lessonRerservationMonthList = $this->getLessonReservationMonthList();   
    if (!$month) {
			// if month is not selected, select the latest
			foreach ($lessonRerservationMonthList as $key => $value) {
				$month = $key;
				break;
			}
		}	
    
    $conditionArray = array(
      'LessonSchedule.status !='  => '0', 
      'LessonSchedule.user_id' => $this->Auth->user('id'),
      'LessonSchedule.lesson_time !=' => '',
      array('or' => array('LessonSchedule.lesson_time >=' => date('Y-m-d H:i:s', strtotime('-25 minute')),
            array('LessonSchedule.status' => 3, 'LessonSchedule.apology_show' => 1)
      ))
    );
    
    if ($month) {
			$conditionArray['DATE_FORMAT(LessonSchedule.created, "%Y%m")'] = $month;
		}
    
		$this->paginate = array(
				'LessonSchedule' => array(  
					'conditions'=> $conditionArray,
					'order' => ('LessonSchedule.lesson_time asc, LessonSchedule.id desc'),
					'limit' => 5
				));
        
    $this->set('selectMonth', $month);
		$bookedLessons = $this->paginate('LessonSchedule');
		$this->set('bookedLessons', $bookedLessons);
    
    if ($this->request->is('ajax')) {
			$this->layout = "";
			$this->render('lesson_reservation');
		} else {
			$this->set('lessonMonths', $lessonRerservationMonthList);
			$this->set('selectMonth', $month);
		}
    
	}
  
  
  // get months of all lesson reservation time( 'Ym' => 'Y年m月')
	private function getLessonReservationMonthList() {
		$retMonths = array();

		$userId = $this->Auth->user('id');
		$conditions = array(
			'LessonSchedule.user_id' => $userId,
			'LessonSchedule.created !=' => "",
		);
    
		$listOfLessonReservationDate = $this->LessonSchedule->find('list', array(
								'fields' => array(
									"LessonSchedule.created"),
								'conditions' => $conditions,
								'order' => array(
									'LessonSchedule.id DESC')));

		if (is_array($listOfLessonReservationDate)) {
			foreach ($listOfLessonReservationDate as $date) {
				$dateYM = date("Ym", strtotime($date));
				if ($dateYM && !in_array($dateYM, $retMonths)) {
					$retMonths[$dateYM] = date("Y年m月", strtotime($date));
				}
			}
		}
		return $retMonths;
	}
  
  
}
?>
