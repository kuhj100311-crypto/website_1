<?php
session_start();
session_destroy();
?>

<script>
    alert("You are successfully logged out!");
    location.href = "../index.html";
</script>