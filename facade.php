<?php

// Connects to some database
class Database
{
}

// Generate an HTML template
class Template
{
}

// Logg user action
class Logger
{
}

// We have to do all these things for each template ID
$id = $_GET['id']; // i.e. 23

$db = new Database();
$data = $db->getData($id);

$logger = new Logger();
$logger->log("Accessing page with ID {$id} by user");

$template = new Template();
$template->serve();
