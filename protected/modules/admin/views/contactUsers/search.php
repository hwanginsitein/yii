<form>
	<div class="row1">
		<span>
			区域：
			<select name="region" id="UploadDocs_area">
				<option value="">全部</option>
				<option value="新干县">新干县</option>
				<option value="安福县">安福县</option>
				<option value="峡江县">峡江县</option>
				<option value="永丰县">永丰县</option>
				<option value="吉水县">吉水县</option>
				<option value="吉州区">吉州区</option>
				<option value="青原区">青原区</option>
				<option value="吉安县">吉安县</option>
				<option value="永新县">永新县</option>
				<option value="泰和县">泰和县</option>
				<option value="井冈山市">井冈山市</option>
				<option value="遂川县">遂川县</option>
				<option value="万安县">万安县</option>
			</select>
		</span>
		<span>
			在已上传的文档中搜索：
			<select>
				<option>全部</option>
			</select>
		</span>
	</div>
	<div class="row1">
		委托人<input type="text" name="clientele">
	</div>
	<div class="row1">
		<input type="checkbox" name="receiveLetter[]" value="4">律师函被退回的用户
		<input type="checkbox" name="receiveLetter[]" value="3">拒收律师函的用户
		<input type="checkbox" name="phone1_status" value="1">已更新的用户
		<input type="checkbox" name="objection" value="1">提出异议的用户
		<input type="checkbox" name="ifrepay" value="1">已缴费的用户
	</div>
	<table>
		<thead>
		<tr>
			<th>姓名</th>
			<th>缴费编号</th>
			<th>欠费号码</th>
			<th>身份证号码</th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td><input type="text" name="name"></td>
			<td><input type="text" name="account_number"></td>
			<td><input type="text" name="telephone"></td>
			<td><input type="text" name="ID_number"></td>
		</tr>
		</tbody>
	</table>
	<input type="button" value="搜索" id="search">
</form>
<br>
<hr>
<div id="blank">
	
</div>
<script type="text/javascript">
	$(function(){
		$("#search").click(function(){
			$.ajax({
				type:"POST",
				url:"/admin/contactUsers/search",
				data:$("form").serialize(),
				success:function(data){
					console.log(data);
					$("#blank").html(data);
					$("#search1").DataTable();
				}
			})
		})
	})
</script>