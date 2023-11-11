<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-mini">{{ __('BN') }}</a>
            <a href="#" class="simple-text logo-normal">{{ __('Breaking News') }}</a>
        </div>
        <ul class="nav">
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ _('Dashboard') }}</p>
                </a>
            </li>

            <li @if ($pageSlug == 'profile') class="active " @endif>
                <a href="{{ route('profile.edit')  }}">
                    <i class="tim-icons icon-single-02"></i>
                    <p>{{ __('messages.user_profile') }}</p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#laravel-examples" aria-expanded="true">
                    <i class="fab fa-laravel" ></i>
                    <span class="nav-link-text" >{{ __('Gerenciamento') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse show" id="laravel-examples">
                    <ul class="nav pl-4">

                        @can('administrador')
                            <li @if ($pageSlug == 'users') class="active " @endif>
                                <a href="{{ route('user.index')  }}">
                                    <i class="tim-icons icon-bullet-list-67"></i>
                                    <p>{{ __('Lista de usuários') }}</p>
                                </a>
                            </li>
                            <li @if ($pageSlug == 'user_create') class="active " @endif>
                                <a href="{{ route('user.create')  }}">
                                    <i class="tim-icons icon-badge"></i>
                                    <p>{{ __('Cadastro de usuários') }}</p>
                                </a>
                            </li>
                        @endcan

                        <li @if ($pageSlug == 'noticias') class="active " @endif>
                            <a href="{{ route('noticias.index')  }}">
                                <i class="tim-icons icon-paper"></i>
                                <p>{{ __('messages.news') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'noticias_create') class="active " @endif>
                            <a href="{{ route('noticias.create')  }}">
                                <i class="tim-icons icon-single-copy-04"></i>
                                <p>{{ __('messages.public_news') }}</p>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>

        </ul>
    </div>
</div>
