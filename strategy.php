<?php

// Depending on situation you can call different method
// If there is more than 20 characters sort using different method for better performance

interface SOrtStrategy {
    public function sort();
}

class QuickSort {
    private $data;

    public function __construct(Array $data)
    {
        $this->data = $data;
    }

    public function sort()
    {
        return "Quick";
    }
}

class MergeSort {
    private $data;

    public function __construct(Array $data)
    {
        $this->data = $data;
    }

    public function sort()
    {
        return "Merge";
    }
}


function sortData(Array $data) {
    if(count($data) < 20) {
        $tempData = new QuickSort($data);
    } else {
        $tempData = new MergeSort($data);
    }

    echo $tempData->sort();
}

$data = [2, 4, 53, 3, 434, 23, 6, 34, 76, 32, 1, 78, 90];
sortData($data);
