<div class="container">
    <div class="row">
        <div class="col-md-9 col-sm-12">
            <div class="panel panel-default profile-panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-3 col-xs-12 text-center" >
                            <img src="http://www.thecelebsocial.com/images/players/Politics/Barack%20Obama.jpg" class="img-circle user-image">
                        </div>
                        <div class="col-sm-9 col-xs-12 user-info-box">
                            <a class="btn btn-info pull-right btn-edit" href="#" data-toggle="modal" data-target="#edit-profile">
                                <i class="fa fa-edit"></i>
                                Edit…
                            </a>
                            <h3 class="user-name"><?php echo $userinfo->firstname?></h3>
                            <p><strong><span class="user-dept"><?php echo $userinfo->name ?> </span></strong></p>
                            <p><span class="user-year">3rd Year</span>, <span class="user-sem">5th Semester</span></p>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <p><strong><i class="fa fa-envelope"></i> E-mail: <?php echo $userinfo->email ?> </strong><span class="user-email">user@example.com</span></p>
                                        <p><strong><i class="fa fa-phone-square"></i> Phone: </strong><span class="user-phone">9434000000</span></p>
                                        <p><strong><i class="fa fa-users"></i> Admission Year: </strong><span class="user-admission-year">2016</span></p>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <p><strong><i class="fa fa-calendar"></i> Date of Birth: </strong><span class="user-dob">01-01-1994</span></p>
                                        <p><strong><i class="fa fa-bars"></i> Student ID No: </strong><span class="user-enrollment-no"><?php echo $userinfo->id ?></span></p>
                                    </div>
                                </div>
                           
                        </div>
                    </div>
                </div>
            </div>
			</div>
			  <div class="col-md-3 col-sm-12">
            <div class="row">
                <!-- Panel 2 -->
                <div class="col-md-12 col-sm-6 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bullhorn fa-lg"></i> 
                            Recent Notices
                        </div>
                        <div class="panel-body">
                            <div id="notice-slider" class="carousel slide sidebar-slider" data-interval="10000" data-ride="carousel">
                                <!-- Carousel indicators -->
                                <ol class="carousel-indicators">
                                    <li data-target="#notice-slider" data-slide-to="0" class="active"></li>
                                    <li data-target="#notice-slider" data-slide-to="1"></li>
                                    <li data-target="#notice-slider" data-slide-to="2"></li>
                                </ol>   
                               <!-- Carousel items -->
                                <div class="carousel-inner">
                                    <div class="active item">
                                        <h4>Notice 1</h4>
                            			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, veritatis nulla eum laudantium totam tempore optio doloremque laboriosam quas, quos eaque molestias odio aut eius animi. Impedit temporibus nisi accusamus.</p>
                                        <p>SSG</p>
                                    </div>
                                    <div class="item">
                                        <h4>Notice 2</h4>
                        				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, veritatis nulla eum laudantium totam tempore optio doloremque laboriosam quas, quos eaque molestias odio aut eius animi. Impedit temporibus nisi accusamus.</p>
                                        <p>SMU</p>
                                    </div>
                                    <div class="item">
                                        <h4>Notice 3</h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, veritatis nulla eum laudantium totam tempore optio doloremque laboriosam quas, quos eaque molestias odio aut eius animi. Impedit temporibus nisi accusamus.</p>
                                        <p>NDR</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Panel 2 -->
                <div class="col-md-12 col-sm-6 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-file fa-lg"></i> 
							Another Update
							</div>
                        <div class="panel-body">
						Another Update
                        </div>
                    </div>
                </div>
            </div>
        </div>
			</div>
			
			</div>
			
			
			