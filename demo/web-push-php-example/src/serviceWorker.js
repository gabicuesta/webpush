self.addEventListener('push', function (event) {

  console.log('[Service Worker] Push Received.');
  console.log('[Service Worker] Push had this data: "${event.data.text()}"');

  const title = 'Título de la notificación';
  const options = {
    body: 'Contenido de la notificación.',
    icon: 'images/icon.png',
    image: 'https://webpush-webpusht.1d35.starter-us-east-1.openshiftapps.com/demo/web-push-php-example/src/images/badge.jpg'
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
