<h2>Regisztráció</h2>
<form action="<?= SITE_ROOT ?>regisztral" method="post">
    <label for="csaladi_nev">Családi név</label>
    <input type="text" name="csaladi_nev" id="csaladi_nev" required inputmode="text">
    <br>
    <label for="utonev">Utónév</label>
    <input type="text" name="utonev" id="utonev" required inputmode="text">
    <br>
    <label for="reg_login">Felhasználónév</label>
    <input type="text" name="reg_login" id="reg_login" required
           pattern="[a-zA-Z][\-\.a-zA-Z0-9_]{3}[\-\.a-zA-Z0-9_]+">
    <br>
    <label for="reg_pw">Jelszó:</label>
    <input type="password" name="reg_pw" id="reg_pw" required
           pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$">
    <br>
    <label for="reg_pw_confirm">Jelszó megerősítése:</label>
    <input type="password" name="reg_pw_confirm" id="reg_pw_confirm" required
           pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$">
    <br>
    <input type="submit" value="Regisztrál">
</form>
<h2><br><?= (isset($viewData['uzenet']) ? $viewData['uzenet'] : "") ?><br></h2>