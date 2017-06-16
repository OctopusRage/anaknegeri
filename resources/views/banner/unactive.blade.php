@if (Auth::check())
	@if(Auth::user()->isActive(false)) 
		<nav class="navbar navbar-light bg-faded">
		   <span class="navbar-text">
		      <strong>Akun belum aktif,</strong> silakan lakukan aktivasi sesuai prosedur di email. atau <a href="{{ route('authenticated.resend', ['id'=>Auth::user()->id]) }}">Kirim Ulang Email Aktivasi</a>
		    </span>
		</nav>
	@endif
@endif