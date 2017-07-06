<?php

//set session path
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']).'/session'));
//clear previous sessions
ini_set('session.gc_probability', 1);
//start session
session_start();

// remove all session variables
session_destroy();

header("Location: ./index.php");

?>


