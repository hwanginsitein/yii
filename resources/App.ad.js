/*
 * Version:  v1.1
 * Author:   gaohong
 * Recently: gaoli (2011-12-19)
 */

(function(win){
	$('.ad-close').click(function(){
		$(this).parent().fadeOut();
	}).fadeIn();
	
	$('.ad-cycle').each(function(){
		var $this =$(this);
		$this.cycle({
			fx:'fade',
			speed:'fast',
			timeout:8000
		});
	});
	$('.projection-ad').each(function(){
		var $this = $(this),
			
			delay = 3000,
			$replay = $this.find('.projection-ad-replay').click(init),
			to = parseInt(($replay.attr('timeout')||5000)/1000),
			toStart = to,
			replayText = $replay.text(),
			$close = $this.find('.projection-ad-close').click(close),
			$content = $this.find('.projection-ad-content'),
			_t;
		
		function init(){
			if($replay.hasClass('countdown')){
				return;
			}
			//debugger;
			$this.show();
			to = toStart;
			$replay.text(to).addClass('countdown');
			$content.slideDown('slow',countdown);
			
		}
		
		function close(){
			clearInterval(_t);
			$content.slideUp('slow',function(){
				$replay.text(replayText).removeClass('countdown');
				
			});			
		}
		function countdown(){
			_t = setInterval(function(){
				to--;
				$replay.text(to);
				if(to<=0){
					close();
				}
			},1000);
		}
		setTimeout(init,delay);
	});
	
	$('.pop-ad').each(function(){
		var $this = $(this),
		to = $this.find('.pop-ad-content').attr('timeout')||5000;
		if(App.ie6){
			$this.append('<iframe class="fix-ie6" src="javascript:;" frameborder="0"></iframe>');
		}
		
		setTimeout(function(){
			$this.fadeOut();
		},to);
	});
	
	var $adjustWidth = $('.ad-adjust-width').attr('auto-hidden','true');
	//debugger;
	var floatAdWidtn;
	if(window.location.href=='http://www.19lou.com/' || window.location.href=='http://www.19lou.com/index.html' || window.location.href=='http://www.19lou.com/home.html'){
		floatAdWidtn=1400;
	}else{
		floatAdWidtn=1200;
	}
	if(document.documentElement.clientWidth>=floatAdWidtn){
		$adjustWidth.show().removeAttr('auto-hidden');
	}
	$(win).bind('resize',function(){	
		if(document.documentElement.clientWidth<floatAdWidtn){
			$adjustWidth.filter(':visible').hide().attr('auto-hidden','true');
		}
		else{
			$adjustWidth.filter('[auto-hidden]').show().removeAttr('auto-hidden');
		}
	});
	//页角广告
	$('.corner-ad').each(function(){
		var $this = $(this),
			$embeds= $this.find('.corner-ad-thumbnail,.corner-ad-main'),
			$cornerAdMain = $this.find('.corner-ad-main'),
			_t;
		win.toggleCornerAd = function(){
			$embeds.toggle();
			clearTimeout(_t);
			if($cornerAdMain.is(':visible')){
				_t = setTimeout(function(){
					$embeds.toggle();
				},8000);
			}
		}	
	});
	//debugger;
	if($.browser.msie&&$.browser.version == 6){
		
		$('.ad-ie6fixed-top').each(function(){
			
			var $this = $(this),
				ot = this.currentStyle.top;// origin top
				if(/%$/.test(ot)){
					ot = this.offsetParent.clientHeight * parseInt(ot)/100;
				}
				else{
					ot = parseInt(ot)
				}
			$(win).bind('scroll resize',function(){
				$this.css({'top':ot + parseInt(document.documentElement.scrollTop)});
			});
		});

		$('.ad-ie6fixed-bottom').each(function(){
			var t = this;
			$(window).bind('scroll',function(){
				t.className = t.className; //更新 viewport
			});				
		});
	}

    // ad lazyload
    $(function() {
        $(".lazyImage").each(function() {
            var self = $(this),
                _src = self.attr("lzsrc");

            self.attr({
                "src" : _src
            })
        })
    })
})(window);
