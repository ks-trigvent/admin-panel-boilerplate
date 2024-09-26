@props([
'roles',
'name',
'email'
])

<div>
    <div class="form-group row">
        <div class="col-sm-12 mb-3 mb-sm-0">
            <label for="name">Name</label>
            <input type="text" class="form-control form-control-user" name="name" id="name"
                placeholder="name" value="{{$name}}">
        </div>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control form-control-user" name="email" id="email"
            placeholder="Email Address" value="{{$email}}">
        @error('email')
        <x-alert type="danger" message="{{ $message }}" />
        @enderror
    </div>
    @if($type == 'add_new')
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control form-control-user"
            id="password" placeholder="Password">
    </div>
    @endif
    @error('password')
    <x-alert type="danger" message="{{ $message }}" />
    @enderror

    @if($type != 'edit_own_profile' || $userRoleType != 'viewer')
    <div class="form-group">
        @if(isset($roles))
        @foreach($roles as $key => $role)
        <div class="form-check form-check-inline">
        @if($type != 'add_new')
            <input class="form-check-input" type="radio" {{ ($role->name == $userRoleType) ? 'checked' : '' }} name="role_id" id="rolesRadioBox{{$key}}" value="{{$role->id}}">
        @else
            <input class="form-check-input" type="radio" name="role_id" id="rolesRadioBox{{$key}}" value="{{$role->id}}">
        @endif
            <label class="form-check-label" for="rolesRadioBox{{$key}}">{{$role->name}}</label>
        </div>
        @endforeach
        @endif
        @error('role_id')
        <x-alert type="danger" message="{{ $message }}" />
        @enderror
    </div>
    @endif

    <input value="{{$buttonName}}" type="submit" class="btn btn-primary btn-user btn-block" />
    @if($type != 'add_new')
    <a class="btn btn-primary btn-user btn-block" href="{{route('dashboard')}}" type="button">Go back</a>
    @endif
</div>