@include('services.head', ['title' => 'Регистрация'])

<div style="max-width: 500px; margin: 0 auto;">
    <h2>Регистрация</h2>
    <form method="POST" action="{{ route('blog.register') }}">
        @csrf
        <div style="margin-bottom: 10px;">
            <label for="name">Имя</label>
            <br>
            <input id="name" type="text" name="name" required>
            @error('name')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 10px;">
            <label for="email">Email</label>
            <br>
            <input id="email" type="email" name="email" required>
            @error('email')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 10px;">
            <label for="bio">О себе</label>
            <br>
            <textarea id="bio" name="bio"></textarea>
            @error('bio')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 10px;">
            <label for="password">Пароль</label>
            <br>
            <input id="password" type="password" name="password" required>
            @error('password')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 10px;">
            <label for="password_confirmation">Повторите пароль</label>
            <br>
            <input id="password_confirmation" type="password" name="password_confirmation" required>
            @error('password_confirmation')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Зарегистрироваться</button>
    </form>
</div>


@include('services.footer')