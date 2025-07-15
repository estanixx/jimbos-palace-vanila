<?php
// The full connection URL provided by Neon
$connection_url = 'postgresql://neondb_owner:npg_DwvYTBatW14P@ep-orange-flower-aensusa7-pooler.c-2.us-east-2.aws.neon.tech/neondb?sslmode=require';

// Establish connection using the URL
$conn = pg_connect($connection_url);

// Check connection
if (!$conn) {
    die("Connection failed: " . pg_last_error());
}
?>