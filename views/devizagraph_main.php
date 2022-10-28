<h1>Árfolyamgrafikon</h1>
<h2>Grafikon paraméterek</h2>
<?php
$today = date("m/d/Y");
$eredmeny = "sss";
$eredmeny2 = "aaa";
$rdate = "fff";
$ddate = "ddd";
$rdate2 = "fff";
$ddate2 = "ddd";
$currency1 = "ooo";
$currency2 = "www";
$dev;
$dev2;
$days = array();
$values = array();
$foo = array();
$error = "A kiválasztott devizákra az adott napon nem található adat!";
$er = 0;
function bck()
{
  $view = new View_Loader('arfolyamok_main');
}
?>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<style>
  table {
    width: 80%;
  }

  th {
    height: 20px;
    text-align: center;
    background-color: bisque;
    width: 20%;
    min-width: 50px;
  }

  td {
    height: 20px;
    text-align: center;
    background-color: greenyellow;
    width: 20%;
    min-width: 50px;
  }

  #center {
    margin: auto;
    width: fit-content;
  }
</style>

<script>
  $(function() {

    $("#daterangepicker").daterangepicker({
      "maxDate": "<?php echo $today; ?>"
    });
  });
</script>

<body>

  <form id="center" name="tableselect" text="Tábla választás" method="POST">
    <input type="text" name="datum" id="daterangepicker" required="required">
    <select id="center" name="penznem" required="required">
      <option value=" ">Válasszon Devizát!</option>
      <?php
      print_r($_POST['datum']);
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
      $sdate = explode("-", $_POST['datum']);
      $ddate = explode("/", $sdate[0]);
      $ddate2 = explode("/", $sdate[1]);
      $rdate = $ddate[2] . "-" . $ddate[0] . "-" . $ddate[1];
      $rdate2 = $ddate2[2] . "-" . $ddate2[0] . "-" . $ddate2[1];
      $currency1 = $_POST['penznem'];
      $currency2 = $_POST['penznem2'];
    }
    if (isset($_POST['penznem']) && isset($_POST['datum'])  && isset($_POST['kuld']) && $currency1 != $currency2) {
      $eredmeny = simplexml_load_string(exc_rates($rdate, $rdate2, $currency1));
      $eredmeny2 = simplexml_load_string(exc_rates($rdate, $rdate2, $currency2));
      if ($eredmeny->count() != 0 || $eredmeny2->count() != 0) {
        $json = json_encode($eredmeny);
        $array = json_decode($json, TRUE);
        $dev = ($array["Day"]);
        $eredmeny = "";
        $_POST['penznem'] = '';
        $_POST['penznem2'] = '';
        $_POST['datum'] = '';
        $json2 = json_encode($eredmeny2);
        $array2 = json_decode($json2, TRUE);
        $dev2 = ($array2["Day"]);
        // array_push($foo, ($dev/$dev2));
        $eredmeny2 = "";
        $er = 0;
      } else {
        $er = 1;
      }
    }
    if (isset($_POST['penznem']) && isset($_POST['datum'])  && isset($_POST['kuld']) && $currency1 == $currency2) {
      $eredmeny = simplexml_load_string(exc_rates($rdate, $rdate2, "EUR"));
      $eredmeny2 = simplexml_load_string(exc_rates($rdate, $rdate2, "EUR"));
      if ($eredmeny->count() != 0 || $eredmeny2->count() != 0) {
        $json = json_encode($eredmeny);
        $array = json_decode($json, TRUE);
        $dev = ($array["Day"]);
        $eredmeny = "";
        $_POST['penznem'] = '';
        $_POST['penznem2'] = '';
        $_POST['datum'] = '';
        $json2 = json_encode($eredmeny2);
        $array2 = json_decode($json2, TRUE);
        $dev2 = ($array2["Day"]);
        // array_push($foo, ($dev/$dev2));
        $eredmeny2 = "";
        $er = 0;
      } else {
        $er = 1;
      }
    }

    ?>



    <input type="submit" name="kuld" value="Küld">
    <?php if ($currency1 != "ooo" && $currency2 != "www" && $rdate != "fff" && $rdate2 != "fff") { ?>
      <h3>A megadott devizák atváltási aránya az adott napon:</h3>


      <div class="table-responsive-sm">
        <table class="table table-sm table-hover">
          <tr>
            <th scope="col">Dátum</th>
            <th scope="col">Árfolyam ( <?php echo ($currency1 . " -> " . $currency2); ?> )</th>
          </tr>
          <?php
          $cnt = 0;
          foreach ($dev as $fooo) {
            if (isset($_POST["kuld"]) && $currency1 != "HUF" && $currency2 != "HUF") { ?>
              <tr>
                <td> <?php echo $fooo["@attributes"]["date"];
                      array_push($days, $fooo["@attributes"]["date"]); ?></td>
                <td><?php echo (number_format(floatval(str_replace(',', '.', trim($fooo["Rate"]))) / floatval(str_replace(',', '.', trim($dev2[$cnt]["Rate"]))), 5));
                    array_push($values, (number_format(floatval(str_replace(',', '.', trim($fooo["Rate"]))) / floatval(str_replace(',', '.', trim($dev2[$cnt]["Rate"]))), 5))); ?></td>
              </tr>
            <?php $cnt += 1;
            }
            if (isset($_POST["kuld"]) && $currency1 == "HUF" && $currency2 == "HUF") { ?>
              <tr>
                <td> <?php echo $fooo["@attributes"]["date"];
                      array_push($days, $fooo["@attributes"]["date"]); ?></td>
                <td><?php echo (number_format(floatval(str_replace(',', '.', trim($fooo["Rate"]))) / floatval(str_replace(',', '.', trim($dev2[$cnt]["Rate"]))), 5));
                    array_push($values, (number_format(floatval(str_replace(',', '.', trim($fooo["Rate"]))) / floatval(str_replace(',', '.', trim($dev2[$cnt]["Rate"]))), 5))); ?></td>
              </tr>
            <?php $cnt += 1;
            }
            if (isset($_POST["kuld"]) && $currency1 == "HUF" && $currency2 != "HUF") { ?>
              <tr>
                <td> <?php echo $fooo["@attributes"]["date"];
                      array_push($days, $fooo["@attributes"]["date"]); ?></td>
                <td><?php echo (number_format(1 / floatval(str_replace(',', '.', trim($dev2[$cnt]["Rate"]))), 5));
                    array_push($values, (number_format(1 / floatval(str_replace(',', '.', trim($dev2[$cnt]["Rate"]))), 5))); ?></td>
              </tr>
            <?php $cnt += 1;
            }
            if (isset($_POST["kuld"]) && $currency1 != "HUF" && $currency2 == "HUF") { ?>
              <tr>
                <td> <?php echo $fooo["@attributes"]["date"];
                      array_push($days, $fooo["@attributes"]["date"]); ?></td>
                <td><?php echo (number_format(floatval(str_replace(',', '.', trim($fooo["Rate"]))), 5));
                    array_push($values, (number_format(floatval(str_replace(',', '.', trim($fooo["Rate"]))), 5))); ?></td>
              </tr>
          <?php $cnt += 1;
            }
          } ?>
        </table>
      </div>


      <div>
        <canvas id="myChart"></canvas>
      </div>

      <script>
        var dat = <?php echo json_encode($days); ?>;
        var val = <?php echo json_encode($values); ?>;


        const data = {
          labels: dat,
          datasets: [{
            label: 'Árfolyamok',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: val,
          }]
        };

        const config = {
          type: 'line',
          data: data,
          options: {}
        };
      </script>
      <script>
        if (data.length != 0) {
          const myChart = new Chart(
            document.getElementById('myChart'),
            config
          );
        }
      </script>
    <?php } ?>


</body>