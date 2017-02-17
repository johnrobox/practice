<div class="container-fluid">
	<div class="row-fluid">
		<div class="main-content">

			<h3>Daily Track Records</h3>
			<select id='month' class='span2'>
				<?php
					foreach($months as $key => $val) {
						$selected = ($key == date('n')) ? 'selected' : '';
				?>
				<option value='<?php echo $key; ?>' <?php echo $selected;?>>
					<?php echo $val;?>
				</option>
				<?php
					}
				?>
				<option value='0'>All</option>
			</select>
			<select id='year' class='span2'>
				<?php
					foreach($years as $key => $val) {
						$selected = ($val == date('Y')) ? 'selected' : '';
				?>
				<option value='<?php echo $val; ?>' <?php echo $selected; ?>>
					<?php echo $val; ?>
				</option>
				<?php
					}
				?>
			</select>
			<select id='shift' class='span2'>
				<option selected disabled>Choose Shift</option>
				<?php
					foreach($shifts as $key => $val) {
				?>
				<option value="<?php echo $val['Employeeshift']['id']; ?>">
					<?php echo $val['Employeeshift']['description']; ?>
				</option>
				<?php
					}
				?>
				<option value="0">All Shifts</option>
			</select>
			<br/>
			<span class="label">pending</span>
			<span class="label label-success">Present</span>
			<span class="label label-info">Late</span>
			<span class="label label-important">Absent</span>
			<span class="label label-warning">Undertime</span>
			<br/>
			<br/>
			<div id="dtr" style='width:100%; border:1px solid #aaa; overflow: auto;'></div>
			<div class='clearfix'></div>
		</div> <!-- End of main content -->
	</div>
</div>
<?php echo $this->Html->script('admin/dtr'); ?>
<?php echo $this->Html->css('admin/dtr'); ?>