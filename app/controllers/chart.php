<?php

class Chart extends Controller
{
    public function index()
    { }

    public function get_day()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST['action'] == 'next') {
                // tommorow is 
                $stop_date = new DateTime($_POST['day']);
                $stop_date->modify('+1 day');
                $tommorow = $stop_date->format('Y-m-d');
                // $beginOfDay = date('Y-m-d H:i:s', strtotime("midnight"));
                // $endOfDay   = date('Y-m-d H:i:s', strtotime("tomorrow") - 1);
                $data       = [];
                $sum        = 3600;
                for ($i = 1; $i <= 24; $i++) {
                    $beganOfTime = date('Y-m-d H:i:s', strtotime("$tommorow midnight") + $sum - 3600);
                    $endOfTime   = date('Y-m-d H:i:s', strtotime("$tommorow midnight") + $sum);
                    $log         = DataLog::whereBetween('log_time', [$beganOfTime, $endOfTime])->avg('average_voltage');
                    array_push($data, number_format($log));
                    $sum += 3600;
                }
                $result = [
                    'data' => $data,
                    'tommorow' => $tommorow
                ];
                echo json_encode($result);
                die();
            } elseif ($_POST['action'] == 'pre') {
                // previous day is 
                $stop_date = new DateTime($_POST['day']);
                $stop_date->modify('-1 day');
                $pre = $stop_date->format('Y-m-d');
                $data       = [];
                $sum        = 3600;
                for ($i = 1; $i <= 24; $i++) {
                    $beganOfTime = date('Y-m-d H:i:s', strtotime("$pre midnight") + $sum - 3600);
                    $endOfTime   = date('Y-m-d H:i:s', strtotime("$pre midnight") + $sum);
                    $log         = DataLog::whereBetween('log_time', [$beganOfTime, $endOfTime])->avg('average_voltage');
                    array_push($data, number_format($log));
                    $sum += 3600;
                }
                $result = [
                    'data' => $data,
                    'pre' => $pre
                ];
                echo json_encode($result);

                die();
            }elseif ($_POST['action'] == 'enter') {
                // previous day is 
                $stop_date = new DateTime($_POST['day']);
                // $stop_date->modify('-1 day');
                $date = $stop_date->format('Y-m-d');
                $data       = [];
                $sum        = 3600;
                for ($i = 1; $i <= 24; $i++) {
                    $beganOfTime = date('Y-m-d H:i:s', strtotime("$date midnight") + $sum - 3600);
                    $endOfTime   = date('Y-m-d H:i:s', strtotime("$date midnight") + $sum);
                    $log         = DataLog::whereBetween('log_time', [$beganOfTime, $endOfTime])->avg('average_voltage');
                    array_push($data, number_format($log));
                    $sum += 3600;
                }
                $result = [
                    'data' => $data,
                ];
                echo json_encode($result);
                die();
            }
            echo json_encode('nothing to respond');
            die();
        }
    }
}
