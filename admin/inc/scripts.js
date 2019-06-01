
function change_color(value)
{

	color_mass=new Array("black","white","red","green","blue","magenta","cian","yellow","orange");
	for(i=0;i<color_mass.length;i++)
	{
		if(color_mass[i]==value)
		{
			document.getElementById("color_"+color_mass[i]).className='box_color2';
		}
		else
		{
			document.getElementById("color_"+color_mass[i]).className='box_color';
		}
	}
	document.getElementById("color").value=value;
}




$(document).ready(function(){


    $(window).scroll(function(){
    	if ($(document).height() > $(window).height() && $(document).height() - $(window).scrollTop() > $(window).height()) 
    	{

    		$("#button_bottom").css({ 'position' : 'fixed', 'left' : 55, 'bottom' : 69 ,'z-index':10});
    		
    		if(document.getElementById("actions"))
    		{
    			$('#button_bottom_layout').css({'bottom':53 ,'width':380,'height':60,'display':'block'});
    		}
    		else
    		{
    			if(document.getElementById("java_bulk"))
    			{
    				$('#button_bottom_layout').css({'bottom':53 ,'width':230,'height':60,'display':'block'});
    			}
    			else
    			{
    				$('#button_bottom_layout').css({'bottom':53 ,'width':200,'height':60,'display':'block'});
    			}
    		}
   	 	}
    	else 
    	{
    		$('#button_bottom_layout').css({'left':0,'bottom':0 ,'width':0,'height':0,'display':'none'});
    	};
    });
    


    });