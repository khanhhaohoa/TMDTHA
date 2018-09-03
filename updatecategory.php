<div id="here">
<?php
set_time_limit(0);
include "class/func.php";
$data  = $mysql->where('shopee_category', 0)->get('product');
echo 'Total: '.count($data).'<br />';
$html = '';
for($i=0;$i<count($data);$i++){
	$mini = $mysql->where('child_id_2', $data[$i]['primarycategory'])->get('mini_child_category_laz');
	if($mini[0]['laz_child_name_2'] != null){
		$a = $mini[0]['laz_child_name_2'];
		$b = $mini[0]['laz_child_name_1'];
		$c = $mini[0]['laz_name'];
		#echo $mini[0]['child_id_2'].' | '.$data[$i]['name'].' | <b>'.$c.' -> '.$b.' -> '.$a.'</b><br />';
		$html .= '<tr id="row'.$i.'">
		<td id="id'.$i.'">'.$mini[0]['child_id_2'].'</td>
		<td id="name'.$i.'">'.$data[$i]['name'].'</td>
		<td id="category'.$i.'">'.$c.' -> '.$b.' -> '.$a.'</td>
		<td id="shopee'.$i.'">'.$data[$i]['shopee_category'].'</td>
		<td>
		<input type="button" id="edit_button'.$i.'" value="Edit" class="edit" onclick="edit_row('.$i.')">
		<input type="button" id="save_button'.$i.'" value="Save" class="save" onclick="save_row('.$i.')">
		<input type="button" value="Delete" class="delete" onclick="delete_row('.$i.')">
		</td>
		</tr>';

	}else{
		$a = $mysql->where('laz_id', $data[$i]['primarycategory'])->get('mini_child_category_laz');
		$b = $a[0]['laz_child_name_2'];
		$c = $a[0]['laz_child_name_1'];
		$d = $a[0]['laz_name'];
		#echo $data[$i]['primarycategory'].' | '.$data[$i]['name'].' | <b>'.$d.' -> '.$c.' -> '.$b.'</b><br />';
		#echo '######## <br />';
		$html .= '<tr id="row'.$i.'">
		<td id="id'.$i.'">'.$data[$i]['primarycategory'].'</td>
		<td id="name'.$i.'">'.$data[$i]['name'].'</td>
		<td id="category'.$i.'">'.$d.' -> '.$c.' -> '.$b.'</td>
		<td id="shopee'.$i.'">'.$data[$i]['shopee_category'].'</td>
		<td>
		<input type="button" id="edit_button'.$i.'" value="Edit" class="edit" onclick="edit_row('.$i.')">
		<input type="button" id="save_button'.$i.'" value="Save" class="save" onclick="save_row('.$i.')">
		<input type="button" value="Delete" class="delete" onclick="delete_row('.$i.')">
		</td>
		</tr>';
	}
}
?>
<div id="wrapper">
<table align='center' cellspacing=2 cellpadding=5 id="data_table" border=1>
<tr>
<th>ID</th>
<th>NAME</th>
<th>Category</th>
<th>SHOPEE</th>
</tr>

<?php echo $html; ?>
<tr>
<td><input type="text" id="new_name"></td>
<td><input type="text" id="new_country"></td>
<td><input type="text" id="new_age"></td>
<td><input type="button" class="add" onclick="add_row();" value="Add Row"></td>
</tr>

</table>
</div>

</body>
</div>
<script type="text/javascript">
function edit_row(no)
{
 document.getElementById("edit_button"+no).style.display="none";
 document.getElementById("save_button"+no).style.display="block";
	
 var name=document.getElementById("name"+no);
 var country=document.getElementById("category"+no);
 var age=document.getElementById("shopee"+no);
	
 var name_data=name.innerHTML;
 var country_data=country.innerHTML;
 var age_data=age.innerHTML;
	
 //name.innerHTML="<input type='text' id='name_text"+no+"' value='"+name_data+"'>";
 //country.innerHTML="<input type='text' id='country_text"+no+"' value='"+country_data+"'>";
 age.innerHTML="<input type='text' id='age_text"+no+"' value='"+age_data+"'>";
}

function save_row(no)
{
 var id=document.getElementById("id"+no).innerText;
 //var name_val=document.getElementById("name_text"+no).value;
 //var country_val=document.getElementById("country_text"+no).value;
 var age_val=document.getElementById("age_text"+no).value;
 var xhttp = new XMLHttpRequest();
 console.log(id);
 console.log(age_val);
 xhttp.open("GET", "update.php?id=" + id + "&shopee=" + age_val, true);
 xhttp.send();
 //document.getElementById("name"+no).innerHTML=name_val;
 //document.getElementById("category"+no).innerHTML=country_val;
 document.getElementById("shopee"+no).innerHTML=age_val;

 document.getElementById("edit_button"+no).style.display="block";
 document.getElementById("save_button"+no).style.display="none";
 document.getElementById("row"+no+"").outerHTML="";
 location.reload();
}

function delete_row(no)
{
 document.getElementById("row"+no+"").outerHTML="";
}

function add_row()
{
 var new_name=document.getElementById("new_name").value;
 var new_country=document.getElementById("new_country").value;
 var new_age=document.getElementById("new_age").value;
	
 var table=document.getElementById("data_table");
 var table_len=(table.rows.length)-1;
 var row = table.insertRow(table_len).outerHTML="<tr id='row"+table_len+"'><td id='name_row"+table_len+"'>"+new_name+"</td><td id='country_row"+table_len+"'>"+new_country+"</td><td id='age_row"+table_len+"'>"+new_age+"</td><td><input type='button' id='edit_button"+table_len+"' value='Edit' class='edit' onclick='edit_row("+table_len+")'> <input type='button' id='save_button"+table_len+"' value='Save' class='save' onclick='save_row("+table_len+")'> <input type='button' value='Delete' class='delete' onclick='delete_row("+table_len+")'></td></tr>";

 document.getElementById("new_name").value="";
 document.getElementById("new_country").value="";
 document.getElementById("new_age").value="";
}
</script>