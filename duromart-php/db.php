<?php
/**
 * db.php
 *
 * This file establishes a connection to the Supabase PostgreSQL database.
 * It is intended to be included at the beginning of any script
 * that needs to interact with the database.
 */

// Define database connection constants for Supabase.
// Replace the values with your actual Supabase credentials.
define('DB_SERVER', 'db.sgurgsblrlridrowcypr.supabase.co');
define('DB_PORT', 5432);
define('DB_USERNAME', 'postgres');
define('DB_PASSWORD', 'Tx*#ep?kt89pNbu');
define('DB_NAME', 'postgres'); // Changed from 'postgrest' to 'postgres'

// Attempt to establish a connection to the PostgreSQL database.
// The connection string is a single parameter for pg_connect.
$conn_string = "host=" . DB_SERVER . " port=" . DB_PORT . " dbname=" . DB_NAME . " user=" . DB_USERNAME . " password=" . DB_PASSWORD;

$conn = pg_connect($conn_string);

// Check the connection.
if (!$conn) {
    die("ERROR: Could not connect to the database.");
}

// Set character set to UTF-8.
pg_set_client_encoding($conn, "UTF-8");

?>