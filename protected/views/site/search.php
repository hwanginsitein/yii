<div class="layout">
    <div class="bread J_bread">

        <a href="/"><span>首页</span></a> 
        <span class="">&gt;</span>
        <span>搜索</span>
    </div>
    <div class="box">
        <div class="box-main clearall">
            <div class="main">
                <div class="box-data">
                    <div class="box-hd">
                        <h3>催欠列表</h3>
                        <span></span>
                    </div>
                    <table class="box-bd">
                        <thead>
                            <tr class="">
                                <th width="100">催欠编号</th>
                                <th>被催欠人</th>
                                <th width="100">被催欠人地区</th>
                                <th width="80">催欠金额</th>
                                <th width="60">委托状态</th>
                                <th width="40"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($contactUsers as $contactUser){?>
                                <tr>
                                    <td><?=$contactUser->account_number?></td>
                                    <td><?=$contactUser->name?></td>
                                    <td><?=$contactUser->region?></td>
                                    <td><?=$contactUser->debt_money?></td>
                                    <td><?=($contactUser->status)?"通过":"待审核"?></td>
                                    <td><a href="/site/detail/id/<?=$contactUser->id?>" target='_blank'>详情>></a></td>
                                </tr>
                            <?php }?>
                        </tbody>
                    </table>
                    <div class="wpagenavi">
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
            </aside>
        </div>
    </div>
</div>