<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>llumipunts</title>
  <meta name="description" content="qrs">
  <meta name="author" content="Jordi">
  <link rel="stylesheet" type="text/css" href="style.css"></link>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
  <script type="text/javascript" src="header.js"></script>
  <script type="text/javascript" src="footer.js"></script>
  <?php include('lang.php'); ?>
</head>
<body>
  <header>
      <div class="user-info">
          <span id="user-name"></span>
          <span id="user-points"></span>
      </div>
  </header>
  <section class="container">
    <?php
    require('config.php');
    $result = mysqli_query($conn,"SELECT * FROM `users` ORDER BY `points` DESC");
    echo "<table class='ranking'>
    <tr class='keys'>
    <th>";
    echo $copy["form:username"];
    echo "</th>
    <th>llumipunts</th>
    </tr>
    </table>";

    echo "<table class='scroll'>";
    while($row = mysqli_fetch_array($result))
    {
    echo "<tr>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['points'] . "</td>";
    echo "</tr>";
    }
    echo "</table>";

    mysqli_close($conn)

    ?>
  </section>
  <footer>
    <div class="links">
      <a onclick="showInfo()"> <?php echo $copy["footer:info"]; ?></a>
      <a href="/ranking.php"> <?php echo $copy["footer:ranking"]; ?></a>
      <a onclick="showLegal()"> <?php echo $copy["footer:legal"]; ?> </a>
    </div>
    <img class="logo" src="./assets/ui/logo.png">
  </footer>

  <section id="info-overlay" class="overlay" onclick="closeInfo()">
        <div class="overlay-content">
            <!-- <a onclick="closeInfo()" class="close"></a> -->
            <img style="max-width: 100%; height: auto;" src="assets/ui/info.jpg" alt="info">
        </div>
  </section>

  <section id="legal-overlay" class="overlay" onclick="closeLegal()">
        <div class="overlay-content">
        <img style="max-width: 100%; height: auto;" src="assets/ui/legal.jpg" alt="info">
            <!-- <a onclick="closeLegal()" class="close"></a> -->
           
        </div>
  </section>
</body>

<style>
  #pdf{
    width:100%;
    height:100%;
  }
  
  table{
    border-spacing: 0;
    display: block;
  }
  .scroll {
    max-height: calc(100vh - 300px);
    overflow: auto;
    background-color: #f6ce70;
  }
  tbody{
    display: inline-table;
    width:100%;
  }
  td {
    padding: 5px 10px;
    font-size: 14pt;
  }
  th {
    padding: 10px;
    font-size: 14pt;
  }
  tr:nth-child(odd){
    background-color: #f6ce70;
  }
  tr:nth-child(even){
    background-color: #edbe4f;
  }
  .keys{
    background-color: black !important;
    color: white;
    text-transform: uppercase;
  }
  td:nth-child(1), th:nth-child(1){
    text-align: left;
  }
  td:nth-child(2), th:nth-child(2){
    text-align: right;
  }
</style>


</html>

