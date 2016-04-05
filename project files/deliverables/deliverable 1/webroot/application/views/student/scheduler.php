
<main class="container">
		<div class="scheduler-app">
			<div class="scheduler-row">
				<div class="scheduler-full scheduler-title">
					<h3 class="scheduler-header"><i class="glyphicon glyphicon-triangle-right fix-icon"></i> WINTER 2016</h3>
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
							<p class="remove-time-block"><i class="glyphicon glyphicon-ban-circle fix-icon"></i> Monday: 9:00am to 10:00am</p>
						</div>
					</div>
				</div>
			</div>
			<div class="scheduler-row">
				<div class="scheduler-half">
					<div class="scheduler-search">
						<h3 id="scheduler-search-cover"><i class="glyphicon glyphicon-search fix-icon"></i> SEARCH <span id="blink_underscore">_</span></h3>
						<input id="scheduler-search-input" style="display: none" type="text" placeholder="SEARCH">
					</div>
					<div class="scheduler-courses">
						<h3 class="scheduler-header">COURSES
							<button class="scheduler-auto-btn">Auto-Pick</button>
						</h3>
						<div class="list-group scheduler-list-group">
							<div class="list-group-item scheduler-list-item">
								<span class="badge">2</span>
								Cras justo odio
							</div>
							<div class="list-group-item scheduler-list-item">
								<span class="badge">3</span>
								Cras justo odio
							</div>
							<div class="list-group-item scheduler-list-item">
								<span class="badge">4</span>
								Cras justo odio
							</div>
							<div class="list-group-item scheduler-list-item">
								<span class="badge">5</span>
								Cras justo odio
							</div>
							<div class="list-group-item scheduler-list-item">
								<span class="badge">6</span>
								Cras justo odio
							</div>
						</div>
					</div>
					<div class="scheduler-results">
						<h3 class="scheduler-header">SCHEDULES
							<button class="scheduler-auto-btn">Generate</button>
						</h3>
						<div class="list-group scheduler-list-group">
							<div class="list-group-item scheduler-list-item">
								Cras justo odio
							</div>
							<div class="list-group-item scheduler-list-item">
								Cras justo odio
							</div>
							<div class="list-group-item scheduler-list-item">
								Cras justo odio
							</div>
							<div class="list-group-item scheduler-list-item">
								Cras justo odio
							</div>
							<div class="list-group-item scheduler-list-item">
								Cras justo odio
							</div>
						</div>
					</div>
				</div>
				<div class="scheduler-half">
					<div  class="scheduler-registered">
						<h3 class="scheduler-header">REGISTER</h3>
						<div class="list-group scheduler-list-group">
							<div class="list-group-item scheduler-list-item list-group-item-success">
								Cras justo odio
							</div>
							<div class="list-group-item scheduler-list-item list-group-item-success">
								Cras justo odio
							</div>
							<div class="list-group-item scheduler-list-item list-group-item-warning">
								Cras justo odio
							</div>
							<div class="list-group-item scheduler-list-item list-group-item-warning">
								Cras justo odio
							</div>
							<div class="list-group-item scheduler-list-item list-group-item-danger">
								Cras justo odio
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="scheduler-row">
				<div class="scheduler-full">
					<div class="scheduler-commit text-center">
						<h3 class="scheduler-header">COMMIT</h3>
					</div>
				</div>
			</div>
			<div class="scheduler-row">
				<div class="scheduler-full">
					<div class="scheduler-schedule">
						<h3 class="scheduler-header">SCHEDULE</h3>
					</div>
					<div id="mySchedule">

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
							<label class="col-sm-2 control-label">Weekday:</label>
							<div class="col-sm-10">
								<select class="form-control">
									<option>Select a Weekday</option>
									<option value="1">Monday</option>
									<option value="2">Tuesday</option>
									<option value="3">Wednesday</option>
									<option value="4">Thursday</option>
									<option value="5">Friday</option>
									<option value="6">Saturday</option>
									<option value="0">Sunday</option>
								</select>
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
					<button type="button" class="btn btn-primary time_add">Save</button>
				</div>
			</div>
		</div>
	</div>

	<div id="info-controller" style="display: none" data-controller-url="<?php echo dirname(current_url()); ?>"></div>