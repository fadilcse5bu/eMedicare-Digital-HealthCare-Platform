<?php     
    session_start();
    session_destroy();
      
    header("Location: http://localhost/emedicare/userAuthentication/index.php")
;?>