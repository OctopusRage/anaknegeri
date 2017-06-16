@if (Auth::check())
    @if (Auth::user()->isVerified(true))
<div class="card card-inverse card-success py-5 d-md-down-none">
    <div class="card-block text-center">
        <div>
            <h2>Verified!</h2>
            <h2 class="mt-4 mb-4">
                <i class="icon-user-following"></i>
            </h2>
            <p>Akun anda telah terverifikasi. Mulai campaign sekarang untuk pendidikan Indonesia yang lebih baik!</p>
            <button type="button" class="btn btn-warning mt-3">Mulai Campaign</button>
            
        </div>
    </div>
</div>      
    @else
<div class="card card-inverse card-danger py-5 d-md-down-none">
    <div class="card-block text-center">
        <div>
            <h2>Unverified!</h2>
            <h2 class="mt-4 mb-4">
                <i class="icon-user-unfollow"></i>
            </h2>
            <p>Akun anda belum diverifikasi. Silakan verifikasi dengan mengikuti prosedur verifikasi di bawah</p>
        </div>
    </div>
</div>
    @endif
@endif