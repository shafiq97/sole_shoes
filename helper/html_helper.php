<?php
// html helper make alert
function alert($message, $type)
{
    return '<div class="alert alert-' . $type . ' alert-dismissible fade show" role="alert">
                ' . $message . '
            </div>';
}
function base_url($link)
{
    return 'http://localhost/shoes/' . $link;
}
function redirect($link)
{
    echo '<script>window.location.href="' . $link . '"</script>';
}
