
<?php



//$coverage = new \SebastianBergmann\CodeCoverage\CodeCoverage;
$coverage = new \SebastianBergmann\CodeCoverage\CodeCoverage();
$coverage->start('kaka');

// ...

$coverage->stop();

$writer = new \SebastianBergmann\CodeCoverage\Report\Clover;
$writer->process($coverage, '/tmp/clover.xml');

$writer = new \SebastianBergmann\CodeCoverage\Report\Html\Facade;
$writer->process($coverage, '/tmp/code-coverage-report');