<div class="layout">
    <div class="image-list">
        <ul id="slideshow1" class="slide-player">
            <li class="slide-item" style="z-index: 1; display: none;">
                <img src="/resources/b1.jpg">
            </li>
            <li class="slide-item" style="z-index: 3; display: list-item;">
                <img src="/resources/b2.jpg">
            </li>
            <li class="slide-page">
                <a href="javascript:;" title="" class="">1</a>
                <a href="javascript:;" title="" class="trigger">2</a>
            </li>
        </ul>
    </div>
</div>
<div class="box">
    <div class="box-main clearall">
        <div class="main">
            <div id="search">
                <form method="get" action="/site/search">
                    <div class="i-search ld">
                        <ul id="shelper" class="hide"></ul>
                        <div class="form">
                            <input type="text" class="text" accesskey="s" name="q" id="keyword" placeholder="催欠编号/姓名/手机号码/身份证号码" autocomplete="off" value="">
                            <input type="submit" value="搜索" class="button">
                            
                        </div>
                    </div>
                </form>
                <?php
                    $count = ContactUsers::model()->count();
                ?>
                <div class="info">共收录 <?=$count?> 条记录</div>
            </div>
            <div class="box-data">
                <div class="box-hd">
                    <h3>祝贺信息</h3>
                    <span><a href="http://cq.gz-lawfirm.com/congratulation.aspx">更多&gt;&gt;</a></span>
                </div>
                <div class="box-bd">
                    <div id="txtroll">
                        <ul id="txtcontent">
                            <?php foreach($contactusers as $contactuser){?>
                                <li>祝贺 <?=$contactuser->region?> <?=$contactuser->name?> 缴清了（<?=$contactuser->letterNumber?>）话费，谢谢配合！</li>
                            <?php }?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <aside class="side">
            <div class="box-data">
                <div class="box-hd">
                    <h3>催欠流程图</h3>
                    <span></span>
                </div>
                <div class="box-bd">
                </div>
            </div>

            <div class="adbox">
                <a href="http://cq.gz-lawfirm.com/article/?categoryid=8"><img src="/resources/credit.jpg" border="0"></a>
            </div>
            <div class="adbox">
                <a href="http://www.openlaw.cn/" target="_blank"><img src="/resources/openlaw.jpg" border="0"></a>
            </div>
            <div class="adbox">
                <a href="http://zhixing.court.gov.cn/search/" target="_blank"><img src="/resources/court.jpg" border="0"></a>
            </div>
        </aside>
    </div>
</div>