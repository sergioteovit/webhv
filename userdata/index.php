<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User data</title>
</head>
<body>  
    <?php
    defined("_JEXEC", 1);
    define("JPATH_BASE", realpath("../.."));

    echo "<h1>Datos del usuario</h1>";

    $jpathbaseDefines = JPATH_BASE . "/includes/defines.php";
    $jpathbaseFramework = JPATH_BASE . "/includes/framework.php";

    echo "The file " . $jpathbaseDefines . " and " . $jpathbaseFramework . " exists.........";

    if (file_exists($jpathbaseDefines) && file_exists($jpathbaseFramework)) {
        echo "The file " . $jpathbaseDefines . " and " . $jpathbaseFramework . " exists.........";

        require_once $jpathbaseDefines;
        require_once $jpathbaseFramework;

        // Get the Joomla application instance
        $app = JFactory::getApplication("site");
        $app->initialise();

        echo "<h1>Datos del usuario</h1>";

        // For Joomla 4.x and above
        //use Joomla\CMS\Factory;
        $user = JFactory::getUser();

        // Accessing user properties
        $userId = $user->id;
        $userName = $user->name;
        $userUsername = $user->username;
        $userEmail = $user->email;
        $userGroups = $user->groups; // An array of group IDs the user belongs to
        $isGuest = $user->guest; // Boolean: true if the user is a guest, false if logged in

        // You can also access user parameters/preferences
        $userParams = $user->getParams();
        $preferredLanguage = $userParams->get("language");

        // Displaying some information (for demonstration)
        echo "User ID: " . $userId . "<br>";
        echo "User Name: " . $userName . "<br>";
        echo "User Email: " . $userEmail . "<br>";
        if ($isGuest) {
            echo "Status: Guest (Not logged in)<br>";
        } else {
            echo "Status: Logged in<br>";
        }
    } else {
        echo "The file " . $jpathbaseDefines . " and " . $jpathbaseFramework . " doesn't exists.........";
    }
    ?>
</body>
</html>