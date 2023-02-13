<?php

namespace App\Controllers;

use App\Models\monthlyy;
use App\Models\weekly;
use App\Models\overall;
use App\Models\dayly;
use App\Libraries\Reportmonthly;
use App\Libraries\Reportdayly;
use App\Libraries\ReportWeekly;
use App\Libraries\ReportOverAll;

class Home extends BaseController
{
    public function weekly()
    {
        $weekly = $this->request->getGet('weekly');
        $year = $this->request->getGet('year');
        $network = $this->request->getGet('network');

        $gaweek = new weekly();
        $gamonthly = $gaweek->weekly($weekly, $year, $network);

        $ReportWeekly = new ReportWeekly($weekly, $year, $network);
        $total_post_weekly = $ReportWeekly->total_post_weekly($weekly, $year, $network);

        $result["total"] = $gamonthly["charts"];
        $result['totalweek'] = $total_post_weekly['totalweek'];
        // echo "<pre>";
        // var_dump($result['total']);
        // echo "</pre>";

        return view('view_weekly', $result);
    }

    public function overall()
    {
        $Reportoverall = new ReportOverAll();
        $total_post_overall = $Reportoverall->total_post_overall();
        $overall = new overall();
        $overalldata = $overall->overall();
        $result["total"] = $overalldata['charts'];

        $result['totaloverall'] = $total_post_overall['overall'];

        return view('view_overall', $result);
    }

    public function dayly()
    {

        $from_date = $this->request->getGet('from_date');
        $to_date = $this->request->getGet('to_date');
        $network = $this->request->getGet('network');

        $Reportdayly = new Reportdayly();
        $total_post_dayly = $Reportdayly->total_post_dayly($from_date, $to_date, $network);
        $dayly = new dayly();
        $daylydata = $dayly->dayly($from_date, $to_date, $network);
        $result["total"] = $daylydata['charts'];

        $result['totaldayly'] = $total_post_dayly['totaldayly'];

        return view('view_dayly', $result);
    }


    public function monthly_table()
    {
        $monthly = $this->request->getGet('monthly');
        $year = $this->request->getGet('year');
        $network = $this->request->getGet('network');


        $gamonth = new monthlyy();

        $gamonthly = $gamonth->monthly($monthly, $year, $network);

        $Reportmonthly = new Reportmonthly($monthly, $year, $network);
        $total_post_monthly = $Reportmonthly->total_post_monthly($monthly, $year, $network);
        $result["total"] = $gamonthly["charts"];


        $result['totalmonthly'] = $total_post_monthly['totalmonthly_facecook'];


        // $gamonthly = ($gamonthly);
        // $result['gamonthly'] = $gamonthly;
        // echo "<pre>";
        // var_dump($result['gamonthly']);
        // echo "</pre>";

        return view('view_monthly', $result);
    }
}
