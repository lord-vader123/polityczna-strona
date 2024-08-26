<!DOCTYPE html>
<html lang="pl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/css/style.css">
  <title>Strona polityczna</title>

</head>

<body>

  <header>
    <div class="title">
    <h1> Polityczna Strona </h1>
    </div>
    <div class="menu">
      <div class="navbar">
        <a href="index.php">Strona Główna</a>
        <a href="about:blank">Aktualności</a>

        <div class="dropdown">
        <button class="dropbtn">Listy<i class="fa fa-caret-down"></i></button>
        <div class="dropdown-content">
          <a href="about:blank">Partie</a>
          <a href="about:blank">Politycy</a>
        </div>
      </div> 

      <div class="dropdown">
        <button class="dropbtn">Narzędzia<i class="fa fa-caret-down"></i></button>
        <div class="dropdown-content">
          <a href="about:blank">Dodaj partie</a>
          <a href="about:blank">Dodaj polityka</a>
        </div>
      </div> 
    </div>
    <!--Wymaga popraw (zrobie to kiedyś) -->


  </div>

  <div class="login">
      <div class="dropdown">
      <img style="width: 100px; height: 100px;" src="/assets/img/trzymaczmiejsca.png">
        <div class="dropdown-content">
          <a href="/php/login.php">Zaloguj się</a>
          <a href="/php/registration.php">Zarejestruj się</a>
        </div>


  </div>
</div>
  </header>

  <div class="content">
  <p>Aktualna ilość partii: </p>
  <p>Aktualna ilość okręgów wyborczych: </p>
  <p>Aktualna ilość polityków: </p>

  </div>
  

</body>

</html>
