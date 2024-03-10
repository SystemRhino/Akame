<?php
include('./php/conecta.php');
include('footer.php');
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <link rel="stylesheet" href="./css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/footer.css">

    <title>Akame</title>
</head>
<body>


<nav>
        <a class="logo" href="/"><img src="img/3dgifmaker87728.gif" alt="logo" width="100   "></a>
        <div class="mobile-menu">
          <div class="line1"></div>
          <div class="line2"></div>
          <div class="line3"></div>
        </div>
        <ul class="nav-list">
          <li><a href="php/navbar.php">Início</a></li>
          <li><a href="#">Sobre</a></li>
          <li><a href="#">Projetos</a></li>
          <li><input type="text"></li>
        </ul>
      </nav>


    

    <div class="main">
    <aside class="left"> 
    Left
    </aside>

    <main>centro
    </main>
<aside class="right">right</aside>
    </div>


    <footer>
        <div class="container">
            <div class="footer-content">
                <h3>Contact Us</h3>
                <p><a href="pags/login.php">login</a></p>
                <p>Phone:+121 56556 565556</p>
                <p>Address:Your Address 123 street</p>
            </div>
            <div class="footer-content">
                <h3>Quick Links</h3>
                 <ul class="list">
                    <li><a href="">Home</a></li>
                    <li><a href="">About</a></li>
                    <li><a href="">Services</a></li>
                    <li><a href="">Products</a></li>
                    <li><a href="">Contact</a></li>
                 </ul>
            </div>
            <div class="footer-content">
                <h3>Follow Us</h3>
                <ul class="social-icons">
                 <li><a href=""><i class="fab fa-facebook"></i></a></li>
                 <li><a href=""><i class="fab fa-twitter"></i></a></li>
                 <li><a href=""><i class="fab fa-instagram"></i></a></li>
                 <li><a href=""><i class="fab fa-linkedin"></i></a></li>
                </ul>
                </div>
        </div>
        <div class="bottom-bar">
            <p>&copy; 2024, Akame Organization BY botzin</p>
        </div>
    </footer>


<div id="enterPag">
<img src="./img/logo-gif.gif" alt=""><br>
    <h1 id="clickEnter" style="cursor:pointer;">[ENTER]</h1>
</div>



<script>
document.getElementById("clickEnter").addEventListener("click", function() {
document.getElementById("enterPag").style.display = "none";
});

class MobileNavbar {
  constructor(mobileMenu, navList, navLinks) {
    this.mobileMenu = document.querySelector(mobileMenu);
    this.navList = document.querySelector(navList);
    this.navLinks = document.querySelectorAll(navLinks);
    this.activeClass = "active";

    this.handleClick = this.handleClick.bind(this);
  }

  animateLinks() {
    this.navLinks.forEach((link, index) => {
      link.style.animation
        ? (link.style.animation = "")
        : (link.style.animation = `navLinkFade 0.5s ease forwards ${
            index / 7 + 0.3
          }s`);
    });
  }

  handleClick() {
    this.navList.classList.toggle(this.activeClass);
    this.mobileMenu.classList.toggle(this.activeClass);
    this.animateLinks();
  }

  addClickEvent() {
    this.mobileMenu.addEventListener("click", this.handleClick);
  }

  init() {
    if (this.mobileMenu) {
      this.addClickEvent();
    }
    return this;
  }
}

const mobileNavbar = new MobileNavbar(
  ".mobile-menu",
  ".nav-list",
  ".nav-list li",
);
mobileNavbar.init();
</script>

</body>
</html>
