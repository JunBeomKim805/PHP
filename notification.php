<?php
  require __DIR__ . '/vendor/autoload.php';

  $options = array(
    'cluster' => 'us2',
    'useTLS' => true
  );
  $pusher = new Pusher\Pusher(
    'd9dc343a80ff8180e0f3',
    '38fe1eee45bb76056b17',
    '1333967',
    $options
  );

  $data['message'] = 'hello';
  $pusher->trigger('my-channel', 'my-event', $data);
?>