<table id="repaystable">
    <thead>
        <tr>
            <th>名字</th>
            <th>缴费日期</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($repays as $repay){?>
        <tr>
            <td><?=$repay['debtor']?></td>
            <td><?=$repay['pay_date']?></td>
        </tr>
    <?php }?>
    </tbody>
    <tfoot>
        <tr>
            <th>名字</th>
            <th>缴费日期</th>
        </tr>
    </tfoot>
</table>