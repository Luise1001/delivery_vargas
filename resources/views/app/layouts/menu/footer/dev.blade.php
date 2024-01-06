<a class="footer-icons {{ Route::is('buy.index') ? 'active' : '' }}" href="{{ route('buy.index') }}">
    <img id="icon_compra" class="footer-icons" src="{{ asset('assets/storage/icons/menu/' . (Route::is('buy.index') ? 'Ico_Compra_ON.png' : 'Ico_Compra_OFF.png')) }}">
</a>
<a class="footer-icons {{ Route::is('calculator.index') ? 'active' : '' }}" href="{{ route('calculator.index') }}">
    <img id="icon_calculator" class="footer-icons" src="{{ asset('assets/storage/icons/menu/' . (Route::is('calculator.index') ? 'Ico_Calculator_ON.png' : 'Ico_Calculator_OFF.png')) }}">
</a>
<a class="footer-icons {{ Route::is('home.index') ? 'active' : '' }}" href="{{ route('home.index') }}">
    <img id="icon_home" class="footer-icons" src="{{ asset('assets/storage/icons/menu/' . (Route::is('home.index') ? 'Ico_Home_ON.png' : 'Ico_Home_OFF.png')) }}">
</a>
<a class="footer-icons {{ Route::is('order.index') ? 'active' : '' }}" href="{{ route('order.index') }}">
    <img id="icon_order" class="footer-icons" src="{{ asset('assets/storage/icons/menu/' . (Route::is('order.index') ? 'Ico_Order_ON.png' : 'Ico_Order_OFF.png')) }}">
</a>
<a class="footer-icons {{ Route::is('profile.index') ? 'active' : '' }}" href="{{ route('profile.index') }}">
    <img id="icon_perfil" class="footer-icons" src="{{ asset('assets/storage/icons/menu/' . (Route::is('profile.index') ? 'Ico_Perfil_ON.png' : 'Ico_Perfil_OFF.png')) }}">
</a>


  