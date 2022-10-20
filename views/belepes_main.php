<h2>Belépés</h2>
<form action="<?= SITE_ROOT ?>beleptet" method="post">
    <label for="login">Felhasználónév:</label>
    <input type="text" name="login" id="login" required
           pattern="[a-zA-Z][\-\.a-zA-Z0-9_]{3}[\-\.a-zA-Z0-9_]+">
    <br>
    <label for="password">Jelszó:</label>
    <input type="password" name="password" id="password" required
           pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$">
    <br>
    <input type="submit" value="Bejelentkezés">
</form>
<h2><br><?= ($viewData['uzenet'] ?? "") ?><br></h2>