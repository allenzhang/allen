window.onload = function(){
	//首页轮播
    $('.carousel').carousel();
    $('div[name="Carousel_img"]').bind({
        mouseover: function(){
            $('#prev').css('display', 'block');
            $('#next').css('display', 'block');
        },
        mouseout: function(){
            $('#prev').css('display', 'none');
            $('#next').css('display', 'none');
        }
    });
}

$(function(){          
		var isIE = /msie/.test(navigator.userAgent.toLowerCase());   
		if(isIE) {    
			$('#nav').remove();
		}else{       
			$('#ieNav').remove();
			$('#nav').css('display','block');
		} 
})
