<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
  <?php require_once'include/database.php';?>
<?php include_once'include/nav.php'; ?>
<?php 
if(isset($_POST ['ajouter'])){

  $t=$_POST['title'];
  if(!empty($t)){
  
    
    $req="insert into items values(null,?)";
    $stat=$pdo->prepare($req);
    $stat->execute([$t]);
  }
  else{
    ?>
    <div class="alert alert-primary" role="alert">
    the title is mandatory(required)!
  </div>
<?php

  }
 
}
?>
<form method="post">
 <fieldset class="border border-primary p-2 my-5 mx-auto w-75">
  <legend>Ajouter une Tache:</legend>
 
  <div class="mb-3">
    <label for="title" name="title"  class="form-label">title</label>
    <input type="text"  name ="title" class="form-control" id="title">
  </div>
  <div class="mb-3 form-check">
  <button type="submit" name="ajouter" value="ajouter" class="btn btn-primary">ADD</button>

  
  </div>
  </fieldset>
</form> 
<?php
$sqlstat=$pdo->query("select * from items");
$items=$sqlstat->fetchAll(PDO::FETCH_ASSOC);
?>




<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">title</th>
      <th scope="col">operation</th>
    
    </tr>
  </thead>
  <tbody>
    <?php foreach($items as $key=>$item){
?>
<tr>
  <td><span class="badge text-bg-primary"><?php echo $item['id'] ?></span></td>
  <td><?php echo $item['title'] ?></td>
  <td>
  <form method="post">
      <input type="hidden" name="id" value="<?php echo $item['id'] ?>">
      <input formaction="modifier.php" class='btn btn-sm rounded-3 btn-primary' type="submit" value="&#9999;" name="modifier">
      <input formaction="supprimer.php" class='btn btn-sm rounded-3 btn-danger' type="submit" value="&#10008;" name="supprimer" onclick="return confirm('Voulez-vous vraiment supprimer <?php echo $item['title'] ?> ???');">
    </form>
  </td>
</tr
<?php 
    }?>
   
  </tbody>
</table>
</body>
</html>
