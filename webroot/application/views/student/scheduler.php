
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
							<p><i class="glyphicon glyphicon-ban-circle fix-icon"></i> Monday: 9:00am to 10:00am</p>
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
						<h3 class="scheduler-header">COURSES</h3>
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
						<h3 class="scheduler-header">SECTIONS</h3>
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
				</div>
			</div>
		</div>
	</main>

	<div class="modal fade" id="scheduler-pref-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content scheduler-modal">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Modal title</h4>
				</div>
				<div class="modal-body">
					...
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal">Save</button>
				</div>
			</div>
		</div>
	</div>

	<div id="info-controller" style="display: none" data-controller-url="<?php echo dirname(current_url()); ?>"></div>