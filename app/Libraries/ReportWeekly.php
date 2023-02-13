<?php namespace App\Libraries;

use App\Models\weekly;


class ReportWeekly
{
 public function total_post_weekly($weekly,$year,$network)
 {
   $totalweek = new weekly();
   $totalweek = $totalweek->weekly($weekly,$year,$network); 
   $result["totalweek"] = $totalweek;
   return $result;
 }
}
