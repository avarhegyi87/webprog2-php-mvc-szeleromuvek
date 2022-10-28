<h1>Deviza árfolyam megtekintés egy adott napra</h1>
<?php
$eredmeny = "sss";
$eredmeny2 = "aaa";
$rdate = "fff";
$currency1 = "ooo";
$currency2 = "www";
$dev;
$dev2;
$foo = 0.0;
$error = "A kiválasztott devizákra az adott napon nem található adat!";
$er = 0;
function bck()
{
  $view = new View_Loader('arfolyamok_main');
}
?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>jQuery UI Datepicker - Default functionality</title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js">
</script>

<script>
  $(function() {
    $("#datepicker").datepicker();
  });
</script>

<body>

  <form id="center" name="tableselect" text="Tábla választás" method="POST">
    <input type="text" name="datum" id="datepicker" required="required">
    <select id="center" name="penznem" required="required">
      <option value=" ">Válasszon Devizát!</option>
      <?php
      $curr = currencies();
      for ($i = 0; $i < count($curr); $i++) { ?>
        <option value="<?php echo ($curr[$i][0])->__toString(); ?>"><?php echo ($curr[$i][0])->__toString();
                                                                    } ?></option>
    </select>
    <select id="center" name="penznem2" required="required">
      <option value=" ">Válasszon Devizát!</option>
      <?php
      $curr1 = currencies();
      for ($i = 0; $i < count($curr1); $i++) { ?>
        <option value="<?php echo ($curr1[$i][0])->__toString(); ?>"><?php echo ($curr1[$i][0])->__toString();
                                                                    } ?></option>
    </select>

    <?php

    if (isset($_POST['datum']) && isset($_POST['penznem']) && isset($_POST['kuld']) && $_POST['datum'] != "" && $_POST['penznem'] != "" && $_POST['penznem2'] != "") {
      $sdate = explode("/", $_POST['datum']);
      $rdate = $sdate[2] . "-" . $sdate[0] . "-" . $sdate[1];
      $currency1 = $_POST['penznem'];
      $currency2 = $_POST['penznem2'];
    }
    if (isset($_POST['penznem']) && isset($_POST['datum']) && $_POST['penznem'] != "HUF" && $_POST['penznem2'] != "HUF" && isset($_POST['kuld'])) {
      $eredmeny = simplexml_load_string(exc_rates($rdate, $rdate, $currency1));
      $eredmeny2 = simplexml_load_string(exc_rates($rdate, $rdate, $currency2));
      if ($eredmeny->count() != 0 || $eredmeny2->count() != 0) {
        $json = json_encode($eredmeny);
        $array = json_decode($json, TRUE);
        $dev = floatval(str_replace(',', '.', trim($array["Day"]["Rate"])));
        $eredmeny = "";
        $_POST['penznem'] = '';
        $_POST['penznem2'] = '';
        $_POST['datum'] = '';
        $json2 = json_encode($eredmeny2);
        $array2 = json_decode($json2, TRUE);
        $dev2 = floatval(str_replace(',', '.', trim($array2["Day"]["Rate"])));
        $foo = $dev / $dev2;
        $eredmeny2 = "";
        $er = 0;
      } else {
        $er = 1;
      }
    }
    if (isset($_POST['penznem']) && isset($_POST['datum']) && $_POST['penznem'] == "HUF" && $_POST['penznem2'] != "HUF" && isset($_POST['kuld'])) {

      $eredmeny2 = simplexml_load_string(exc_rates($rdate, $rdate, $currency2));
      if ($eredmeny2->count() != 0) {

        $_POST['penznem'] = '';
        $_POST['penznem2'] = '';
        $_POST['datum'] = '';
        $json2 = json_encode($eredmeny2);
        $array2 = json_decode($json2, TRUE);
        $dev2 = floatval(str_replace(',', '.', trim($array2["Day"]["Rate"])));
        $foo = 1 / $dev2;
        $eredmeny2 = "";
        $er = 0;
      } else {
        $er = 1;
      }
    }
    if (isset($_POST['penznem']) && isset($_POST['datum']) && $_POST['penznem'] != "HUF" && $_POST['penznem2'] == "HUF" && isset($_POST['kuld'])) {
      $eredmeny = simplexml_load_string(exc_rates($rdate, $rdate, $currency1));
      if ($eredmeny->count() != 0) {

        $_POST['penznem'] = '';
        $_POST['penznem2'] = '';
        $_POST['datum'] = '';
        $json = json_encode($eredmeny);
        $array = json_decode($json, TRUE);
        $dev = floatval(str_replace(',', '.', trim($array["Day"]["Rate"])));
        $foo = $dev;
        $eredmeny = "";
        $er = 0;
      } else {
        $er = 1;
      }
    }
    ?>
    <input type="submit" name="kuld" value="Küld">
    <?php if ($currency1 != "ooo" && $currency2 != "www" && $rdate != "fff") { ?>


      <h3>A megadott devizák atváltási aránya a megadott napon (<?php echo $rdate; ?>):</h3>
      <h3> <?php echo $currency1 . " => " . $currency2; ?></h3>
      <h4><?php if (isset($_POST["kuld"]) && $foo != 0) {
            echo $foo;
          }
          if ($er == 1) {
            echo $error;
          }
        } ?></h4>

</body>