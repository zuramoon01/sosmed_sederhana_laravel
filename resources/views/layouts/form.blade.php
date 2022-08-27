<section id="form">
    <div class="container">
        <h1>@yield('form name')</h1>

        <form action="@yield('form action')" method="post">
            @csrf

            @if (Request::path() === 'signup')
                <div class="form-input">
                    <label for="name">Nama</label>
                    <input type="name" id="name" name="name" placeholder="Nama">
                </div>
            @endif
            <div class="form-input">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Email">
            </div>
            <div class="form-input">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Password">
            </div>
            @error('password')
                {{ $message }}
            @enderror

            <button type="submit">
                @yield('form name')
            </button>
        </form>

        <p>@yield('form request')</p>
    </div>
</section>
