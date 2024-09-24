<div>
    @if($type == 'registration')
    <div class="form-group row">
        <div class="col-sm-12 mb-3 mb-sm-0">
            <label for="name">Name</label>
            <input type="text" class="form-control form-control-user" name="name" id="name"
                placeholder="Name">
        </div>
    </div>
    @endif
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control form-control-user" name="email" id="email"
            placeholder="Email Address">
    </div>
    @error('email')
    <x-alert type="danger" message="{{ $message }}" />
    @enderror

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control form-control-user"
            id="password" placeholder="Password">
    </div>
    @error('password')
    <x-alert type="danger" message="{{ $message }}" />
    @enderror

    <input value="{{$buttonName}}" type="submit" class="btn btn-primary btn-user btn-block">
</div>