<template>
    <footer style="padding:0px;position: fixed;bottom: 0;left: 0;right: 0;">
        <div id="footer" class="p-1">
            <div class="row" style="padding:15px; margin:0px; width: 100%;">
                <div class="col col-md-2 justify-content-left">
                    <img src="/images/logo_footer.png" alt="">
                </div>
                <div class="col col-md-10 justify-content-right">
                    <ul class="nav navbar-nav navbar-right" style="margin: -14px;">
                        <li>
                            <a style="color: white; font-weight: bold;" class="page-scroll" href="#">About Us</a>
                        </li>
                        <li>
                            <a style="color: white; font-weight: bold;" class="page-scroll" href="/contact-us">Contact
                                Us</a>
                        </li>
                        <li>
                            <a style="color: white; font-weight: bold;" class="page-scroll" href="#">Testimonials</a>
                        </li>
                        <li>
                            <a style="color: white; font-weight: bold;" class="page-scroll" href="#">Articles</a>
                        </li>
                        <li>
                            <a style="color: white; font-weight: bold;" class="page-scroll" href="/pages.faqs">FAQ</a>
                        </li>
                        <li>
                            <a style="color: white; font-weight: bold;" class="page-scroll"
                               href="/pages.privacy-policy">Privacy Policy</a>
                        </li>
                        <li>
                            <a style="color: white; font-weight: bold;" class="page-scroll" href="/terms-conditions">Terms
                                & Conditions</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</template>

<script>
    import Vue from 'vue';

    export default Vue.extend({
        name: 'footer',
        props: [],
        methods: {
            logout() {
                window.location.href = this.$config.BASE_URL + '/logout';
            }
        }
    })
</script>
