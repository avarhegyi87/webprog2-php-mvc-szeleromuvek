<h2>Hírek</h2>
<?php
if ($_SESSION['userid'] == 0 || !isset($_SESSION['userid'])) {
	?><h2>A hírek eléréséhez és a kommenteléshez kérjük jelentkezzen be!</h2><?php
} else { ?>
<!--        <pre>--><?php //print_r($viewData) ?><!--</pre>--><?php
    ?>
    <h2><?= ($viewData['uzenet'] ?? "") ?></h2>
    <h2><?= ($viewData['kommentel-uzenet'] ?? "") ?></h2>
    <h2><?= ($viewData['hirbekuld-uzenet'] ?? "") ?></h2>
    <?php
	foreach ($viewData as $hir) {
		if (isset($hir['hir'])) { ?>
            <ul>
                <li>
                    <dl>
                        <dt><em><?php echo $hir['bejelentkezes'] . ' - ' . $hir['datum'] ?></em></dt>
                        <dd><?php echo $hir['hir'] ?></dd>
                    </dl>
                </li>
				<?php foreach ($hir['kommentek'] as $komment) { ?>
                    <ul>
                        <li>
                            <dl>
                                <dt><em><?php echo $komment['bejelentkezes'] . ' - ' . $komment['datum'] ?></em></dt>
                                <dd><?php echo $komment['komment'] ?></dd>
                            </dl>
                        </li>
                    </ul>
				<?php } ?>
                <form action="<?php SITE_ROOT ?>kommentel" method="post">
                    <textarea name="ujkomment"></textarea>
                    <input name="hirid" type="hidden" value="<?php echo $hir['id'] ?>"/>
                    <input type="submit" value="Komment küldése">
                </form>
            </ul>
		<?php }
	} ?>
    <h2>Új hír beküldése</h2>
    <form action="<?php SITE_ROOT ?>hirbekuld" method="post">
        <textarea name="ujhir"></textarea>
        <input type="submit" value="Hír beküldése">
    </form>
<?php } ?>
