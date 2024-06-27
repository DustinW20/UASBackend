@extends('layouts.user')

@section('title', 'About Us')

@section('content')
    <div class="container my-4">
        <h1 class="my-4">About Us</h1>
        <div class="row">
            <div class="col-lg-6">
                <p>Welcome to Es Teh Solo, Di ufuk barat, senja perlahan tenggelam,
                    Merah saga merona, seiring bayang-bayang malam.
                    Seperti kenangan yang tertinggal di balik jendela,
                    Lara dan asmara bercampur dalam sepotong senja.

                    Gelap datang menghampiri, mendekap dalam diam,
                    Sedikit demi sedikit, menyisakan jejak suram.
                    Namun di antara sorot lembut matahari yang padam,
                    Ada cinta yang masih membara, tak pernah tenggelam..</p>

                <p>Kita duduk berdua, merasakan es teh yang manis,
                    Mencoba melupakan duka yang pernah mengiris.
                    Setiap tetes teh, seakan bercerita,
                    Tentang rindu yang terpendam, tentang kita yang selalu bersama.

                    Lara hadir bersama senja yang memudar,
                    Namun asmara tetap bertahan, tak pernah pudar.
                    Dalam setiap tegukan es teh yang menyegarkan,
                    Tersimpan harapan, cinta yang tak terelakkan..</p>

                <p>Di Solo, senja selalu indah meski dihiasi lara,
                    Karena ada es teh yang manis, dan asmara yang menggetarkan jiwa.
                    Marilah kita nikmati senja ini dengan secangkir cinta,
                    Karena dalam setiap senja, ada cerita kita berdua.</p>
            </div>
            <div class="col-lg-6">
                <img class="img-fluid rounded" src="{{ asset('/assets/img/') . '/' . 'bg.jpg' }}" alt="Es teh Solo">
            </div>
        </div>
    </div>
@endsection
