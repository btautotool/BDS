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
    </ul>