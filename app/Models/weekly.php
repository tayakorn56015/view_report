<?php

namespace App\Models;

use App\Controllers\influencer_controller;
use CodeIgniter\Model;


class weekly extends Model
{
    public function weekly($weekly, $year, $network)
    {

        $dbweek = \Config\Database::connect();
        $weekly = $weekly;
        $year = $year;
        $network = $network;

        if ($weekly != null && $year != null && $network != null) {
            // $weekly = $dbweek->query("SELECT  count(distinct influencer_id),
            // network,    
            // sum(post_total)as sum_post,
            // count(distinct influencer_id) AS sum_influencer,
            // year(create_date) as year,
            // day(create_date) DAY,
            // count(id) row_bot,
            // WEEK(create_date)AS week,
            // MONTHNAME(create_date)AS  name_month,
            // min(date(create_date))AS min,
            // max(date(create_date))AS max,
            // DATE(create_date) DATE,
            // dayname(create_date) nameday
            // FROM influencer_stat_post_recent 
            $weekly = $dbweek->query("SELECT  week,
            year,    
            network,
            account,
            follower,
            total_post,
            unique_post,
            duplicate
            FROM weekly 
            WHERE week = '$weekly' and year = '$year' AND network = '$network'
            GROUP BY week");
        } 

        elseif ($weekly == null && $year != null && $network != null) {
            $weekly = $dbweek->query("SELECT  week,
            year,    
            network,
            account,
            follower,
            total_post,
            unique_post,
            duplicate
            FROM weekly 
            WHERE  year = '$year' AND network = '$network'
            GROUP BY week,network");
        } 
        
        elseif ($weekly != null && $year != null && $network == null) {
            $weekly = $dbweek->query("SELECT  week,
            year,    
            network,
            account,
            follower,
            total_post,
            unique_post,
            duplicate
            FROM weekly 
            WHERE week = '$weekly' and year = '$year' 
            GROUP BY network");
        }

        elseif ($year != null && $weekly == null && $network == null) {
            $weekly = $dbweek->query("SELECT  week,
            year,    
            network,
            account,
            follower,
            total_post,
            unique_post,
            duplicate
            FROM weekly 
            WHERE  year = '$year' 
            GROUP BY week,network");
        } 

        elseif ($year == null && $weekly != null && $network == null) {
            $weekly = $dbweek->query("SELECT  week,
            year,    
            network,
            account,
            follower,
            total_post,
            unique_post,
            duplicate
            FROM weekly 
            WHERE  week = $weekly 
            GROUP BY network");
        } 
        elseif ($year == null && $weekly != null && $network != null) {
            $weekly = $dbweek->query("SELECT  week,
            year,    
            network,
            account,
            follower,
            total_post,
            unique_post,
            duplicate
            FROM weekly 
            WHERE  week = $weekly and network = '$network' 
            GROUP BY network");
        } 
        
        else {
            $weekly = $dbweek->query("SELECT  week,
            year,    
            network,
            account,
            follower,
            total_post,
            unique_post,
            duplicate
            FROM weekly 
            GROUP BY week,network
            ORDER BY week desc
            LIMIT 4");
        }

        $week = $weekly->getResult();
        $charts = [];
        
        foreach ($week as $row) {
            $charts[] = array(
                'network'   => $row->network,
                'total_post' => floatval($row->total_post),
                'unique_post' => floatval($row->unique_post),
                'week' => @$row->week
            );
        }

        // var_dump($ga);

        $results['weekly'] = $weekly->getResultArray();
        $results['charts'] = ($charts);

        return $results;
    }
}
