<?php

(!defined('SDG')) ? die ('Triple protection!') : null;

$arrRobotConf = array(
						'configs' => array(
												'robot_running' => true,
												'robot_running_firsttime' => 1329085825,
												'robot_term' => 1,
												'robot_term_coef' => 3600
										  ),
						'actions' => array(
												'updateCounters' => false,
												'delNonverifyUsers' => false,
												'delNontypeUsers' => false,
												'delUnpaidUsers' => false,
												'delUnpaidSubscr' => false,
												'vacActionSlo' => false,
												'resActionSlo' => false,
												'vacDelNonverify' => false,
												'resDelNonverify' => false,
												'vacDelUnpaid' => false,
												'resDelUnpaid' => false,
												'vacVipResetSlo' => false,
												'resVipResetSlo' => false,
												'vacHotResetSlo' => false,
												'resHotResetSlo' => false
										  )
					 );
