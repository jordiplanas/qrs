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
  <?php include('lang.php'); ?>
</head>
<body>
<?php
require('config.php');
$result = mysqli_query($conn,"SELECT * FROM `users` ORDER BY `points` DESC");

echo "<table border='1'>
<tr>
<th>User</th>
<th>Llumipunts</th>
</tr>";

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
   

</body>


</html>

