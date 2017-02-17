<?php
App::uses('AppController', 'Controller');
App::uses('Calendar', 'Lib');
App::uses('AttendanceStatus', 'Lib');

class AttendancesController extends AppController {
	public $helpers = array('Html', 'Form');


	public function index($layout) {
		$this->layout = $layout;
		//if ($date == 0) {
		$date = date('Y-m-d');	
		//}
		$autoOvertime = $this->getAutoOvertime() ? 'fa-toggle-on' : 'fa-toggle-off';

		$this->set('title', 'FDC : ATTENDANCE');
		$this->set('attendanceStat', $this->getAttendanceStatus());
		$this->set('autoOvertime', $autoOvertime);
		$this->set('shifts', $this->getShifts());

		$this->getCalendar();
		
		//pr($this->getShifts());
		//exit();
	}

	public function getCalendar() {
		$date = "";
		$calendar = new Calendar();
		

		if ($this->request->is('Ajax') ) {
			$this->layout = 'ajax';
			$data = $this->request->data;
			if (!empty($data)) {
				$date = $data['date'];
				//$focus = date('Y-m-d', strtotime($data['focus']));
			}
		}

		$calendar->ini($date);
		//$focus = empty($focus) ? $calendar->currentDate : $focus;
		$focus = $calendar->currentDate;
		$this->set('month', $calendar->month);
		$this->set('days', $calendar->days);
		$this->set('today', $calendar->today);
		$this->set('week', $calendar->week);
		$this->set('d', $calendar->d);
		$this->set('firstDay', $calendar->firstDay);
		$this->set('totalDays', $calendar->totalDays);
		$this->set('currentDate', $calendar->currentDate);
		$this->set('focus', $focus);
		if ($this->request->is('Ajax')) { 
			$this->render('view_calendar');
			return;
		}
		
	}
	
	private function getShifts() {
		$this->loadModel('Employeeshift');
		$eshifts = $this->Employeeshift->find('all', array(
				'fields' => array('id', 'description'),
				'conditions' => array('status' => 1)
			)
		);
		return $eshifts;
	}
	
	public function getEmployee() {
		$this->loadModel('Employee');
		$this->autoRender = false;
		
		$join =  array(
			array(
				'table' => 'employee_shifts',
				'conditions' => array(
						'Employee.employee_shifts_id = employee_shifts.id'
				)
			)

		);

		$employees = $this->Employee->find('all',
			array(
				'conditions' => array('Employee.status = 2'),
				'joins'	=> $join,
				'fields' => array(
					'id',
					'employee_shifts.f_time_in',
					'employee_shifts.f_time_out',
					'employee_shifts.break'//,
					//'employee_shifts.l_time_in',
					//'employee_shifts.l_time_out'
				)
			)
		);
			
		return $employees;
	}
	
	public function attendanceList() {
		if($this->request->is('ajax')) {
			$this->autoRender = false;
			
			$data = $this->request->data;
			
			$employees = $this->getEmployeeAttendance($data);
			if (!is_array($employees)) {
				echo json_encode(array('error' => "Attendance is not available for this day"));
				return;
			}
			$employees_arr = array();
			$statusArr = $this->getAttendanceStatus();
			foreach($employees as $key => $employee) {
				$ftimein 	= $employee['attendances']['f_time_in'];
				$ftimeout 	= $employee['attendances']['f_time_out'];
				//$ltimein 	= $employee['attendances']['l_time_in'];
				//$ltimeout 	= $employee['attendances']['l_time_out'];
			
				$firstLog 	= $this->Attendance->totalDifference($ftimein, $ftimeout);
				//$lastLog 	= $this->Attendance->totalDifference($ltimein, $ltimeout);
				//$totalTime 	= $this->Attendance->sumTime($firstLog['time'], $lastLog['time']);
				
				
				$getStat 	= $employee['attendances']['status'] ? $employee['attendances']['status'] : 0;
				$status 	= $statusArr[$getStat];
				
				$data = array(
						'employee_id' 	=> 	$employee['Employee']['employee_id'],
						'name' 			=> 	$employee['profiles']['first_name']. " " . $employee['profiles']['middle_name'] . " " .$employee['profiles']['last_name'],
						'f_time_in' 	=>	$ftimein,
						'f_time_out' 	=>	$ftimeout,
						'break'			=>  $employee['attendances']['break'],
						//'l_time_in' 	=>	$ltimein,
						//'l_time_out' 	=>	$ltimeout,
						//'el_time_in'	=>	!$this->Attendance->verifyTimeFormat($employee['employee_shifts']['l_time_in']),
						//'el_time_out'	=>	!$this->Attendance->verifyTimeFormat($employee['employee_shifts']['l_time_out']),
						'shift_id'			=>	$employee['Employee']['employee_shifts_id'],
						'shift'			=>	$employee['employee_shifts']['description'],
						'total_time'	=>  $employee['attendances']['render_time'],
						'over_time'		=>  $employee['attendances']['over_time'],
						'status'		=>	$status,
						'date'			=>  $employee['attendances']['date'],
						'day'			=>	date('j', strtotime($employee['attendances']['date'])),
						'id'			=>	$employee['attendances']['id'],
						'ef_time_in'	=>	!$this->Attendance->verifyTimeFormat($employee['employee_shifts']['f_time_in']),
						'ef_time_out'	=>	!$this->Attendance->verifyTimeFormat($employee['employee_shifts']['f_time_out']),
						'e_ot_start'	=> 	$employee['employee_shifts']['overtime_start'],
						'estatus'		=> 	$employee['Employee']['status'],
						'ebreak'		=>	$employee['employee_shifts']['break']
				);
				array_push($employees_arr, $data);
			}
			echo json_encode($employees_arr);
		}
	}
	
	public function updateAttendance() {
		if ($this->request->is('ajax')) {
			$this->autoRender = false;

			$data = $this->request->data;

			$fieldData = json_decode($data['field']);
			$idData = json_decode($data['id']);
			$val 	= $data['value'] == '' ? NULL : $data['value'];

			$updateData = array();
			$condition = array();
			
			foreach ($fieldData as $key => $field) {
				if ($field != 'status') {
					$updateData[$field] = empty($val) ? $val : "'". date('Y-m-d H:i:s', strtotime($val)) ."'";
				} else {
					$updateData[$field] = $val;
				}
			}

			foreach ($idData as $key => $id) {
				$condition[] = $id;
			}
			if ($this->Attendance->updateAll($updateData, array('Attendance.id' => $condition))) {
				echo 'success';
			} else {
				echo json_encode($this->Attendance->validationErrors);
			}
			
		}
	}
	
	public function resetAttendance() {
		if ($this->request->is('ajax')) {
			$this->autoRender = false;
			$data = $this->request->data;
			$eAttendance = json_decode($data['ids']); //$this->getEmployeeAttendance($data);
			$updateData = array();
			if (!empty($eAttendance)) {
					foreach($eAttendance as $ea) {
					array_push($updateData, array('Attendance.id' => $ea));
				}
				$resetData = array(
						//'Attendance.l_time_in' 	=> NULL,
						//'Attendance.l_time_out'	=> NULL,
						'Attendance.f_time_in'	=> NULL,
						'Attendance.f_time_out'	=> NULL,
						'Attendance.over_time'	=> NULL,
						'Attendance.render_time' => NULL,
						'Attendance.status'		=> 0	
				);
				$this->Attendance->updateAll($resetData, array('OR'=>$updateData));
				echo "success";
			} else {
				echo "wala";
			}
			
			
		}
	}
	
	public function getTotalTime() {
		if ($this->request->is('ajax')) {
			$this->autoRender = false;
			$data = $this->request->data;
			if (
				empty($data['f_time_in']) || empty($data['f_time_out'])
			) {
				$empData = NULL;
				$totalTime = NULL;
				$stat = 0;
				$overtime = NULL;
				$result = array('render_time' => $totalTime, 'status' => $stat, 'over_time' => $overtime);
			} else {
				$empData = $this->Attendance->getEmployeeDetail($data['id']);
				$totalTime = $this->Attendance->calcRenderTime($data, $empData);
				$stat = $this->Attendance->checkStat($data, $empData);
				$overtime = '';
				$result = array('render_time' => $totalTime, 'status' => $stat);
				if ($this->getAutoOvertime()) {
					$overtime = $this->calcOvertime($data['id'], $empData);
					$result['over_time'] = $overtime;
				}
			}
			
			
			
			if ($this->Attendance->updateTotalTime($data['id'], $result)) {
				echo json_encode($result);
			}
		}
	}
	
	
	public function getOverTime() {
		if ($this->request->is('ajax')) {
			$this->autoRender = false;
			$data = $this->request->data;
			$empData = $this->Attendance->getEmployeeDetail($data['id']);
			echo $this->calcOvertime($data['id'], $empData, true);
		}
	}

	private function calcOvertime($id, $data, $saves = false) {
		$overtime = $this->Attendance->getOT($id, $data);
		if ($saves) { //used for getting overtime only
			$this->Attendance->saveTime($id, array('over_time', $overtime));
		}
		return $overtime;
	}
	
	public function resetOvertime() {
		if ($this->request->is('ajax')) {
			$this->autoRender = false;
			$data = $this->request->data;
			$this->Attendance->saveTime($data['id'], array('over_time', '00:00:00'));
			echo 'success';
		}
	}
	

	public function setAutoOvertime() {
		if ($this->request->is('ajax')) {
			$this->autoRender = false;
			$data = $this->request->data;
			if ($data['auto'] == 1) {
				$this->Cookie->write('autoOvertime', '1', false, '1 hour');
				echo 'fa-toggle-on';
			} else {
				$this->Cookie->delete('autoOvertime');
				echo 'fa-toggle-off';
			}

		} 
	}

	public function attendanceHistory($layout) {
		$this->layout = $layout;
		$id = $this->Session->read('Auth.UserProfile.employee_id');//$this->params['id'];
		$getMonthly = true;
		if (empty($id)) {
			$this->redirect('/');
			return;
		}

		$history = $this->Attendance->getAttendanceHistory($id, $getMonthly); //Get monthly History
		$this->set('history', $history);
		$this->set('empId', $id);
	}

	public function getAttendanceDetail() {
		if ($this->request->is('Ajax')) {
			$this->layout = 'ajax';
			$id = $this->request->data['id'];
			$date = $this->request->data['date'];
			$history = $this->Attendance->getAttendanceHistory($id, false, $date);
			$status = new AttendanceStatus();
			$status->ini();
			$this->set('history', $history);
			$this->set('status', $status->status);
			$this->render('history_detail');
			return;
		}
	}


	/* Private Functions */
	private function getAutoOvertime() {
		$autoOvertime = $this->Cookie->read('autoOvertime');
		return empty($autoOvertime) ? false : true;// 'fa-toggle-off' : 'fa-toggle-on';
	}

	private function getEmployeeAttendance($data) {
		//Check date
		$currentDate = date("Y-m-d");
		$conditions = array();
		$searchByMonth = false;
		if (!empty($data)) {
			if (!empty($data['date'])) {
				$currentDate = date('Y-m-d', strtotime($data['date']));
			}

			if (!empty($data['monthly'])) {
				$currentDate = date('Y-m-d', strtotime($data['monthly']));
				$conditions['MONTH(attendances.date) ='] = date('n', strtotime($currentDate));
				$conditions['YEAR(attendances.date) ='] = date('Y', strtotime($currentDate));
				$searchByMonth = true;
			}

			if (!empty($data['keyword'])) {
				$conditions['OR'] = array(
						array("concat_ws(' ', profiles.first_name, profiles.middle_name, profiles.last_name) like" => "%{$data['keyword']}%"),
						array("Employee.employee_id like" => "%{$data['keyword']}%")
				);
					
				//$conditions["like"] = "%{$data['keyword']}%";
			}
			if (isset($data['status']) && $data['status'] >= 0) {
				$conditions['attendances.status ='] = $data['status'];
			}

			if (!empty($data['shifts']) && $data['shifts'] >= 0) {
				$conditions['Employee.employee_shifts_id ='] = $data['shifts'];
			}

			
	
		}
		$emp = $this->getEmployee();
		
		if (!$searchByMonth) {
			$conditions['attendances.date ='] = $currentDate;
			$create = $this->Attendance->createAttendance($currentDate, $emp);
			if ($create == 'FAIL') {
				//$this->Session->setFlash(__('No attendance for this date'));
				return 1;
			}
		}
		$conditions['Employee.status <>'] = 0;
			
		$this->loadModel('Employee');
		
		$join = array(
				array(
						'table' => 'attendances',
						'type' => 'left',
						'conditions' => array(
								'Employee.id = attendances.employees_id'
						)
				), array(
						'table' => 'profiles',
						'conditions' => array(
								'Employee.profile_id = profiles.id'
						)
				), array(
						'table' => 'employee_shifts',
						'conditions' => array(
								'Employee.employee_shifts_id = employee_shifts.id'
						)
				)

		);
		
		$selectFields = array(
				'Employee.employee_id',
				'Employee.status',
				'Employee.employee_shifts_id',
				'employee_shifts.description',
				'profiles.first_name',
				'profiles.last_name',
				'profiles.middle_name',
				'attendances.f_time_in',
				'attendances.f_time_out',
				'attendances.break',
				//'attendances.l_time_in',
				//'attendances.l_time_out',
				'attendances.status',
				'attendances.date',
				'attendances.id',
				'attendances.over_time',
				'attendances.render_time',
				'employee_shifts.f_time_in',
				'employee_shifts.f_time_out',
				//'employee_shifts.l_time_in',
				//'employee_shifts.l_time_out',
				'employee_shifts.overtime_start',
				'employee_shifts.break'
		);
		$employees = $this->Employee->find('all',
				array(
						'joins' => $join,
						'fields' => $selectFields,
						'conditions' => $conditions,
						'order' => array('Employee.id' => 'ASC', 'attendances.date' => 'ASC')
				)
		);
		
		return $employees;
		
	}
	
	private function totalDifference($timeA, $timeB) {
		$totalTime = 0;
		if (!empty($timeA) && !empty($timeB)) {
			$to_time 	= new DateTime($timeA);
			$from_time 	= new DateTime($timeB);
			$diff 		= $from_time->diff($to_time);
			$hours 		= str_pad($diff->format('%h'), 2, "0", STR_PAD_LEFT);
			$mins 		= str_pad($diff->format('%i'), 2, "0", STR_PAD_LEFT);
			$sec 		= str_pad($diff->format('%s'), 2, "0", STR_PAD_LEFT);
			$totalTime 	= array(
					"time" 	=> "$hours:$mins:$sec",
					"h" 	=> $hours, 
					"m" 	=> $mins, 
					"s" => $sec
			);
		}
		return $totalTime;
	}
	
	private function getAttendanceStatus() {
		return $statusArr = array('pending', 'present', 'absent', 'late', 'undertime');
	}


}
?>