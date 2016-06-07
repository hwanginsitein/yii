/**
 * @describe gotop
 * @author gaohong
 * @create 2011-11-16 14:50
 * @update 2011-11-16 14:50
 */

(function(){
	var $gt = $('.go-top');
	if($gt.length <= 0){
		return;
	}

	$(window).bind('scroll resize',function(){
		//fix ie6 pos:fixed
		if(App.ie6){
			$gt.attr('class',$gt.attr('class'));
		}
	});
	
	$gt.find('.go-top-btn').click(function(){
		$('body,html').animate({scrollTop:0},500);
		return false;
	})
	
})();
