<!DOCTYPE html>
<html>
<head>
<style>
form{
  width: 50%;
    margin: auto;
}
input#scan_full{

  font-size:15px;
  padding:10px;
  margin-bottom:15px;
}
input#search{
  width:100%;
  font-size:15px;
  padding:10px;
  margin-bottom:15px;
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
<form action="Reader.php" method="post" enctype="multipart/form-data">
<input type="checkbox" id="scan_full" name="scan_full" value='1' onclick="toggleFunction()" />Is parse Complete Doc
<br/>
<input type="text"  name="search" id="search" placeholder="Parse section name" value="description"><br/>

  <input type="file" id="resume" name="resume" accept=".doc, .docx">
  <br/>
  <input type="submit" class="btn-submit" name="SubmitBtn" >
</form>
<script>
function toggleFunction() {
    var checkBox = document.getElementById("scan_full");
    var x = document.getElementById("search");
    if (checkBox.checked == true){
        x.style.display = "none";
  } else {
    x.style.display = "block";
  }

}
</script>
   
</body>
</html>
