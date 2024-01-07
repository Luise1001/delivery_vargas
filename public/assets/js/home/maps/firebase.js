const firebaseConfig = 
{
  apiKey: "AIzaSyBJQ58JnvpmUStRpQFABxBr1I0gxoH2j4g",
  authDomain: "delivery-vargas.firebaseapp.com",
  projectId: "delivery-vargas",
  storageBucket: "delivery-vargas.appspot.com",
  messagingSenderId: "957245818769",
  appId: "1:957245818769:web:35ecbb13f1be17acb3bc30",
  measurementId: "G-1QPGHSKPXM"
};

firebase.initializeApp(firebaseConfig);


const fcm = firebase.messaging();

let badge = 0;


fcm.getToken({vapidKey: "BMtO3lEOTcLz0oZMQbtWdi7e2IuCid-TAerWspv9TBC4L2VLkeXcQjbo7FX4EGPYHWBeSeVxc-TxcBsEIEdcTDU"}).then(
  (currentToken)=>
{ 
  if(currentToken)
  {
    let funcion = 'nuevo_token_firebase';
    let token = currentToken;
    console.log(token)
    // $.ajax
    // ({
    //    url: '../../server/functions/agregar.php',
    //    type: 'POST',
    //    dataType: 'html',
    //    data: 
    //    {
    //       funcion: funcion,
    //       token: token
    //    }
  
    // })
    // .done(function(res)
    // {
      
    // })
    // .fail(function(err)
    // {
    //   console.log(err);
    // })
  }
  else
  {
    console.log('connection failed');
  }
})

fcm.onMessage((data) => 
{
  badge += 1;

   Notification.requestPermission((status)=>
   {
      if(status === 'granted')
      {
        
      }
   });
});

