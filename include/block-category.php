<?php
	defined('myeshop') or die('������ ��������!');
?>
<div id="block-category">
    <p class="header-title">��������� �������</p>
    <ul>
        <li><a id="index1" ><img src="/images/book-icon.gif" id="book-images"/>�����</a>
            <ul class="category-section">
                <li><a href="view_cat.php?type=book"><strong>��� ����� ����</strong></a></li>
				<?php
					$result = mysql_query("SELECT * FROM category WHERE type='book'",$link);
					If (mysql_num_rows($result) > 0)
					{
						$row = mysql_fetch_array($result);
						do
						{
							echo '
							<li><a href="view_cat.php?cat='.strtolower($row["brand"]).'&type='.$row["type"].'">'.$row["brand"].'</a></li>
							';
						}
						while ($row = mysql_fetch_array($result));
					} 
				?>              
			</ul>
		</li>
		<!--<li><a id="index2" ><img src="/images/stationery-icon.gif" id="stationery-images"/>������������ ������</a>
			<ul class="category-section">
				<li><a href="view_cat.php?type=stationery"><strong>��� ��������������</strong></a></li>
				<?php/*
					$result = mysql_query("SELECT * FROM category WHERE type='stationery'",$link);
					If (mysql_num_rows($result) > 0)
					{
						$row = mysql_fetch_array($result);
						do
						{
							echo '
							<li><a href="view_cat.php?cat='.strtolower($row["brand"]).'&type='.$row["type"].'">'.$row["brand"].'</a></li>
							';
						}
						while ($row = mysql_fetch_array($result));
					} 
				?>
			</ul>
		</li>
		<li><a id="index3" ><img src="/images/boardgames-icon.gif" id="boardgame-images"/>���������� ����</a>
			<ul class="category-section">
				<li><a href="view_cat.php?type=boardgames"><strong>��� ����� ���</strong></a></li>
				<?php
					$result = mysql_query("SELECT * FROM category WHERE type='boardgames'",$link);
					If (mysql_num_rows($result) > 0)
					{
						$row = mysql_fetch_array($result);
						do
						{
							echo '
							<li><a href="view_cat.php?cat='.strtolower($row["brand"]).'&type='.$row["type"].'">'.$row["brand"].'</a></li>
							';
						}
						while ($row = mysql_fetch_array($result));
					} 
				*/?>
			</ul>
		</li>-->
	</ul>
</div>	