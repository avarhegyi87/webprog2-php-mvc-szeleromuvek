<h2>Hírek</h2>
<?php
if ($_SESSION['userid'] == 0 || !isset($_SESSION['userid'])) {
	?><h2>A hírek eléréséhez és a kommenteléshez kérjük jelentkezzen be!</h2><?php
} else {
    ?><h2><br><?= ($viewData['uzenet'] ?? "") ?><br></h2><?php
	print_r($viewData);
}