const female = document.getElementById('female');
const male = document.getElementById('male');
const gender = document.getElementById('user_gender');

if (gender.value == 'F') {
    female.checked = true;
    male.checked = false;
} else {
    female.checked = false;
    male.checked = true;
}

$(document).on('change', '#input_fp', function()
{
  let container = '.foto_perfil';
 readImage(container, this);
});