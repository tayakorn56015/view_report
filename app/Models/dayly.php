<?php

namespace App\Models;

use App\Controllers\influencer_controller;
use CodeIgniter\Model;


class dayly extends Model
{
    public function dayly($from_date, $to_date, $network)
    {
        $dbdayly = \Config\Database::connect();
        $from_date = $from_date;
        $to_date = $to_date;
        $network = $network;

        if ($from_date != null && $to_date != null && $network != null) {
            $dayly = $dbdayly->query("SELECT network,sum(post_total)total_post,
			count(distinct influencer_id) influencer,
			date(create_date)as DATE,
			WEEK(create_date)AS week,
            year(create_date)AS year,
			MONTHNAME(create_date)AS name_month
            FROM influencer_stat_post_recent
            WHERE date(create_date) BETWEEN '$from_date' AND '$to_date' and network='$network'
            GROUP BY date(create_date)");
        } elseif ($from_date != null && $to_date != null && $network == null) {
            $dayly = $dbdayly->query("SELECT network,sum(post_total)total_post,
			count(distinct influencer_id) influencer,
			date(create_date)as DATE,
			WEEK(create_date)AS week,
            year(create_date)AS year,
			MONTHNAME(create_date)AS name_month
            FROM influencer_stat_post_recent
            WHERE date(create_date) BETWEEN '$from_date' AND '$to_date'
            GROUP BY network");
        } 
        elseif ($from_date == null && $to_date == null && $network != null) {
            $dayly = $dbdayly->query("SELECT network,sum(post_total)total_post,
            count(distinct influencer_id) influencer,
            date(create_date)as DATE,
            WEEK(create_date)AS week,
            year(create_date)AS year,
            MONTHNAME(create_date)AS name_month
            FROM influencer_stat_post_recent
            WHERE week(create_date)=week(NOW()) and year(create_date)=year(NOW()) and network = '$network'
            GROUP BY date(create_date)");
        }else {
            $dayly = $dbdayly->query("SELECT network,sum(post_total)total_post,
			count(distinct influencer_id) influencer,
			date(create_date)as DATE,
			WEEK(create_date)AS week,
            year(create_date)AS year,
			MONTHNAME(create_date)AS name_month
            FROM influencer_stat_post_recent
            WHERE week(create_date)=week(NOW()) AND year(create_date)=year(NOW())
            GROUP BY network");
        }

        $month = $dayly->getResult();
        $charts = [];

        foreach ($month as $row) {
            $charts[] = array(
                'network'   => $row->network,
                'total' => floatval($row->total_post),
                'DATE' => $row->DATE,
                'influencer' => $row->influencer
            );
        }

        $results['dayly'] = $dayly->getResultArray();
        $results['charts'] = ($charts);

        // echo "<pre>";
        // var_dump($results['ga']);
        // echo "</pre>";
        return $results;
    }
}
