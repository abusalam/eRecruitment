<div class="MenuBar">
	<ul>
		<li
			class="<?php echo ($_SERVER['SCRIPT_NAME']==BaseDIR.'index.php')?'SelMenuitems':'Menuitems';?>">
			<a href="<?php echo GetAbsoluteURLFolder(); ?>index.php">Home</a>
		</li>
		<li
			class="<?php echo ($_SERVER['SCRIPT_NAME']==BaseDIR.'AppForm.php')?'SelMenuitems':'Menuitems';?>">
			<a href="<?php echo GetAbsoluteURLFolder(); ?>Application.php">Application
				Form</a>
		</li>
		<li
			class="<?php echo ($_SERVER['SCRIPT_NAME']==BaseDIR.'PrintChallan.php')?'SelMenuitems':'Menuitems';?>">
			<a href="<?php echo GetAbsoluteURLFolder(); ?>PrintChallan.php">Print
				Challan</a>
		</li>
		<li
			class="<?php echo ($_SERVER['SCRIPT_NAME']==BaseDIR.'AppStatus.php')?'SelMenuitems':'Menuitems';?>">
			<a href="<?php echo GetAbsoluteURLFolder(); ?>AppStatus.php">Application
				Status</a>
		</li>
		<li
			class="<?php echo ($_SERVER['SCRIPT_NAME']==BaseDIR.'Helpline/index.php')?'SelMenuitems':'Menuitems';?>">
			<a href="<?php echo GetAbsoluteURLFolder(); ?>Helpline">Helpline</a>
		</li>
	</ul>
</div>
