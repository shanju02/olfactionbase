<footer id="footer">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col-lg-12 text-lg-left text-center">
                <div class="copyright">
                    Last Updated on 16th May, 2022
                </div>
            </div>
        </div>
        <div class="row d-flex align-items-center mt-3">
            <div class="col-lg-12">
                <nav class="footer-links text-lg-right text-center pt-2 pt-lg-0">
                    <a href="{{ route('index') }}">Home</a>
                    <a href="{{ route('odor') }}">Odors</a>
                    <a href="{{ route('odorant') }}">Chemicals</a>
                    <a href="{{ route('receptor') }}">Receptors</a>
                    <a href="{{ route('or.odorant') }}">OR-odorant Pairs</a>
                    <a href="{{ route('protein') }}">OBP/PBP</a>
                    <a href="{{ route('aroma') }}">Aroma Wheels</a>
                    <a href="{{ route('tools') }}">Tools</a>
                    <a href="{{ route('publication') }}">Publication</a>
                    <a href="{{ route('contact') }}">Contact</a>
                    <a href="{{ route('olfaction.wheel') }}">Olfaction Wheel</a>
                </nav>
            </div>
        </div>
        <div class="row d-flex align-items-center mt-3">
            <div class="col-lg-12 text-lg-left text-center">
                <div class="copyright">
                    &copy; {{ date('Y') }} Copyright OlfactionBase. All Rights Reserved
                </div>
            </div>
        </div>
    </div>
</footer>
