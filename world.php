<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);


$country = strval(htmlspecialchars(stripslashes(trim($_GET['country']))));

$term = "%$country%";

$stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :term");
$stmt->bindParam(':term', $term, PDO::PARAM_STR);
$stmt->execute();


$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$lookup = $_GET['lookup'];

if($lookup === 'cities'){
  $stmt = $conn->prepare("SELECT c.name as city, c.district, c.population as city_population FROM cities c JOIN countries coun ON c.country_code=coun.code WHERE coun.name LIKE :term");
  
  $stmt->bindParam(':term', $term, PDO::PARAM_STR);
  $stmt->execute();

  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

  <table>
  <tr>
    <th>Name</th>
    <th>Distrtict</th>
    <th>Population</th>
  </tr>
  
  <?php foreach ($results as $row): ?>
    <tr>
      <td><?= $row['city']?></td>
      <td><?= $row['district']?></td>
      <td><?= $row['city_population']?></td>
    </tr>
  <?php endforeach; ?>
  
</table>


<?php
}else{
?>

<table>
  <tr>
    <th>Country Name</th>
    <th>Continent</th>
    <th>Independence Year</th>
    <th>Head of State</th>
  </tr>
  
  <?php foreach ($results as $row): ?>
    <tr>
      <td><?= $row['name']?></td>
      <td><?= $row['continent']?></td>
      <td><?= $row['independence_year']?></td>
      <td><?= $row['head_of_state']?></td>
    </tr>
  <?php endforeach; ?>
  
</table>

<?php } ?>