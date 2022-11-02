<?php
    if (isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"]) {
        $isLoggedIn = $_SESSION["isLoggedIn"];
    }
    else { 
        $isLoggedIn = false;
    }
?>
        </div>
        <div class="mt-3 mb-3">
            <hr>
            <ul class="nav justify-content-center">
                <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                <?php echo $isLoggedIn 
                ? "<li class=\"nav-item\"><a class=\"nav-link\" href=\"add.php\">Add New Animal</a></li><li class=\"nav-item\"><a class=\"nav-link\" href=\"logout.php\">Log Out</a></li>" 
                : "<li class=\"nav-item\"><a class=\"nav-link\" href=\"login.php\">Login</a></li>"; ?>
            </ul>
        </div>
        
    <script src="js/bootstrap.bundle.min.js"></script>
    </body>
</html>