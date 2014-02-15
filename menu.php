<?php
global $loggedin;
global $admin;
global $confirmed;
global $username;

echo("<div id=topPanel><ol>");
if($loggedin){
    echo <<<_END
    <a id="profile" href='index.php?page=profile&name=$username'>Profile</a>
    <a id="logout" href='index.php?page=login&action=logout'>Logout</a>
_END;
}else{
    echo <<<_END
        <a id="login" href='index.php?page=login'>Login</a>
        <a id="register" href='index.php?page=register'>Register</a>
_END;
}


echo <<<_END
</ol>
</div>
<div id=menu>
    <ol>
        <li><a href='index.php?page=home'>Home</a></li>
        <li><a href='index.php?page=recipes'>Recipes & Resources</a></li>
        <li><a href='index.php?page=tutorials'>Tutorials</a></li>
        <li><a href='index.php?page=servers'>Servers</a></li>
        <li><a href='index.php?page=tutorials'>Links</a></li>
    </ol>
</div>
_END;

echo("<nav>");

echo("</nav>");

