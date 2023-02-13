<?php namespace App\Libraries;

use App\Models\monthlyy;


class Reportmonthly
{
 public function total_post_monthly($monthly,$year,$network)
 {
   $totalmonthly = new monthlyy();
   $totalmonthly_facebook = $totalmonthly->monthly($monthly,$year,$network); 
   $result["totalmonthly_facecook"] = $totalmonthly_facebook;
    return $result;
 }
}
