;(function(){
    var login = {};

    /**
     * 版本
     * @type {String}
     */
    login.version = "1.0";

    /**
     * 版本
     * @type {String}
     */
    login.url = "/outsite/login";
    var url = "", appType="", invite="", inviteType="", r="", refer = "", unbindWindow="",

    outSiteLogin = function(obj,loginUrl){
        appType = $(obj).attr("data-type");
        invite = $(obj).attr("data-invite");
        inviteType = $(obj).attr("data-invite-type");
        r = $(obj).attr("data-r");
        refer = $(obj).attr("data-refer");
        url = loginUrl + "?appType=" + appType;
        unbindWindow = $(obj).attr("data-need-unbind");
        if(unbindWindow) $(window).unbind();
        if (invite) {
        	url += "&invite=" + invite;
        	url += "&type=" + inviteType;
        }
        if (r) url += "&r=" + r;
        if (refer) url += "&refer=" + refer; else url += "&refer=" + encodeURIComponent(window.location.href);
        window.location.href = url;

    };
    loginDelegate = function(){
        $("body").delegate(".J_outsiteLogin", "click", function() {
            outSiteLogin(this, login.url);
            return false;
        });
    };
    loginDelegate();
})();