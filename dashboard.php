<?php
session_start();
include("config/db.php");

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>

<style>
body{
margin:0;
font-family:Arial;
background:#f4f6f9;
}

.topbar{
background:#2c5364;
color:white;
padding:15px;
}

.sidebar{
width:200px;
height:100vh;
background:#203a43;
position:fixed;
color:white;
padding-top:20px;
display:flex;
flex-direction:column;
}

.sidebar a{
display:block;
color:white;
padding:10px;
text-decoration:none;
}

.menu{
flex:1;
}

.logout-btn{
margin-top:auto;
padding:12px;
text-align:center;
background:#2c5364;
color:white;
text-decoration:none;
}

.content{
margin-left:200px;
padding:20px;
}

.gallery{
display:grid;
grid-template-columns: repeat(2, 1fr);
gap:20px;
}

.card{
background:white;
padding:10px;
border-radius:10px;
box-shadow:0 2px 8px rgba(0,0,0,0.1);
text-align:center;
}

.card img{
width:100%;
border-radius:8px;
max-height:300px;
object-fit:cover;
}

.vertical{
grid-column: span 1;
}

.horizontal{
grid-column: span 2;
}

.add-btn{
position:fixed;
top:20px;
right:20px;
width:50px;
height:50px;
background:#2c5364;
color:white;
font-size:30px;
text-align:center;
line-height:50px;
border-radius:50%;
text-decoration:none;
}
</style>

</head>

<body>

<div class="topbar">Dashboard</div>

<div class="sidebar">
    <div class="menu">
        <a href="dashboard.php"></a>
        <a href="add-item.php"></a>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
    <a href="logout.php" class="logout-btn">Logout</a>
</div>

<div class="content">

<h2>Items</h2>

<a href="add-item.php" class="add-btn">+</a>

<br><br>

<div class="gallery">

<?php
if($_SESSION['role'] == 'admin'){
    $q = mysqli_query($conn,"SELECT * FROM items");
} else {
    $user_email = $_SESSION['user'];
    $q = mysqli_query($conn,"SELECT * FROM items WHERE user_email='$user_email'");
}

while($row = mysqli_fetch_assoc($q)){

$class = ($row['layout_type'] == "horizontal") ? "horizontal" : "vertical";
?>

<div class="card <?php echo $class; ?>">

<img src="uploads/<?php echo $row['image']; ?>">

<h3><?php echo $row['name']; ?></h3>

<a href="delete.php?id=<?php echo $row['id']; ?>">
<button>Delete</button>
</a>

</div>

<?php } ?>

</div>

</div>

</body>
</html>