<aside class="main-sidebar">
    <section class="sidebar" style="height: auto;">
        <ul class="sidebar-menu tree" data-widget="tree">
            <li>
                <a href="{{ route("admin.home") }}">
                    <i class="fas fa-fw fa-tachometer-alt">

                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>
            @can('user_management_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-users">

                        </i>
                        <span>{{ trans('cruds.userManagement.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('permission_access')
                            <li class="{{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                <a href="{{ route("admin.permissions.index") }}">
                                    <i class="fa-fw fas fa-unlock-alt">

                                    </i>
                                    <span>{{ trans('cruds.permission.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('role_access')
                            <li class="{{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                <a href="{{ route("admin.roles.index") }}">
                                    <i class="fa-fw fas fa-briefcase">

                                    </i>
                                    <span>{{ trans('cruds.role.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('user_access')
                            <li class="{{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                <a href="{{ route("admin.users.index") }}">
                                    <i class="fa-fw fas fa-user">

                                    </i>
                                    <span>{{ trans('cruds.user.title') }}</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('course_access')
                <li class="{{ request()->is('admin/courses') || request()->is('admin/courses/*') ? 'active' : '' }}">
                    <a href="{{ route("admin.courses.index") }}">
                        <i class="fa-fw fas fa-book">

                        </i>
                        <span>{{ trans('cruds.course.title') }}</span>
                    </a>
                </li>
            @endcan
            @can('lesson_access')
                <li class="{{ request()->is('admin/lessons') || request()->is('admin/lessons/*') ? 'active' : '' }}">
                    <a href="{{ route("admin.lessons.index") }}">
                        <i class="fa-fw fas fa-cogs">

                        </i>
                        <span>{{ trans('cruds.lesson.title') }}</span>
                    </a>
                </li>
            @endcan
            @can('question_access')
                <li class="{{ request()->is('admin/questions') || request()->is('admin/questions/*') ? 'active' : '' }}">
                    <a href="{{ route("admin.questions.index") }}">
                        <i class="fa-fw fas fa-question">

                        </i>
                        <span>{{ trans('cruds.question.title') }}</span>
                    </a>
                </li>
            @endcan
            @can('questions_option_access')
                <li class="{{ request()->is('admin/questions-options') || request()->is('admin/questions-options/*') ? 'active' : '' }}">
                    <a href="{{ route("admin.questions-options.index") }}">
                        <i class="fa-fw fas fa-cogs">

                        </i>
                        <span>{{ trans('cruds.questionsOption.title') }}</span>
                    </a>
                </li>
            @endcan
            @can('test_access')
                <li class="{{ request()->is('admin/tests') || request()->is('admin/tests/*') ? 'active' : '' }}">
                    <a href="{{ route("admin.tests.index") }}">
                        <i class="fa-fw fas fa-cogs">

                        </i>
                        <span>{{ trans('cruds.test.title') }}</span>
                    </a>
                </li>
            @endcan
            <li class="{{ request()->is('admin/system-calendar') || request()->is('admin/system-calendar/*') ? 'active' : '' }}">
                <a href="{{ route("admin.systemCalendar") }}">
                    <i class="fas fa-fw fa-calendar">

                    </i>
                    <span>{{ trans('global.systemCalendar') }}</span>
                </a>
            </li>
            @php($unread = \App\QaTopic::unreadCount())
                <li class="{{ request()->is('admin/messenger') || request()->is('admin/messenger/*') ? 'active' : '' }}">
                    <a href="{{ route("admin.messenger.index") }}">
                        <i class="fa-fw fa fa-envelope">

                        </i>
                        <span>{{ trans('global.messages') }}</span>
                        @if($unread > 0)
                            <strong>( {{ $unread }} )</strong>
                        @endif
                    </a>
                </li>
                <li>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <i class="fas fa-fw fa-sign-out-alt">

                        </i>
                        {{ trans('global.logout') }}
                    </a>
                </li>
        </ul>
    </section>
</aside>