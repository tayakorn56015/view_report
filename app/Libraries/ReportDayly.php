<?php namespace App\Libraries;

use App\Models\dayly;


class ReportDayly
{
 public function total_post_dayly($from_date,$to_date,$network)
 {
   $totaldayly = new dayly();
   $totaldayly = $totaldayly->dayly($from_date,$to_date,$network); 
   $result["totaldayly"] = $totaldayly;
    return $result;
 }
}
