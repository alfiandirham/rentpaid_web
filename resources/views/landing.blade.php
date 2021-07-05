<!DOCTYPE html><!--  This site was created in Webflow. http://www.webflow.com  -->
<!--  Last Published: Fri Jun 25 2021 12:20:38 GMT+0000 (Coordinated Universal Time)  -->
<html data-wf-page="5f5595893d5590df9697d70a" data-wf-site="5f5595893d5590368397d709">
<head>
    <meta charset="utf-8">
    <title>Rentpaid</title>
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="Webflow" name="generator">
    <link href="{{url('assets')}}/css/normalize.css" rel="stylesheet" type="text/css">
    <link href="{{url('assets')}}/css/webflow.css" rel="stylesheet" type="text/css">
    <link href="{{url('assets')}}/css/rentpaid.webflow.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
    <script type="text/javascript">WebFont.load({google: {families: ["Nunito Sans:regular,600,700,800,900"]}});</script>
    <!-- [if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"
            type="text/javascript"></script><![endif] -->
    <script type="text/javascript">!function (o, c) {
            var n = c.documentElement, t = " w-mod-";
            n.className += t + "js", ("ontouchstart" in o || o.DocumentTouch && c instanceof DocumentTouch) && (n.className += t + "touch")
        }(window, document);</script>
    <link href="{{url('assets')}}/images/favicon.png" rel="shortcut icon" type="image/x-icon">
    <link href="{{url('assets')}}/images/webclip.png" rel="apple-touch-icon">
</head>
<body class="body">
<div data-collapse="medium" data-animation="default" data-duration="400" role="banner" class="navbar w-nav">
    <div class="container w-container">
        <a href="#" class="w-nav-brand"><img src="{{url('assets')}}/images/logov1.svg" loading="lazy" alt=""></a>
        <nav role="navigation" class="nav-menu w-nav-menu">
            <a href="#hero" class="nav-link w-nav-link">Beranda</a>
            <a href="#tentang" class="nav-link w-nav-link">Tentang</a>
            <a href="#fitur" class="nav-link w-nav-link">Fitur</a>
            <a href="#bottom" class="nav-link last w-nav-link">Hubungi Kami</a>
            <div class="login">
                <a href="{{$data['link_button_login'] ?? '/login'}}" class="link-block w-inline-block">
                    <div>Client Login</div>
                </a>
            </div>
        </nav>
        <div class="menu-button w-nav-button">
            <div class="w-icon-nav-menu"></div>
        </div>
    </div>
</div>
<div class="hero">
    <div class="w-container">
        <div data-w-id="86c43c89-aea8-a6ba-fd38-712a05813c2e" data-animation-type="lottie"
             data-src="{{url('assets')}}/documents/city.json" data-loop="1" data-direction="1" data-autoplay="1"
             data-is-ix2-target="0" data-renderer="svg" data-default-duration="15.033333333333333" data-duration="20"
             class="lottie-animation"></div>
        <h1 class="h1 top-100 text-blue">Kontrol aset sewaan kamu kini lebih mudah dengan <span class="yellow-text">Rentpaid</span>
        </h1>
        <div class="wrapper-cta">
            <a href="{{$data['link_dapatkan_penawaran'] ?? '#bottom'}}" class="btn-cta w-inline-block">
                <div>Dapatkan Penawaran</div>
            </a>
            <div class="text-20-reg top-bottom-24">atau</div>
            <a href="{{$data['link_pelajari_selengkapnya'] ?? '#tentang'}}" class="scond-cta">Pelajari Selengkapnya</a>
        </div>
    </div>
</div>
<div class="tentang">
    <div class="container-tentang w-container">
        <div class="content">
            <h4 class="h4">Tentang</h4>
            <h1 class="h1 light">Apa itu Rentpaid?</h1>
            <p class="p top-bottom-32">Rentpaid merupakan layanan aplikasi digital yang dikembangkan oleh PT Bahana
                Security System untuk menjawab kebutuhan teknologi guna membantu unit usaha yang bergerak dibidang
                penyewaan properti yang mana kami menyediakan sistem penagihan digital berbasis mobile dan web dashboard
                sehingga memudahkan bagi para pelaku usaha penyewaan properti dalam memantau dan mengontrol usaha
                mereka.</p>
        </div>
        <div class="image"><img src="{{url('assets')}}/images/sunmi.png" loading="lazy" width="327" alt=""
                                class="image-5"><img src="{{url('assets')}}/images/square.png" loading="lazy"
                                                     width="143" alt="" class="image-2"><img
                src="{{url('assets')}}/images/struk.png" loading="lazy" width="209" alt="" class="image-3"><img
                src="{{url('assets')}}/images/blue_circle.png" loading="lazy" width="111" alt="" class="image-4"></div>
        <div class="app">
            <div class="content">
                <h2 class="h2 top-bottom-24">Sistem Rentpaid</h2>
                <p class="p">Rentpaid terdiri dari 2 aplikasi yang saling terkoneksi yakni Aplikasi Mobile dan Web
                    dashboard.</p>
            </div>
            <div class="col-app w-row">
                <div class="w-col w-col-6">
                    <div class="card-app"><img src="{{url('assets')}}/images/ic_mobile.svg" loading="lazy" alt=""
                                               class="card-app-img">
                        <div class="card-app-content">
                            <h4 class="card-app-title">Rentpaid Mobile</h4>
                            <p class="paragraph no-margin">Merupakan aplikasi mobile berbasis Android yang terintegrasi
                                dengan handheld all in one, yang mana berfungsi sebagai aplikasi kolektor untuk
                                penagihan pembayaran sewa.</p>
                        </div>
                    </div>
                </div>
                <div class="w-col w-col-6">
                    <div class="card-app"><img src="{{url('assets')}}/images/ic_dashboard.svg" loading="lazy" alt=""
                                               class="card-app-img">
                        <div class="card-app-content">
                            <h4 class="card-app-title">Web Dashboard</h4>
                            <p class="paragraph no-margin">Aplikasi berbasis web yang menampung dan memvisualisasikan
                                data transaksi penagihan serta mengolah laporan berdasarkan data transaksi dari Rentpaid
                                Mobile.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mitra-kami">
    <div class="container-mitra w-container">
        <h1 class="h1 dark">Mitra Kami</h1>
        <div class="partner-logo"><img src="{{url('assets')}}/images/pd_pasar_sewakadarma.png" loading="lazy"
                                       width="160" alt="" class="im-partner"><img src="{{url('assets')}}/images/bss.png"
                                                                                  loading="lazy" width="160" alt=""
                                                                                  class="im-partner"><img
                src="{{url('assets')}}/images/bintang.png" loading="lazy" width="160" alt="" class="im-partner"></div>
    </div>
</div>
<div class="fitur">
    <div class="w-container">
        <h1 class="h1 dark">Fitur Rentpaid</h1>
        <div class="w-layout-grid grid-fitur">
            <div class="card-fitur">
                <h6 class="card-heading">Mobile App Collector</h6>
                <p class="p dark top-16">Aplikasi penagihan berbasis android yang terintegrasi dengan sistem cloud</p>
            </div>
            <div class="card-fitur">
                <h6 class="card-heading">All In One Device</h6>
                <p class="p dark top-16">Satu device dengan sistem multifungsi memudahkan dalam melakukan penagihan
                    sewa</p>
            </div>
            <div class="card-fitur">
                <h6 class="card-heading">Rich Feature Dashboard</h6>
                <p class="p dark top-16">Kemudahan mengelola data dan laporan dalam satu sistem web dashboard</p>
            </div>
            <div class="card-fitur">
                <h6 class="card-heading">Multilevel User</h6>
                <p class="p dark top-16">Membatasi hak akses setiap level pengguna dalam sistem web dashboard dan
                    aplikasi mobile</p>
            </div>
            <div class="card-fitur">
                <h6 class="card-heading">Location Management</h6>
                <p class="p dark top-16">Kemudahan dalam mengatur tarif dan penyewa dalam setiap lokasi yang
                    disewakan</p>
            </div>
            <div class="card-fitur">
                <h6 class="card-heading">Member Card</h6>
                <p class="p dark top-16">Mencetak kartu member atau kartu penyewa dapat dilakukan hanya dengan beberapa
                    klik</p>
            </div>
            <div class="card-fitur">
                <h6 class="card-heading">QR Code</h6>
                <p class="p dark top-16">Proses penagihan menggunakan sistem scan QR Code sehingga data lebih akurat</p>
            </div>
            <div class="card-fitur">
                <h6 class="card-heading">Payment Integration</h6>
                <p class="p dark top-16">Memberi kemudahan proses penagihan dengan integrasi berbagai layanan
                    pembayaran</p>
            </div>
            <div class="card-fitur">
                <h6 class="card-heading">Customer Support</h6>
                <p class="p dark top-16">Pelayanan yang terbaik dari kami dalam menangani kritik, saran maupun keluhan
                    terhadap sistem</p>
            </div>
        </div>
        <div class="wrap-cta">
            <div class="cta-fitur">
                <p class="p dark-info">Masih terdapat berbagai fitur dan keuntungan lainnya. Gabung sekarang dan nikmati
                    kemudahan mengelola aset sewaan kamu.</p>
                <a href="{{$data['link_dapatkan_penawaran'] ?? '#'}}" class="btn-cta w-inline-block">
                    <div>Dapatkan Penawaran</div>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="bottom">
    <div data-w-id="4e7b65f1-387f-9182-5ad1-d1566a94c4cd" class="contact">
        <div class="container-contact w-container">
            <div class="content contact">
                <h1 class="h2 dark">Hubungi Kami</h1>
                <div class="form w-form">
                    <form action="{{route('contact-us')}}" method="post" id="email-form" name="email-form" data-name="Email Form" class="form-contact">
                        @csrf
                        <label
                            for="Nama" class="label">Name</label>
                        <input type="text" class="text-field w-input"
                                                                        maxlength="256" name="name" data-name="Nama"
                                                                        placeholder="Masukkan nama kamu" id="Nama"
                                                                        required="">
                        <label for="email" class="label">Email
                            Address</label>
                        <input type="email" class="text-field w-input" maxlength="256" name="email"
                                                  data-name="Email" placeholder="Masukkan email kamu" id="email"
                                                  required="">
                        <label for="company" class="label">Nama Perusahaan</label>
                        <input
                            type="text" class="text-field w-input" maxlength="256" name="perusahaan" data-name="company"
                            placeholder="Masukkan nama perusahaan" id="company" required="">
                        <label for="pesan"
                                                                                                   class="label">Pesan</label>
                        <textarea
                            placeholder="Masukkan pesan" maxlength="5000" id="pesan" name="pesan" required=""
                            data-name="pesan" class="text-field w-input"></textarea>
                        @if (session()->has('message'))
                            <label>{{session('message')}}</label>
                        @endif
                        <input type="submit"
                                                                                           value="Kirim Pesan"
                                                                                           data-wait="Please wait..."
                                                                                           class="btn-submit w-button">
                    </form>
                    <div class="success-message w-form-done">
                        <div class="success">Terima kasih, <br>pesan kamu terkirim. Tim kami akan segera membalas pesan
                            kamu.
                        </div>
                    </div>
                    <div class="error-message w-form-fail">
                        <div>Maaf ada kesalahan saat mengirim pesan. Mohon cek koneksi internet kamu.</div>
                    </div>
                </div>
            </div>
            <div class="img-contact"><img src="{{url('assets')}}/images/square_3d.png" loading="lazy" width="151" alt=""
                                          class="image-8"><img src="{{url('assets')}}/images/hand.png" loading="lazy"
                                                               width="364" sizes="(max-width: 767px) 100vw, 310.5px"
                                                               srcset="images/hand-p-500.png 500w, images/hand.png 728w"
                                                               alt="" class="image-6"><img
                    src="{{url('assets')}}/images/hai.png" loading="lazy" width="310.5" alt="" class="image-9"></div>
        </div>
    </div>
    <div class="footer">
        <div class="bg-footer">
            <div class="container-footer w-container">
                <div class="w-row">
                    <div class="col-footer w-col w-col-4"><img src="{{url('assets')}}/images/logov1.svg" loading="lazy"
                                                               alt="">
                        <p class="p-footer">Aplikasi solusi manajemen penyewaan properti berbasis web dan mobile.</p>
                        <div class="socmed">
                            <a href="{{$data['facebook'] ?? '#'}}" class="link-socmed w-inline-block"><img
                                    src="{{url('assets')}}/images/ic_fb.svg" loading="lazy" alt=""
                                    class="ic_socmed"></a>
                            <a href="{{$data['whatsapp'] ?? '#'}}" class="link-socmed w-inline-block"><img
                                    src="{{url('assets')}}/images/ic_wa.svg" loading="lazy" alt=""
                                    class="ic_socmed"></a>
                            <a href="{{$data['instagram'] ?? '#'}}" class="link-socmed w-inline-block"><img
                                    src="{{url('assets')}}/images/ic_ig.svg" loading="lazy" alt=""
                                    class="ic_socmed"></a>
                        </div>
                        <div class="text-footer">Rentpaid 2021</div>
                    </div>
                    <div class="col-footer w-col w-col-4">
                        <div class="footer-title">Company</div>
                        <a href="{{$data['link_tentang_kami'] ?? '#'}}" class="link-footer">Tentang Kami</a>
                        <a href="{{$data['link_karir'] ?? '#'}}" class="link-footer">Karir</a>
                        <a href="{{$data['link_syarat_ketentuan'] ?? '#'}}" class="link-footer">Syarat &amp;
                            Ketentuan</a>
                    </div>
                    <div class="col-footer w-col w-col-4">
                        <div class="footer-title">Office</div>
                        <div class="title-office">Head Office Makassar</div>
                        <p class="p-footer">{{$data['address_head_office_makassar'] ?? ''}}</p>
                        <div class="title-office">Head Office Makassar</div>
                        <p class="p-footer">{{$data['address_head_office_makassar2'] ?? ''}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=5f5595893d5590368397d709"
        type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>
<script src="{{url('assets')}}/js/webflow.js" type="text/javascript"></script>
<!-- [if lte IE 9]>
<script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
</body>
</html>
