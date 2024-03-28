<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="navbar.css">
    <title></title>
</head>
<body>
    <nav>
        <ul class="nav-list">
            <li><a href="catalogo.php">Início</a></li>
            <li><a href="carrinho.php">Carrinho</a></li>
            <li><a href="#">Sobre</a></li>
            

        </ul>
        <a class="logo" href="index.php"><img src="img/logo.png " alt="logo"></a>
        <?php
            if(isset($_SESSION['id'])){
        ?>
                
                <ul class="nav-user">
                    <li><a href="carrinho.php">Carrinho</a></li>
                    <li><a href="logout.php">Sair</a></li>
                </ul>
        <?php
            }else{
        ?>
               <div class="nav-user">
                    <a class="login" href="login.php">Login</a>
                    <button class="cadastro"href="cadastro.php">Cadastre-se</button>
                </div>
        <?php
            }
        ?>
        <div class="mobile-menu">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
    </nav>

    <script>
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
                  link.style.animation ? (link.style.animation = "") : (link.style.animation = `navLinkFade 0.5s ease forwards ${index / 7 + 0.3}s`);
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
