<?php
declare(strict_types=1);
require_once "config/koneksi.php";

function flashMessage(string $type, $msg) :void {
    $alert = ["alertType" => $type, "alertMessage" => $msg];
    $_SESSION['alert'] = $alert;
    $_SESSION['alert-shown'] = false;
}

function setOldInput(string $name,$value) :void {
    $old = [$name => $value];
    $_SESSION['oldinput'] = $old;
}

function clearOldInput() :void {
    unset($_SESSION['oldinput']);
}

function consoleMessage(string $msg) :void {
    echo "<script>console.log('$msg');</script>";
}

function alertIconGenerator(string $type) :string {
    switch ($type) {
        case 'info':
            return '<svg class="bi flex-shrink-0 me-2" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>';
        case 'success':
            return '<svg class="bi flex-shrink-0 me-2" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>';
        case 'warning':
            return '<svg class="bi flex-shrink-0 me-2" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>';
        case 'danger':
            return '<svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>';
        }

    }
        
function getFirstName(string $name) {
    return explode(" ", $name)[0];
}

function back() :void {
    $destination = $_SERVER['HTTP_REFERER'];
    header("Location: $destination");
    exit(0);
}

function redirectTo(string $dest) :void {
    header("Location: $dest");
    exit(0);    
}

function isAuth() :bool {
    return isset($_SESSION['auth']) || isset($nim) || isset($nama);
}

function showAlert(string $type, $message) :void {
    $icon = alertIconGenerator($type);

    echo '<div class="alert alert-'.$type.' d-flex align-items-center py-2 alert-space" role="alert">
    '.$icon.'<div>'.
    $message.
    '</div></div>';

    $_SESSION['alert-shown'] = true;
}

    
$dbFetcher = function(string $query, bool $fetchAll = true, array $param = []) use($con) :array {
    try {
        $statement = $con->prepare($query); 
        $statement->execute($param);
        $result = $fetchAll ? $statement->fetchAll() : $statement->fetch();
        return $result; 
    } catch (\PDOException $th) {
        throw $th;
    }
};

$dbPush = function(string $table, array $data) use ($con) :bool {
    try {
        $columns = implode(',', array_keys($data));
        $values = '"' . join('","', array_values($data)) . '"';
        $statement = $con->prepare("INSERT INTO $table ($columns) VALUES($values);");
        return $statement->execute();
    } catch (\PDOException $th) {
        throw $th;
    }
};

$dbDestroy = function(string $table, array $id) use($con) :bool {
    try {
        $prim = array_keys($id)[0];
        $idPrim = array_values($id)[0];
        $statement = $con->prepare("DELETE FROM $table WHERE $prim = $idPrim;");
        return $statement->execute();
    } catch (\PDOException $th) {   
        throw $th;
    }
};