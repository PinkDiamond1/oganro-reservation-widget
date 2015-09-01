var cache = {};
var dropDownIconStyle = '<span class="glyphicon glyphicon-chevron-down"></span>';
		
(function($) {
	
	var nighttxt ='Night';
	var nightstext ='Nights';
	
	var defaultNights = 2;
	
	initNightsDropDown = function(nights){
		$("#noofnights").val(nights);
		$("#nightsDrpdwnBtn").val(nights);
		
		if(defaultNights==1){
			$("#nightsDrpdwnBtn").html('<span> '+nights + ' '+nighttxt+'</span> '+dropDownIconStyle);
		}else{
			$("#nightsDrpdwnBtn").html('<span> '+nights + ' '+nightstext+'</span> '+dropDownIconStyle);
		}
	};
	
	initNightsDropDown(defaultNights);
	
	
	adjustToDate = function(nights){
		var fromDate = $(".input-group.date.from_date").datepicker('getDate');
		//console.log("From DT="+fromDate);
		//console.log("nights="+nights);
		
		if (!isNaN(fromDate)) {
			$("#noofnights").val(nights);
			
			var endDate = fromDate;
			var minDateObj = new Date(endDate); 
			var minDate = new Date(minDateObj.getFullYear(), minDateObj.getMonth(), minDateObj.getDate()+1);
			endDate.setDate(endDate.getDate() + Number($("#noofnights").val()));
			
			$(".input-group.date.to_date").datepicker('setStartDate', minDate);
			$('.input-group.date.to_date').datepicker('setDate',endDate);
		}
	};

	$("#nightsDrpdwnUl li a").click(function() {
	
		if($(this).data('value') == 1 ? true : false){
			$(this).parents('.dropdown').find('.btn').html($(this).text() + ' '+nighttxt+' '+dropDownIconStyle);
		} else {
			$(this).parents('.dropdown').find('.btn').html($(this).text() + ' '+nightstext+' '+dropDownIconStyle);
		}
		
		var nights = $(this).data('value');
		
		$(this).parents(".dropdown").find('.btn').val(nights);
		
		adjustToDate(nights);
	});
	
	$.fn.datepicker.defaults = {
		    allowDeselection: false,
		};
	
	$('.input-group.date.from_date').datepicker({
	    language: 'en',
	    format: "dd-M-yyyy",
	    startDate: "0d",
	    forceParse:'false',
	    startView: 0,
	    minViewMode: 0,
	    todayBtn: false, 
	    autoclose: true,
	    todayHighlight: true
    }).on('changeDate', function(ev){
        adjustToDate($("#noofnights").val());
    });
	
	$('.input-group.date.to_date').datepicker({
	    language: 'en',
	    format: "dd-M-yyyy",
	    startDate: "+1",
	    forceParse:'false',
	    startView: 0,
	    minViewMode: 0,
	    autoclose: true,
	    todayHighlight: true
	}).on('changeDate', function(ev){
		var toDate = $(".input-group.date.to_date").datepicker('getDate');
		if (!isNaN(toDate)) {
			var checkIn = $(".input-group.date.from_date").datepicker('getDate');
			var checkOut = $(".input-group.date.to_date").datepicker('getDate');
			var oneDay = 1000 * 60 * 60 * 24;
			var dateDifferent = Math.ceil((checkOut - checkIn) / oneDay);
			if (dateDifferent >= 1 && dateDifferent <= 30) {
				initNightsDropDown(dateDifferent);
			} else if (dateDifferent < 1) {
				console.log('dateDifferent ==>' + dateDifferent);
			} else if (dateDifferent > 30) {
				initNightsDropDown(30);
				checkOut.setDate(checkOut.getDate() - 30);
				$('.input-group.date.from_date').datepicker('setDate',checkOut);
			}
		} 		
    });
	
	var checkinDate = new Date();
	checkinDate.setDate(checkinDate.getDate() + 3);
	$('.input-group.date.from_date').datepicker('setDate',checkinDate).datepicker('update');
	
   	/* $("#searchboxform").validate({
        rules: {
        	autocompleter_city:{
                minlength: 3,
                maxlength: 20,
                required: true
            }
        }
    }); */
	
	
	/* $("#starRatingDrpdwnUl li a").click(function() {
		$(this).parents('.dropdown').find('.btn').html($(this).text()+' '+dropDownIconStyle);
		$(this).parents(".dropdown").find('.btn').val($(this).data('value'));
	}); */
	
	popMouseEnter = function () {
		
		var noOfRms=$("#noOfRoomsDrpdwnBtn").val();
		
		var mHtml ='';
		
		if (noOfRms>0) {
			
			for ( var rm = 1; rm <= noOfRms; rm++) {
				
				var adults = $("#adultsDwn_"+rm).find('.btn').val();
				var children = $("#childrenDropDwn_"+rm).find('.btn').val();
				
				mHtml +='<div class="popoversecdiv"><div class="popoversecdivroom"><div>Room '+ rm +'</div><div><div class="badge popadults floatLeft">'+adults+'</div>' +
				'&nbsp;<div class="seacrhpopover_adults floatLeft">Adults</div></div>';
				
				if(children>0){
					mHtml+='&nbsp;Children&nbsp;<div class="badge popchild floatLeft">'+children+'</div>';
					mHtml+='&nbsp;<div><div class="floatLeft">Age:</div>&nbsp;';
					for ( var ch = 1; ch <= children; ch++) {
						
						var age = $("#ageDropDwn_"+rm+"_"+ch).find('.btn').val();
						mHtml+='<div class="badge agebadge">'+age+'&nbsp;</div>';
					}
					mHtml+='';
				}
				mHtml+='</div></div>';
				
			}
		} else {
			if (noOfRms==-1) {
				mHtml ='<div class="popoversecdiv"><div class="popoversecdivroom"><div>Room 1:</div> '+
					'<div><div class="badge popadults floatLeft">2</div><div class="seacrhpopover_adults floatLeft">Adults</div></div></div></div>';
			} else if (noOfRms==-2){
				mHtml ='<div>Room 1: '+
					'Adults&nbsp;<span class="badge">1</span></div>';
			}
		}
		$("#popovercontent").html(mHtml);
		
	};
	
	initOccupancy = function(noOfRooms,isToggle){
		if(noOfRooms>0){
			$("#noofrooms").val(noOfRooms);
		}
		
		$("#adultsDwn_2, #adultsDwn_3, #adultsDwn_4, #adultsDwn_5").find('#adults').prop('disabled', true);
		$("#adultsDwn_2, #adultsDwn_3, #adultsDwn_4, #adultsDwn_5").hide();
		
		$("#childrenDropDwn_2, #childrenDropDwn_3, #childrenDropDwn_4, #childrenDropDwn_5").hide();
		$("#childrenDropDwn_2, #childrenDropDwn_3, #childrenDropDwn_4, #childrenDropDwn_5").prop('disabled', true);
		
		$(".ageDropDwnToggle").hide();
		$(".ageLblToggle").hide();
		
		if(isToggle){
			$('#rmOccupancyModal').modal('toggle');
		}

		if (noOfRooms > 0) {
			
			var adltArr = [];
			var childArr = [];
			var ageArr = [];
			//console.log("adltArr: "+adltArr);
			//console.log("childArr: "+childArr);
			//console.log("ageArr: "+ageArr);
			
			for ( var rm = 1; rm <= noOfRooms; rm++) {
				//console.log("adltArrX: "+adltCount);
				$("#adultsDwn_"+rm).find('#adults').prop('disabled', false);
				$("#adultsDwn_"+rm).show();
				
				if(!isToggle){ 
					var adltCount = adltArr[rm-1];
					$("#adultsDwn_"+rm).find('.btn').val(adltCount);
					$("#adultsDwn_"+rm).find('.btn').html(adltCount+" Adults ggh <span class='glyphicon glyphicon-chevron-down'></span>");
					$("#adultsDwn_"+rm).find('#adults').val(adltCount);
				}
				
				$("#childrenDropDwn_"+rm).find('#children').prop('disabled', false);
				$("#childrenDropDwn_"+rm).show();
				
				var childCount = 0;
				
				if(!isToggle){
					childCount = childArr[rm-1];
				} else {
					childCount = $("#childrenDropDwn_"+rm).find('.btn').val();
				}
				
				if(childCount>0){
					if(!isToggle){
						$("#childrenDropDwn_"+rm).find('.btn').val(childCount);
						$("#childrenDropDwn_"+rm).find('.btn').html(childCount+" Children <span class='glyphicon glyphicon-chevron-down'></span>");
						$("#childrenDropDwn_"+rm).find('#children').val(childCount);
					}
					
					$("#age_lbl_"+rm).show();
					for ( var ch = 1; ch <= childCount; ch++) {
						$("#ageDropDwn_"+rm+"_"+ch).find('#age').prop('disabled', false);
						$("#ageDropDwn_"+rm+"_"+ch).show();
						
						if(!isToggle){
							var age = ageArr[(ch-1)+(rm-1)];
							$("#ageDropDwn_"+rm+"_"+ch).find('.btn').val(age);
							$("#ageDropDwn_"+rm+"_"+ch).find('.btn').html(age+" <span class='glyphicon glyphicon-chevron-down'></span>");
							$("#ageDropDwn_"+rm+"_"+ch).find('#age').val(age);						
						}
					}
				}
				
			}
			
		}
	};
	
	$("#noOfRoomsDrpdwnUl li a").click(function() {
		
		var noOfRooms = $(this).data('value');
		
		var isToggle = false;
		if(noOfRooms>0){
			isToggle = true;
		}else if(noOfRooms==-1 ){
			$("#noofrooms").val(1);
			$("#adultsDwn_1").find('#adults').val("2");
		}else if(noOfRooms==-2){
			$("#noofrooms").val(1);
			$("#adultsDwn_1").find('#adults').val("1");
		}
		initOccupancy(noOfRooms,isToggle);
		
		$(this).parents('.dropdown').find('.btn').html($(this).text()+' '+dropDownIconStyle);
		$(this).parents(".dropdown").find('.btn').val(noOfRooms);
		
		popMouseEnter();
		
	});
	
	$('#updateRoomsBtn').click(function () {
		    var btn = $(this);
		    btn.button('loading');
		    
		    btn.button('reset');
		    $('#rmOccupancyModal').modal('toggle');
	});
	
	$("#adultsDrpdwnUl li a").click(function() {
		$(this).parents('.dropdown').find('.btn').html($(this).text()+' '+dropDownIconStyle);
		var selctdAdults = $(this).data('value');
		$(this).parents(".dropdown").find('.btn').val(selctdAdults);
		$(this).parents(".dropdown").find('#adults').val(selctdAdults);
	});
	
	$("#childrenDrpdwnUl li a").click(function() {
		
		var arr = $(this).parents(".dropdown").prop("id").split('_');
		
		$(".ageRawToggle_"+arr[1]).hide();
		$("#age_lbl_"+arr[1]).hide();
		
		$(this).parents('.dropdown').find('.btn').html($(this).text()+' '+dropDownIconStyle);
		var selctdChildren = $(this).data('value');
		$(this).parents(".dropdown").find('.btn').val(selctdChildren);
		$(this).parents(".dropdown").find('#children').val(selctdChildren);
		
		
		if ($(this).data('value') > 0) {
			
			$("#age_lbl_"+arr[1]).show();
						
			for ( var ch = 1; ch <= $(this).data('value'); ch++) {
				$("#ageDropDwn_"+arr[1]+"_"+ch).find('#age').prop('disabled', false);
				$("#ageDropDwn_"+arr[1]+"_"+ch).show();
			}
			
		}
	});
	
	$("#ageDrpdwnUl li a").click(function() {
		$(this).parents('.dropdown').find('.btn').html($(this).text()+' '+dropDownIconStyle);
		var selctdAge = $(this).data('value');
		$(this).parents(".dropdown").find('.btn').val(selctdAge);
		$(this).parents(".dropdown").find('#age').val(selctdAge);
	});
	
	
	$('#noOfRoomsDrpdwn>.triggerx').popover({
	    trigger: 'hover focus',
	    'placement': 'bottom',
	    html: true,
	    title: function () {
	        return $(this).parent().find('.head').html();
	    },
	    content: function () {
	        return $(this).parent().find('.content').html();
	    }
	    
	}).on('mouseenter', popMouseEnter); 
	
	
	
    
    //var autoCompleterUrl = "http://test.multeehotel.com/common/autocompleter!getLocationList.html";
    var autoCompleterUrl = "http://www.demo.oganro.net/common/autocompleter!getLocationList.html";		    
	
	if ('' != '') {

		document.getElementById('form_reqcurrency').value = '';
	}else{
		//console.log("search box==reqcurrency==>no #session.req_currency ==> IRR");
	} 
	
	try{
    	$("#autocompleter_city").autocomplete({
    		source : function(request, response) {
    		    if ( request.term in cache ) {
	    			response( cache[ request.term ] );
	    			return;
    		    } 
    		    $.ajax({
    			url : autoCompleterUrl,
    			type: "POST",
    			dataType : "jsonp",
    			data : {
    			    featureClass : "P",
    			    style : "full",
    			    maxRows : 12,
    			    term : request.term
    			},
    			success : function(data) {
    			    returnData = $.map(data.cityNameIdList, function(item) {
	    				return {
	    				    label : item.myValue,
	    				    cityId: item.myKey
	    				};
    			    }); 
    			    cache[ request.term ] = returnData;
    			    response(returnData);
    			}
    		    });
    		},
    		
    		delay: 300,
    		minLength : 3,
    		scroll: true,
    		height:   200,
    		select : function(event, ui) {
    		    $('#cityName').val(ui.item.label);
    		    $('#cityId').val(ui.item.cityId);
    		},
    		open : function() {
    		    $(this).removeClass("ui-corner-all").addClass("ui-corner-top");
    		},
    		close : function() {
    		    $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
    		}
    	});	
	
	}catch(ex){
		console.log("ERRROR while generating widget .....");
	}	
	
	$( "#autocompleter_city" ).focus(function(e) {
		$(this).val("");
		$("#cityName").val("");
		$("#cityId").val(0);
	}); 
	
	$('#autocompleter_city').on('input',function(e){ 
        e.target.setCustomValidity('');
	});
	
	/**/
	
	
	setTimeout(function (){
		$( "#autocompleter_city" ).val("");
		if(''!=''){
			$('.input-group.date.from_date').datepicker('setDate','');
			$('.input-group.date.to_date').datepicker('setDate','');
		}
		
		if(""!=''){
			
			//console.log("noofrooms: "+'');
			$("#noOfRoomsDrpdwnBtn").html(" Rooms <span class='glyphicon glyphicon-chevron-down'></span>");
			$("#noOfRoomsDrpdwnBtn").val("");
			initOccupancy('',false);
			popMouseEnter();
		}
		
		if(""!=null && ""!=''){
			
			$("#hotelMappingId").val("");
		}
		
	}, 100);
	
	$("#searchboxform").submit(function(e) {
	     var self = this;
	     e.preventDefault();
	     
	     var m_names = new Array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
	     var fromDate = new Date($(".input-group.date.from_date").datepicker('getDate'));
	     var toDate = new Date($(".input-group.date.to_date").datepicker('getDate'));
	     
	     $("#datefrom").val(fromDate.getDate() + "-" + m_names[fromDate.getMonth()] + "-" + fromDate.getFullYear());
	     $("#dateto").val(toDate.getDate() + "-" + m_names[toDate.getMonth()] + "-" + toDate.getFullYear());
	     self.submit();
	});
	
})(jQuery);