<?php
	defined('myeshop') or die('Доступ запрещён!');
?>
<div id="block-header">
    <div id="header-top-block">
        <ul id="header-top-menu">
            <li>Ваш город - <span>Минск</span></li>                        
            <li><a href="feedback.php">Обратная связь</a></li>
		</ul> 
        <?php
	       if ($_SESSION['auth'] == 'yes_auth')
           {
                echo '<p id="auth-user-info" align="right"><img src="/images/user.png"/>Здравствуйте '.$_SESSION['auth_name'].'!</p>'; 
           }
           else
           {
                echo '<p id="reg-auth-title" align="right"><a class="top-auth">Вход</a><a href="registration.php">Регистрация</a></p>'; 
           }   
        ?>         
        <div id="block-top-auth">
            <div class="corner"></div>
            <form method="post">
                <ul id="input-email-pass">
                    <h3>Вход</h3>
                    <p id="message-auth">Неверный логин и(или) пароль</p>
                    <li><center><input type="text" id="auth_login" placeholder="Логин или E-mail"/></center></li>
                    <li><center><input type="password" id="auth_pass" placeholder="Пароль"/><span id="button-pass-show-hide" class="pass-show"></span></center></li>
                    <ul id="list-auth">
                        <li><input type="checkbox" name="rememberme" id="rememberme"/><label for="rememberme">Запомнить меня</label></li>
                        <li><a id="remindpass" href="#">Забыли пароль?</a></li>
                    </ul>
                    <p align="right" id="button-auth"><a>Вход</a></p>
                    <p align="right" class="auth-loading"><img src="/images/loading.gif"/></p>
                </ul>
            </form>
            <div id="block-remind">
                <h3>Восстановление<br /> пароля</h3>
                <p id="message-remind" class="message-remind-success" ></p>
                <center><input type="text" id="remind-email" placeholder="Ваш E-mail" /></center>
                <p align="right" id="button-remind" ><a>Готово</a></p>
                <p align="right" class="auth-loading" ><img src="/images/loading.gif" /></p>
                <p id="prev-auth">Назад</p>
            </div>
        </div> 
	</div>
    <div id="top-line"></div>
   	<div id="block-user" >
		<div class="corner2"></div>
		<ul>
			<li><img src="/images/user_info.png" /><a href="profile.php">Профиль</a></li>
			<li><img src="/images/logout.png" /><a id="logout" >Выход</a></li>
		</ul>
	</div>
    <img id="img-logo" src="/images/logo.png"/>
    <div id="personal-info">
		
	</div>
	<div id="block-search">   
        <form method="GET" action="search.php?q=">
            <span></span>
            <input type="text" id="input-search" name="q" placeholder="   Поиск     среди     всех     товаров" value="<?php echo $search;?>"/>            
            <input type="submit" id="button-searh" value="Поиск"/>   
		</form>    
        <ul id="result-search">
        </ul>
	</div>     
</div>
<div id="top-menu">
    <ul>
        <li><a href="index.php">Главная</a></li>
        <li><a href="view_aystopper.php?go=news">Новинки</a></li>
        <li><a href="view_aystopper.php?go=leaders">Лидеры продаж</a></li>
        <li><a href="view_aystopper.php?go=sale">Распродажа</a></li>
	</ul>
    <p align="right" id="block-basket"><a href="cart.php?action=oneclick">Корзина пуста</a></p>
    <div id="nav-line"></div>
</div>