<?php
function showMessage($message, $type = 'error') {
    // $type can be 'error' or 'success'
    $color = $type === 'success' ? 'green' : 'red';
    return "<p style='color: $color; font-weight: bold;'>$message</p>";
}
?>