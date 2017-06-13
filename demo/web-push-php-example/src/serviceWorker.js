self.addEventListener('push', function (event) {

  console.log('[Service Worker] Push Received.');
  console.log('[Service Worker] Push had this data:');
  console.log(event.data.text());

  jsonReceived = JSON.parse(event.data.text());

  console.log(jsonReceived['title']);

  const title = jsonReceived['title'];
  const options = {
    body: jsonReceived['content'],
    icon: jsonReceived['icon'],
    image: jsonReceived['image']
  };

  event.waitUntil(self.registration.showNotification(title, options));

  /*
    if (!(self.Notification && self.Notification.permission === 'granted')) {
        return;
    }

    const sendNotification = body => {
        // you could refresh a notification badge here with postMessage API
        const title = "Web Push example";

        return self.registration.showNotification(title, {
            body,
        });
    };

    if (event.data) {
        const message = event.data.text();
        event.waitUntil(sendNotification(message));
    }
    */
});
