<?php

class Home extends Controller
{
    public function index($name = '')
    {

        // DataLog::where('id', 'like' , '%%')->delete();
        // echo 'everything destroyed!';
        // die();

        // with 20 seconds delay
        $datetime = date('Y-m-d H:i:s', strtotime('-160 second'));
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

        // $this->insert_data();

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
        $labels = $this->labels();
        $dataset = $this->dataset();
        // get month chart data
        $month_labels = $this->month_labels();
        $month_data   = $this->month_data();
        $years = $this->get_years();

        $this->view('home/index',  [
            'datalog'       => $datalog,
            'average_power' => $average_power,
            'total_power'   => $total_power,
            'total_yield'   => $total_yield,
            'labels'        => json_encode($labels),
            'dataset'       => json_encode($dataset),
            'month_data'       => json_encode($month_data),
            'month_labels'       => json_encode($month_labels),
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
            $log         = DataLog::whereBetween('log_time', [$beganOfTime, $endOfTime])->avg('average_voltage');
            array_push($data, number_format($log));
            $sum += 3600;
        }
        $dataset = [
            'label'           => 'Average Voltage',
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
            array_push($data, number_format($log));
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
        $lower_year  = date('Y', strtotime($lower_date));
        $higher_year = date('Y', strtotime($higher_date));

        echo $lower_year . '<br>';
        echo $higher_year . '<br>';
        die();
    }

    public function insert_data()
    {
        for ($i = 1; $i <= 7200; $i++) {
            $datetime =  date('Y-m-d H:i:s', strtotime('-1 year') + $i);
            DataLog::create([
                'log_time'           => $datetime,
                'global_irradiation' => rand(10 , 1500),
                'wind_speed'         => rand(0 , 30),
                'pv_temp'            => rand(10 , 80),
                'ambient_temp'       => rand(10 , 60),
                'total_power'        => rand(10 , 12000),
                'average_power'      => rand(10 , 80),
                'average_voltage'    => rand(0 , 80),
                'total_yield'        => rand(10 , 70000),
                'messages'           => 'OK',
            ]);
        }
        die();
    }
}
