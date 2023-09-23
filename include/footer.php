<div class="container-fluid bg-dark text-light pt-4 footer-se mt-5 wow bg-4 footer " data-wow-delay="0.1s">
    <div class="container">
        <div class="row gx-5">
            <div class="col-lg-12 col-md-6">
                <div class="section-title text-center position-relative pb-3 mb-4 mx-auto">
                    <h3 class="text-light mb-4 mt-4">Talk To Us</h3>
                    <h5 class="text-light mb-4" style="font-weight: 300 !important;">Feel free to call, email, or hit us up on our social media accounts</h5>
                    <a href="https://ibrlive.com/contact" class="btn btn-light py-md-3 px-md-5 animated">CONTACT US</a>
                </div>
            </div>
        </div>
        <div class="row gx-5">
            <div class="col-lg-4 col-md-12 pt-2 mb-5">
                <div class="section-title section-title-sm position-relative pb-3 mb-4">
                    <h3 class="text-light mb-2">PHONE</h3>
                    <h5 class="text-light" style="font-weight: 300 !important;">+91-9991622344</h5>
                </div>
                <p class="f-18"><a href="https://ibrlive.com/privacy-policy" class="text-light">Privacy Policy</a></p>
            </div>
            <div class="col-lg-4 col-md-12 pt-2 mb-5">
                <div class="section-title section-title-sm position-relative pb-3 mb-4">
                    <h3 class="text-light mb-2">EMAIL</h3>
                    <h5 class="text-light" style="font-weight: 300 !important;">contact@ibrlive.com</h5>
                </div>
                <p class="f-18"><a href="https://ibrlive.com/terms-and-conditions" class="text-light">Terms and Conditions</a></p>
            </div>
            <div class="col-lg-4 col-md-12 pt-2 mb-5">
                <div class="section-title section-title-sm position-relative pb-3 mb-4">
                    <h3 class="text-light mb-2">FOLLOW US</h3>
                    <h4 style="font-weight: 300 !important;"><a href="https://www.facebook.com/ibrliveindia/" class="text-light"><i class="fab fa-facebook-f"></i></a> &nbsp; <a href="https://twitter.com/ibr_live" class="text-light"><i class="fab fa-twitter"></i></a> &nbsp; <a href="https://www.instagram.com/ibrlive/" class="text-light"><i class="fab fa-instagram"></i></a> &nbsp; <a href="https://www.linkedin.com/company/ibrlive/" class="text-light"><i class="fab fa-linkedin"></i></a></h4>
                </div>
                <p class="f-18"><a href="https://ibrlive.com/refund-cancellation" class="text-light">Refund and Cancellation</a></p>
            </div>
        </div>
    </div>
</div>
<a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/counterup/counterup.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="js/main.js"></script>
<script>
    $(function() {

        var url = window.location.pathname,
            urlRegExp = new RegExp(url.replace(/\/$/, '') + "$"); // create regexp to match current url pathname and remove trailing slash if present as it could collide with the link in navigation in case trailing slash wasn't present there
        // now grab every link from the navigation
        $('.active').removeClass('active'); 
        $('.navbar a').each(function() {
            // and test its normalized href against the url pathname regexp
            if (urlRegExp.test(this.href.replace(/\/$/, ''))) {
                $(this).addClass('active');
            }
        });

    });

    (function(w, d, s, c, r, a, m) {
        w['KiwiObject'] = r;
        w[r] = w[r] || function() {
            (w[r].q = w[r].q || []).push(arguments)
        };
        w[r].l = 1 * new Date();
        a = d.createElement(s);
        m = d.getElementsByTagName(s)[0];
        a.async = 1;
        a.src = c;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', "https://app.interakt.ai/kiwi-sdk/kiwi-sdk-17-prod-min.js?v=" + new Date().getTime(), 'kiwi');
    window.addEventListener("load", function() {
        kiwi.init('', 'Zlw2804l9EzYOcZ43XoLkBDSBvuUJjUV', {});
    });
</script>