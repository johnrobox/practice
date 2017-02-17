<?php
	if ($dtrHeader) {
?>
<table id='dtrTable' class='table table-bordered' style='white-space:nowrap;'>
	<thead>
		<tr>
			<th>Employees</th>
			<?php 
				$dayTotal = 0;
				foreach($dtrHeader as $key => $val) {
					$dayTotal++;
			?>
			<th>
				<?php 
					$day = date('d', strtotime($key));
					$dayName = date('D', strtotime($key));
					echo "$day - $dayName"; 
				?>
			</th>
			<?php
				}
			?>
			<th>Total</th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach($dtrBody as $key => $val) {
				$dayCtr = 0;
		?>
		<tr>
			<td class='empName'>
				<?php echo $val['profile']['first_name'] . ' '. $val['profile']['middle_name'] . ' ' . $val['profile']['last_name'];?>
			</td>
			<?php
				foreach($val['attendance'] as $akey => $aVal) {
					$fTimein = empty($aVal['f_time_in']) ? '' : date('g:i A', strtotime($aVal['f_time_in']));
					$fTimeout = empty($aVal['f_time_out']) ? '' : date('g:i A', strtotime($aVal['f_time_out']));
					$overTime = empty($aVal['over_time']) ? '' : date('H:i', strtotime($aVal['over_time']));
					$renderTime = empty($aVal['render_time']) ? '' : date('H:i', strtotime($aVal['render_time']));
					$track = (empty($fTimein) && empty($fTimeout)) ? '-----' : "$fTimein - $fTimeout";
					$overTimeDis = empty($overTime) ? '' : "$overTime";
					$statusClass = '';
					switch ($aVal['status']) {
						case 1 : 
							$statusClass = 'label-success';
							break;
						case 2 :
							$statusClass = 'label-important';
							break;
						case 3 :
							$statusClass = 'label-info';
							break;
						case 4 :
							$statusClass = 'label-warning';
							break;
					}
					$status = "<span class='label $statusClass'> </span>";
			?>
			<td class='daily-time'>
				<span class='pull-right'>
					<?php echo $status; ?>
				</span>
				<span>
					<?php echo $track;?>
				</span> <br/>
				<div class='daily-ot-rt'>
				<?php
					if (!empty($overTimeDis) || !empty($renderTime)) {
				?>
					<span>
						Overtime : <b><?php echo $overTimeDis; ?></b>
					</span>
					<br/>
					<span>
						Rendertime : <b><?php echo $renderTime; ?></b>
					</span>
				
				<?php
					} else {
				?>
					<span>No Over and Render Time</span>
				<?php
					}
				?>
				</div>
			</td>
			<?php
					$dayCtr++;
				}
			?>
			<?php
				for(; $dayCtr < $dayTotal; $dayCtr++) {
			?>
			<td></td>
			<?php
				}
			?>
			<td>
				<?php echo $val['total_render']; ?>: RT <br/>
				<?php echo $val['total_overtime']; ?>: OT
			</td>
		</tr>
		<?php
			}
		?>
	</tbody>
</table>
<div class='well'>
	<table width='100%'>
		<tr>
			<td># of Employees: <?php echo $empCount; ?></td>
			<td>Working Hrs: <?php echo $workingHrs; ?> </td>
		</tr>
		<tr>
			<td># of Absent: <?php echo $absent; ?></td>
			<td>Total of Hours: <?php echo $totalHrs; ?></td>
		</tr>
	</table>
</div>
<?php
} else {
?>
<div class='alert alert-danger'>
	<b>Ooopppsss!!</b> No data found!!
</div>
<?php
}
?>

