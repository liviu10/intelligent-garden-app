<footer>
    <div class="footer footer--container">
        <p class="lead footer__title">
            <span>{{ __('footer.title') }}</span>
            <span>|</span> 
            <span>{{ config('app.name') }}</span>
        </p>
        <p class="lead footer__project-info">{{ __('footer.footer_project_info') }}</p>
        <p class="lead footer__social-link">
            Follow me on: 
            <a href="https://github.com/liviu10" title="{{ __('footer.github_title_link') }}">Github</a> 
            | 
            <a href="https://www.linkedin.com/in/liviu-voica-849732a4/" title="{{ __('footer.linkedin_title_link') }}">Linkedin</a>
        </p>
        <p class="lead footer__copyright">
            &#169; Copyright 
            @php $startingYear = 2021 @endphp
            @if ( $startingYear > date('Y') )
            {{ $startingYear }} &#8212; {{ date('Y') }}
            @else
            {{ date('Y') }}
            @endif
        </p>
    </div>
</footer>