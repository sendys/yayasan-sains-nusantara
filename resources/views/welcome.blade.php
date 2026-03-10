<!DOCTYPE html>
<html lang="id">

<head>

    @include('layouts.frontend.head-css')

</head>

<body>

    <!-- header -->
    <header class="fixed-top header">
        <!-- top header -->
        @include('layouts.frontend.top-header')
        <!-- navbar -->
        <div class="navigation w-100">
            <div class="container">
                @include('layouts.frontend.navbar')
            </div>
        </div>
    </header>
    <!-- /header -->

    <!-- hero slider -->
    @include('layouts.frontend.hero')
    <!-- /hero slider -->

    <!-- banner-feature -->
    {{-- @include('layouts.frontend.banner') --}}
    <!-- /banner-feature -->

    <!-- about us -->
    @include('layouts.frontend.about')
    <!-- /about us -->

    <!-- courses -->
    @include('layouts.frontend.event')
    <!-- /courses -->

    <!-- cta -->
    @include('layouts.frontend.cta')
    <!-- /cta -->

    <!-- success story -->
    @include('layouts.frontend.story')
    <!-- /success story -->

    <!-- events -->
    {{-- @include('layouts.frontend.event') --}}
    <!-- /events -->

    <!-- blog -->
    @include('layouts.frontend.blog')
    <!-- /blog -->

    <!-- footer -->
    @include('layouts.frontend.footer')
    <!-- /footer -->

    <!-- Cookie Consent Banner -->
    <div id="cookie-consent"
        style="display:none; position:fixed; bottom:0; left:0; right:0; z-index:9999;
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
        color: #f0f0f0; padding: 18px 24px;
        box-shadow: 0 -4px 20px rgba(0,0,0,0.35);
        border-top: 2px solid rgba(255,255,255,0.08);">
        <div
            style="max-width:900px; margin:0 auto; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:14px;">
            <div style="display:flex; align-items:center; gap:12px; flex:1; min-width:240px;">
                <span style="font-size:28px;">🍪</span>
                <div>
                    <p style="margin:0 0 4px; font-weight:600; font-size:15px; color:#fff;">Kami Menghargai Privasi Anda
                    </p>
                    <p style="margin:0; font-size:13px; color:#c0c0d0; line-height:1.5;">
                        Kami menggunakan cookie untuk membantu meningkatkan pengalaman Anda di situs ini dan memastikan
                        informasi tentang program kami tersampaikan dengan baik. Dengan mengklik “Terima Semua Cookie”,
                        Anda membantu kami terus menyempurnakan layanan dan
                        dampak yang kami hadirkan. Anda dapat mengatur preferensi melalui “Pengaturan Cookie” atau
                        membaca lebih lanjut di
                        <a href="{{ route('kebijakan') }}" style="color:#93c5fd; text-decoration:underline;">Pernyataan
                            Privasi</a> kami.
                    </p>
                </div>
            </div>
            <div style="display:flex; gap:10px; flex-shrink:0;">
                <button id="reject-cookie"
                    style="padding:9px 20px; border:1px solid rgba(255,255,255,0.25); background:transparent;
                    color:#c0c0d0; border-radius:6px; cursor:pointer; font-size:13px;
                    transition:all 0.2s ease;">
                    Tolak
                </button>
                <button id="accept-cookie"
                    style="padding:9px 22px; background:linear-gradient(135deg, #4f8ef7, #3a6fd8);
                    color:#fff; border:none; border-radius:6px; cursor:pointer; font-size:13px;
                    font-weight:600; box-shadow:0 3px 10px rgba(79,142,247,0.4);
                    transition:all 0.2s ease;">
                    Terima Semua
                </button>
            </div>
        </div>
    </div>
    <!-- /Cookie Consent Banner -->

    <!-- jQuery -->
    <script src="{{ asset('assets/fe/plugins/jQuery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/fe/plugins/bootstrap/bootstrap.min.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // ── Helper: set cookie ──────────────────────────────────────
            function setCookie(name, value, days) {
                let expires = "";
                if (days) {
                    let date = new Date();
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    expires = "; expires=" + date.toUTCString();
                }
                document.cookie = name + "=" + (encodeURIComponent(value)) + expires + "; path=/; SameSite=Lax";
            }

            // ── Helper: get cookie ──────────────────────────────────────
            function getCookie(name) {
                let nameEQ = name + "=";
                let ca = document.cookie.split(';');
                for (let i = 0; i < ca.length; i++) {
                    let c = ca[i].trim();
                    if (c.indexOf(nameEQ) === 0)
                        return decodeURIComponent(c.substring(nameEQ.length));
                }
                return null;
            }

            // ── Helper: delete cookie ───────────────────────────────────
            function deleteCookie(name) {
                document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/";
            }

            // ── Helper: animate banner out ──────────────────────────────
            function hideBanner() {
                const banner = document.getElementById("cookie-consent");
                banner.style.transition = "transform 0.4s ease, opacity 0.4s ease";
                banner.style.transform = "translateY(100%)";
                banner.style.opacity = "0";
                setTimeout(function() {
                    banner.style.display = "none";
                }, 420);
            }

            // ── Show banner only if consent not yet given ───────────────
            const consent = getCookie("cookie_consent");
            if (!consent) {
                const banner = document.getElementById("cookie-consent");
                banner.style.display = "block";
                // Animate in from bottom
                banner.style.transform = "translateY(100%)";
                banner.style.opacity = "0";
                banner.style.transition = "transform 0.5s ease, opacity 0.5s ease";
                requestAnimationFrame(function() {
                    requestAnimationFrame(function() {
                        banner.style.transform = "translateY(0)";
                        banner.style.opacity = "1";
                    });
                });
            }

            // ── Accept button ───────────────────────────────────────────
            document.getElementById("accept-cookie").addEventListener("click", function() {
                setCookie("cookie_consent", "accepted", 365);
                hideBanner();
            });

            // ── Reject button ───────────────────────────────────────────
            document.getElementById("reject-cookie").addEventListener("click", function() {
                setCookie("cookie_consent", "rejected", 30);
                hideBanner();
            });

            // ── Hover effects for buttons ───────────────────────────────
            const acceptBtn = document.getElementById("accept-cookie");
            const rejectBtn = document.getElementById("reject-cookie");

            acceptBtn.addEventListener("mouseover", function() {
                this.style.transform = "translateY(-2px)";
                this.style.boxShadow = "0 6px 18px rgba(79,142,247,0.55)";
            });
            acceptBtn.addEventListener("mouseout", function() {
                this.style.transform = "translateY(0)";
                this.style.boxShadow = "0 3px 10px rgba(79,142,247,0.4)";
            });
            rejectBtn.addEventListener("mouseover", function() {
                this.style.background = "rgba(255,255,255,0.08)";
                this.style.color = "#fff";
            });
            rejectBtn.addEventListener("mouseout", function() {
                this.style.background = "transparent";
                this.style.color = "#c0c0d0";
            });

        });
    </script>

    <script src="{{ asset('assets/fe/plugins/slick/slick.min.js') }}"></script>
    <script src="{{ asset('assets/fe/plugins/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/fe/plugins/venobox/venobox.min.js') }}"></script>
    <script src="{{ asset('assets/fe/plugins/mixitup/mixitup.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU&libraries=places">
    </script>
    <script src="{{ asset('assets/fe/plugins/google-map/gmap.js') }}"></script>
    <script src="{{ asset('assets/fe/js/script.js') }}"></script>

    @push('scripts')

    </body>

    </html>
