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


class TemplateFacade {
    public function serveAndLog($id, $msg = '')
    {
        // We have to do all these things for each template ID
        $db = new Database();
        $data = $db->getData($id);

        $logger = new Logger();
        $logger->log($msg);

        $template = new Template();
        $template->serve();
    }
}

$id = $_GET['id']; // i.e. 23

// We just call facade so all is called at once
$page = new TemplateFacade();
$page->serveAndLog($id, "Accessing page with ID {$id} by user");

// Facade seems to be against single responsibility principle...