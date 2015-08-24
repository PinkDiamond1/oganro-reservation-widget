<form id="searchboxform" name="searchboxform" action="<?php echo($ogn_rw_view_setting_cname); ?>/reservation/searchresult!callmdb.html" method="post" accept-charset="utf-8" data-toggle="validator" >
	
		<input type="hidden" name="hotelMappingId" value="0" id="hotelMappingId"/>
		<input type="hidden" name="changedfiled" value="" id="changedfiled"/>
		<input type="hidden" name="showcity" value="true" id="showcity"/>
		<input type="hidden" name="reqcurrency" value="GBP" id="box_reqcurrency"/>
		<input type="hidden" name="cityName" value="" id="cityName"/> 
		<input type="hidden" name="cityId" value="" id="cityId"/>
		<input type="hidden" name="datefrom" value="" id="datefrom"/>
		<input type="hidden" name="dateto" value="" id="dateto"/>
		<input type="hidden" name="noofnights" value="" id="noofnights"/>
		<input type="hidden" name="starrate" value="-2" id="starrate"/>
		<input type="hidden" name="noofrooms" value="1" id="noofrooms"/>
	
	 <div id="search_box_main_wrap">
		
		<div class="form-group col-lg-3 col-sm-12 col-custom-full ogh_searchbox">
        <label class="control-label siteheader_title"  for="exampleInputEmail1"><?php echo($ogn_rw_view_location_title); ?></label>
		  <div class="input-group special_englishfont_load control-label">
           <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
					<input id="autocompleter_city" name="autocompleter_city" type="text" class="form-control destinationautocomplete"  results="0"
								placeholder="<?php echo($ogn_rw_view_location_placeholder); ?>" 
							required oninvalid="this.setCustomValidity('Please select a city or country from the list.') "/>
				</div>	
				 </div>		 
       
       <div class="form-group col-lg-2 col-md-12 col-sm-12  col-custom-full ogh_checkin">
      <label class="control-label" for="exampleInputEmail1"><?php echo($ogn_rw_view_checkin_title); ?></label>
      <div class="input-group date  from_date">
        
        <input id="tmp_date_from" name="tmp_date_from" type="text" class="form-control" required/>
        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
      </div>
    </div>
    
       
        <div class="form-group col-lg-2 col-md-12 col-sm-12 col-custom-full ogh_checkout">
      <label class="control-label" for="exampleInputEmail1"><?php echo($ogn_rw_view_checkout_title); ?></label>
      <div class="input-group date to_date">
        
        <input id="tmp_date_to" name="tmp_date_to" type="text" class="form-control" required/>
        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
      </div>
    </div>
				
			 <div class="form-group col-lg-1 col-md-12 col-sm-12 specialcolumnwidth col-custom-full ogh_nights">
			 <label class="control-label" for="exampleInputEmail1"><?php echo($ogn_rw_view_nights_title); ?></label>
		<div class="dropdown input-group" id="nightsDrpdwn">
		
			<button class="btn btn-default dropdown-toggle special_englishfont_load nights" type="button" id="nightsDrpdwnBtn" data-toggle="dropdown"></button>
			<ul class="dropdown-menu scrollable-menu special_englishfont_load" role="menu" aria-labelledby="nightsDrpdwn" id="nightsDrpdwnUl">			   
			   <?php for($x=1;$x<=30;$x++) { ?>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="<?php echo($x); ?>"><?php echo($x); ?> </a></li>
				<?php } ?>			 
			</ul>
	   	</div>
			</div>
		
		<div class="form-group rooms col-lg-2 col-md-12 col-sm-12 col-custom-full ogh_rooms">
		<label  class="control-label"  for="exampleInputEmail1"><?php echo($ogn_rw_view_rooms_title); ?></label>
	   	<div class="dropdown input-group special_englishfont_load" id="noOfRoomsDrpdwn">
	   	
			<button class="btn btn-default dropdown-toggle triggerx roomstype" type="button"
				id="noOfRoomsDrpdwnBtn" data-toggle="dropdown" value="-1">
				1 room, 2 adults &nbsp;
				<span class="glyphicon glyphicon-chevron-down"></span>
			</button>
			<ul class="dropdown-menu" role="menu" aria-labelledby="noOfRoomsDrpdwn" id="noOfRoomsDrpdwnUl">
				<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="-1">
					1 room, 2 adults</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="-2">
					1 room, 1 adults</a></li>
				<li role="presentation" class="divider"></li>
				<li role="presentation" class="dropdown-header">More Options</li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="1">
					1&nbsp;Room</a></li>
				
					<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="2">
					2&nbsp;Rooms</a></li>
			 	
					<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="3">
					3&nbsp;Rooms</a></li>
			 	
					<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="4">
					4&nbsp;Rooms</a></li>
			 	
					<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="5">
					5&nbsp;Rooms</a></li>
			 	
			</ul>
			
			<div id="popoverwrap" class="searchbox_popover">
			    <div class="head hide">Room Occupancy Details</div>
			    <div id="popovercontent" class="content hide">
			        <div class="popoversecdiv">
			        <div class="popoversecdivroom">
				        <div>Room&nbsp;1:&nbsp;</div>
				        <div>
				        <div class="badge popadults floatLeft">2</div><div class="seacrhpopover_adults floatLeft">Adults</div></div>
				    </div>
				    </div>
			    	</div>
		    </div>
	   	</div>
	   	</div>
		<div id="rmOccupancyModal" class="modal fade bs-example-modal-sm ogh_popups" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">

			<div class="modal-dialog modal-sm">

				<div class="modal-content">
					<div class="modal-header">
						<button id="rmOccupancyClose" type="button" class="close" data-dismiss="modal">
							<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
						</button>
						<h4 class="modal-title" id="rmOccupancyModalLabel">Room Occupancy Details</h4>
					</div>

					<div class="modal-body searchbox_roomresult_pop">
					
							
							
							<div class="dropdown col-md-12" style="display: block;" id="adultsDwn_1">
							
							<div class="cssboxmarginclass">
							   	<span class="room_label">
							   		Room&nbsp;<span class="special_englishfont_load label label-primary">1</span></span></div>
				
								<div  class="col-md-9"><span>Number of Adults</span></div>
								
								<div class="col-md-2">
								<button class="btn btn-default dropdown-toggle cssboxmarginclass " type="button" id="adultsDrpdwnBtn" data-toggle="dropdown" value="2">
									2&nbsp;
									
									<span class="glyphicon glyphicon-chevron-down"></span>
								</button>
								<ul class="dropdown-menu" role="menu" aria-labelledby="adultsDrpdwn" id="adultsDrpdwnUl">
									<li role="presentation">
									<a role="menuitem" tabindex="-1" href="#" data-value="1">
										1&nbsp;</a></li>
									
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="2">
										2&nbsp;</a></li>
								 	
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="3">
										3&nbsp;</a></li>
								 	
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="4">
										4&nbsp;</a></li>
								 	
								</ul>
								</div>
								<input type="hidden" name="adults" value="2" id="adults"/>
			   				</div>
			   				
			   				
			   				 	
			   				<div class="dropdown col-md-12" style="display: block;" id="childrenDropDwn_1">
									
									<div class="col-md-9"><span>Number of Children</span></div>
									<div class="col-md-2">
								<button class="btn btn-default dropdown-toggle cssboxmarginclass " type="button"
									id="childrenDrpdwnBtn" data-toggle="dropdown" value="0">0&nbsp;
									
									<span class="glyphicon glyphicon-chevron-down"></span>
								</button>
								<ul class="dropdown-menu" role="menu" aria-labelledby="childrenDrpdwn" id="childrenDrpdwnUl">
									<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="0">
										0&nbsp;</a></li>
									
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="1">
										1&nbsp;</a></li>
								 	
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="2">
										2&nbsp;</a></li>
								 	
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="3">
										3&nbsp;</a></li>
								 	
								</ul>
								</div>
								<input type="hidden" name="children" value="0" id="children"/>
			   				</div>
			   				
			   				
			   				<div class="col-md-12">
			   				<div class="age_lbl_cls ageLblToggle" id="age_lbl_1" style="display: none;" >
			   					<div class="cssboxmarginclass"><span>Age of Children </span></div>
			   				</div>
			   				
			   				
			   					<span class="dropdown ageDropDwnToggle ageRawToggle_1" style="display: none;" 
									id="ageDropDwn_1_1">
									
								<button class="btn btn-default dropdown-toggle cssboxmarginclass special_englishfont_load" type="button" id="ageDrpdwnBtn" data-toggle="dropdown" value="1">
									1
									<span class="glyphicon glyphicon-chevron-down"></span>
								</button>
								<ul class="dropdown-menu scrollable-menu special_englishfont_load" role="menu" aria-labelledby="ageDrpdwn" id="ageDrpdwnUl">
										
										<?php for($x=1;$x<=17;$x++) { ?>
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="<?php echo($x); ?>"><?php echo($x); ?></a></li>
										<?php } ?>
								 	
								</ul>
								<input type="hidden" name="age" value="0" id="age" disabled="disabled"/>
			   					</span>
			   				
			   				
			   					<span class="dropdown ageDropDwnToggle ageRawToggle_1" style="display: none;" id="ageDropDwn_1_2">
									
								<button class="btn btn-default dropdown-toggle cssboxmarginclass special_englishfont_load" type="button" id="ageDrpdwnBtn" data-toggle="dropdown" value="1">
									1
									<span class="glyphicon glyphicon-chevron-down"></span>
								</button>
								<ul class="dropdown-menu scrollable-menu special_englishfont_load" role="menu" aria-labelledby="ageDrpdwn" id="ageDrpdwnUl">
								
										<?php for($x=1;$x<=17;$x++) { ?>
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="<?php echo($x); ?>">
										<?php echo($x); ?></a></li>
										<?php } ?>
								 	
								</ul>
								<input type="hidden" name="age" value="0" id="age" disabled="disabled"/>
			   					</span>
			   				
			   				
			   					<span class="dropdown ageDropDwnToggle ageRawToggle_1" style="display: none;" id="ageDropDwn_1_3">
									
								<button class="btn btn-default dropdown-toggle cssboxmarginclass special_englishfont_load" type="button" id="ageDrpdwnBtn" data-toggle="dropdown" value="1">
									1
									<span class="glyphicon glyphicon-chevron-down"></span>
								</button>
								<ul class="dropdown-menu scrollable-menu special_englishfont_load" role="menu" aria-labelledby="ageDrpdwn" id="ageDrpdwnUl">
									
										<?php for($x=1;$x<=17;$x++) { ?>
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="<?php echo($x); ?>">
										<?php echo($x); ?></a></li>
										<?php } ?>
																												 	
								</ul>
								<input type="hidden" name="age" value="0" id="age" disabled="disabled"/>
			   					</span>
			   				
			   				</div>
			   				<div class="clearfix"></div>
			   	
							
							
							<div class="dropdown col-md-12" style="display: none;" id="adultsDwn_2">
							
							<div class="cssboxmarginclass">
							   	<span class="room_label">
							   		Room&nbsp;<span class="special_englishfont_load label label-primary">2</span></span></div>
				
								<div  class="col-md-9"><span>Number of Adults</span></div>
								
								<div class="col-md-2">
								<button class="btn btn-default dropdown-toggle cssboxmarginclass " type="button" id="adultsDrpdwnBtn" data-toggle="dropdown" value="2">
									2&nbsp;
									
									<span class="glyphicon glyphicon-chevron-down"></span>
								</button>
								<ul class="dropdown-menu" role="menu" aria-labelledby="adultsDrpdwn" id="adultsDrpdwnUl">
									<li role="presentation">
									<a role="menuitem" tabindex="-1" href="#" data-value="1">
										1&nbsp;</a></li>
									
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="2">
										2&nbsp;</a></li>
								 	
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="3">
										3&nbsp;</a></li>
								 	
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="4">
										4&nbsp;</a></li>
								 	
								</ul>
								</div>
								<input type="hidden" name="adults" value="2" id="adults" disabled="disabled"/>
			   				</div>
			   				
			   				
			   				 	
			   				<div class="dropdown col-md-12" style="display: none;" 
									id="childrenDropDwn_2">
									
									<div class="col-md-9"><span>Number of Children</span></div>
									<div class="col-md-2">
								<button class="btn btn-default dropdown-toggle cssboxmarginclass " type="button"
									id="childrenDrpdwnBtn" data-toggle="dropdown" value="0">0&nbsp;
									
									<span class="glyphicon glyphicon-chevron-down"></span>
								</button>
								<ul class="dropdown-menu" role="menu" aria-labelledby="childrenDrpdwn" id="childrenDrpdwnUl">
									<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="0">
										0&nbsp;</a></li>
									
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="1">
										1&nbsp;</a></li>
								 	
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="2">
										2&nbsp;</a></li>
								 	
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="3">
										3&nbsp;</a></li>
								 	
								</ul>
								</div>
								<input type="hidden" name="children" value="0" id="children" disabled="disabled"/>
			   				</div>
			   				
			   				
			   				<div class="col-md-12">
			   				<div class="age_lbl_cls ageLblToggle" id="age_lbl_2" style="display: none;" >
			   					<div class="cssboxmarginclass"><span>Age of Children </span></div>
			   				</div>
			   				
			   				
			   					<span class="dropdown ageDropDwnToggle ageRawToggle_2" style="display: none;" 
									id="ageDropDwn_2_1">
									
								<button class="btn btn-default dropdown-toggle cssboxmarginclass special_englishfont_load" type="button" id="ageDrpdwnBtn" data-toggle="dropdown" value="1">
									1
									<span class="glyphicon glyphicon-chevron-down"></span>
								</button>
								<ul class="dropdown-menu scrollable-menu special_englishfont_load" role="menu" aria-labelledby="ageDrpdwn" id="ageDrpdwnUl">
										
										<?php for($x=1;$x<=17;$x++) { ?>
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="<?php echo($x); ?>">
										<?php echo($x); ?></a></li>
										<?php } ?>
								 	
								</ul>
								<input type="hidden" name="age" value="0" id="age" disabled="disabled"/>
			   					</span>
			   				
			   				
			   					<span class="dropdown ageDropDwnToggle ageRawToggle_2" style="display: none;" 
									id="ageDropDwn_2_2">
									
								<button class="btn btn-default dropdown-toggle cssboxmarginclass special_englishfont_load" type="button" id="ageDrpdwnBtn" data-toggle="dropdown" value="1">
									1
									<span class="glyphicon glyphicon-chevron-down"></span>
								</button>
								<ul class="dropdown-menu scrollable-menu special_englishfont_load" role="menu" aria-labelledby="ageDrpdwn" id="ageDrpdwnUl">
										
										<?php for($x=1;$x<=17;$x++) { ?>
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="<?php echo($x); ?>">
										<?php echo($x); ?></a></li>
										<?php } ?>
								 	
								</ul>
								<input type="hidden" name="age" value="0" id="age" disabled="disabled"/>
			   					</span>
			   				
			   				
			   					<span class="dropdown ageDropDwnToggle ageRawToggle_2" style="display: none;" 
									id="ageDropDwn_2_3">
									
								<button class="btn btn-default dropdown-toggle cssboxmarginclass special_englishfont_load" type="button" id="ageDrpdwnBtn" data-toggle="dropdown" value="1">
									1
									<span class="glyphicon glyphicon-chevron-down"></span>
								</button>
								<ul class="dropdown-menu scrollable-menu special_englishfont_load" role="menu" aria-labelledby="ageDrpdwn" id="ageDrpdwnUl">
										
										<?php for($x=1;$x<=17;$x++) { ?>
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="<?php echo($x); ?>">
										<?php echo($x); ?></a></li>
										<?php } ?>
								 	
								</ul>
								<input type="hidden" name="age" value="0" id="age" disabled="disabled"/>
			   					</span>
			   				
			   				</div>
			   				<div class="clearfix"></div>
			   			
				
							
							<div class="dropdown col-md-12" style="display: none;" id="adultsDwn_3">
							
							<div class="cssboxmarginclass">
							   	<span class="room_label">
							   		Room&nbsp;<span class="special_englishfont_load label label-primary">3</span></span></div>
				
								<div  class="col-md-9"><span>Number of Adults</span></div>
								
								<div class="col-md-2">
								<button class="btn btn-default dropdown-toggle cssboxmarginclass " type="button" id="adultsDrpdwnBtn" data-toggle="dropdown" value="2">
									2&nbsp;
									
									<span class="glyphicon glyphicon-chevron-down"></span>
								</button>
								<ul class="dropdown-menu" role="menu" aria-labelledby="adultsDrpdwn" id="adultsDrpdwnUl">
									<li role="presentation">
									<a role="menuitem" tabindex="-1" href="#" data-value="1">
										1&nbsp;</a></li>
									
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="2">
										2&nbsp;</a></li>
								 	
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="3">
										3&nbsp;</a></li>
								 	
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="4">
										4&nbsp;</a></li>
								 	
								</ul>
								</div>
								<input type="hidden" name="adults" value="2" id="adults" disabled="disabled"/>
			   				</div>
			   				
			   				
			   				 	
			   				<div class="dropdown col-md-12" style="display: none;" 
									id="childrenDropDwn_3">
									
									<div class="col-md-9"><span>Number of Children</span></div>
									<div class="col-md-2">
								<button class="btn btn-default dropdown-toggle cssboxmarginclass " type="button"
									id="childrenDrpdwnBtn" data-toggle="dropdown" value="0">0&nbsp;
									
									<span class="glyphicon glyphicon-chevron-down"></span>
								</button>
								<ul class="dropdown-menu" role="menu" aria-labelledby="childrenDrpdwn" id="childrenDrpdwnUl">
									<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="0">
										0&nbsp;</a></li>
									
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="1">
										1&nbsp;</a></li>
								 	
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="2">
										2&nbsp;</a></li>
								 	
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="3">
										3&nbsp;</a></li>
								 	
								</ul>
								</div>
								<input type="hidden" name="children" value="0" id="children" disabled="disabled"/>
			   				</div>
			   				
			   				
			   				<div class="col-md-12">
			   				<div class="age_lbl_cls ageLblToggle" id="age_lbl_3" style="display: none;" >
			   					<div class="cssboxmarginclass"><span>Age of Children </span></div>
			   				</div>
			   				
			   				
			   					<span class="dropdown ageDropDwnToggle ageRawToggle_3" style="display: none;" 
									id="ageDropDwn_3_1">
									
								<button class="btn btn-default dropdown-toggle cssboxmarginclass special_englishfont_load" type="button" id="ageDrpdwnBtn" data-toggle="dropdown" value="1">
									1
									<span class="glyphicon glyphicon-chevron-down"></span>
								</button>
								<ul class="dropdown-menu scrollable-menu special_englishfont_load" role="menu" aria-labelledby="ageDrpdwn" id="ageDrpdwnUl">
										
										<?php for($x=1;$x<=17;$x++) { ?>
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="<?php echo($x); ?>">
										<?php echo($x); ?></a></li>
										<?php } ?>
								 	
								</ul>
								<input type="hidden" name="age" value="0" id="age" disabled="disabled"/>
			   					</span>
			   				
			   				
			   					<span class="dropdown ageDropDwnToggle ageRawToggle_3" style="display: none;" 
									id="ageDropDwn_3_2">
									
								<button class="btn btn-default dropdown-toggle cssboxmarginclass special_englishfont_load" type="button" id="ageDrpdwnBtn" data-toggle="dropdown" value="1">
									1
									<span class="glyphicon glyphicon-chevron-down"></span>
								</button>
								<ul class="dropdown-menu scrollable-menu special_englishfont_load" role="menu" aria-labelledby="ageDrpdwn" id="ageDrpdwnUl">
										
										<?php for($x=1;$x<=17;$x++) { ?>
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="<?php echo($x); ?>">
										<?php echo($x); ?></a></li>
										<?php } ?>
								 	
								</ul>
								<input type="hidden" name="age" value="0" id="age" disabled="disabled"/>
			   					</span>
			   				
			   				
			   					<span class="dropdown ageDropDwnToggle ageRawToggle_3" style="display: none;" 
									id="ageDropDwn_3_3">
									
								<button class="btn btn-default dropdown-toggle cssboxmarginclass special_englishfont_load" type="button" id="ageDrpdwnBtn" data-toggle="dropdown" value="1">
									1
									<span class="glyphicon glyphicon-chevron-down"></span>
								</button>
								<ul class="dropdown-menu scrollable-menu special_englishfont_load" role="menu" aria-labelledby="ageDrpdwn" id="ageDrpdwnUl">
										
										<?php for($x=1;$x<=17;$x++) { ?>
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="<?php echo($x); ?>">
										<?php echo($x); ?></a></li>
										<?php } ?>
								 	
								</ul>
								<input type="hidden" name="age" value="0" id="age" disabled="disabled"/>
			   					</span>
			   				
			   				</div>
			   				<div class="clearfix"></div>
			   				
							
							
							<div class="dropdown col-md-12" style="display: none;" id="adultsDwn_4">
							
							<div class="cssboxmarginclass">
							   	<span class="room_label">
							   		Room&nbsp;<span class="special_englishfont_load label label-primary">4</span></span></div>
				
								<div  class="col-md-9"><span>Number of Adults</span></div>
								
								<div class="col-md-2">
								<button class="btn btn-default dropdown-toggle cssboxmarginclass " type="button" id="adultsDrpdwnBtn" data-toggle="dropdown" value="2">
									2&nbsp;
									
									<span class="glyphicon glyphicon-chevron-down"></span>
								</button>
								<ul class="dropdown-menu" role="menu" aria-labelledby="adultsDrpdwn" id="adultsDrpdwnUl">
									<li role="presentation">
									<a role="menuitem" tabindex="-1" href="#" data-value="1">
										1&nbsp;</a></li>
									
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="2">
										2&nbsp;</a></li>
								 	
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="3">
										3&nbsp;</a></li>
								 	
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="4">
										4&nbsp;</a></li>
								 	
								</ul>
								</div>
								<input type="hidden" name="adults" value="2" id="adults" disabled="disabled"/>
			   				</div>
			   				
			   				
			   				 	
			   				<div class="dropdown col-md-12" style="display: none;" 
									id="childrenDropDwn_4">
									
									<div class="col-md-9"><span>Number of Children</span></div>
									<div class="col-md-2">
								<button class="btn btn-default dropdown-toggle cssboxmarginclass " type="button"
									id="childrenDrpdwnBtn" data-toggle="dropdown" value="0">0&nbsp;
									
									<span class="glyphicon glyphicon-chevron-down"></span>
								</button>
								<ul class="dropdown-menu" role="menu" aria-labelledby="childrenDrpdwn" id="childrenDrpdwnUl">
									<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="0">
										0&nbsp;</a></li>
									
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="1">
										1&nbsp;</a></li>
								 	
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="2">
										2&nbsp;</a></li>
								 	
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="3">
										3&nbsp;</a></li>
								 	
								</ul>
								</div>
								<input type="hidden" name="children" value="0" id="children" disabled="disabled"/>
			   				</div>
			   				
			   				
			   				<div class="col-md-12">
			   				<div class="age_lbl_cls ageLblToggle" id="age_lbl_4" style="display: none;" >
			   					<div class="cssboxmarginclass"><span>Age of Children </span></div>
			   				</div>
			   				
			   				
			   					<span class="dropdown ageDropDwnToggle ageRawToggle_4" style="display: none;" 
									id="ageDropDwn_4_1">
									
								<button class="btn btn-default dropdown-toggle cssboxmarginclass special_englishfont_load" type="button" id="ageDrpdwnBtn" data-toggle="dropdown" value="1">
									1
									<span class="glyphicon glyphicon-chevron-down"></span>
								</button>
								<ul class="dropdown-menu scrollable-menu special_englishfont_load" role="menu" aria-labelledby="ageDrpdwn" id="ageDrpdwnUl">
										
										<?php for($x=1;$x<=17;$x++) { ?>
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="<?php echo($x); ?>">
										<?php echo($x); ?></a></li>
										<?php } ?>
								 	
								</ul>
								<input type="hidden" name="age" value="0" id="age" disabled="disabled"/>
			   					</span>
			   				
			   				
			   					<span class="dropdown ageDropDwnToggle ageRawToggle_4" style="display: none;" 
									id="ageDropDwn_4_2">
									
								<button class="btn btn-default dropdown-toggle cssboxmarginclass special_englishfont_load" type="button" id="ageDrpdwnBtn" data-toggle="dropdown" value="1">
									1
									<span class="glyphicon glyphicon-chevron-down"></span>
								</button>
								<ul class="dropdown-menu scrollable-menu special_englishfont_load" role="menu" aria-labelledby="ageDrpdwn" id="ageDrpdwnUl">
										
										<?php for($x=1;$x<=17;$x++) { ?>
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="<?php echo($x); ?>">
										<?php echo($x); ?></a></li>
										<?php } ?>
								 	
								</ul>
								<input type="hidden" name="age" value="0" id="age" disabled="disabled"/>
			   					</span>
			   				
			   				
			   					<span class="dropdown ageDropDwnToggle ageRawToggle_4" style="display: none;" 
									id="ageDropDwn_4_3">
									
								<button class="btn btn-default dropdown-toggle cssboxmarginclass special_englishfont_load" type="button" id="ageDrpdwnBtn" data-toggle="dropdown" value="1">
									1
									<span class="glyphicon glyphicon-chevron-down"></span>
								</button>
								<ul class="dropdown-menu scrollable-menu special_englishfont_load" role="menu" aria-labelledby="ageDrpdwn" id="ageDrpdwnUl">
										
										<?php for($x=1;$x<=17;$x++) { ?>									
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="<?php echo($x); ?>">
										<?php echo($x); ?></a></li>
										<?php } ?>
								 	
								</ul>
								<input type="hidden" name="age" value="0" id="age" disabled="disabled"/>
			   					</span>
			   				
			   				</div>
			   				<div class="clearfix"></div>
			   			
							
							<div class="dropdown col-md-12" style="display: none;" id="adultsDwn_5">
							
							<div class="cssboxmarginclass">
							   	<span class="room_label">
							   		Room&nbsp;<span class="special_englishfont_load label label-primary">5</span></span></div>
				
								<div  class="col-md-9"><span>Number of Adults</span></div>
								
								<div class="col-md-2">
								<button class="btn btn-default dropdown-toggle cssboxmarginclass " type="button" id="adultsDrpdwnBtn" data-toggle="dropdown" value="2">
									2&nbsp;
									
									<span class="glyphicon glyphicon-chevron-down"></span>
								</button>
								<ul class="dropdown-menu" role="menu" aria-labelledby="adultsDrpdwn" id="adultsDrpdwnUl">
									<li role="presentation">
									<a role="menuitem" tabindex="-1" href="#" data-value="1">
										1&nbsp;</a></li>
									
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="2">
										2&nbsp;</a></li>
								 	
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="3">
										3&nbsp;</a></li>
								 	
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="4">
										4&nbsp;</a></li>
								 	
								</ul>
								</div>
								<input type="hidden" name="adults" value="2" id="adults" disabled="disabled"/>
			   				</div>
			   				
			   				
			   				 	
			   				<div class="dropdown col-md-12" style="display: none;" 
									id="childrenDropDwn_5">
									
									<div class="col-md-9"><span>Number of Children</span></div>
									<div class="col-md-2">
								<button class="btn btn-default dropdown-toggle cssboxmarginclass " type="button"
									id="childrenDrpdwnBtn" data-toggle="dropdown" value="0">0&nbsp;
									
									<span class="glyphicon glyphicon-chevron-down"></span>
								</button>
								<ul class="dropdown-menu" role="menu" aria-labelledby="childrenDrpdwn" id="childrenDrpdwnUl">
									<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="0">
										0&nbsp;</a></li>
									
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="1">
										1&nbsp;</a></li>
								 	
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="2">
										2&nbsp;</a></li>
								 	
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="3">
										3&nbsp;</a></li>
								 	
								</ul>
								</div>
								<input type="hidden" name="children" value="0" id="children" disabled="disabled"/>
			   				</div>
			   				
			   				
			   				<div class="col-md-12">
			   				<div class="age_lbl_cls ageLblToggle" id="age_lbl_5" style="display: none;" >
			   					<div class="cssboxmarginclass"><span>Age of Children </span></div>
			   				</div>
			   				
			   				
			   					<span class="dropdown ageDropDwnToggle ageRawToggle_5" style="display: none;" 
									id="ageDropDwn_5_1">
									
								<button class="btn btn-default dropdown-toggle cssboxmarginclass special_englishfont_load" type="button" id="ageDrpdwnBtn" data-toggle="dropdown" value="1">
									1
									<span class="glyphicon glyphicon-chevron-down"></span>
								</button>
								<ul class="dropdown-menu scrollable-menu special_englishfont_load" role="menu" aria-labelledby="ageDrpdwn" id="ageDrpdwnUl">
										
										<?php for($x=1;$x<=17;$x++) { ?>
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="<?php echo($x); ?>">
										<?php echo($x); ?></a></li>
										<?php } ?>
								 	
								</ul>
								<input type="hidden" name="age" value="0" id="age" disabled="disabled"/>
			   					</span>
			   				
			   				
			   					<span class="dropdown ageDropDwnToggle ageRawToggle_5" style="display: none;" 
									id="ageDropDwn_5_2">
									
								<button class="btn btn-default dropdown-toggle cssboxmarginclass special_englishfont_load" type="button" id="ageDrpdwnBtn" data-toggle="dropdown" value="1">
									1
									<span class="glyphicon glyphicon-chevron-down"></span>
								</button>
								<ul class="dropdown-menu scrollable-menu special_englishfont_load" role="menu" aria-labelledby="ageDrpdwn" id="ageDrpdwnUl">
										
										<?php for($x=1;$x<=17;$x++) { ?>
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="<?php echo($x); ?>">
										<?php echo($x); ?></a></li>
										<?php } ?>
								 	
								</ul>
								<input type="hidden" name="age" value="0" id="age" disabled="disabled"/>
			   					</span>
			   				
			   				
			   					<span class="dropdown ageDropDwnToggle ageRawToggle_5" style="display: none;" 
									id="ageDropDwn_5_3">
									
								<button class="btn btn-default dropdown-toggle cssboxmarginclass special_englishfont_load" type="button" id="ageDrpdwnBtn" data-toggle="dropdown" value="1">
									1
									<span class="glyphicon glyphicon-chevron-down"></span>
								</button>
								<ul class="dropdown-menu scrollable-menu special_englishfont_load" role="menu" aria-labelledby="ageDrpdwn" id="ageDrpdwnUl">
										
										<?php for($x=1;$x<=17;$x++) { ?>
										<li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-value="<?php echo($x); ?>">
										<?php echo($x); ?></a></li>
										<?php } ?>
								 	
								</ul>
								<input type="hidden" name="age" value="0" id="age" disabled="disabled"/>
			   					</span>
			   				
			   				</div>
			   				<div class="clearfix"></div>
			   				
						
					</div>
					
					<div class="modal-footer">
				        <button type="button" id="updateRoomsBtn" class="btn btn-primary">Update</button>
			      	</div>
				</div>
			</div>
			</div>
      


		<div class="input-group col-lg-1 col-sm-1 text-center ogh_submitwrap">
			<button class="btn searchsubmit" type="submit">
				 <?php echo($ogn_rw_view_search_btntxt); ?>
			</button>
	    </div>
<div class="clearfix"></div>

	</div>
	
	</form>