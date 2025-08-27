<footer class="full">
    <div class="footer-main">
        <div class="footer-content">
            <div class="footer-logo">
                <a href="{{ url('/') }}" class="footer-logo-img"><img src="{{ url('websiteasset/images/final.png') }}"
                        alt="" height="70"></a>
            </div>
            <div class="footer-subcontent">
                <div class="footer-links">
                    <div class="footer-links-1">
                        <h5 class="footer-links-title">Product</h5>
                        <ul class="footer-links-lists">
                            <li><a href="{{ url('/customerhome') }}">Home</a></li>
                            <li><a href="{{ url('/order') }}">Order</a></li>
                            <li><a href="{{ url('/pricing') }}">Subscription</a></li>
                     
                        </ul>
                    </div>
                    <div class="footer-links-2">
                        <h5 class="footer-links-title">Help</h5>
                        <ul class="footer-links-lists">
                            <li><a href="#">Live Chat</a></li>
                            <li><a href="#">Send Email</a></li>
                            <li><a href="#">FAQ</a></li>
                        </ul>
                    </div>
                    {{-- <div class="footer-links-3">
                        <h5 class="footer-links-title">Company</h5>
                        <ul class="footer-links-lists">
                            <li><a href="#">About</a></li>
                            <li><a href="#">Customers</a></li>
                            <li><a href="#">Blog</a></li>
                        </ul>
                    </div> --}}
                </div>
                <div class="footer-newsletter">
                    <div class="footer-newsletter-main">
                        <h5 class="footer-links-title">Try TweetNow</h5>
                        <form class="footer-newsletter-form">
                            <input type="text" class="footer-newsletter-input" placeholder="Email Address" required>
                            <button class="footer-newsletter-button">Start Scheduling</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-text">

        </div>
    </div>
</footer>
