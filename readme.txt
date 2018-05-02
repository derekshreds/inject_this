Inject This! - Readme
https://github.com/derekshreds
---------------------

function use:
    inject_this(query, arg1, arg2, arg3...)

inject_this will replace %ijt with the arguments in the same order.

---------------------
Instead of insecure method:
    $query = "SELECT * FROM `Users` WHERE username='" . $_POST["username"] . "'" . "AND password='" . $_POST["password"] . "'";

Do this:
    $query = inject_this("SELECT * FROM 'Users' WHERE username=%ijt AND password=%ijt", $_POST["username"], $_POST["password"]);

inject_this will autoformat to prevent sql and html injection.
