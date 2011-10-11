// VALIDATE BIDDING PRICE
function CheckBidValue(price,text, minval){
	 
  var ValidChars = "0123456789.";
  var IsNumber=true;
  var Char;

  if(price ==''){alert(text);return false;} 	
	
   for (i = 0; i < price.length && IsNumber == true; i++){ 
   
      Char = price.charAt(i); 
      if (ValidChars.indexOf(Char) == -1){
		  
         alert(text);
		 return false;
		 
         }		 
     }

	if(price <= minval){
		alert(text);
		return false;
	}
	
	
	return true;
	
}

function CheckMessageData(a,b,c,text){
	 
	if(a =='' || b =='' || c ==''){
	
		alert(text);
		return false;
	
	}
	
	return true;
	
	
}

function countWords(heyslay){
	heyslay=heyslay.split("\n").join(" ");
	chocolate=heyslay.split(" ");
	heyslay=0;
	for(da=0;da<chocolate.length;da++){
		if(chocolate[da].length>0){
			heyslay++;
		}
	}
	return heyslay;
}
 