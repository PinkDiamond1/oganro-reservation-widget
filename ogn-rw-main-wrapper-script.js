var l=0;
function f(i){

for (a=0;a<=100;a++){
var nameElem = document.getElementById('i'+a);
if (a<=i) {
	nameElem.classList.add("og_wrapbar");	
}else {
	nameElem.classList.remove("og_wrapbar")
}
		
}
	
im = 'i' + l;
d=document.all[im];
d.height=19;
document.all.form1.t1.value=i;
im = 'i' + i;
d=document.all[im];
d.height=1;
l=i;
}

document.addEventListener('DOMContentLoaded', function() {
var lx=0;
function oncrt(i){
for (a=0;a<=100;a++){
	var nameElem = document.getElementById('i'+a);
	setInterval(function() {           
if (a<=i) {		
	nameElem.classList.add("og_wrapbar");	
}else {		
	nameElem.classList.remove("og_wrapbar")
}
        }, 100)	
}	
im = 'i' + lx;
d=document.all[im];
d.height=19;
document.all.form1.t1.value=i;
im = 'i' + i;
d=document.all[im];
d.height=1;
lx=i;
}

var list = 0;
var x = 0;
var timer = setInterval(function() {	
var nameElem = document.getElementById('i'+list);
nameElem.classList.add("og_wrapbar");	
    if (x <= list) {
		  //console.log(x+"=>"+list);	        
        list += 1;
        document.getElementById('t1').value=list;
        
    }
    else return;
	 if(list == stp) clearInterval(timer);
    x++;    
}, 10);

oncrt("<?php echo($loop); ?>");
}, false);

function ognSliderClick(ogn_slider_count) {
	document.getElementById('ogn_rw_opt_setting_boxwidth_hidden').value=ogn_slider_count;	
}

function ognResetValue() {	
	var ogn_set_val = document.getElementById('ogn_rw_opt_setting_boxwidth_hidden').value;	
	document.getElementById('t1').value = ogn_set_val;
	f(ogn_set_val);
}

jQuery(document).ready(function($){
    $('.my-color-field').wpColorPicker();
});