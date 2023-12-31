const type = document.getElementById('type');
const mobile = document.getElementById('mobile');
const transfer = document.getElementById('transfer');
const zelle = document.getElementById('zelle');

type.addEventListener('change', (e) => {
    if (e.target.value === 'mobile') {
        mobile.classList.remove('d-none');
    } else {
        mobile.classList.add('d-none');
    }
    if(e.target.value === 'transfer') {
        transfer.classList.remove('d-none');
    } else {
        transfer.classList.add('d-none');
    }
    if(e.target.value === 'zelle') {
        zelle.classList.remove('d-none');
    } else {
        zelle.classList.add('d-none');
    }
});

