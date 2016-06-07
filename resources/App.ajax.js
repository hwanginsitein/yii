/*
 * From:sbsAjax
 */
	App.add({
		ajax:function(id,options){
			//clearWinTips
			if($.clearWinTips){
				$.clearWinTips();
			}
			//init
			var obj = $(id),
				obj_disabled = obj.hasClass("disabled"),
				obj_text = obj.text(),
				opt_success = options.success,
				opt_hold = options.hold || false,
				btn_toggle = function(){
					obj.filter(".confirm-btn , .options-btn").toggleClass("disabled-small");
					obj.filter(".submit-btn,.reply-btn,.option-btn").toggleClass("disabled-big");					
				};
			if(!obj_disabled){
				obj.addClass("disabled");
				loadTime = setTimeout(function(){
					obj.find("span").text("提交中").prepend("<span class='loading'>loading</span>");
				},3000);
				
				btn_toggle();
				defaults = {
					success:function(data){
						clearTimeout(loadTime);
						
						btn_toggle();
						if(!opt_hold || !data.Success){
							obj.removeClass("disabled");
						}
						obj.find("span").text(obj_text);

						if(data.Code == 1199){
							App.tips({type: "error" ,message: "你尚未登录，请登录！" , autoclose: 3, redirectUrl:"/login"});
			            } else if (data.Code == 8888) {
							App.tips({type: "error" ,message: "提交次数过多，请稍后再提交！" , autoclose: 3});
			            } else if (data.Code == 7777) {
							App.tips({type: "error" ,message: "你还没有激活，请先激活！" , autoclose: 3,redirectUrl:"/util/email/active"});
						}else{
							opt_success(data);
						}
					}
				};
				if(!options.contentType){
					defaults.contentType = 'application/x-www-form-urlencoded; charset=UTF-8';
				};
				options = $.extend({},options,defaults);
				//ajax
				$.ajax(options);
			}	
		}
	});