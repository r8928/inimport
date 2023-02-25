<x-smalllayout title="Login">

    <div class="form-group">
        <label for="email">Email</label>
        <input class="form-control" type="email" name="email" required>
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input class="form-control" type="password" name="password" required>
    </div>

    <x-errors></x-errors>

    <div class="mt-3 text-center">
        <button class="btn btn-primary" type="submit">Login</button>
    </div>
</x-smalllayout>
