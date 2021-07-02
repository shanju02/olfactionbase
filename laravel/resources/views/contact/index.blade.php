@extends('layouts.frontend')

@section('page-title', 'Contact us')

@section('content')
    @include('partials.breadcrumb')
    <section id="contact" class="contact">
        <div class="container">


            <div class="row">
                <div class="col-lg-6 col-md-6 mt-4 mt-md-0 mb-5" data-aos="fade-up" data-aos-delay="200">
                    <div class="info">
                        <div>
                            <p style="font-size: 18px; font-weight: bold">Corresponding Author:</p>
                            <p>
                                <span style="font-size: 24px; font-weight: bold">Dr. Pritish Varadwaj</span>
                                <span style="font-size: 18px;">
                                    <br />Professor,
                                    <br />Indian Institute of Information Technology-Allahabad
                                    <br />Prayagraj-211012, Uttar Pradesh, India
                                </span>
                            </p>

                            <p style="font-size: 18px; font-weight: bold">Contact Information:</p>
                            <p style="font-size: 18px;">
                                <i class="ri-mail-send-line"></i> <a href="mailto:pritish@iiita.ac.in">pritish@iiita.ac.in</a>
                            </p>
                            <p style="font-size: 18px;"><i class="ri-phone-line"></i> <a href="phone:+91-532-2922090">+91-532-2922090</a></p>
                            <p style="font-size: 18px;"><i class="ri-global-line"></i> <a href="https://profile.iiita.ac.in/pritish/" target="_blank">https://profile.iiita.ac.in/pritish/</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 mt-4 mt-md-0 mb-5" data-aos="fade-up" data-aos-delay="200">
                    <p style="font-size: 18px; font-weight: bold">Contributors:</p>
                    <table class="table-responsive table-bordered" cellpadding="10">
                        <thead>
                            <tr>
                                <th width="30%">Name</th>
                                <th>Contribution</th>
                                <th width="30%">Contact</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Anju Sharma</strong></td>
                                <td>
                                    Data Collection, Processing, Manual Verification, Website Development
                                </td>
                                <td>
                                    <a href="mailto:anjusharma.online@gmail.com">anjusharma.online@gmail.com</a>
                                    <br />
                                    <a href="mailto:rss2017504@iiita.ac.in">rss2017504@iiita.ac.in</a>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Bishal Saha</strong></td>
                                <td>
                                    Website Development
                                </td>
                                <td>
                                    <a href="mailto:bishal.saha@gmail.com">bishal.saha@gmail.com</a>
                                    <br />
                                    <a href="mailto:bishal.saha@gentryx.com">bishal.saha@gentryx.com</a>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Rajnish Kumar</strong></td>
                                <td>
                                    Manual Verification
                                </td>
                                <td>
                                    <a href="mailto:12.rajnish@gmail.com,">12.rajnish@gmail.com,</a>
                                    <br />
                                    <a href="mailto:rkumar2@lko.amity.edu">rkumar2@lko.amity.edu</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="section-title" data-aos="fade-up">
                <h2>Contact Us</h2>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 offset-3" data-aos="fade-up" data-aos-delay="300">
                    <form action="{{ route('contact') }}" method="post" role="form" class="php-email-form">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                        </div>
                        <div class="my-3">
                            @include('partials.alerts')
                        </div>
                        <div class="text-center"><button type="submit">Send Message</button></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('header')
@endpush

@push('footer')
@endpush

