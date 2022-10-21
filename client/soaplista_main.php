
<!DOCTYPE HTML>
<html>

  <?php 
  $client = new SoapClient('http://localhost/feladat/server/tables.wsdl');
  $users = $client->getusers();
  $locations = $client->getlocations();
  $counties = $client->getcounties();
  $towers = $client->gettowers();
  ?>
    
  <body>
    <h2>Üdvözöljük!</h2>
    <h3>Ezen az oldalon megtekintheti az adatbázis minden táblájának adatait, SOAP API segítségével.</h3>
    
    <form name="tableselect" text="Tábla választás" method="POST">
      <select name="tabla" onchange="javascript:tableselect.submit();">

        <option value="">Válasszon táblát!</option>
        <option value="user">Felhasználók</option>
        <option value="loc">Helyszínek</option>
        <option value="county">Megyék</option>
        <option value="tower">Tornyok</option>
        
      </select>

        <?php
        if(isset($_POST['tabla']) && trim($_POST['tabla']) != "")
        {
          $selectOption = $_POST['tabla'];


          if($selectOption == "user")
          {
          ?>
          <table>
            <tr>
              <th>ID</th>
              <th>Családi név</th>
              <th>Keresztnév</th>
              <th>Felhasználónév</th>
              <th>Jogosultság</th>
            </tr>

            <?php foreach($users -> users as $user){ ?>
            <tr>
              <td><?php echo $user['id'] ?></td>
              <td><?php echo $user['csaladi_nev'] ?></td>
              <td><?php echo $user['utonev'] ?></td>
              <td><?php echo $user['bejelentkezes'] ?></td>
              <td><?php echo $user['jogosultsag'] ?></td>
            </tr>
            <?php } ?>

          </table>
          <?php } ?>

          <?php
          if($selectOption == "loc")
          {
          ?>
          <table>
            <tr>
              <th>ID</th>
              <th>Név</th>
              <th>Megye ID</th>
            </tr>

            <?php foreach($locations -> locations as $loc){ ?>
            <tr>
              <td><?php echo $loc['id'] ?></td>
              <td><?php echo $loc['nev'] ?></td>
              <td><?php echo $loc['megyeid'] ?></td>
            </tr>
            <?php } ?>

          </table>
          <?php } ?>
        
          <?php
          if($selectOption == "county")
          {
          ?>
          <table>
           <tr>
             <th>ID</th>
             <th>Név</th>
             <th>Régió</th>
           </tr>

           <?php foreach($counties -> counties as $county){ ?>
           <tr>
             <td><?php echo $county['id'] ?></td>
             <td><?php echo $county['nev'] ?></td>
             <td><?php echo $county['regio'] ?></td>
           </tr>
           <?php } ?>

          </table>
          <?php } ?>

          <?php
          if($selectOption == "tower")
          {
          ?>
         <table>
           <tr>
             <th>ID</th>
             <th>Darab</th>
             <th>Teljesítmény</th>
             <th>Kezdeti év</th>
             <th>Helyszín ID</th>
           </tr>

           <?php foreach($towers -> towers as $tower){ ?>
           <tr>
             <td><?php echo $tower['id'] ?></td>
             <td><?php echo $tower['darab'] ?></td>
             <td><?php echo $tower['teljesitmeny'] ?></td>
             <td><?php echo $tower['kezdev'] ?></td>
             <td><?php echo $tower['helyszinid'] ?></td>
           </tr>
           <?php } ?>

          </table>
          <?php } }?>
    </form>
  </body>                                                          
</html>