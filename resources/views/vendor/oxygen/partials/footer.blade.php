<footer class="bring-top" style="background-color: #10002e">
    <div id="footer" class="p-1">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <a href="https://myfittest.com.au/" class="d-block mt-2">
                        <img src="{{ asset('images/logo_fittest_v2_footer.png') }}" alt="">
                    </a>
                </div>
                <div class="col-md-10">
                    <ul class="nav justify-content-end">
                        <li class="nav-item">
                            <a class="nav-link" href="https://myfittest.com.au/index.php/what-is-fit-test/">About
                                Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://myfittest.com.au/index.php/about-steve/">Contact Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('testimonials') }}">Testimonials</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://myfittest.com.au/index.php/articles/">Articles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://myfittest.com.au/index.php/blog/">Videos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pages.faqs') }}">FAQ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pages.privacy-policy') }}">Privacy Policy</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pages.terms-conditions') }}">Terms & Conditions</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
    .bring-top {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
    }
</style>
