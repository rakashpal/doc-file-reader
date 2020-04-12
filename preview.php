<!DOCTYPE html>
<html>
<head>
<style>
form{
  width: 50%;
    margin: auto;
}
textArea{
    display:block;
    width:100%;
    height:150px;
    border:none;
    background:#ddd;
    overflow:auto; 
}
.btn-submit{
    margin-top:10px;
    background-color:black;
    border-radius:5px;
    border:none;
    color:white;
    font-size:15px;
    padding:5px 10px;
}
</style>
</head>
<body>
<form action="database.php" method="post" >

<textArea name="description" readonly required>
<?=$a_tables?>
</textarea>
<input class="btn-submit" type="submit" name="save" />
   </from>
</body>
</html>