/**
 * @Description: App.header.js
 * @Version:     v3.0
 * @Author:      GaoLi
 */
 
var TIPS_TIMING;
 
App.tips = function(options) {

    var tips = {};

    /**
     * 版本
     * @type {String}
     */
    tips.version = "3.0";

    /**
     * 数据
     * @type {Object}
     */
    tips._data = {
    
        def: {
            type: "right",
            message: "",
            autoclose: 3,
            redirectUrl: "",
            closeBtn: false
        },
        
        jid: {
            tips: "J_tips",
            tipsCont: "J_tipsCont",
            tipsClose: "J_tipsClose"
        },
        
        tpl: [
            '<div id="J_tips" class="tips-mod" {{#ie6}}style="position:absolute;top:{{top}}px;"{{/ie6}}>',
                '<strong>',
                    '<i class="tips-ls"></i>',
                    '<em id="J_tipsCont" class="{{type}}">{{&message}}</em>',
                    '<i class="tips-rs"><a id="J_tipsClose" class="close" {{^closeBtn}}style="display:none"{{/closeBtn}}>关闭</a></i>',
                '</strong>',
                '{{#ie6}}',
                '<iframe class="fix-ie6"></iframe>',
                '{{/ie6}}',
            '</div>'
        ]
        
    };

    /**
     * 工具
     * @type {Object}
     */
    tips._util = {};

    /**
     * 函数
     * @type {Object}
     */
    tips._fn = {};
    
    (function(data, util) {
    
        var def = data.def,
            jid = data.jid;

        /**
         * 通过元素ID生成jQuery对象
         * @param  {String} jid
         * @return {Object}
         */
        util.$ = function(jid) {
            return $("#" + jid);
        };
        
        /**
         * 获取合并参数
         * @return {Object}
         */
        util.getHash = function() {
            return $.extend(def, options, {type: "tips-" + (options.type || def.type)});
        };
        
        /**
         * 是否存在提示
         * @return {Boolean}
         */
        util.hasTips = function() {
            return !!util.$(jid.tips).length;
        };

    })(tips._data, tips._util);
    
    (function(data, util, fn) {
        
        var jid  = data.jid,
            tpl  = data.tpl,
            hash = util.getHash();
        
        /**
         * 创建
         * @param  {String} tpl
         * @param  {Object} hash
         */
        fn.create = function(tpl, hash) {
            AM("mustache.js", function() {
                $("body").append(Mustache.render(tpl, hash));
                fn.bind();
            });
        };
        
        /**
         * 事件
         * @param  {String} tpl
         * @param  {Object} hash
         */
        fn.bind = function() {
            var $tips = util.$(jid.tips);
            
            $tips.delegate(".close", "click", function() {
                // 清除定时
                clearTimeout(TIPS_TIMING);
                // 隐去提示
                $tips.fadeOut();
            });
        };
        
        /**
         * 渲染
         * @param  {String}  type
         * @param  {String}  cont
         * @param  {Boolean} hasBtn
         */
        fn.render = function(type, cont, hasBtn) {
            var $win       = $(window),
                $tips      = util.$(jid.tips),
                $tipsCont  = util.$(jid.tipsCont),
                $tipsClose = util.$(jid.tipsClose);

            if (App.ie6) {
                $tips.css("top", $win.scrollTop() + $win.height() * 0.4);
            }
            
            $tipsCont[0].className = type;
            $tipsCont.html(cont);
            hasBtn ? $tipsClose.show() : $tipsClose.hide();
            $tips.show();
        };

        /**
         * 定时
         * @param  {number} time
         * @param  {String} url
         */
        fn.timing = function(time, url) {
        
            // 清除定时
            clearTimeout(TIPS_TIMING);
            
            TIPS_TIMING = setTimeout(function() {
                
                // 隐去提示
                util.$(jid.tips).fadeOut();
                
                // 跳转页面
                if (!!url) {
                    location.href = url.replace(/#*$/, "");
                }
                
            }, time * 1000);
        };
        
        /**
         * 初始化
         */
        fn.init = function() {
            var $win = $(window);
            
            // IE6 层级
            if (App.ie6) {
                hash.ie6 = true;
                hash.top = $win.scrollTop() + $win.height() * 0.4;
            }
            
            if (util.hasTips()) {
                fn.render(hash.type, hash.message, hash.closeBtn);
            } else {
                fn.create(tpl.join(""), hash);
            }
            
            // IE6 重置滚动
            if (App.ie6 && !util.hasTips()) {
                $win.bind("resize scroll", function() {
                    util.$(jid.tips).css("top", $win.scrollTop() + $win.height() * 0.4);
                });
            }
            
            fn.timing(hash.autoclose, hash.redirectUrl);
        };
        
        fn.init();

    })(tips._data, tips._util, tips._fn);
    
};