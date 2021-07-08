<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

        <div class="logo">
            <!--h1><a href="{{ route('index') }}">Olfaction</a></h1-->
            <a href="{{ route('index') }}"><img src="{{ asset('assets/img/logo.png') }}" alt="" class="img-fluid"></a>
        </div>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto {{ \Request::route()->getName() == 'odor' ? 'active' : '' }}" href="{{ route('odor') }}">Odors</a></li>
                <li><a class="nav-link scrollto {{ \Request::route()->getName() == 'odorant' ? 'active' : '' }}" href="{{ route('odorant') }}">Chemicals</a></li>
                <li><a class="nav-link scrollto {{ \Request::route()->getName() == 'receptor' ? 'active' : '' }}" href="{{ route('receptor') }}">Receptors</a></li>
                <li><a class="nav-link scrollto {{ \Request::route()->getName() == 'or.odorant' ? 'active' : '' }}" href="{{ route('or.odorant') }}">OR-Odorant Pairs</a></li>
                <li><a class="nav-link scrollto {{ \Request::route()->getName() == 'protein' ? 'active' : '' }}" href="{{ route('protein') }}">OBP/PBP</a></li>
                <li><a class="nav-link scrollto {{ \Request::route()->getName() == 'aroma' ? 'active' : '' }}" href="{{ route('aroma') }}">Aroma Wheels</a></li>
                <li><a class="nav-link scrollto {{ \Request::route()->getName() == 'tools' ? 'active' : '' }}" href="{{ route('tools') }}">Tools</a></li>
                <li><a class="nav-link scrollto {{ \Request::route()->getName() == 'publication' ? 'active' : '' }}" href="{{ route('publication') }}">Publications</a></li>
                <li><a class="nav-link scrollto {{ \Request::route()->getName() == 'contact' ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a></li>
                <li><a class="getstarted scrollto "  href="{{ route('olfaction.wheel') }}">Olfaction Wheel</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header>
