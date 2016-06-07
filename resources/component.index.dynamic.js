    //登录信息获取
    App.ajax("",{
        type: 'GET',
        dataType: 'json',
        cache: false,
        url: '/ws/AccountService.aspx?action=indexlogininfo',
        success: function(res){
            var login = res.success,
                loginData = res.data,
                loginHtml = "";
            if(!login){
                loginHtml += '<div class="login">';
                if(loginData.isSslModelOn == "true"){
                    loginHtml += '<form id="loginForm" name="loginForm" action="'+loginData.loginSslUrl+'" method="post">';
                } else {
                    loginHtml += '<form id="loginForm" name="loginForm" action="'+loginData.loginUrl+'" method="post">';
                }
                loginHtml += ' <ul>';
                loginHtml += '	<li class="login-txt"><input type="text" placeholder="手机号码/用户名/邮箱" id="uname" class="txt txt-large" name="username"></li>';
                loginHtml += '	<li class="login-txt"><input type="password" id="upwd" class="txt txt-large" name="password"></li>';
                loginHtml += '	<li class="login-keep">';//<a href="'+loginData.lostpassUrl+'" ttname="login_forgetpwd_shouye">忘记密码</a>';
                loginHtml += '<label class="fl"><input type="checkbox" name="keepLogin" checked="checked">自动登录&nbsp;&nbsp;&nbsp;</label>';
                loginHtml += '<label class="fl"><a href="' + loginData.lostpassUrl + '" ttname="login_forgetpwd_shouye">忘记密码</a></label>';
                /*
                loginHtml += '<label class="fl"><input type="checkbox" name="ssl"';
                if(loginData.isSslModelOn == "true"){
                    loginHtml += 'checked="checked"';
                }
                loginHtml += 'onclick="if(this.checked){$(\'#loginForm\').attr(\'action\',\''+loginData.loginSslUrl+'\');}else{$(\'#loginForm\').attr(\'action\',\''+loginData.loginUrl+'\');}">安全登录</label>';
                */
                loginHtml += '</li>';
                loginHtml += '	<li class="login-btn">';
                loginHtml += ' <a ttname="login_entry_shouye_ljdl" id="loginButton" class="btn-login btn" href="javascript:;">登录</a>';
                loginHtml += ' <a id="regist" class="register-btn btn1 btn" name="register-btn" href="'+loginData.registerUrl+'">立即注册</a></li>';
				/*if(loginData.qqZoneTotalFlag == "1" || loginData.sinaTotalFlag == "1"|| loginData.taobaoTotalFlag == "1" || loginData.qihooTotalFlag == "1"){
                    loginHtml += '<li class="login-others">用其他账号登录：';
                    if(loginData.qqZoneTotalFlag == "1"){
						loginHtml += '<a href="javascript:;" ttname="OWS_QQ_entry_homepage" data-type="QQZone" class="qq J_outsiteLogin"></a>';
                    }
                    if(loginData.sinaTotalFlag == "1"){
						loginHtml += '<a href="javascript:;" ttname="OWS_Sina_entry_homepage" data-type="Sina" class="wb J_outsiteLogin"></a>';
                    }
                    if(loginData.taobaoTotalFlag == "1"){
						loginHtml += '<a href="javascript:;" ttname="OWS_Taobao_entry_homepage" data-type="Taobao" class="tb J_outsiteLogin"></a>';
                    }
					if(loginData.qihooTotalFlag == "1"){
						loginHtml += '<a href="javascript:;" ttname="OWS_Qihoo_entry_homepage" data-type="Qihoo" class="qh J_outsiteLogin"></a>';
                    }
                    loginHtml += '</li>';
                }*/
                loginHtml += '</ul></form></div>';
            }else{
                loginHtml += '<div class="logined">'
                loginHtml += '<div class="clearall link6 logined-hd">'
                loginHtml += '<em class="uname"><a href="'+loginData.homeUrl+'"><img src="'+loginData.uavatar+'" alt="'+loginData.username+'" class="avatar"></a>'
                if(loginData.sockpuppet){
                    loginHtml += '<a href="javascript:;" class="mg-more" id="mg-more" title="账号切换"><span class="arrow-down"></span></a>'
                    loginHtml += '<ul class="mg-list">'
                    $(loginData.sockpuppet).each(function(i){
                        var u = this;
                        if(u.spId > 0){
                            loginHtml +=  '<li><a class="switch-sockpuppet" href="#" uid="'+u.uid+'">'+u.uname+'</a></li>'
                        }else{
                            loginHtml +=  '<li><a class="switch-sockpuppet" uid="'+u.uid+'">'+u.uname+'</a></li>'
                        }
                    })
                    if(loginData.showSockpuppetMore){
                        loginHtml +=  '<li><a href="'+loginData.sockpuppetUrl+'">更多&gt;&gt;</a></li>'
                    }
                    loginHtml +=  '</ul>'
                }
                loginHtml +=  '<a href="'+loginData.homeUrl+'">'+loginData.username+'</a>'
                loginHtml +=  '</em>'
                loginHtml += '<a class="logout" href="'+loginData.logoutUrl+'">[退出]</a>'
                loginHtml +=  '<p class="uadrs"></p>'
                loginHtml +=  '<p class="uopt">'
                var mCount = 0,
                    nCount = 0,
                    rCount = 0,
                    tCount = 0,
                    sCount = 0;
                $.ajax({
                    type: 'GET',
                    dataType: 'json',
					cache: false,
					url: "/ws/AccountService.aspx?action=logininfo",
                    data: {},
                    success: function(res){
                        var userHomeData = res.data;
                        if(res.success){
                            if(userHomeData.msgNewCount > 0){
                                if(userHomeData.msgNewCount > 99)
                                    mCount = 99;
                                else
                                    mCount = userHomeData.msgNewCount;
                            }
                            if(userHomeData.noticeCount > 0){
                                if(userHomeData.noticeCount > 99)
                                    nCount = 99;
                                else
                                    nCount = userHomeData.noticeCount;
                            }
                            if(userHomeData.myReferedCount > 0){
                                if(userHomeData.myReferedCount > 99)
                                    rCount = 99;
                                else
                                    rCount = userHomeData.myReferedCount;
                            }
                            if(userHomeData.threads > 0){
                                if(userHomeData.threads > 9999)
                                    tCount = 9999;
                                else
                                    tCount = userHomeData.threads;
                            }
                            if(userHomeData.coinCount > 0){
                                if(userHomeData.coinCount > 9999)
                                    sCount = 9999;
                                else
                                    sCount = userHomeData.coinCount;
                            }
                            $(".coins").html(sCount);
                            $(".msgNewCount").html(mCount);
                            $(".noticeCount").html(nCount);
                            $(".myReferedCount").html(rCount);
                            $(".threads").html(tCount);
                        }

                    }
                })
                //loginHtml +=   '<a href="'+loginData.msgUrl+'" class="msg"><span>私信</span><em><i class="msgNewCount">'+mCount+'</i></em></a>'
                loginHtml +=   '<a href="'+loginData.noticUrl+'" class="tip"><span>提醒</span><em><i class="noticeCount">'+nCount+'</i></em></a>'
                //loginHtml +=   '<a href="'+loginData.referUrl+'" class="me"><span>@我</span><em><i class="myReferedCount">'+rCount+'</i></em></a>'
                loginHtml +=  '</p>'
                loginHtml +=  '</div>'
                var fCount = 0;
                if(loginData.fans > 0){
                    if(loginData.fans > 9999)
                        fCount = 9999;
                    else
                        fCount = loginData.fans;
                }

                loginHtml +=  '<div class="logined-bd"><div class="udata clearall">'
                //loginHtml +=      '<a href="'+loginData.detailUrl+'"><p>积分</p><div class="coins">'+sCount+'</div></a>'
                //loginHtml +=      '<a href="'+loginData.myThreadUrl+'"><p>帖子</p><div class="threads">'+tCount+'</div></a>'
                //loginHtml +=      '<a href="'+loginData.fansUrl+'"><p>粉丝</p><div>'+fCount+'</div></a>'
                loginHtml +=  '</div>'
                loginHtml += '<p class="tc mt10"><a class="btn uhome" href="'+loginData.homeUrl+'">立即进入</a></p>'
                loginHtml += '</div>'
                if(loginData.noticeShow){
                    loginHtml += '<div id="log-suc">登录成功 : )</div>'
                }
                loginHtml += '</div>'
            }
            
            $("#currentLoginUserInfo").html(loginHtml);
						if(!login){
							$("#regist").click(function(){
								try{
									ttclickAdd("reg_enter_homepage_kszc");
								}catch(err){
								  }
							});
					  }
            $('#log-suc').animate({top:"-30px",opacity:"0"},1200,function(){
                $(this).remove();
            });

            $('.login-box').delegate('#mg-more','click',function(event){
                event.stopPropagation();
                $('.mg-list').show();
            });
            $('body').click(function(){
                $('.mg-list').hide();
            });
            $('.login-box').delegate('.mg-list','click',function(event){
                event.stopPropagation();
            });

            App.placeholder();
            //豪华版首页登录密码框交互
            var pwd = $('#upwd');
            if (('placeholder' in document.createElement('input'))) {
              pwd.attr('placeholder', '密码').addClass("focus");
            } else {
              pwd.focus(function () {
                pwd.addClass("focus");
              }).blur(function () {
                if (this.value == '') {
                  pwd.removeClass("focus");
                }
              }).blur();
            }

            //登录事件
            $("#loginButton").click(function(){
                //$("#loginForm").submit();

                if ($.trim($("#uname").val()) == "" || $.trim($("#upwd").val()) == "") {
                    App.tips({ type: "error", message: "请输入用户名和密码！", autoclose: 3 });
                    return false;
                }

                var data = $('#loginForm').serialize() + "&action=login&backurl=http://pos.jxxqlawyer.com/";
                $.ajax({
                    url: '/ws/AccountService.aspx',
                    data: data,
                    type: 'post',
                    async: false,
                    dataType: "json",
                    success: function (res) {
                        if (res.code == 200) {
                            window.location.href = res.msg.info;
                        }
                        else {
                            App.tips({ type: "error", message: res.msg.err, autoclose: 3 });
                        }
                    },
                    error: function (res) {
                        if (res && res.responseText) {
                            App.tips({ type: "error", message: res.responseText, autoclose: 3 });
                        }
                    }
                });
                return false;
            })

            //回车登录事件绑定
            $("#uname, #upwd").keypress(function(e){
                if( (e.keyCode || e.which) == 13 ){
                    $("#loginForm").submit();
                    return false;
                }
            });

            if(loginData.sockpuppet){
                var sockpuppetJs = loginData.jsForumDomain+'/component.sockpuppet.js'
                AM(sockpuppetJs, function() {
                    $(".switch-sockpuppet").click(function(e){
                        e.preventDefault();
                        Sockpuppet.switchSockpuppetAjaxUrl = "/user/sockpuppet/switch";
                        Sockpuppet.switchSockpuppet($(this).attr("uid"));
                    });
                });
            }
        },
        error:function(){}
    })//$.ajax

    //关注TA
    $(".JFollowOpt").live("click",function(){
       if($("#uname").length > 0){
          $("#uname").focus();
          App.tips({type: "error" ,message: "请先登录" , autoclose: 2})
       }else{
          addAttention(this);
       }
    })

    function  addAttention(obj){
        var _this = $(obj);
        var uid = _this.attr("userId");

        AttentionAct.attention({uids:[uid],callback:function(r){
            if(r.success){
                if(r.data.symbol == true){
                    if(r.data.existList.length > 0)
                        App.tips({type: "right" ,message: "你已经关注该用户!" , autoclose: 3});
                    else
                        AttentionAct.changeGroup(r.data);
                }else{
                    App.tips({type: "error" ,message: "关注失败，请稍后再试" , autoclose: 3});
                }
            }
        }});
    }

    $('.club-list .club').hover(function () {
        $(this).addClass('club-hover');
    }, function () {
        $(this).removeClass('club-hover');
    });

    $('.slide-player').each(function () {
        App.slidePlayer(this,{time: '8000'});
    })
	$('.haodian-slide').each(function () {
        //App.slidePlayer(this,{time: '8000',width:'300px',height:'260px'});
    })

    App.hoverToggle({".community-people dl":"hover"});

    var guide_obj=$(".life-guide-title");
    guide_obj.find("h3").hover(function(){
        guide_obj.find("h3").removeClass("hover");
        $(this).addClass("hover");
        guide_obj.siblings("ul").hide().eq(guide_obj.find("h3").index($(this)[0])).show();
    })

    //搜索
    App.selectBox($(".select"));
    $("#submitBtn").click(function(){
        var keyword = $.trim($("#keyword").val());
        var type = $.trim($(".search-type").find("dt").html());
        if(keyword == "搜你想要的..." || keyword.length == 0){
            if(type == "帖子"){
                url = "http://www.dashou.us/search/?t=2";
            }else if(type == "用户"){
                url = "http://www.dashou.us/search/?t=2";
            }else{
                url = "http://www.dashou.us/search/?t=2";
            }
            window.open(url);
            return false;
        }
        var url = "http://www.dashou.us/search/?t=2";
        if(type == "帖子")
            url = "http://www.dashou.us/search/?t=2";
        if(type == "用户")
            url = "http://www.dashou.us/search/?t=2";
        if(type == "版块")
            url = "http://www.dashou.us/search/?t=2";
        url += "&q="+encodeURIComponent(keyword);
        window.open(url);
    });
	
	App.placeholder({obj:'#keyword'});