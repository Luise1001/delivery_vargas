import firebase from "firebase/app";


const firebaseConfig = {
  apiKey: "AIzaSyBJQ58JnvpmUStRpQFABxBr1I0gxoH2j4g",
  authDomain: "delivery-vargas.firebaseapp.com",
  projectId: "delivery-vargas",
  storageBucket: "delivery-vargas.appspot.com",
  messagingSenderId: "957245818769",
  appId: "1:957245818769:web:35ecbb13f1be17acb3bc30",
  measurementId: "G-1QPGHSKPXM"
};


const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);

console.log(app)