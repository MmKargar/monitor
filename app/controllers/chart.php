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
                    array_push($data, $log);
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
                    array_push($data, $log);
                    $sum += 3600;
                }
                $result = [
                    'data' => $data,
                    'pre' => $pre
                ];
                echo json_encode($result);

                die();
            } elseif ($_POST['action'] == 'enter') {
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
                    array_push($data, $log);
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

    public function get_month()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST['action'] == 'next') {
                $month = $_POST['month-date'];
                $year = $_POST['month-year-date'];
                $month = date('Y-m-01', strtotime("$year-$month-01"));
                $month = date("$year-m-01", strtotime("$month +1 month"));
                $first_day_this_month     = date('01-m-Y', strtotime($month));
                $number_day_of_this_month = cal_days_in_month(CAL_GREGORIAN, date('m', strtotime($month)), date('Y', strtotime($month)));
                $day  = $first_day_this_month;
                $data = [];
                for ($i = 1; $i <= $number_day_of_this_month; $i++) {
                    $beganOfTime = date('Y-m-d H:i:s', strtotime("$day"));
                    $endOfTime   = date('Y-m-d H:i:s', strtotime("$day +1 day"));
                    $log         = DataLog::whereBetween('log_time', [$beganOfTime, $endOfTime])->avg('average_power');
                    array_push($data, $log);
                    $day = date('Y-m-d H:i:s', strtotime("$day +1 day"));
                }
                $result = [
                    'month_date' => date('m', strtotime($month)),
                    'month_year_date' => date('Y', strtotime($month)),
                    'data' => $data
                ];
                echo json_encode($result);
                die();
            } elseif ($_POST['action'] == 'pre') {
                $month = $_POST['month-date'];
                $year = $_POST['month-year-date'];
                $month = date('Y-m-01', strtotime("$year-$month-01"));
                $month = date("$year-m-01", strtotime("$month -1 month"));
                $first_day_this_month     = date('01-m-Y', strtotime($month));
                $number_day_of_this_month = cal_days_in_month(CAL_GREGORIAN, date('m', strtotime($month)), date('Y', strtotime($month)));
                $day  = $first_day_this_month;
                $data = [];
                for ($i = 1; $i <= $number_day_of_this_month; $i++) {
                    $beganOfTime = date('Y-m-d H:i:s', strtotime("$day"));
                    $endOfTime   = date('Y-m-d H:i:s', strtotime("$day +1 day"));
                    $log         = DataLog::whereBetween('log_time', [$beganOfTime, $endOfTime])->avg('average_power');
                    array_push($data, $log);
                    $day = date('Y-m-d H:i:s', strtotime("$day +1 day"));
                }
                $result = [
                    'month_date' => date('m', strtotime($month)),
                    'month_year_date' => date('Y', strtotime($month)),
                    'data' => $data
                ];
                echo json_encode($result);
                die();
            } elseif ($_POST['action'] == 'change') {
                $month = $_POST['month-date'];
                $year = $_POST['month-year-date'];
                $month = date('Y-m-01', strtotime("$year-$month-01"));
                // $month = date("$year-m-01", strtotime("$month -1 month"));
                $first_day_this_month     = date('01-m-Y', strtotime($month));
                $number_day_of_this_month = cal_days_in_month(CAL_GREGORIAN, date('m', strtotime($month)), date('Y', strtotime($month)));
                $day  = $first_day_this_month;
                $data = [];
                for ($i = 1; $i <= $number_day_of_this_month; $i++) {
                    $beganOfTime = date('Y-m-d H:i:s', strtotime("$day"));
                    $endOfTime   = date('Y-m-d H:i:s', strtotime("$day +1 day"));
                    $log         = DataLog::whereBetween('log_time', [$beganOfTime, $endOfTime])->avg('average_power');
                    array_push($data, $log);
                    $day = date('Y-m-d H:i:s', strtotime("$day +1 day"));
                }
                $result = [
                    'month_date' => date('m', strtotime($month)),
                    'month_year_date' => date('Y', strtotime($month)),
                    'data' => $data
                ];
                echo json_encode($result);
                die();
            }
            echo json_encode('nothing to respond');
            die();
        }
    }

    public function get_year()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST['action'] == 'next') {
                $sent_year = $_POST['year-date'];
                $year   = date('Y-01-01',  strtotime("$sent_year-01-01  +1 year"));
                $data = [];
                for ($i = 1; $i <= 12; $i++) {
                    $day_nums    = cal_days_in_month(CAL_GREGORIAN, date('m', strtotime($year)), date('Y', strtotime($year)));
                    $beganOfTime = date('Y-m-01', strtotime($year));
                    $endOfTime   = date("Y-m-$day_nums", strtotime($year));
                    $log         = DataLog::whereBetween('log_time', [$beganOfTime, $endOfTime])->avg('total_yield');
                    array_push($data, $log);
                    $year = date('Y-m-d', strtotime(" $year +1 month"));
                }
                $year   = date('Y-01-01',  strtotime("$sent_year-01-01  +1 year"));
                $labels = [];
                for ($i = 1; $i <= 12; $i++) {
                    $temp_month = date('M', strtotime($year));
                    $temp_year = date('Y', strtotime($year));
                    array_push($labels, $temp_month . ' ' . $temp_year);
                    $year   = date('Y-m-d', strtotime(" $year +1 month"));
                }
                $year_date   = date('Y',  strtotime("$sent_year-01-01  +1 year"));
                $result = [
                    'year_date' => $year_date,
                    'data'      => $data,
                    'labels'    => $labels
                ];
                echo json_encode($result);
                die();
            } elseif ($_POST['action'] == 'pre') {
                $sent_year = $_POST['year-date'];
                $year   = date('Y-01-01',  strtotime("$sent_year-01-01  -1 year"));
                $data = [];
                for ($i = 1; $i <= 12; $i++) {
                    $day_nums    = cal_days_in_month(CAL_GREGORIAN, date('m', strtotime($year)), date('Y', strtotime($year)));
                    $beganOfTime = date('Y-m-01', strtotime($year));
                    $endOfTime   = date("Y-m-$day_nums", strtotime($year));
                    $log         = DataLog::whereBetween('log_time', [$beganOfTime, $endOfTime])->avg('total_yield');
                    array_push($data, $log);
                    $year = date('Y-m-d', strtotime(" $year +1 month"));
                }
                $year   = date('Y-01-01',  strtotime("$sent_year-01-01  -1 year"));
                $labels = [];
                for ($i = 1; $i <= 12; $i++) {
                    $temp_month = date('M', strtotime($year));
                    $temp_year = date('Y', strtotime($year));
                    array_push($labels, $temp_month . ' ' . $temp_year);
                    $year   = date('Y-m-d', strtotime(" $year +1 month"));
                }
                $year_date   = date('Y',  strtotime("$sent_year-01-01  -1 year"));
                $result = [
                    'year_date' => $year_date,
                    'data'      => $data,
                    'labels'    => $labels
                ];
                echo json_encode($result);
                die();
            } elseif ($_POST['action'] == 'change') {
                $sent_year = $_POST['year-date'];
                $year   = date('Y-01-01',  strtotime("$sent_year-01-01 "));
                $data = [];
                for ($i = 1; $i <= 12; $i++) {
                    $day_nums    = cal_days_in_month(CAL_GREGORIAN, date('m', strtotime($year)), date('Y', strtotime($year)));
                    $beganOfTime = date('Y-m-01', strtotime($year));
                    $endOfTime   = date("Y-m-$day_nums", strtotime($year));
                    $log         = DataLog::whereBetween('log_time', [$beganOfTime, $endOfTime])->avg('total_yield');
                    array_push($data, $log);
                    $year = date('Y-m-d', strtotime(" $year +1 month"));
                }
                $year   = date('Y-01-01',  strtotime("$sent_year-01-01"));
                $labels = [];
                for ($i = 1; $i <= 12; $i++) {
                    $temp_month = date('M', strtotime($year));
                    $temp_year = date('Y', strtotime($year));
                    array_push($labels, $temp_month . ' ' . $temp_year);
                    $year   = date('Y-m-d', strtotime(" $year +1 month"));
                }
                $year_date   = date('Y',  strtotime("$sent_year-01-01"));
                $result = [
                    'year_date' => $year_date,
                    'data'      => $data,
                    'labels'    => $labels
                ];
                echo json_encode($result);
                die();
            }
            echo json_encode('nothing to respond');
            die();
        }
    }

    public function get_total(){
        echo 'get total function';
        die();
    }
}
