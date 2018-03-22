<?php
	defined('myeshop') or die('Доступ запрещён!');
?>
<script type="text/javascript">
	$(document).ready(function() {
		$('#blocktrackbar').trackbar({
			onMove : function() {
				document.getElementById("start-price").value = this.leftValue;
				document.getElementById("end-price").value = this.rightValue;	
			},
			width : 160,
			leftLimit : 1,
			leftValue : <?php
				if ((int)$_GET["start-price"] >= 1 AND (int)$_GET["start-price"] <= 500)
				{
					echo(int)$_GET["start-price"]; 
				}
				else
				{
					echo "1";
				}
			?>,
			rightLimit : 500,
			rightValue : <?php
				if ((int)$_GET["end_price"] >= 1 AND (int)$_GET["end_price"] <= 500)
				{
					echo(int)$_GET["end_price"]; 
				}
				else
				{
					echo "250";
				}
			?>,
			roundUp : 10
		});
	});
</script>
<div id="block-parameter">
	<p class="header-title" >Поиск по параметрам</p>
	<p class="title-filter">Стоимость</p>
	<form method="GET" action="search_filter.php">
		<div id="block-input-price">
			<ul>
				<li><p>от</p></li>
				<li><input type="text" id="start-price" name="start_price" value="1" /></li>
				<li><p>до</p></li>
				<li><input type="text" id="end-price" name="end_price" value="500" /></li>
				<li><p>руб</p></li>
			</ul>
		</div>
		<div id="blocktrackbar"></div>
		<p class="title-filter">Жанры</p>
		<ul class="checkbox-brand">
			<?php
				$result = mysql_query("SELECT * FROM category WHERE type='book'",$link);
				If (mysql_num_rows($result) > 0)
				{
					$row = mysql_fetch_array($result);
					do
					{
						$checked_brand = ""; 
						if ($_GET["brand"])
						{
							if (in_array($row["id"],$_GET["brand"]))
							{
								$checked_brand = "checked";
							}
						} 
						echo '
						<li><input '.$checked_brand.' type="checkbox"name="brand[]" value="'.$row["id"].'" id="checkbrend'.$row["id"].'" /><label for="checkbrend'.$row["id"].'">'.$row["brand"].'</label></li>
						'; 
					}
					while ($row = mysql_fetch_array($result));	
				} 
			?>
		</ul>
		<center><input type="submit" name="submit" id="button-param-search" value=" " /></center> 
	</form>
</div>