<?php namespace KevBaldwyn\Miner\Data;

use KevBaldwyn\Miner\Data\Point;
use KevBaldwyn\Miner\Utils\Maths;

class DataSetSupport {

    private $data;

    /**
     * values is an array of data points with the corresponding value for that data point in the data collection
     * we store this to stop computing them each time they're needed
     * @var array
     */
    private $values = [];

    private $absoluteStandardDeviations = [];

    public function __construct(Set $data)
    {
        $this->data = $data;
    }

    public function getModifiedStandardScoreFor(Point $dataPoint)
    {
        $median    = Maths::median($this->getValues($dataPoint));
        $deviation = $this->getAbsoluteStandardDeviation($dataPoint);

        return ($dataPoint->getValue() - $median) / $deviation;
    }

    public function getValues(Point $dataPoint)
    {
        if(!array_key_exists($dataPoint->getKey(), $this->values)) {
            $values = [];
            foreach($this->data as $collection) {
                if($collection->hasDataPoint($dataPoint)) {
                    $values[] = $collection->getDataPoint($dataPoint)->getValue();
                }
            }
            sort($values);
            $this->values[$dataPoint->getKey()] = $values;
        }
        return $this->values[$dataPoint->getKey()];
    }

    public function getAbsoluteStandardDeviation(Point $dataPoint)
    {
        if(!array_key_exists($dataPoint->getKey(), $this->absoluteStandardDeviations)) {
            $value = $this->getValues($dataPoint);
            $median = Maths::median($value);

            $deviation = (1/count($value)) * Maths::sum($value, function($itemValue) use($median) {
                return abs($itemValue - $median);
            });

            $this->absoluteStandardDeviations[$dataPoint->getKey()] = $deviation;
        }
        return $this->absoluteStandardDeviations[$dataPoint->getKey()];
    }
}