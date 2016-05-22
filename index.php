<?php
$redis = new Redis();
$con=$redis->connect('127.0.0.1', 6379);
$redis->select(1);
$count = $redis->dbSize();
echo $redis->get('test');
// Will set the key, if it doesn't exist, with a ttl of 10 seconds
$redis->set('key', 'value', Array('nx', 'ex'=>10));

// Will set a key, if it does exist, with a ttl of 1000 miliseconds
$redis->set('key', 'value', Array('xx', 'px'=>10000));
echo "Redis has $count keys\n";
echo "fjsaj";
$it = NULL; /* Initialize our iterator to NULL */
$redis->setOption(Redis::OPT_SCAN, Redis::SCAN_RETRY); /* retry when we get no keys back */
while($arr_keys = $redis->scan($it)) {
    foreach($arr_keys as $str_key) {
        echo "Here is a key: $str_key\n";
    }
    echo "No more keys to scan!\n";
}


echo "<br><br>";
$redis->set('foo', 'bar');
$val = $redis->dump('foo');
echo $val;
$redis->restore('bar', 0, $val); // The key 'bar', will now be equal to the key 'foo'