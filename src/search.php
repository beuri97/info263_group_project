<!DOCTYPE html>
<html lang="en" xmlns:mso="urn:schemas-microsoft-com:office:office" xmlns:msdt="uuid:C2F41010-65B3-11d1-A29F-00AA00C14882">
<head>
    <meta charset="UTF-8">
    <title>Star Wars - INFO263</title>
    <script src="js/script.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'/>
    <!-- CSS libraries -->
    <link href=https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href=https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="css/style.css" />

</head>
<body>

<link rel="stylesheet" href="styles.css">
<div class="search">
    <div class="icon"></div>
    <div class="input">
      <input type="text" placeholder="Search" id="mysearch">
    </div>
    <span class="clear" onclick="document.getElementByID('mysearch').value=''"></span>
  </div>
  <script>
    const icon = document.querySelector('.icon');
    const search = document.querySelector('.search');
    icon.onclick = function(){
        search.classlist.toggle('active')
    }
  </script>

<section class="container"></section>
<form>
    <input type="text" name="" id="search-item" placeholder="Search"
           onkeyup="search()">
</form>
<script src="app.js"></script>

</body>
</html>