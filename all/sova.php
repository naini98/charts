<?php 

$sName = "localhost";
$uName = "root";
$pass = "";
$db_name = "valorantagents";

try {
  $pdo = new PDO("mysql:host=localhost;dbname=valorantagents", 
    "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
}catch(PDOException $e){
  echo "Connection failed : ". $e->getMessage();
}
?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Valorant Chart</title>
    <style type="text/css">
      .chartBox{
        width: 800px;
        height:400px;
      }
    </style>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body class= "bg-dark" >
<div class="col-8 offset-2 my-5">
   <div class="card">
       <div class="card-body">
           <h5>Sova stats</h5>
           <hr>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="chartBox">  
    <canvas id="myChart" ></canvas>
    </div>
    </div>
    </div>
    </div>
<?php 
// Attempt select query execution
try{
  $sql = "SELECT * FROM `valorant_dataset` WHERE agent= 'sova' ; ";
 
  $result = $pdo->query($sql);
  if($result->rowCount() > 0) {
    $kda =  array();
    $kill =  array();
    $death =  array();
    $assistant =  array();
    $winrate = array();
    $defenderwinrate = array();
    $attackwinrate = array();
    $pickrate = array();
    $totalgame = array();
    while($row = $result->fetch()) {
      $map[] = $row["map"];
      $kda[] = $row["kda"];
      $kill[] = $row["kill"];
      $death[] = $row["death"];
      $assistant[] = $row["assistant"];
      $winrate[] = $row["winrate"];
      $defenderwinrate[] = $row["defenderwinrate"];
      $attackwinrate[] = $row["attackwinrate"];
      $pickrate[] = $row["pickrate"];
      $totalgame[] = $row["totalgame"];
    }

  unset($result);
  } else {
    echo "No records matching your query were found.";
  }
} catch(PDOException $e){
  die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}
 
// Close connection
unset($pdo);
?>
<div class="chartBox">  
    <canvas id="myChart" ></canvas>
    </div>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  //setup 
const kda = <?php echo json_encode($kda); ?>;
const kill = <?php echo json_encode($kill); ?>;
const death = <?php echo json_encode($death); ?>;
const assistant = <?php echo json_encode($assistant); ?>;
const winrate = <?php echo json_encode($winrate); ?>;
const defenderwinrate = <?php echo json_encode($defenderwinrate); ?>;
const attackwinrate = <?php echo json_encode($attackwinrate); ?>;
const pickrate = <?php echo json_encode($pickrate); ?>;
const totalgame = <?php echo json_encode($totalgame); ?>;
  const data = {
  labels: [ 'Split', 'Bind', 'Haven', 'Ascent', 'Icebox','Breeze'],
        datasets: [{
            label: 'kda',
            data: kda,
            backgroundColor: 'rgba(255, 99, 132, 0.4)',
           borderColor:  'rgba(255, 99, 132, 1)',
           borderWidth: 1
        },{
            label: 'kill',
            data: kill,
            backgroundColor:'rgba(54, 162, 235, 0.4)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        },{
            label: 'death',
            data: death,
            backgroundColor:  'rgba(255, 206, 86, 0.4)',
             borderColor: 'rgba(255, 206, 86, 1)',
            borderWidth: 1
        },{
            label: 'assistant',
            data: assistant,
            backgroundColor: 'rgba(75, 192, 192, 0.4)',
             borderColor:  'rgba(75, 192, 192, 1)',
             borderWidth: 1
        },{
            label: 'winrate',
            data: winrate,
            backgroundColor: 'rgba(153, 102, 255, 0.4)',
             borderColor:  'rgba(153, 102, 255, 1)',
             borderWidth: 1
        },{
            label: 'defenderwinrate',
            data: defenderwinrate,
            backgroundColor: 'rgba(75, 102, 192, 0.4)',
             borderColor:  'rgba(255, 192, 86, 1)',
             borderWidth: 1
        },{
            label: 'attackwinrate',
            data: attackwinrate,
            backgroundColor: 'rgba(255, 102, 321, 0.4)',
             borderColor:  'rgba(153, 192, 255, 1)',
             borderWidth: 1
        },{
            label: 'pickrate',
            data: pickrate,
            backgroundColor: 'rgba(255, 162, 235, 0.4)',
             borderColor:  'rgba(54, 206, 235, 1)',
             borderWidth: 1
        },{
            label: 'totalgame',
            data: totalgame,
            backgroundColor: 'rgba(0, 0, 0, 0.4)',
             borderColor:  'rgba(75, 162, 235, 1)',
             borderWidth: 1
        },]
      };

  //config
const config = {
  type: 'bar',
    data,
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
};

  //render

  const myChart = new Chart(
    document.getElementById('myChart'),
    config
    
  );
  
  

</script>


</body>

</html>
