<div class="scheduler-notify">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div id="scheduler-notify-item" style="display: none">

				</div>
			</div>
		</div>
	</div>
</div>
<main class="container">
		<div> <!--TODO: move this somewhere else-->
			<button class="schedule-reset">RESET</button>
			<button class="schedule-undo-drop" style="display: none">UNDO</button>
		</div>
		<div class="scheduler-app">
			<div class="scheduler-row">
				<div class="scheduler-full scheduler-title">
					<h3 class="scheduler-header"><i class="glyphicon glyphicon-triangle-right fix-icon"></i> <?= strtoupper($semester_name) ?></h3>
				</div>
			</div>
			<div class="scheduler-row">
				<div class="scheduler-full">
					<div class="scheduler-pref">
						<h3 class="scheduler-header" data-toggle="collapse" data-target="#scheduler-pref" aria-expanded="true" aria-controls="scheduler-pref">PREFERENCES <span class="glyphicon glyphicon-chevron-down fix-icon"></span></h3>
						<button data-toggle="modal" data-target="#scheduler-pref-modal"><i class="glyphicon glyphicon-plus fix-icon"></i></button>
					</div>
					<div class="collapsing app-container" id="scheduler-pref">
						<div class="scheduler-pref-time">
						</div>
					</div>
				</div>
			</div>
			<div class="scheduler-row">
				<div class="scheduler-left">
					<input id="scheduler-search" type="text" placeholder="SEARCH">
					<div class="scheduler-courses">
						<h3 class="scheduler-header">COURSES
							<button class="scheduler-auto-btn auto-pick">Auto-Pick</button>
						</h3>
						<div class="list-group scheduler-list-group" id="scheduler-reg-course">

						</div>
					</div>
					<div class="scheduler-results">
						<h3 class="scheduler-header">SCHEDULES
							<button class="scheduler-auto-btn generate">Generate</button>
						</h3>
						<div class="list-group scheduler-list-group">
							<div class="list-group-item scheduler-list-item main-schedule schedule">
								Current Schedule for <?= $semester_name ?>
							</div>
							<div class="generated-schedules">

							</div>
						</div>
					</div>
				</div>
				<div class="scheduler-right">
					<div  class="scheduler-registered">
						<h3 class="scheduler-header">Schedule Details</h3>
						<div class="list-group scheduler-details" id="schedule-detail">
						</div>
					</div>
				</div>
			</div>
			<div class="scheduler-row">
				<div class="scheduler-full">
					<div class="scheduler-commit text-center">
						<h3 class="scheduler-header">COMMIT & ENROLL</h3>
					</div>
				</div>
			</div>
			<div class="scheduler-row">
				<div class="scheduler-full">
					<div class="scheduler-schedule">
						<h3 class="scheduler-header" id="schedule-name">SCHEDULE</h3>
					</div>
					<div id="schedule-div">

					</div>
				</div>
			</div>
		</div>
	</main>

	<div class="modal fade" id="scheduler-pref-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content scheduler-modal">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Add a Restricting Time</h4>
				</div>
				<div class="modal-body">
					<div class="form-horizontal">
						<div class="form-group">
							<div class="col-sm-10">
									Select a Weekday
									<br>
									<input type="checkbox" name="weekday" value="monday">monday<br>
									<input type="checkbox" name="weekday" value="tuesday">tuesday <br>
									<input type="checkbox" name="weekday" value="wednesday">wednesday <br>
									<input type="checkbox" name="weekday" value="thursday">thursday <br>
									<input type="checkbox" name="weekday" value="friday">friday <br>
									<input type="checkbox" name="weekday" value="saturday">saturday<br>
									<input type="checkbox" name="weekday" value="sunday">sunday <br>

									
								
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<div class="checkbox" style="padding: 0">
									<label>
										<input type="checkbox" id="time_all_day"> Restrict the whole day
									</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Interval:</label>
							<div class="col-sm-5">
								<input type="time" class="form-control time_interval" step="300"/>
								<div class="help-block">Starting time.</div>
							</div>
							<div class="col-sm-5">
								<input type="time" class="form-control time_interval" step="300"/>
								<div class="help-block">Ending time.</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button type="button" id = "btnsubmit" class="btn btn-primary time_add">Save</button>
				</div>
			</div>
		</div>
	</div>

	<div id="info-controller" style="display: none" data-controller-url="<?= $ajax_route ?>"></div>