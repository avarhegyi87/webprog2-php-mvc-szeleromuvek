<!DOCTYPE html>
<html lang="hu-hu">
<head>
    <meta charset="utf-8">
    <title>MVC - PHP</title>
    <link rel="stylesheet" type="text/css" href="<?php echo SITE_ROOT ?>css/main_style.css">
	<?php if ($viewData['style']) echo '<link rel="stylesheet" type="text/css" href="' . $viewData['style'] . '">'; ?>
</head>
<body>
<header>
    <div id="user"><em><?= ($_SESSION['userid'] != 0 || !isset($_SESSION['userid'])) ? $_SESSION['userlastname'] . " " . $_SESSION['userfirstname'] ?></em></div>
    <h1 class="header">Web-programozás II - MVC alkalmazás - Szélerőművek</h1>
</header>
<nav>
	<?php echo Menu::getMenu($viewData['selectedItems']); ?>
</nav>
<aside>
    <p>This is a text in an aside section</p>
</aside>
<section>
	<?php if ($viewData['render']) include($viewData['render']); ?>
</section>
<footer>&copy; Várhegyi-Miłoś Ádám, Csabai Albert <?= date("Y") ?></footer>
</body>
</html>
