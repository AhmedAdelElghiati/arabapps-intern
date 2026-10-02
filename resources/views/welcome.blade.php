{{-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"> --}}
<a href="http://" target="_blank" rel="noopener noreferrer">{{ __('messages.welcome') }}</a>
<a href="http://" target="_blank" rel="noopener noreferrer">{{ __('messages.login') }}</a>
<a href="http://" target="_blank" rel="noopener noreferrer">{{ __('messages.register') }}</a>
<a href="http://" target="_blank" rel="noopener noreferrer">{{ __('messages.logout') }}</a>
app.locale: {{ str_replace('_', '-', app()->getLocale()) }}
<br>
{{ app()->getLocale() }}
<br>
<a href="{{ route('lang.index', ['lang' => 'en']) }}">English</a>
<a href="{{ route('lang.index', ['lang' => 'ar']) }}">العربية</a>