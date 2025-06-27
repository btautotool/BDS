<ul class="collection with-header">

    <li class="collection-header center">
        <div class="m-t-10">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/User_icon_2.svg/220px-User_icon_2.svg.png" alt="{{ auth()->user()->name }}" class="circle responsive-img">
        </div>
        <h5 class="truncate">
            {{ auth()->user()->name }}
        </h5>
        <h6 class="m-t-0"><small>{{ auth()->user()->email }}</small></h6>
    </li>

    <a href="{{ route('agent.dashboard') }}">
        <li class="collection-item {{ Request::is('agent/dashboard') ? 'active' : '' }}">
            <i class="material-icons left">dashboard</i>
            <span>Dashboard<span>
        </li>
    </a>
    <a href="{{ route('agent.message') }}">
        <li class="collection-item {{ Request::is('agent/message*') ? 'active' : '' }}">
            <i class="material-icons left">mail</i>
            <span>Lịch hẹn</span>
        </li>
    </a>

    <a href="{{ route('agent.properties.index') }}">
        <li class="collection-item {{ Request::is('agent/properties') ? 'active' : '' }}">
            <i class="material-icons left">view_list</i>
            <span>Tài sản<span>
        </li>
    </a>
    <a href="{{ route('agent.properties.create') }}">
        <li class="collection-item {{ Request::is('agent/properties/create') ? 'active' : '' }}">
            <i class="material-icons left">create</i>
            <span>Tạo mới tài sản<span>
        </li>
    </a>
</ul>