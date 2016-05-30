CTYPE html>
<html lang="ja">
<head>
 <meta charset="UTF-8">
 <title>todolist</title>
</head>

<body>
  <?php
  $dsn = 'mysql:dbname=todolist;host=localhost;charset=utf8';
  $user = 'root';
  $password = 'root';
  $bdh = new PDO($dsn, $user, $password);
  $dbh->query('SET NAMES utf8');
  $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

  if(isset($_GET['add'])) {
    $sql = 'INSERT INTO todolist(item) VALUES(?)';
    $stmt = $dbh->prepare($sql);
    $data[] = $_GET['name'];
    $stmt-> execute($data);

    $dbh = null;
  } else if(isset($_GET['delete'])) {
    $sql = 'DELETE FROM todolist WHERE id=?';
    $stmt = $dbh->prepare($sql);
    $data[] = $_GET['name'];
    $stmt-> execute($data);

    $dbh = null;
  }
  $sql = 'SELECT name FROM todolist WHERE id=1';
  $stmt = $dbh->prepare($sql);
  $stmt->execute();

  $dbh = null;
  ?>
<form method = "get" action = "index.php">
<input type="text" name = "name" style="width:200px">
<input type="submit" value="add"><br />
</form>

<form method = "get" action = "project_delete">
while(true) {
  $rec =$stmt->fetch(PDO::FETCH\ASSOC);
  if($rec==false){
    break;
  }
  print $rec['item'];
  <input type="submit" value="delete" name="$rec['id']" style="background:url('submit_delete.jpg')" />
  print '</br>';
}

</body>

</html>
