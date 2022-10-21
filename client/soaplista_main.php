
<!DOCTYPE HTML>
<html>

  <?php 
  $client = new SoapClient('http://localhost/feladat/server/tables.wsdl');
  $users = $client->getusers();
 // if(isset($_POST['user']) && trim($_POST['user']) != "")
  //  $users = $client->getmodellek($_POST['user']);
  ?>
    
  <body>
    <h2>Üdvözöljük!</h2>
    <h3>Ezen az oldalon megtekintheti az adatbázis minden táblájának adatait, SOAP API segítségével.</h3>
    <form name="tableselect" text="Tábla választás" method="POST">
      <select name="tabla" onchange="javascript:tableselect.submit();">
        <option value="">Válasszon táblát!</option>
        <?php
          foreach($users->users as $user)
          {
            echo '<option value="'.$user['id'].'">'.$user['bejelentkezes'].'</option>';
          }
        ?>
      </select>
        <?php
        //  if(isset($modellek))
         // {
         //   echo "<fieldset>";
         //   echo '<legend>'.$modellek->markanev.'('.$modellek->markakod.') modelljei:</legend>';
         //   foreach($modellek->modellek as $modell)
         //   {
         //     echo $modell['modellkod'].' - '.$modell['modellnev']."<br>";
         //   }
         //   echo "</fieldset>";
         // }
        ?>
    </form>
  </body>                                                          
</html>