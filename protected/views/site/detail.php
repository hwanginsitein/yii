<div class="layout">
    <div class="bread J_bread">
        <a href="/"><span>首页</span></a> 
        <span class="">&gt;</span>
        <span><span itemprop="title">催欠信息</a></span>
    </div>
    <div class="box">
        <div class="box-main clearall">
            <div class="main">
                <div class="box-data">
                    <div class="box-hd">
                        <h3>催欠信息</h3>
                        <span></span>
                    </div>
                    <div class="box-bd">
                        <table cellpadding="0" cellspacing="0" class="detail">
                            <tbody>
                                <tr>
                                    <th>催欠金额：</th>
                                    <td><?=$contactUser->debt_money?>元</td>
                                </tr>
                                <tr>
                                    <th>催欠项目：</th>
                                    <td>
                                        <?php
                                            $uploadDoc = UploadDocs::model()->findByPk($contactUser->docsId);
                                            echo $uploadDoc->type;
                                        ?>催欠
                                    </td>
                                </tr>
                                <tr>
                                    <th>委托人姓名：</th>
                                    <td><?=$contactUser->clientele?></td>
                                </tr>
                                <tr>
                                    <th>
                                        被催欠人：
                                    </th>
                                    <td>
                                        <?=$contactUser->name?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        身份证号：
                                    </th>
                                    <td>
                                        <?=substr_replace($contactUser->ID_number,"********",-12,8)?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        手机：
                                    </th>
                                    <td>
                                        <?=substr_replace($contactUser->ID_number,"****",-8,4)?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        地区：
                                    </th>
                                    <td>
                                        江西省
                                        吉安市
                                        <?=$contactUser->region?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        详细地址：
                                    </th>
                                    <td>
                                        <?=$contactUser->address?>
                                        <?=substr_replace($contactUser->address,"******",-6,6)?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        账户编号：
                                    </th>
                                    <td>
                                        <?=$contactUser->account_number?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        停机日期：
                                    </th>
                                    <td>
                                        <?=$contactUser->overdue_time?>
                                    </td>
                                </tr>
                                                                
                                <tr>
                                    <th>
                                        当前状态：
                                    </th>
                                    <td>
                                        <?=$contactUser->status==1?"已通过":"待审核"?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="deal">
                            我有异议 我已缴费
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
            </aside>
        </div>
    </div>