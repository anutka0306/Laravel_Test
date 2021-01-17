<li class="nav-item "><a class="nav-link" href="{{ url('/')}}">На сайт</a></li>
<li class="nav-item {{ request()->routeIs('admin.categories.index')?'active':'' }}"><a class="nav-link" href="{{ route('admin.categories.index') }}">Категории</a></li>
<li class="nav-item {{ request()->routeIs('admin.tests.index')?'active':'' }}"><a class="nav-link" href="{{ route('admin.tests.index') }}">Тесты</a></li>
