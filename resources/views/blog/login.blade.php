@include('services.head')

<div style="background-color: #f2f2f2; padding: 20px;">
    <h2 style="text-align: center;">Login Form</h2>

    <form method="POST" action="{{ route('blog.actions.login') }}" style="max-width: 500px; margin: 0 auto;">
        @csrf

        <div style="margin-bottom: 10px;">
            <label for="email" style="display: block; margin-bottom: 5px;">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" style="padding: 5px; width: 100%; border: 1px solid #ccc; border-radius: 3px;">
            @error('email')
                <div style="color: red; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 10px;">
            <label for="password" style="display: block; margin-bottom: 5px;">Password:</label>
            <input type="password" id="password" name="password" style="padding: 5px; width: 100%; border: 1px solid #ccc; border-radius: 3px;">
            @error('password')
                <div style="color: red; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 3px; cursor: pointer;">Login</button>
    </form>
</div>

@include('services.footer')