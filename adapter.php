<?php

/**
 * Adapter enables classes with incompatible interfaces to work together
 * Incompatible can be method name and/or output
 */


// Old File Writer
abstract class FileWriter
{
    abstract public function writeToFile($data): bool;
}

// Old CSV file writer
class CsvFileWriter extends FileWriter
{
    public function writeToFile($data): bool
    {
        // Open the file for writing. Write to the file and close the file
        print PHP_EOL . 'Writing to the csv file...' . PHP_EOL;
        sleep(2);
        return true;
    }
}


// New File Writer not compatible with an old one (different method name)
interface NewFileWriter
{
    public function write($data);
}

// New CSV file writer not compatible with an old ona (different method name and no output)
class NewCsvFileWriter implements NewFileWriter
{
    // Different name of method
    public function write($data): void
    {
        // Open the file for writing. Write to the file and close the file
        print PHP_EOL . 'Writing to the csv file...' . PHP_EOL;
        sleep(2);
    }

    // Does not return anything
}


// Adapter. Its method has compatible name and run a new method within. Also provides output
class NewFileWriterAdapter extends FileWriter
{
    private NewFileWriter $fileWriter;

    public function __construct(NewFileWriter $fileWriter)
    {
        $this->fileWriter = $fileWriter;
    }
    public function writeToFile($data): bool
    {
        $this->fileWriter->write($data);
        return true;
    }
}


// File processor which must be compatible for both new and old (it is kept as it is for Old, no changes here)
class RandomProcessor
{
    private FileWriter $fileWriter;

    public function __construct(FileWriter $fileWriter)
    {
        $this->fileWriter = $fileWriter;
    }

    /**
     * @throws Exception
     */
    public function process(array $data): bool
    {
        $result = $this->fileWriter->writeToFile($data);

        if(!$result) {
            throw new Exception('Error writing to file');
        }

        //Continue Processing
        print 'Continue processing...' . PHP_EOL;

        return true;
    }
}


// Call adapter (new)
$newCsvFileWriter = new NewCsvFileWriter();
$fileWriter = new NewFileWriterAdapter($newCsvFileWriter);

// Call old method - no changes here
//$fileWriter = new CsvFileWriter();

// Now you can use Random processor for new and for old
$processor = new RandomProcessor($fileWriter);

// Proof of concept
try {
    return $processor->process(['foo' => 'bar']);
} catch (Exception $e) {
    return $e->getMessage();
}