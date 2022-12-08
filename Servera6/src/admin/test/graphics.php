<?php
include_once "./create_watermark.php";
require_once($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');
use Amenadiel\JpGraph\Graph;
use Amenadiel\JpGraph\Plot;

function drawByDuration($orders) {
    $graph = new Graph\PieGraph(700, 700);
    $graph->title->Set("Duration");
    $graph->SetBox(true);
    $data = array();
    foreach ($orders as $order) {
        array_push($data, $order->duration);
    }
    $p1 = new Plot\PiePlot($data);
    $p1->ShowBorder();
    $p1->SetColor('black');
    $graph->Add($p1);
    $graph->Stroke('./img/duration_graph.png');
    create_watermark('./img/duration_graph.png', './img/watermarked_duration_graph.png');
}

function drawByCost($orders) {
    $datax = array();
    for ($i = 1; $i <= 50; $i++) {
        array_push($datax, $i);
    }
    $datay = array();
    $min = NULL;
    $max = NULL;
    foreach ($orders as $order) {
        if ($min == NULL || $min > $order->cost) {
            $min = $order->cost;
        }
        if ($max == NULL || $max < $order->cost) {
            $max = $order->cost;
        }
        array_push($datay, $order->cost);
    }
    $graph = new Graph\Graph(700, 700,'auto');
    $graph->title->Set("Cost");
    $graph->SetScale("textlin");
    
    $top = 50;
    $bottom = 80;
    $left = 50;
    $right = 20;
    $graph->Set90AndMargin($left,$right,$top,$bottom);
    $graph->xaxis->SetPos('min');
    $graph->xaxis->SetTickLabels($datax);
    $graph->xaxis->SetLabelMargin(5);
    $graph->xaxis->SetLabelAlign('right','center');
    $graph->yaxis->scale->SetGrace(20);
    $graph->yaxis->SetPos('max');
    
    $bplot = new Plot\BarPlot($datay);
    $bplot->value->Show();
    $graph->Add($bplot);
    $graph->Stroke('./img/cost_graph.png');
    create_watermark('./img/cost_graph.png', './img/watermarked_cost_graph.png');
}

function drawByTime($orders) {
    $TimeCallback = function ($aVal) {
        return date('d.m.Y H:i:s', $aVal);
    };

    $datay = array();
    for ($i = 1; $i <= 50; $i++) {
        array_push($datay, $i);
    }
    $datax = array();
    $min = NULL;
    $max = NULL;
    foreach ($orders as $order) {
        if ($min == NULL || $min > $order->registration_time) {
            $min = $order->registration_time;
        }
        if ($max == NULL || $max < $order->registration_time) {
            $max = $order->registration_time;
        }
        array_push($datax, $order->registration_time);
    }
    $graph = new Graph\Graph(900, 700);
    $graph->SetMargin(200, 50, 50, 50);
    $graph->title->Set("Time");
    $graph->SetAlphaBlending();
    $graph->SetScale('intlin', $min, $max, 0, 50);
    $graph->yaxis->SetLabelFormatCallback($TimeCallback);
    $p1 = new Plot\LinePlot($datax, $datay);
    $graph->Add($p1);
    $graph->Stroke('./img/time_graph.png');
    create_watermark('./img/time_graph.png', './img/watermarked_time_graph.png');
}
?>
