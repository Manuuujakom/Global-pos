<?php
/**
 * db.php
 *
 * This file establishes a connection to the Supabase PostgreSQL database
 * using a single DATABASE_URL string, a common practice for
 * deployment environments.
 */

// Your Supabase database connection URL.
$databaseUrl = "postgresql://postgres:Tx*%23ep%3Fkt89pNbu@db.sgurgsblrlridrowcypr.supabase.co:5432/postgres";

// Parse the DATABASE_URL to extract its components.
$url = parse_url($databaseUrl);

// Ensure the URL was parsed successfully.
if ($url === false) {
    die("ERROR: Could not parse the DATABASE_URL.");
}

// Build the connection string for pg_connect.
$conn_string = sprintf(
    "host=%s port=%s dbname=%s user=%s password=%s",
    $url['host'],
    $url['port'],
    ltrim($url['path'], '/'), // Remove the leading slash from the path.
    $url['user'],
    // pg_connect expects a decoded password.
    rawurldecode($url['pass']) 
);

// Attempt to establish a connection to the PostgreSQL database.
$conn = pg_connect($conn_string);

// Check the connection.
if (!$conn) {
    die("ERROR: Could not connect to the database.");
}

// Set character set to UTF-8.
pg_set_client_encoding($conn, "UTF-8");

?>