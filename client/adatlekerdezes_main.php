<!DOCTYPE HTML>
<html>
<link rel="stylesheet" type="text/css" href="<?php echo SITE_ROOT ?>css/main_style.css">

<?php
$client = new SoapClient('http://localhost/feladat/server/tables.wsdl');
$locations = $client->getlocations();
$counties = $client->getcounties();
$towers = $client->gettowers();
$len = count($counties->counties);
$html = "";
?>

<body>
<h2 id="center">Üdvözöljük!</h2>
<h3 id="center">Ezen az oldalon megtekintheti az adatbázis minden táblájának adatait, SOAP API segítségével.</h3>

<form id="center" name="tableselect" text="Tábla választás" method="POST">
    <select id="center" name="megye" onchange="javascript:tableselect.submit();">

        <option value=" ">Válasszon megyét!</option>
		<?php
		foreach ($counties->counties as $county) { ?>

            <option value="<?php echo $county['id']; ?>" <?php if (isset($_POST['megye']) && $_POST['megye'] == $county['id']) {
				echo "selected=selected";
			} ?> ><?php echo $county['nev']; ?></option>
		<?php } ?>
    </select>
	<?php
	if (isset($_POST['megye']) && trim($_POST['megye']) != "") { ?>
    <select id="center" name="hely" onchange="javascript:tableselect.submit();">
        <option value="">Válasszon helységet!</option>
		<?php
		foreach ($locations->locations as $loc) {
			if ($loc['megyeid'] == $_POST['megye']) { ?>
                <option value="<?php echo $loc['id']; ?>" <?php if (isset($_POST['hely']) && $_POST['hely'] == $loc['id']) {
					echo "selected=selected";
				} ?>><?php echo $loc['nev']; ?></option>
			<?php }
		}
		} ?>
    </select>
    <input type="submit" name="kiir" value="Kiírás">
	<?php
	if (isset($_POST['hely']) && trim($_POST['hely']) != "" && trim($_POST['megye']) != "" && isset($_POST['megye']) && isset($_POST["kiir"])) {
		?>
        <div id="center" style="overflow-x:auto;">
            <table class="table table-sm table-hover">

                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Darab</th>
                    <th scope="col">Teljesítmény</th>
                    <th scope="col">Kezdeti év</th>
                </tr>
            </table>
        </div>
		<?php foreach ($towers->towers as $tower) {
			if ($tower['helyszinid'] == $_POST['hely']) { ?>
                <div class="table-responsive-sm">
                    <table class="table table-sm table-hover">
                        <tr>
                            <td><?php echo $tower['id'] ?></td>
                            <td><?php echo $tower['darab'] ?></td>
                            <td><?php echo $tower['teljesitmeny'] ?></td>
                            <td><?php echo $tower['kezdev'] ?></td>
                        </tr>
                    </table>
                </div>
			<?php } ?>

            </table>
            </div>
		<?php }
	}
	unset($_POST['megye']);
	unset($_POST['hely']); ?>

</form>
</body>

</html>