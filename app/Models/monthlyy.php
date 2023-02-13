<?php

namespace App\Models;

use App\Controllers\influencer_controller;
use CodeIgniter\Model;


class monthlyy extends Model
{
    public function monthly($monthly, $year, $network)
    {
        $dbmonthly = \Config\Database::connect();
        $monthly = $monthly;
        $year = $year;
        $network = $network;

        if ($monthly != null && $year != null && $network != null) {
            $monthly = $dbmonthly->query("SELECT  month,
            year,    
            network,
            account,
            follower,
            total_post,
            unique_post,
            duplicate
            FROM monthly 
            WHERE month = '$monthly' and year = $year AND network = '$network'
            GROUP BY month");
        } elseif ($monthly == null && $year != null && $network != null) {
            $monthly = $dbmonthly->query("SELECT  month,
            year,    
            network,
            account,
            follower,
            total_post,
            unique_post,
            duplicate
            FROM monthly 
            WHERE year = '$year'  AND network = '$network'
            GROUP BY month,network");
        } elseif ($monthly != null && $year != null && $network == null) {
            $monthly = $dbmonthly->query("SELECT  month,
            year,    
            network,
            account,
            follower,
            total_post,
            unique_post,
            duplicate
            FROM monthly 
            WHERE  year = $year AND month = '$monthly'
            GROUP BY network");
        } elseif ($year != null && $monthly == null && $network == null) {
            $monthly = $dbmonthly->query("SELECT  month,
            year,    
            network,
            account,
            follower,
            total_post,
            unique_post,
            duplicate
            FROM monthly 
            WHERE  year = $year
            GROUP BY month,network");
        } elseif ($year == null && $monthly != null && $network == null) {
            $monthly = $dbmonthly->query("SELECT  month,
            year,    
            network,
            account,
            follower,
            total_post,
            unique_post,
            duplicate
            FROM monthly 
            WHERE  month = '$monthly'
            GROUP BY network");
        } elseif ($year == null && $monthly != null && $network != null) {
            $monthly = $dbmonthly->query("SELECT  month,
            year,    
            network,
            account,
            follower,
            total_post,
            unique_post,
            duplicate
            FROM monthly 
            WHERE  month = '$monthly' and network = '$network'
            GROUP BY network");
        } else {
            $monthly = $dbmonthly->query("SELECT  max(month)as month,
            max(YEAR)as year,    
            network,
            account,
            follower,
            total_post,
            unique_post,
            duplicate
            FROM monthly 

            GROUP BY month,network
            ORDER BY month desc
            LIMIT 4");
        }

        $month = $monthly->getResult();
        $charts = [];

        foreach ($month as $row) {
            $charts[] = array(
                'network'   => $row->network,
                'total_post' => floatval($row->total_post),
                'unique_post' => floatval($row->unique_post),
                
                'month' => $row->month
            );
        }

        $results['monthly'] = $monthly->getResultArray();
        $results['charts'] = ($charts);

        // echo "<pre>";
        // var_dump($results['ga']);
        // echo "</pre>";
        return $results;
    }
}
