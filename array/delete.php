<?php

echo 'Successfully deleted # '.$_POST['id'];

<?php

App::uses('Rate', 'Lib');
App::uses('HolidayManager', 'Lib');
class Late {
    
    public function __construct($attendance, $empData) {
        $this->attendance = $attendance;
        $this->hours  = 0;
        $this->minutes = 0;
        $this->empData = $empData;
        
    }
    
    public function getLateDeductionReport () {
        $nwrhHours = 0;
        $nwrhMinutes = 0;
        $nwshHours = 0;
        $nwshMinutes = 0;
        $wrhHours = 0;
        $wrhMinutes = 0;
        $wshHours = 0;
        $wshMinutes = 0;
        $dfHours = 0;
        $dfMinutes = 0;
        $rdHours = 0;
        $rdMinutes = 0;
        $lateReport = array();
        $rates =  array();
        $deduction = 0;
        $query = $this->attendance;
        $rate = new Rate($this->empData);
        $checkHoliday = new HolidayManager();
        
        foreach ( $query as $row){
            
            if ($row['Attendance']['render_time'] != null && $row['Attendance']['status'] == 3) {
                
                $date = $row['Attendance']['date'];
                
                $holiday = $checkHoliday->checkHoliday($date);
                $workingDay = $rate->isWorkingDay($date);
                
                $totalTime = new DateTime($row['Attendance']['total_time']);
                $break = new DateTime($row['Attendance']['break']);

                $firstDiff = $totalTime->diff($break);
                $mustRenderedTime= $firstDiff->h.':'.$firstDiff->i.':'.$firstDiff->s;

                $must = new DateTime($mustRenderedTime);
                $renderTime = new DateTime($row['Attendance']['render_time']);

                $secondDiff = $must->diff($renderTime);
                $this->hours = $this->hours + $secondDiff->h;
                $this->minutes = $this->minutes + $secondDiff->i;               
                
                if ($holiday && !$workingDay) {
                    
			if($holiday['type'] == 1) {
                                $nwrhHours   = $nwrhHours  + $secondDiff->h;
                                $nwrhMinutes  = $nwrhMinutes + $secondDiff->i;
                                $lateReport['report']['not working regular holiday']['late'][$date] = ($secondDiff->h * 60) + $secondDiff->i. ' mins.';
                                
                                $rates['NWRH'] = array ($rate->getRate($date));
                                
			} else {
                                $nwshHours  = $nwshHours + $secondDiff->h;
                                $nwshMinutes  = $nwshMinutes + $secondDiff->i;
                                $lateReport['report']['not working special holiday']['late'][$date] = ($secondDiff->h * 60) + $secondDiff->i. ' mins.';
                                $rates['NWSH'] = array ( $rate->getRate($date));        
			}
                        
		} else if ($holiday && $workingDay) {
                    
                        if ($holiday['type'] == 1) {
                            $wrhHours  = $wrhHours + $secondDiff->h;
                            $wrhMinutes  = $wrhMinutes + $secondDiff->i;
                            $lateReport['report']['working regular holiday']['late'][$date] = ($secondDiff->h * 60) + $secondDiff->i. ' mins.';
                            $rates['WRH'] = array ( $rate->getRate($date));      
                        } else {
                            $wshHours  = $wshHours + $secondDiff->h;
                            $wshMinutes  = $wshMinutes + $secondDiff->i;
                            $lateReport['report']['working special holiday']['late'][$date] = ($secondDiff->h * 60) + $secondDiff->i. ' mins.';
                            $rates['WSH'] = array ( $rate->getRate($date));
                        }
                        
		} else if (!$holiday && !$workingDay) {
			$dfHours  = $dfHours + $secondDiff->h;
                        $dfMinutes  = $dfMinutes + $secondDiff->i;
                        $lateReport['report']['day off']['late'][$date] = ($secondDiff->h * 60) + $secondDiff->i. ' mins.';
                        $rates['DO'] = array ( $rate->getRate($date));
                                
		} else {
                    $rdHours = $rdHours + $secondDiff->h;
                    $rdMinutes = $rdMinutes + $secondDiff->i;
                    $lateReport['report']['regular day']['late'][$date] = ($secondDiff->h * 60) + $secondDiff->i. ' mins.';
                    $rates['RD'] = array ( $rate->getRate($date));
                    
                }
                
                
            }
        } // end of foreach
        
        
        if($nwrhHours  != 0 || $nwrhMinutes != 0) {
            $data = array(
                'hours' => $mwrhHours ,
                'minutes' => $nwrhMinutes
            );
            $allMinutes = $this->getMinutesLate($data);
            $hoursDeduction = $this->getHoursDeduction($allMinutes);
            $deduction = $rates['NWRH'][0] * $hoursDeduction;
            $lateReport['report']['not working regular holiday']['deduction'] = array($deduction);
        }
        
        if($nwshHours != 0 || $nwshMinutes != 0) {
            $data = array(
                'hours' => $nwshHours,
                'minutes' => $nwshMinutes
            );
            $allMinutes = $this->getMinutesLate($data);
            $hoursDeduction = $this->getHoursDeduction($allMinutes);
            $deduction = $rates['NWSH'][0] * $hoursDeduction;
            $lateReport['report']['not working special holiday']['deduction'] = array($deduction);
        }
        
        if($wrhHours != 0 || $wrhMinutes != 0) {
            $data = array(
                'hours' => $wrhHours,
                'minutes' => $wrhMinutes
            );
            $allMinutes = $this->getMinutesLate($data);
            $hoursDeduction = $this->getHoursDeduction($allMinutes);
            $deduction = $rates['WRH'][0] * $hoursDeduction;
            $lateReport['report']['working regular holiday']['deduction'] = array($deduction);
        }
        
        if($wshHours != 0 || $wshMinutes != 0) {
            $data = array(
                'hours' => $wshHours,
                'minutes' => $wshMinutes
            );
            $allMinutes = $this->getMinutesLate($data);
            $hoursDeduction = $this->getHoursDeduction($allMinutes);
            $deduction = $rates['WSH'][0] * $hoursDeduction;
            $lateReport['report']['working special holiday']['deduction'] = array($deduction);
        }
        
        if($dfHours != 0 || $dfMinutes != 0) {
            $data = array(
                'hours' => $dfHours,
                'minutes' => $dfMinutes
            );
            $allMinutes = $this->getMinutesLate($data);
            $hoursDeduction = $this->getHoursDeduction($allMinutes);
            $deduction = $rates['DO'][0] * $hoursDeduction;
            $lateReport['report']['day off']['deduction'] = array($deduction);;
        }
        
        if($rdHours != 0 || $rdMinutes != 0) {
            $data = array(
                'hours' => $rdHours,
                'minutes' => $rdMinutes
            );
            $allMinutes = $this->getMinutesLate($data);
            $hoursDeduction = $this->getHoursDeduction($allMinutes);
            $deduction = $rates['RD'][0] * $hoursDeduction;
            $lateReport['report']['regular day']['deduction'] = array($deduction);
        }
        
        return $lateReport;
              
    }
    
    
    private function getMinutesLate ($count) {
        $count['hours'] = $count['hours'] * 60;
        $minutes = $count['hours'] + $count['minutes'];
        return $minutes;   
    }
    
    private function getHoursDeduction($minutes){
        if ($minutes > 60) {
            for ($i=0; $minutes > 60; $i++) {
                $minutes = $minutes - 60;
            }
            if ($minutes != 0) {
                $i++;
            }
        } else {
            $i = 1;
        }
        return $i;
    }
    
}