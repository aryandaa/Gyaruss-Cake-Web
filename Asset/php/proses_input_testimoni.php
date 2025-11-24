<?php
include "../include/connect.php";
$query = "INSERT INTO testimoni (nama, email, pesan) VALUES
    ('$_POST[nama]', '$_POST[email]', '$_POST[pesan]')";