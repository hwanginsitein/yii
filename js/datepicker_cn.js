$(function() {
    $.datepicker.regional["zh-CN"] = {closeText: "关闭", prevText: "&#x3c;上月", nextText: "下月&#x3e;", currentText: "今天", monthNames: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"], monthNamesShort: ["一", "二", "三", "四", "五", "六", "七", "八", "九", "十", "十一", "十二"], dayNames: ["星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六"], dayNamesShort: ["周日", "周一", "周二", "周三", "周四", "周五", "周六"], dayNamesMin: ["日", "一", "二", "三", "四", "五", "六"], weekHeader: "周", dateFormat: "yy-mm-dd", firstDay: 1, isRTL: !1, showMonthAfterYear: !0, yearSuffix: "年"}
    $.datepicker.setDefaults($.datepicker.regional["zh-CN"]);
    var datePicker = $("#ctl00_BodyMain_txtDate").datepicker({
        showOtherMonths: true,
        selectOtherMonths: true

    });
});
$.datepicker._gotoToday = function (id) {
    var target = $(id); 
    var inst = this._getInst(target[0]); 
    if (this._get(inst, 'gotoCurrent') && inst.currentDay) { 
    inst.selectedDay = inst.currentDay; 
    inst.drawMonth = inst.selectedMonth = inst.currentMonth; 
    inst.drawYear = inst.selectedYear = inst.currentYear; 
    } 
    else { 
    var date = new Date(); 
    inst.selectedDay = date.getDate(); 
    inst.drawMonth = inst.selectedMonth = date.getMonth(); 
    inst.drawYear = inst.selectedYear = date.getFullYear(); 
    this._setDateDatepicker(target, date); 
    this._selectDate(id, this._getDateDatepicker(target)); 
    } 
    this._notifyChange(inst); 
    this._adjustDate(target); 
} 