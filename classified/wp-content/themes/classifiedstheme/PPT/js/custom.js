// JavaScript Document

jQuery(document).ready(function() { 

	jQuery("a.switch_thumb").toggle(function(){
										
		jQuery(this).addClass("swap");
		jQuery("ul.display").fadeOut("fast", function() {
		jQuery(this).fadeIn("fast").addClass("thumb_view");
		});		
		}, function () {
		jQuery(this).removeClass("swap");
		jQuery("ul.display").fadeOut("fast", function() {
		jQuery(this).fadeIn("fast").removeClass("thumb_view");
		});
		
	});
 		
 
}); 


function toggleLayer( whichLayer )
{
  var elem, vis;
  if( document.getElementById ) 
    elem = document.getElementById( whichLayer );
  else if( document.all ) 
      elem = document.all[whichLayer];
  else if( document.layers ) 
    elem = document.layers[whichLayer];
  vis = elem.style;
 
  if(vis.display==''&&elem.offsetWidth!=undefined&&elem.offsetHeight!=undefined)    vis.display = (elem.offsetWidth!=0&&elem.offsetHeight!=0)?'block':'none';  vis.display = (vis.display==''||vis.display=='block')?'none':'block';
}

function CheckRemaindingQty(total){

	FindQty = jQuery("#CustomQty").text();
	if(FindQty ==""){ FindQty=1; }
	
	ThisQty = document.getElementById('QtyTotal').value; 
	Remain = FindQty*1 + ThisQty*1;
	
	document.getElementById('QtyTotal').value = Remain ;
	 
	if( (  total*1 - Remain*1  ) < 1){ 
	
	//document.getElementById('QtyTotal').disabled=true; 
	
	 
	} 

}

