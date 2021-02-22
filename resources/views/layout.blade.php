<!DOCTYPE html>
<html lang="ja">
<header>
  <nav class="my-navbar">
    <a class="my-navbar-brand" href="/">ToDo App</a>
    <div class="my-navbar-control">
      @if(Auth::check())
        <span class="my-navbar-item">ようこそ, {{ Auth::user()->name }}さん</span>
        ｜
        <a href="#" id="logout" class="my-navbar-item">ログアウト</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      @else
        <a class="my-navbar-item" href="{{ route('login') }}">ログイン</a>
        ｜
        <a class="my-navbar-item" href="{{ route('register') }}">会員登録</a>
      @endif
    </div>
  </nav>
</header>
<main>
  @yield('content')
</main>
  @if(Auth::check())
    <script>
      document.getElementById('logout').addEventListener('click', function(){
        event.preventDefault();
        document.getElementById('logout-form').submit();
      });
    </script>
  @endif
@yield('scripts')
</body>
</html>