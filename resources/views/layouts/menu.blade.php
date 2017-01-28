<li class="{{ Request::is('commands*') ? 'active' : '' }}">
    <a href="{!! route('commands.index') !!}"><i class="fa fa-edit"></i><span>Commands</span></a>
</li>

<li class="{{ Request::is('broadcasts*') ? 'active' : '' }}">
    <a href="{!! route('broadcasts.index') !!}"><i class="fa fa-edit"></i><span>Broadcasts</span></a>
</li>

<li class="{{ Request::is('viewers*') ? 'active' : '' }}">
    <a href="{!! route('viewers.index') !!}"><i class="fa fa-edit"></i><span>Viewers</span></a>
</li>

