<?php
define('LOGFILE','ACTIVEMQ_DEMO_QUEUES_');
include 'the bootstrap for this demo to work';

/*
 * demo how to use the classes.
 * This will send 100 messages to kuku queue (queue means message is removed once it is read by one client
 * Notice there is at least one underline in the class name, and that the last part MUST match between publisher and subscriber
 */
class SubscriberActiveMQDemo_Kuku extends \Talis\Services\ActiveMQ\Subscriber{
	use \Talis\Services\ActiveMQ\tQueue;
}

class PublisherActiveMQDemo_Kuku extends \Talis\Services\ActiveMQ\Publisher{
	use \Talis\Services\ActiveMQ\tQueue;
}

// Run first the publisher, then run the subscriber.
$p = new PublisherActiveMQDemo_Kuku;
foreach(range(1,100) as $rbac_user_id){
    $p->get_client()->publish($rbac_user_id);
}
die;

$r = new SubscriberActiveMQDemo_Kuku;
$r->get_client()->listen(function($bob){echo $bob . "\n";});
die;









# OLD CLASSES BELOW!







//a publisher for queue names shinto, and send a message '11232323232'
class t_shinto extends \Talis\Services\ActiveMQ\Publisher{
	use \Talis\Services\ActiveMQ\tQueue;
}
$TT = t_shinto::get_client();
$TT->publish('11232323232');



//a publisher for topic names koko, and send a message 'kiki'
class something_koko extends \Talis\Services\ActiveMQ\Publisher{
	use \Talis\Services\ActiveMQ\tTopic;
}
$TT = something_koko::get_client();
$TT->publish('11232323232');