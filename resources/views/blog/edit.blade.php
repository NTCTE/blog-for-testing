@include('services.head')

<form method="POST" action="{{ route('blog.actions.edit', ['id' => $post -> id]) }}" style="margin-top: 15px;">
    @csrf
    <div>
        <label for="heading">Title:</label>
        <input type="text" id="heading" name="heading" value="{{ $post -> heading }}" required>
        @error('heading')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="body">Post Body:</label>
        <textarea id="body" name="body" required>{{ $post -> body }}</textarea>
        @error('body')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <input type="checkbox" id="is_draft" name="is_draft" {{ $post -> is_draft ? 'checked' : '' }}>
        <label for="is_draft">Draft</label>
    </div>
    <div>
        <input type="checkbox" id="is_paid" name="is_paid" {{ $post -> is_paid ? 'checked' : '' }}>
        <label for="is_paid">Paid Post</label>
    </div>
    <div>
        <label for="amount">Price per Post:</label>
        <input type="number" id="amount" name="amount" value="{{ $post -> amount }}">
        @error('amount')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit">Save Post</button>
</form>

<style>
    .error {
        color: red;
    }
</style>



@include('services.footer')