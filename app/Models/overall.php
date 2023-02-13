<?php

namespace App\Models;

use App\Controllers\influencer_controller;
use CodeIgniter\Model;


class overall extends Model
{
    public function overall()
    {

        $dboverall = \Config\Database::connect();
        // $overall = $dboverall->query("SELECT 	network,
		// 	count(id) row_bot,
        //     sum(follower>=2500) as follower,
		// 	count(distinct influencer_id) influencer, 
		// 	sum(post_total)total_post 
        //     FROM influencer_stat_post_recent 
        //     GROUP BY network");

        $overall = $dboverall->query("SELECT network,
        account ,
        follower,total_post, unique_post,duplicate
                    FROM over_all ");

        $overalll = $overall->getResult();
        $charts = [];

        foreach ($overalll as $row) {
            $charts[] = array(
                'network'   => $row->network,
                'total_post' => floatval($row->total_post),
                'unique_post' => floatval($row->unique_post),
            );
        }
        $results['charts'] = ($charts);

        $results['overall'] = $overall->getResultArray();
        return $results;
    }
}
