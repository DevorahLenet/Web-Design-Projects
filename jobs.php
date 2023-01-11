<?php
    require 'header.php';
    require 'navigation.php';
	require 'load_jobs.php';
	require 'load_users.php';

?>
<div class="page_container">
	<h1>Open Jobs</h1>
	<p>The jobs below are waiting for some wonderful person (like you ;) to get 'em done.</p>

	<form action="jobs.php" method="get">
		<span class="form_header">Choose a Job Category:</span><br/>
		<select name="categories" id="filter_menu">
		<option value="all">All</option>
		<option value="errands">Errands</option>
		<option value="rides">Rides</option>
		<option value="childcare">Childcare</option>
		<option value="household help">Household Help</option>
		<option value="tutoring">Tutoring</option>
		<option value="visit">Visiting</option>
		<option value="carrying">Heavy Loads</option>
		<option value="event help">Event Prep</option>
		<option value="elder-care">Elder Care</option>
		<option value="food">Food Prep</option>
		</select>
		<input type="submit" id="form_btn" name="submit" value="Filter"/>
	</form>

	<?php 
		if(isset($_GET['submit'])){
			global $selected_value;
			$selected_value = $_GET['categories'];

			foreach ($jobs_for_display as $job_to_display)
				{
					foreach ($users_for_display as $user){
							if($job_to_display->requestor_id == $user->id){
								$requesting_user = $user;
							}
						}

					if($job_to_display->volunteer_id == 0 && $job_to_display->finished == 0){//job not taken yet
						if($selected_value == 'all'){//user filtered by 'all'
							require 'jobs_display.php';
						}elseif($job_to_display->category == $selected_value){//user filtered by a certain category
							require 'jobs_display.php';
						}
					}
				}
		}else{
			?>
			<div class="process_account_container"></div>
			<?php
		}
	?>
</div>

<?php
	require 'footer.php';
?>