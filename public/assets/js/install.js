let deferredPrompt = null;
const installButton = document.getElementById('installButton');

installButton.addEventListener('click', installApp);

window.addEventListener('beforeinstallprompt', saveEvt);

function saveEvt(e)
{
  e.preventDefault();
  deferredPrompt = e;
  
  installButton.removeAttribute('hidden');
}

function installApp(e)
{
  deferredPrompt.prompt();
  e.srcElement.setAttribute('hidden', true);
}