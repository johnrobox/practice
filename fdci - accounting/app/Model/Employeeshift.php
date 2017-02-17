<?php
App::uses('AppModel', 'Model');

class Employeeshift extends AppModel {
	public $useTable = 'employee_shifts';
	
	public $validate = array(
			'f_time_in' => array(
				'rule' => 'time',//array('validateTime'),
				'message' => '<b>First Time in</b> has Invalid Time format.'
			), 'f_time_out' => array(
				'Rule-1' => array(
					'rule' => 'time',//array('validateTime'),
					'message' => '<b>First Time out</b> has Invalid Time format.'
				), 'Rule-2' => array(
					'rule' => array('checkTimeIn', 'f_time'),
					'message' => '<b>Time out</b> must not be the same with Time in.'
				)
				
			), 'l_time_in' => array(
				'rule' => 'time',//array('validateTime'),
				'message' => '<b>Last Time in</b> has Invalid Time format.'
			), 'l_time_out' => array(
				'Rule-1' => array(
					'rule' => 'time',//array('validateTime'),
					'message' => '<b>Last Time out</b> has Invalid Time format.'
				), 'Rule-2' => array(
					'rule' => array('checkTimeIn', 'l_time'),
					'message' => '<b>Last Time out</b> must not be the same with Last Time in.'
				)
				
			), 'description' => array(
				'Rule-1' => array(
					'rule' => 'notEmpty',
					'message'	=> '<b>Description</b> must not be empty.'
				), 'Rule-2'	=> array(
					'rule'	=> array('isDescriptionExist'),
					'message'	=> '<b>description</b> is already exist.'
				)
			), 'break' => array(
				'rule' => 'time',
				'message' => '<b>Break</b> has Invalid Time format.'
			)
			
	);
	
	public function updateStat($id, $stat) { //Updating Specific Shift
		$this->read(null, $id);
		$this->set('status', $stat);
		if ($this->save()) {
			return true;
		} else {
			return 'false';
		}
	}

	public function isDescriptionExist() {
		$condition = array(
			'description' => $this->data[$this->alias]['description'],
			'status' => 1
		);
		if (!empty($this->data[$this->alias]['id'])) {
			$condition['id <>'] = $this->data[$this->alias]['id'];
		}

 		$data = $this->find('first', array(
				'conditions' => $condition
			)
		);

		return empty($data) ? true : false;
	}

	public function checkTimeIn($check, $type) {
		if ($this->data[$this->alias][$type.'_in']) {
			$in = strtotime($this->data[$this->alias][$type.'_in']);
			$out = strtotime($this->data[$this->alias][$type.'_out']);
			return $in != $out;
		}
	}
}
?>