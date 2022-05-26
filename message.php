<?php

if (isset($_SESSION['message'])) {
    echo '
<div style="width: fit-content;margin: auto;top: 20px;box-shadow: 10px 10px 10px 6px rgb(0 0 0 / 40%); left: 30%; position: absolute; z-index: 10;" class="alert alert-' . $_SESSION['type'] . '">
    <h5 style="text-align: center;">' . $_SESSION['message'] . '</h5>';
    unset($_SESSION['message']);
    unset($_SESSION['type']);
    echo '
</div>';
}
