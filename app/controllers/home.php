<?php


class Home extends Controller
{
    public function index($name = '')
    {
        $settings = Setting::findOrFail(1);
        $time_delay = $settings->time_delay;
        // with 20 seconds delay
        $datetime = date('Y-m-d H:i:s', strtotime("-$time_delay second"));
        // $datetime = date('Y-m-d H:i:s', time());
        $datalog = DataLog::where('log_time', $datetime)->first();

        if (!$datalog) {
            // system doesn't set values show network disconnected
            $datalog = new DataLog();
            $datalog->global_irradiation = 'network disconnected';
            $datalog->wind_speed         = 'network disconnected';
            $datalog->pv_temp            = 'network disconnected';
            $datalog->ambient_temp       = 'network disconnected';
            $datalog->total_power        = 'network disconnected';
            $datalog->average_power      = 'network disconnected';
            $datalog->average_voltage    = 'network disconnected';
            $datalog->total_yield        = 'network disconnected';
            $datalog->messages           = 'network disconnected';
        }

        if ($datalog->global_irradiation == '0.00000') {
            // its night show the 0
            $datalog->global_irradiation = '0';
            $datalog->wind_speed         = '0';
            $datalog->pv_temp            = '0';
            $datalog->ambient_temp       = '0';
            $datalog->total_power        = '0';
            $datalog->average_power      = '0';
            $datalog->average_voltage    = '0';
            $datalog->total_yield        = '0';
            $datalog->messages           = '0';
        }

        // insert and delete fake data
        // $this->insert_data();
        // $this->truncate_all();

        $average_power = 0;
        $total_power = 0;
        $total_yield = 0;
        if ($datalog->average_power != 'network disconnected') {
            $average_power = $datalog->average_power / 80;
            $total_power = $datalog->total_power / 12000;
            $total_yield = $datalog->total_yield / 70000;

            $average_power = number_format($average_power * 100);
            $total_power = number_format($total_power * 100);
            $total_yield = number_format($total_yield * 100);
        }

        // get day chart data
        $labels  = $this->labels();
        $dataset = $this->dataset();

        // get month chart data
        $month_labels = $this->month_labels();
        $month_data   = $this->month_data();
        $years        = $this->get_years();

        // get year chart data 
        $year_labels = $this->year_labels();
        $year_data   = $this->year_data();

        // get total chart data
        $total_data   = $this->total_data();

        $this->view('home/index',  [
            'settings'      => $settings,
            'datalog'       => $datalog,
            'average_power' => $average_power,
            'total_power'   => $total_power,
            'total_yield'   => $total_yield,
            'labels'        => json_encode($labels),
            'dataset'       => json_encode($dataset),
            'month_data'    => json_encode($month_data),
            'month_labels'  => json_encode($month_labels),
            'years'         => $years,
            'year_data'     => json_encode($year_data),
            'year_labels'   => json_encode($year_labels),
            'total_labels'  => json_encode($years),
            'total_data'    => json_encode($total_data)
        ]);
    }

    public function labels()
    {
        $labels = [];
        $sum =  3600;
        for ($i = 1; $i <= 24; $i++) {
            $label = date('HA', strtotime("midnight") + $sum);
            array_push($labels, $label);
            $sum += 3600;
        }

        return $labels;
    }

    public function dataset()
    {
        $beginOfDay = date('Y-m-d H:i:s', strtotime("midnight"));
        $endOfDay   = date('Y-m-d H:i:s', strtotime("tomorrow") - 1);
        $data       = [];
        $sum        = 3600;
        for ($i = 1; $i <= 24; $i++) {
            $beganOfTime = date('Y-m-d H:i:s', strtotime("midnight") + $sum - 3600);
            $endOfTime   = date('Y-m-d H:i:s', strtotime("midnight") + $sum);
            $log         = DataLog::whereBetween('log_time', [$beganOfTime, $endOfTime])->avg('total_power');
            array_push($data, $log);
            $sum += 3600;
        }
        $dataset = [
            'label'           => 'Total Power',
            'backgroundColor' => 'rgb(255, 99, 132)',
            'borderColor'     => 'rgb(255, 99, 132)',
            'data'            => $data
        ];

        return $data;
    }

    public function month_data()
    {
        $first_day_this_month     = date('01-m-Y');                                                            // hard-coded '01' for first day
        $last_day_this_month      = date('t-m-Y');
        $number_day_of_this_month = cal_days_in_month(CAL_GREGORIAN, date('m', time()), date('Y', time()));
        $day  = $first_day_this_month;
        $data = [];
        for ($i = 1; $i <= $number_day_of_this_month; $i++) {
            $beganOfTime = date('Y-m-d H:i:s', strtotime("$day"));
            $endOfTime   = date('Y-m-d H:i:s', strtotime("$day +1 day"));
            $log         = DataLog::whereBetween('log_time', [$beganOfTime, $endOfTime])->avg('average_power');
            array_push($data, $log);
            $day = date('Y-m-d H:i:s', strtotime("$day +1 day"));
        }
        return $data;
    }

    public function month_labels()
    {
        $first_day_this_month     = date('Y-m-01');                                                            // hard-coded '01' for first day
        $last_day_this_month      = date('t-m-Y');
        $number_day_of_this_month = cal_days_in_month(CAL_GREGORIAN, date('m', time()), date('Y', time()));
        $day  = $first_day_this_month;
        $labels = [];
        for ($i = 1; $i <= $number_day_of_this_month; $i++) {
            array_push($labels, $day);
            $day = date('Y-m-d', strtotime("$day +1 day"));
        }
        return $labels;
    }

    public function get_years()
    {
        $lower_date  = DataLog::orderBy('log_time', 'asc')->pluck('log_time')->first();
        $higher_date = DataLog::orderBy('log_time', 'desc')->pluck('log_time')->first();
        $lower_year  = date('Y-m-d', strtotime("$lower_date"));
        $higher_year = date('Y-m-d', strtotime("$higher_date"));
        $years = [];
        $year = $lower_year;
        while ($year < $higher_year) {
            $temp_year = date('Y', strtotime("$year"));
            array_push($years, $temp_year);
            $year = date('Y-m-d', strtotime("$year +1 year"));
        }
        $temp_year = date('Y', strtotime("$year"));
        array_push($years, $temp_year);
        return $years;
    }

    public function insert_data()
    {
        for ($i = 1; $i <= 7200; $i++) {
            $datetime =  date('Y-m-d H:i:s',  time() +  $i);
            DataLog::create([
                'log_time'           => $datetime,
                'global_irradiation' => rand(10, 1500),
                'wind_speed'         => rand(0, 30),
                'pv_temp'            => rand(10, 80),
                'ambient_temp'       => rand(10, 60),
                'total_power'        => rand(10, 12000),
                'average_power'      => rand(10, 80),
                'average_voltage'    => rand(0, 80),
                'total_yield'        => rand(10, 70000),
                'messages'           => 'OK',
            ]);
        }
        echo 'data inserted';
        die();
    }

    public function truncate_all()
    {
        DataLog::where('id', 'like', '%%')->delete();
        echo 'everything destroyed!';
        die();
    }

    public function year_data()
    {
        $year   = date('Y-01-01', time());
        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $day_nums = cal_days_in_month(CAL_GREGORIAN, date('m', strtotime($year)), date('Y', strtotime($year)));
            $beganOfTime = date('Y-m-01', strtotime($year));
            $endOfTime   = date("Y-m-$day_nums", strtotime($year));
            $log         = DataLog::whereBetween('log_time', [$beganOfTime, $endOfTime])->avg('total_yield');
            array_push($data, $log);
            $year = date('Y-m-d', strtotime(" $year +1 month"));
        }
        return $data;
    }

    public function year_labels()
    {
        $year   = date('Y-01-01', time());
        $labels = [];
        for ($i = 1; $i <= 12; $i++) {
            $temp_month = date('M', strtotime($year));
            $temp_year = date('Y', strtotime($year));
            array_push($labels, $temp_month . ' ' . $temp_year);
            $year   = date('Y-m-d', strtotime(" $year +1 month"));
        }
        return $labels;
    }

    public function total_data()
    {
        $lower_date  = DataLog::orderBy('log_time', 'asc')->pluck('log_time')->first();
        $higher_date = DataLog::orderBy('log_time', 'desc')->pluck('log_time')->first();
        $lower_year  = date('Y-m-d H:i:s', strtotime("$lower_date"));
        $higher_year = date('Y-m-d H:i:s', strtotime("$higher_date"));
        $years = [];
        $year = $lower_year;
        $data = [];
        while ($year < $higher_year) {
            $beganOfTime              = date('Y-01-01', strtotime($year));
            $number_day_of_this_month = cal_days_in_month(CAL_GREGORIAN, date('m', strtotime($year)), date('Y', strtotime($year)));
            $endOfTime                = date("Y-12-$number_day_of_this_month  H:i:s", strtotime($year));
            $log                      = DataLog::whereBetween('log_time', [$beganOfTime, $endOfTime])->avg('average_voltage');
            array_push($data, $log);
            $year = date('Y-m-d', strtotime("$year +1 year"));
        }
        $beganOfTime              = date('Y-01-01', strtotime($year));
        $number_day_of_this_month = cal_days_in_month(CAL_GREGORIAN, date('m', strtotime($year)), date('Y', strtotime($year)));
        $endOfTime                = date("Y-12-$number_day_of_this_month  H:i:s", strtotime($year));
        $log                      = DataLog::whereBetween('log_time', [$beganOfTime, $endOfTime])->avg('average_voltage');
        array_push($data, $log);

        return $data;
    }

    public function get_data()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $_POST =json_decode(file_get_contents("php://input")  , true );

            $settings = Setting::findOrFail(1);
            $time_delay = $settings->time_delay;
            // with 20 seconds delay
            $datetime = date('Y-m-d H:i:s', strtotime("-$time_delay second"));
            // $datetime = date('Y-m-d H:i:s', time());
            $datalog = DataLog::where('log_time', $datetime)->first();

            if (!$datalog) {
                // system doesn't set values show network disconnected
                $datalog = new DataLog();
                $datalog->global_irradiation = 'network disconnected';
                $datalog->wind_speed         = 'network disconnected';
                $datalog->pv_temp            = 'network disconnected';
                $datalog->ambient_temp       = 'network disconnected';
                $datalog->total_power        = 'network disconnected';
                $datalog->average_power      = 'network disconnected';
                $datalog->average_voltage    = 'network disconnected';
                $datalog->total_yield        = 'network disconnected';
                $datalog->messages           = 'network disconnected';
            }

            if ($datalog->global_irradiation == '0.00000') {
                // its night show the 0
                $datalog->global_irradiation = '0';
                $datalog->wind_speed         = '0';
                $datalog->pv_temp            = '0';
                $datalog->ambient_temp       = '0';
                $datalog->total_power        = '0';
                $datalog->average_power      = '0';
                $datalog->average_voltage    = '0';
                $datalog->total_yield        = '0';
                $datalog->messages           = '0';
            }
            $average_power = 0;
            $total_power = 0;
            $total_yield = 0;
            if ($datalog->average_power != 'network disconnected') {
                $average_power = $datalog->average_power / 80;
                $total_power = $datalog->total_power / 12000;
                $total_yield = $datalog->total_yield / 70000;

                $average_power = number_format($average_power * 100);
                $total_power = number_format($total_power * 100);
                $total_yield = number_format($total_yield * 100);
            }


            (isset($average_power)) ? $average_power_chart = $average_power : $average_power_chart = 0;
            (isset($total_power))   ? $total_power_chart   = $total_power : $total_power_chart     = 0;
            (isset($total_yield))   ? $total_yield_chart   = $total_yield : $total_yield_chart      = 0;

            ($datalog->global_irradiation == 'network disconnected') ?  $datalog->global_irradiation = 'network disconnected' : $datalog->global_irradiation = number_format($datalog->global_irradiation);
            ($datalog->wind_speed == 'network disconnected')         ?  $datalog->wind_speed         = 'network disconnected' : $datalog->wind_speed         = number_format($datalog->wind_speed);
            ($datalog->pv_temp == 'network disconnected')            ?  $datalog->pv_temp            = 'network disconnected' : $datalog->pv_temp            = number_format($datalog->pv_temp);
            ($datalog->ambient_temp == 'network disconnected')       ?  $datalog->ambient_temp       = 'network disconnected' : $datalog->ambient_temp       = number_format($datalog->ambient_temp);
            ($datalog->total_power == 'network disconnected')        ?  $datalog->total_power        = 'network disconnected' : $datalog->total_power        = number_format($datalog->total_power);
            ($datalog->average_power == 'network disconnected')      ?  $datalog->average_power      = 'network disconnected' : $datalog->average_power      = number_format($datalog->average_power);
            ($datalog->average_voltage == 'network disconnected')    ?  $datalog->average_voltage    = 'network disconnected' : $datalog->average_voltage    = number_format($datalog->average_voltage);
            ($datalog->total_yield == 'network disconnected')        ?  $datalog->total_yield        = 'network disconnected' : $datalog->total_yield        = number_format($datalog->total_yield);

            // get day chart 
            $stop_date = new DateTime($_POST['day']);
            // $stop_date->modify('-1 day');
            $date = $stop_date->format('Y-m-d');
            $day_data       = [];
            $sum        = 3600;
            for ($i = 1; $i <= 24; $i++) {
                $beganOfTime = date('Y-m-d H:i:s', strtotime("$date midnight") + $sum - 3600);
                $endOfTime   = date('Y-m-d H:i:s', strtotime("$date midnight") + $sum);
                $log         = DataLog::whereBetween('log_time', [$beganOfTime, $endOfTime])->avg('total_power');
                array_push($day_data, $log);
                $sum += 3600;
            }

            $data = [
                'day_chart_data' => $day_data,
                'average_power_chart' => $average_power_chart,
                'total_power_chart'   => $total_power_chart,
                'total_yield_chart'   => $total_yield_chart,
                'date'            => date('Y-m-d H:i:s', strtotime("-$time_delay second")),
                'message'            => $datalog->messages,
                'global_irradiation' => $datalog->global_irradiation,
                'wind_speed'         => $datalog->wind_speed,
                'pv_temp'            => $datalog->pv_temp,
                'ambient_temp'       => $datalog->ambient_temp,
                'total_power'        => $datalog->total_power,
                'average_power'      => $datalog->average_power,
                'average_voltage'    => $datalog->average_voltage,
                'total_yield'        => $datalog->total_yield
            ];
            echo json_encode($data);
            die();
        }
    }
}
