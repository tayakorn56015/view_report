<?php namespace App\Libraries;

use App\Models\overall;


class ReportOverAll
{
 public function total_post_overall()
 {
   $totaloverall = new overall();
   $overall = $totaloverall->overall(); 
   $result["overall"] = $overall;
    return $result;
 }
}
