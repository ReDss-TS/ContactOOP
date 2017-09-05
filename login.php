<?php

include_once 'includes/headHtml.php';

function __autoload($className)
{
    //$className = str_replace("..", "", $className);
    require_once("classes/$className.php");
}

$dataForUpdate = array();
$selectedRadio = 0;
$listWithInputError = '';

if (isset($_POST['enterBtn'])) {
    $arrayData['user_login'] = $_POST['user_login'];
    $arrayData['user_pass'] = $_POST['user_pass'];

    $authentication = new DBM();
    $authentication->authentication($arrayData['user_login'], $arrayData['user_pass']);
}

$formForLogin = new Forms();
$form = $formForLogin->buildForm('user_form', $dataForUpdate, $selectedRadio, $listWithInputError);
?>

<div class = "editBlock" id = "editBlock">
    <form method = "post" action = "login.php">
        <?php echo $form; ?>
        <br/>
        <input class = "button" type = "submit" name = "enterBtn" value = "Enter"/>
        <a href = "register.php" class="button">Register</a>
    </form>
</div>

<?php

include_once 'includes/footer.php';

