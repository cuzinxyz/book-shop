<div id="users">
    <h2 class="header">Users</h2>

    <div class="layout-2">
        <div class="monitor">
            <h4>Right Now</h4>
            <div class="clearfix">
                <ul class="content users">
                    <li>list</li>
                </ul>
            </div>
        </div>
        <div class="quick-press">
            <h4>Quick Add</h4>
            <form method="post">
                <input type="text" id="username" placeholder="user name" />
                <input type="text" id="password" placeholder="password" />
                <input type="text" id="email" placeholder="email" />

                <button type="button" class="save">S</button>
                <button type="button" class="delet">D</button>
                <button type="submit" class="submit" id="adduser">Publish</button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
@endpush
