<?php
define('myeshop', true);
	include("include/db_connect.php");
	include("functions/functions.php");
	session_start();
	include("include/auth_cookie.php");
	$id = clear_string($_GET["id"]);
    $seoquery = mysql_query("SELECT seo_words,seo_description FROM table_products WHERE products_id='$id' AND visible='1'",$link);
     If (mysql_num_rows($seoquery) > 0)
     {
        $resquery = mysql_fetch_array($seoquery);
     } 
	If ($id != $_SESSION['countid'])
	{
		$querycount = mysql_query("SELECT count FROM table_products WHERE products_id='$id'",$link);
		$resultcount = mysql_fetch_array($querycount); 
		$newcount = $resultcount["count"] + 1;
		$update = mysql_query ("UPDATE table_products SET count='$newcount' WHERE products_id='$id'",$link);  
	}
	$_SESSION['countid'] = $id; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
        <meta name="Description" content="<? echo $resquery["seo_description"]; ?>"/>
        <meta name="keywords" content="<? echo $resquery["seo_words"]; ?>" /> 
		<meta http-equiv="content-type" content="text/html; charset=windows-1251" />	
		<link href="css/style.css" rel="stylesheet" type="text/css" />
		<link href="css/reset.css" rel="stylesheet" type="text/css" />
		<link href="trackbar/trackbar.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="/js/jquery-1.8.2.min.js"></script> 
		<script type="text/javascript" src="/js/jcarousellite_1.0.1.js"></script> 
		<script type="text/javascript" src="/js/shop-script.js"></script>
		<script type="text/javascript" src="/js/jquery.cookie.min.js"></script>
		<script type="text/javascript" src="/trackbar/jquery.trackbar.js"></script>
		<script type="text/javascript" src="/js/TextChange.js"></script>
        <script type="text/javascript" src="/js/jTabs.js"></script>
        		<link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox.css" />
		<script type="text/javascript" src="fancybox/jquery.fancybox.js"></script>
		<title>BookWorm</title>
        <script type="text/javascript">
            $(document).ready(function(){
                $("ul.tabs").jTabs({content: ".tabs_content", animate: true, effect:"fade"});   
                $(".send-review").fancybox(); 
			});
		</script>
	</head>
	<body>
		<div id="fon">
			<div id="block-body">
				<?php
					include ("include/block-header.php");
				?>
				<div id="block-right">
					<?php
						include ("include/block-category.php");
						include ("include/block-parameter.php");
						include ("include/block-news.php");
					?>
				</div>
				<div id="block-content">
				    <?php
						$result1 = mysql_query("SELECT * FROM table_products WHERE products_id='$id' AND visible='1'",$link);
						If (mysql_num_rows($result1) > 0)
						{
							$row1 = mysql_fetch_array($result1);
							do
							{   
								if  (strlen($row1["image"]) > 0 && file_exists("./uploads_images/".$row1["image"]))
								{
									$img_path = './uploads_images/'.$row1["image"];
									$max_width = 300; 
									$max_height = 300; 
									list($width, $height) = getimagesize($img_path); 
									$ratioh = $max_height/$height; 
									$ratiow = $max_width/$width; 
									$ratio = min($ratioh, $ratiow); 
									$width = intval($ratio*$width); 
									$height = intval($ratio*$height);    
								}else
								{
									$img_path = "/images/no-image.png";
									$width = 110;
									$height = 200;
								}    
                                $query_reviews = mysql_query("SELECT * FROM table_reviews WHERE products_id = '$id' AND moderat='1'",$link);  
                                $count_reviews = mysql_num_rows($query_reviews); 				
								echo  '
								<div id="block-breadcrumbs-and-rating">
								<p id="nav-breadcrumbs"><a href="view_cat.php?type=book">Книги</a> \ <span>'.$row1["brand"].'</span></p>
								<div id="block-like">								
								</div>
								</div>
								<div id="block-content-info">
								<img src="'.$img_path.'" width="'.$width.'" height="'.$height.'" />
								<div id="block-mini-description">
								<p id="content-title">'.$row1["title"].'</p>
								<ul class="reviews-and-counts-content">
								<li><img src="/images/eye-icon.png" /><p>'.$row1["count"].'</p></li>
								<li><img src="/images/comment-icon.png" /><p>'.$count_reviews.'</p></li>
								</ul>
								<p id="style-price" >'.($row1["price"]).' руб</p>
								<a class="add-cart" id="add-cart-view" tid="'.$row1["products_id"].'" ></a>
								<p id="content-text">'.$row1["mini_features"].'</p>
								</div>
								</div>
								';
							}
							while ($row1 = mysql_fetch_array($result1));
							$result = mysql_query("SELECT * FROM table_products WHERE products_id='$id' AND visible='1'",$link);
							$row = mysql_fetch_array($result);
							echo
							'
                            <ul class="tabs">
							<li><a class="active" href="#">Описание</a></li>
							<li><a class="active" href="#">Отзывы</a></li>
							<li><a class="active" href="#">Читать онлайн</a></li>
                            </ul>
                            <div class="tabs_content">
							<div>'.$row["description"].'</div>
							<div>
							<p id="link-send-review"><a class="send-review" href="#send-review">Добавить отзыв</a></p>
							';
							$query_reviews = mysql_query("SELECT * FROM table_reviews WHERE products_id='$id' AND moderat='1' ORDER BY reviews_id DESC",$link);        
							If (mysql_num_rows($query_reviews) > 0)
							{
								$row_reviews = mysql_fetch_array($query_reviews);
								do
								{
									echo 
									'
									<div class="block-reviews" >
									<p class="author-date" ><strong>'.$row_reviews["name"].'</strong>, '.$row_reviews["date"].'</p>
									<h5>Что Вам понравилось:</h5>
									<p class="textrev" >'.$row_reviews["good_reviews"].'</p>
									<h5>Что Вам не понравилось:</h5>
									<p class="textrev" >'.$row_reviews["bad_reviews"].'</p>
									<h5>Ваш комментарий:</h5><p class="text-comment">'.$row_reviews["comment"].'</p>
									</div>
									';
								}
								while ($row_reviews = mysql_fetch_array($query_reviews));
							}
							else
							{
								echo '<p class="title-no-info" >Отзывов нет</p>';
							} 
							echo '
                            </div>
							<div id="book-text">'.$row["book_text"].'</div>
                            </div>
							<div id="send-review" >
							<p align="right" id="title-review">Публикация отзыва производится после предварительной модерации!</p>
							<ul>
							<li><p align="right"><label id="label-name" >Имя<span>*</span></label><input maxlength="15" type="text"  id="name_review" /></p></li>
							<li><p align="right"><label id="label-good" >Что Вам понравилось:<span>*</span></label><textarea id="good_review" ></textarea></p></li>    
							<li><p align="right"><label id="label-bad" >Что Вам не понравилось:<span>*</span></label><textarea id="bad_review" ></textarea></p></li>     
							<li><p align="right"><label id="label-comment" >Комментарий</label><textarea id="comment_review" ></textarea></p></li>     
							</ul>
							<p id="reload-img"><img src="/images/loading.gif"/></p> <p id="button-send-review" iid="'.$id.'" ></p>
							</div>
							';
						} 
					?>	
				</div>
				<?php
					include ("include/block-footer.php");
				?>
			</div>
		</div>
	</body>
</html>