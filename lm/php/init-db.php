<?php
// This file walks you through the most common features of PHP's SQLite3 API.
// The code is runnable in its entirety and results in an `analytics.sqlite` file.


// Create a new database, if the file doesn't exist and open it for reading/writing.
// The extension of the file is arbitrary.
$db = new SQLite3('agenda.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);


// Create a table.

$db->query('CREATE TABLE IF NOT EXISTS "personas" (
    "id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    "nombre" VARCHAR,
    "apellidos" VARCHAR,
    "telefono" VARCHAR
)');


// Insert some sample data.
//
// It's advisable to wrap related queries in a transaction (BEGIN and COMMIT),
// even if you don't care about atomicity.
// If you don't do this, SQLite automatically wraps every single query
// in a transaction, which slows down everything immensely. If you're new to SQLite,
// you may be surprised why the INSERTs are so slow.

$db->exec('BEGIN');
$db->query('INSERT INTO "personas" ("nombre", "apellidos", "telefono")
    VALUES ("Keyser", "Söze", "678231456")');
$db->query('INSERT INTO "personas" ("nombre", "apellidos", "telefono")
    VALUES ("Fred", "Fenster", "623672182")');
$db->query('INSERT INTO "personas" ("nombre", "apellidos", "telefono")
    VALUES ("Dean", "Keaton", "651261132")');
$db->exec('COMMIT');


// Insert potentially unsafe data with a prepared statement.
// You can do this with named parameters:

$statement = $db->prepare('INSERT INTO "personas" ("nombre", "apellidos", "telefono")
    VALUES (:nombre, :apellidos, :telefono)');
$statement->bindValue(':nombre', "Todd");
$statement->bindValue(':apellidos', 'Hockney');
$statement->bindValue(':telefono', "678321557");
$statement->execute(); // you can reuse the statement with different values


// Fetch today's visits of user #42.
// We'll use a prepared statement again, but with numbered parameters this time:

$statement = $db->prepare('SELECT * FROM "personas" WHERE "id" = ?');
$statement->bindValue(1, 1);
$result = $statement->execute();

echo("Get the 1st row as an associative array:\n");
print_r($result->fetchArray(SQLITE3_ASSOC));
echo("\n");

echo("Get the next row as a numeric array:\n");
print_r($result->fetchArray(SQLITE3_NUM));
echo("\n");

// If there are no more rows, fetchArray() returns FALSE.

// free the memory, this in NOT done automatically, while your script is running
$result->finalize();


$userCount = $db->querySingle('SELECT COUNT(DISTINCT "id") FROM "personas"');

echo("User count: $userCount\n");
echo("\n");


// Finally, close the database.
// This is done automatically when the script finishes, though.

$db->close();
?>