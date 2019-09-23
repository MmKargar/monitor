<?php
if (isset($data['validate-error']) && isset($data['errors']) && !isset($data['unique_error']) && !isset($data['error-upload']) ) {
    echo "<div class='alert alert-danger' > <ul >";
    foreach ($data['errors']->firstOfAll() as $error) {
        echo "<li> $error </li>";
    }
    echo "</ul> </div>";
}

if (isset($data['unique_error']) ) {
    echo "<div class='alert alert-danger' > <ul >";
    foreach ($data['errors'] as $error) {
        echo "<li> $error </li>";
    }
    echo "</ul> </div>";
}

if (isset($data['success']) ) {
    echo "<div class='alert alert-success' > <ul >";
    foreach ($data['success'] as $success) {
        echo "<li> $success </li>";
    }
    echo "</ul> </div>";
}

// just errors
if (isset($data['errors']) && !isset($data['unique_error']) && !isset($data['validate-error']) ) {
    echo "<div class='alert alert-danger' > <ul >";
    foreach ($data['errors'] as $error) {
        echo "<li> $error </li>";
    }
    echo "</ul> </div>";
}
?>
