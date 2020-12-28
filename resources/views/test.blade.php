<!DOCTYPE html>
<head>
  <title>Pusher Test</title>
</head>
<body>
  <h1>Pusher Test</h1>
  <p>
    Publish an event to channel <code>my-channel</code>
    with event name <code>my-event</code>; it will appear below:
  </p>
  <div id="test">
    <ul>
      <li v-for="message in messages">
        @{{message}}
      </li>
    </ul>
  </div>

  <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('f0e22cfa0b236ac13f6e', {
      cluster: 'eu'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        test.messages.push(JSON.stringify(data));
    });

    // Vue application
    const test = new Vue({
      el: '#test',
      data: {
        messages: [],
      },
    });
  </script>
</body>
