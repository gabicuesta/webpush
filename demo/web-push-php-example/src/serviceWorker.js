self.addEventListener('push', function (event) {

  console.log('[Service Worker] Push Received.');
  console.log('[Service Worker] Push had this data:');
  console.log(event.data.text());

  jsonReceived = JSON.stringify(event.data.text());

  console.log(jsonReceived["title"]);

  const title = 'Título de la notificación';
  const options = {
    body: 'Contenido de la notificación.',
    icon: 'images/icon.png',
    image: 'images/badge.jpg'
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
