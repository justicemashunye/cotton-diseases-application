<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <div>
            <p class="app-sidebar__user-name">Cotton Diseases</p>
            <p class="app-sidebar__user-designation">Application</p>
        </div>
    </div>
    <ul class="app-menu">
        <li>
            <a class="app-menu__item active" href="#"><i class="app-menu__icon fa fa-dashboard"></i>
                <span class="app-menu__label">Dashboard</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.diseases.index' ? 'active' : '' }}" href="{{ route('admin.disease.index') }}">
                <i class="app-menu__icon fa fa-bar-chart"></i>
                <span class="app-menu__label">Diseases</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.disease-details.index' ? 'active' : '' }}" href="{{ route('admin.disease-details.index') }}">
                <i class="app-menu__icon fa fa-briefcase"></i>
                <span class="app-menu__label">Disease Details</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.stages.index' ? 'active' : '' }}" href="{{ route('admin.stages.index') }}">
                <i class="app-menu__icon fa fa-bar-chart"></i>
                <span class="app-menu__label">Stages</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.locations.index' ? 'active' : '' }}" href="{{ route('admin.locations.index') }}">
                <i class="app-menu__icon fa fa-briefcase"></i>
                <span class="app-menu__label">Locations</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.shapes.index' ? 'active' : '' }}" href="{{ route('admin.shapes.index') }}">
                <i class="app-menu__icon fa fa-briefcase"></i>
                <span class="app-menu__label">Shapes</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.colors.index' ? 'active' : '' }}" href="{{ route('admin.colors.index') }}">
                <i class="app-menu__icon fa fa-briefcase"></i>
                <span class="app-menu__label">Colors</span>
            </a>
        </li>

        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.colorstates.index' ? 'active' : '' }}" href="{{ route('admin.colorstates.index') }}">
                <i class="app-menu__icon fa fa-briefcase"></i>
                <span class="app-menu__label">Color State</span>
            </a>
        </li>

        <li>
            <a class="app-menu__item" href="#"><i class="app-menu__icon fa fa-cogs"></i>
                <span class="app-menu__label">Settings</span>
            </a>
        </li>
    </ul>
</aside>