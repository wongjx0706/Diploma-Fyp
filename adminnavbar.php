<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--this reference link is used to get logo from font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <!--navbar css (commonly used for everything)-->
    <link rel="stylesheet" href="navbar.css"/>
</head>

<body>
<div>
        <header>

        <!--navigation bar -->
            <nav class="nav-bar">
                <div class="nav-branding"><a href="adminlanding.php"><img src="images/icon.png" alt=""></a></div>
                <ul class="nav-menu">
                    
                    <li><a href="adminlanding.php"><i class="fa-sharp fa-regular fa-user" style="color: #ffffff;"></i></a></li>
                </ul>

                <div class="hamburger">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </nav>
            
            <!-- js for navbar hamburger -->    
            <script>
                const hamburger = document.querySelector(".hamburger");
                const navMenu = document.querySelector(".nav-menu");

                hamburger.addEventListener("click", () => {
                    hamburger.classList.toggle("active");
                    navMenu.classList.toggle("active");
                })

                document.querySelectorAll(".nav-link").forEach(n => n.addEventListener("click", ()=> {
                    hamburger.classList.remove("active");
                    navMenu.classList.remove("active");
                }))
            </script>
        </header>
</div>
</body>
</html>