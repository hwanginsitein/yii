/*
 *@Description: App.win.js
 *@Version:	    v1.0
 *@Author:      GaoLi
 *@Update:      GaoLi(2011-02-18 16:30)
 */

(function($){
	$.fn.jqDrag = function(h){return i(this,h,'d');};$.fn.jqResize=function(h){return i(this,h,'r');};$.jqDnR={dnr:{},e:0,drag:function(v){if(M.k == 'd')E.css({left:M.X+v.pageX-M.pX,top:M.Y+v.pageY-M.pY});else E.css({width:Math.max(v.pageX-M.pX+M.W,0),height:Math.max(v.pageY-M.pY+M.H,0)});return false;},stop:function(){E.css('opacity',M.o);$(document).unbind('mousemove',J.drag).unbind('mouseup',J.stop);}};var J=$.jqDnR,M=J.dnr,E=J.e,i=function(e,h,k){return e.each(function(){h=(h)?$(h,e):e;h.bind('mousedown',{e:e,k:k},function(v){var d=v.data,p={};E=d.e;if(E.css('position') != 'relative'){try{E.position(p);}catch(e){}}M={X:p.left||f('left')||0,Y:p.top||f('top')||0,W:f('width')||E[0].scrollWidth||0,H:f('height')||E[0].scrollHeight||0,pX:v.pageX,pY:v.pageY,k:d.k};$(document).mousemove($.jqDnR.drag).mouseup($.jqDnR.stop);return false;});});},f=function(k){return parseInt(E.css(k))||false;}
})(jQuery);

App.win = function(options){

	$(".win").remove();

	var winRemove = function(){
		win.remove();
		winBox.remove();
	};

	//options
	var defaults = {
		id:"defaultId",
		title:"",
		content:"",
		loading:0,
		mask:0,
		button:[{
			idname:"confirm_id",
			title:"确定",
			classname:"confirm-btn",
            link:"",
			callback:function(){return true;}
			},{
			idname:"cancel_id",
			title:"取消",
			classname:"options-btn",
            link:"",
			callback:function(){return true;}
		}],
		callback:function() {
			return true;
		},
		tips:"",
        width:"",
		height:""
	};

	//extend
	if(options.button){
		if(!$.isArray(options.button)){
			var obj = options.button;
			options.button = [obj];
		}else if(options.button.length < 2){
			options.button.push("");
		}
		$.each(options.button,function(i){
			options.button[i] = $.extend({},defaults.button[i],options.button[i]);
		})
	}

	options = $.extend({},defaults,options);

	//content
	var contArray = [
		'<div class="win">',
		'<div class="win-mod" id="'+ options.id +'">',
		'<div class="win-hd">',
		'<h3>'+ options.title +'</h3>',
        '<a class="close"  title="关闭">关闭</a>',
		'</div>',
		'<div class="win-bd">',
		'<div class="win-cont"></div>',
		'<div class="win-btn"></div>',
		'</div>',
		'</div>'
	];
	
	if (options.mask) {
		contArray.push('<div class="win-mask"></div>');
	}
	
	contArray = contArray.concat([
		'</div>'
	]);
	
	$(document.body).append(contArray.join(""));

	//loading
	var win = $("#" + options.id),
		winBox = win.parent(),
		winCont = win.find(".win-cont"),
		winBtn = win.find(".win-btn"),
        cssSize={width:options.width,height:options.height};
        //set css
        win.css(cssSize);
	if(options.loading){
		winCont.html("等待中...");
		$.post(options.loading.url,function(data){
			if(options.loading.callback){
				winCont.html(options.loading.callback(data));
			}else{
				winCont.html(data);
			}
		});
	}else{
		(typeof options.content == "string") ? winCont.append(options.content) : winCont.append(options.content.html());
	}
    
	//winClose
    win.find(".close").bind("click",function(){
        (options.callback()) ? winRemove() : "";
    });
	
	//winBtn
    if(options.button){
        $.each(options.button,function(i){
            var link = this.link ? 'href="' + this.link + '" target="_blank"' : "";
            winBtn.append('<a id="' + this.idname + '" class="'+ this.classname + '"' + link + '><span>'+ this.title +'</span></a>');
            var callback = this.callback;
            winBtn.find("a").eq(i).bind("click",function(){
                (callback()) ? winRemove() : "";
            });
        });
    }

	//winTip
	winBtn.append('<span class="win-tip">'+ options.tips +'</span>');

	//winConfig
	var winWidth = win.width(),
		winHeight = win.height(),
		winConfig = function(){
			winBox.css({
				position: (App.ie6) ? "absolute" : "fixed",
				top: (App.ie6) ? $(window).scrollTop() : "0"
			})
			win.css({
				top: $(window).height()/2,
				left: $(window).width()/2,
				marginTop: -winHeight/2,
				marginLeft: -winWidth/2
			})
			if(options.mask){
				winBox.find(".win-mask").css({
					width: $(window).width(),
					height: $(window).height()
				});
			}
		};

	//ie6
	if(App.ie6){
		win.prepend('<iframe frameborder="0" style="position:absolute;top:0;left:0;width:'+ winWidth +'px;height:'+ winHeight +'px;z-index:-1;"></iframe>');
		$(window).scroll(function(){
			winBox.css({"top":$(window).scrollTop()});
		});
	}

	//init
	winConfig();
	win.jqDrag(".win-hd");
	$(window).bind("resize",winConfig);
}

App.winTip = function(options){
	var defaults = {message:"",target:""};
	options = $.extend({},defaults,options);
	$(options.target).addClass("error_txt").focus();
	$(".win-tip").html(options.message);
}

App.clearTip = function(){
	$(".win-tip input").removeClass("error_txt");
	$(".win-tip").html("");
}