/**
 * App for home
 *
 * hover  toggle makeHtmlByJson
 *
 */
App=$.extend(App,{
    setDefault : {"className":"selected","action":{"options":{},"targets":null},"isGroup":false,"index":0,"status_":null},
    Status: {
        "ANIMATE":0,
        "SLIDE":1,
        "FADE":2,
        "SHOW":3
    },
    getSetDefault : function() {
        var copy = {};
        for (var i in this.setDefault) {
            copy[i] = this.setDefault[i];
        }
        return copy;
    },
    hover :function(unitlist, options) {
        /**
         * @private
         * @type {Object}
         */
        var setting = this.getSetDefault();
        /**
         * @private
         */
        var _that = this;
        /**
         *@private
         */
        setting = $.extend(setting, options);
        //循环注册点击
        unitlist.each(function(index, callback) {
            var _this = $(callback);
            switch (setting.status_) {
                case _that.Status.ANIMATE:;break;
                case _that.Status.FADE:_that.fade(index, _this, setting);break;
                default:
                    _that.normalHov(_this, setting);
            }
        });
    },
    toggle : function(unitlist, options) {
        /**
         * @private
         * @type {Object}
         */
        var setting = this.getSetDefault();
        /**
         * @private
         */
        var _that = this;
        /**
         *@private
         */
        setting = $.extend(setting, options);
        //循环注册点击
        unitlist.each(function(index, callback) {
            var _this = $(callback);
            switch (setting.status_) {
                case _that.Status.ANIMATE:_that.animate(index, _this, setting);break;
                case _that.Status.SLIDE:_that.slide(index, _this, setting);break;
                case _that.Status.SHOW:_that.show(index, _this, setting);break;
                default:_that.normalToggle(index, _this, setting);;
            }
        });

        if (setting.index > 0) {
            unitlist.eq(setting.index - 1).click();
        }

    },
    /**
     * function animate
     * @private
     *
     * @param {number} index
     * @param {Object} _this
     * @param {Object} setting
     */
    animate :function(index, _this, setting) {
        var that = this,no_action = setting.action,target = no_action.targets;
        _this.toggle(
                function() {
                    if (target != null) {
                        target.eq(index).animate(no_action.options, no_action.time);
                    } else {
                    }
                    //             if(setting.isGroup==true){
                    //                 that.getCacheData(this,setting.className).removeClass(className);
                    //             }
                }, function() {
        });
    },
    /**
     * function fade
     * @private
     *
     * @param {number} index
     * @param {Object} _this
     * @param {Object} setting
     */
    fade : function(index, _this, setting) {
        var that = this,no_action = setting.action,target = no_action.targets;
        _this.hover(
                function() {
                    if (target != null) {
                        target.eq(index).fadeTo(no_action.time || "normal", no_action.toOut || 0);
                        if (no_action.isClose != undefined) {
                            target.append(
                                    that.$("<a>", {"href":"javascript:;","class":"close","text":"关闭"}).click(function() {
                                        target.eq(index).fadeTo(no_action.time || "normal", no_action.toIn || 1);
                                    })
                                    );
                        }
                    } else {
                    }
                    //             if(setting.isGroup==true){
                    //                 that.getCacheData(this,setting.className).removeClass(className);
                    //             }
                }, function() {

            if (no_action.isIn == undefined) {
                if (target != null) {
                    target.eq(index).fadeTo(no_action.time || "normal", no_action.toIn || 1);
                } else {
                }
            }
        });
    },
    /**
     * function slide
     * @private
     *
     * @param {number} index
     * @param {Object} _this
     * @param {Object} setting
     */
    slide : function(index, _this, setting) {
        var that = this,no_action = setting.action,target = no_action.targets,className = setting.className;
        _this.toggle(
                function() {
                    _this.addClass(className);
                    if (target != null) {
                        target.eq(index).slideDown(no_action.time || "normal", no_action.options.callback(_this, target.eq(index)));
                    } else {
                    }
                    //             if(setting.isGroup==true){
                    //                 that.getCacheData(this,setting.className).removeClass(className);
                    //             }
                }, function() {
            _this.removeClass(className);
            target.eq(index).slideUp(no_action.time || "normal", no_action.options.callback(_this, target.eq(index)));
        });
    },
    /**
     * function show
     * @private
     * @param {number} index
     * @param {Object} _this
     * @param {Object} setting
     */
    show :function(index, _this, setting) {
        var that = this,no_action = setting.action,target = no_action.targets;
        _this.click(
                function() {
                    _this.addClass(setting.className).siblings().removeClass(setting.className);
                    if (target != null) {
                        target.hide().eq(index).show(no_action.time || "", no_action.options.callback);
                    } else {
                    }
                });
    },
    /**
     * function normalHov
     * @private
     * @param {Object} _this
     * @param {Object} setting
     *
     */
    normalHov : function(_this, setting) {
        var className = setting.className;
        _this.hover(function() {
            _this.addClass(className);
        }, function() {
            _this.removeClass(className);
        });
    },
    /**
     * function normalToggle
     * @private
     * @param {number} index
     * @param {Object} _this
     * @param {Object} setting
     *
     */
    normalToggle : function(index, _this, setting) {
        var className = setting.className,no_action = setting.action,target = no_action.targets;
        _this.click(function() {
            _this.addClass(className).siblings().removeClass(className);
            if (target != null) {
                target.removeClass(setting.className).eq(index).addClass(className);
            }
            if (no_action.options.callback) {
                no_action.options.callback(this);
            }
        });
    },
    /**
     * function makeHtmlByJson
     * @private
     * @param {Object} j
     * @return {Object} hd
     *
     */
    makeHtmlByJson : function(j) {
        /**
         * @private
         * @type {Object} oj
         */
        var oj = j;
        /**
         * @private
         * @type {Object} hd
         */
        var hd = this.$(oj.nodeType, oj.props);
        if (oj.childNode != undefined) {
            for (var i = 0; i < oj.childNode.length; i++) {
                hd.append(this.makeHtmlByJson(oj.childNode[i]));
            }
        }
        return hd;
    }
});