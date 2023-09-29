if ("serviceWorker" in navigator)
 {
  navigator.serviceWorker.register("../firebase-messaging-sw.js").then(registration =>
    {
        if(registration.sync)
        {
            Notification.requestPermission();
        }
        else
        {
            console.log('Background Sync is supported')
        }
    })
  
 }
