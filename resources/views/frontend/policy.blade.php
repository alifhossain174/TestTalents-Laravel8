@extends('frontend.master')

@section('header_css')
<link rel="stylesheet" href="{{url('frontend_assets')}}/css/policy.css">
<style>
    .policy_banner {
        background-image: url('{{url('frontend_assets')}}/images/policy_banner.jpg');
    }
</style>
@endsection

@section('content')

<section>
    <div class="policy_banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="policy_banner_text">
                        <h2><i class="fas fa-user-shield"></i> TestTalents Privacy Policy</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section>
    <div class="policy_content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="mb-3">November, 2022</h4>

                    <p>
                        Welcome to TestTalents! Our priority is to protect your personal data and ensure a transparent and secure experience when using our employee and applicant testing platform. This Privacy Policy outlines how we collect, use, share, and safeguard your information in connection with our website, www.testtalents.com, and the services provided through it.
                    </p>
                    <p>
                        The Platform allows employers and customers ("Customers") to instruct Candidates to take aptitude, personality, and skills tests. To facilitate this process, we may need to process certain personal data of our Users. This Privacy Policy is applicable to all visitors, users, and others who access the Platform ("Users").
                    </p>
                    <p>
                        We understand the importance of your privacy and are committed to complying with the General Data Protection Regulation (GDPR) as a data controller for the processing of personal data.
                    </p>
                    <p>
                        Before you proceed to use our testing platform, we kindly request that you carefully read and fully understand this Privacy Policy to be aware of how we handle your personal data.
                    </p>
                    <p>
                        If you have any questions or concerns regarding your personal data, please do not hesitate to reach out to us. We value your trust in TestTalents and aim to provide a secure and seamless experience while using our services.
                    </p>
                    <p>
                        Thank you for choosing TestTalents, and we look forward to assisting you in finding the best talent for your business needs.
                    </p>

                    <h5>1. Information We Collect</h5>
                    <p>
                        When you use our platform, we collect various types of personal data to provide our services. The information collected depends on whether you are a Candidate or a Customer:
                    </p>
                    <ul>
                        <li>For Candidates: We may collect your full name, gender, email address, username, career-related information, IP address, and communications between you and us.</li>
                        <li>For Customers: We may collect your full name, phone number, address, postal code, city, state, email address, username, career-related information, subscriptions/preferences, and communications between you and us.</li>
                    </ul>


                    <h5 style="margin-top: 35px;">2.	Purposes of Using Your Personal Data </h5>
                    <p>
                        We use your personal data to support and provide services on our platform. The purposes include:
                    </p>
                    <ul>
                        <li>Service Provision: Administering tests, handling inquiries, complaints, and addressing your concerns.</li>
                        <li>Communication: Sending emails, newsletters, and messages to keep you informed about our platform. You can opt out of these communications.</li>
                        <li>Website Monitoring: Checking and optimizing the platform's usage and functionality.</li>
                        <li>Platform Optimization: Improving, testing, and diagnosing technology issues on the platform.</li>
                        <li>Managing Suppliers: Sharing data with suppliers who provide services to us.</li>
                        <li>Easy Access: Facilitating efficient access to your information after sign-in and remembering certain details for future visits.</li>
                        <li>Statistics: Monitoring metrics such as visitor traffic, demographics, and anonymized test results.</li>
                        <li>Development: Developing and testing new products and features.</li>
                        <li>Benchmarks: Providing anonymized test scores and demographics as benchmarks to customers for improvement.</li>
                    </ul>


                    <h5 style="margin-top: 35px;">3. Legal Grounds for Processing Personal Data </h5>
                    <p>
                        We process your personal data based on various legal grounds, including:
                    </p>
                    <ul>
                        <li>Consent: Processing with your consent, which can be withdrawn at any time.</li>
                        <li>Contractual Obligations: Processing data to fulfill our contractual relationship with you.</li>
                        <li>Legal Obligations: Processing data to comply with legal requirements.</li>
                        <li>Legitimate Interests: Processing data for legitimate business interests. You have the right to object to certain processing activities.</li>
                    </ul>


                    <h5 style="margin-top: 35px;">4. Sharing Your Personal Data  </h5>
                    <p>
                        Apart from our sub-processors, we share your data with the following parties:
                    </p>
                    <ul>
                        <li>Customers: Sharing candidate information with customers if they administer tests or have candidate consent to access test results.</li>
                        <li>Test Authors: Sharing aggregated candidate test feedback with test authors for product improvement.</li>
                        <li>Suppliers: Sharing data with suppliers who support our business, subject to information security standards.</li>
                    </ul>


                    <h5 style="margin-top: 35px;">5. Safety and Security</h5>
                    <p>
                        We implement technical and organizational measures, including encryption, to protect your personal data. You are responsible for maintaining the secrecy of your account information.
                    </p>

                    <h5 style="margin-top: 35px;">6. Your Rights</h5>
                    <p>
                        In accordance with the GDPR, you have various rights concerning your personal data, including access, correction, erasure, restriction, portability, and objection. You can contact our data protection officer to exercise these rights or raise any concerns.
                    </p>

                    <h5 style="margin-top: 35px;">7. Third-party Applications, Websites, and Services </h5>
                    <p>
                        We are not responsible for the practices of third-party applications, websites, or services linked to or from our platform.
                    </p>

                    <h5 style="margin-top: 35px;">8. Data Retention</h5>
                    <p>
                        We retain your information for as long as necessary to provide our services and comply with legal requirements.
                    </p>

                    <h5 style="margin-top: 35px;">9. Data Storage Location </h5>
                    <p>
                        Your information is stored on servers in the European Economic Area.
                    </p>

                    <h5 style="margin-top: 35px;">10. Children</h5>
                    <p>
                        Our platform is not intended for use by individuals under 16 years old, and we do not knowingly collect data from children.
                    </p>

                    <h5 style="margin-top: 35px;">11. Changes to this Policy</h5>
                    <p>
                        We may modify or update our Privacy Policy, and you will be notified of any changes.
                    </p>

                    <h5 style="margin-top: 35px;">12. Contact Us</h5>
                    <p>
                        For any questions or concerns regarding this Privacy Policy, you can contact us at the provided contact details.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>


<!--Top Button Start-->
<div class="top_btn wow bounceInRight">
    <i class="fas fa-arrow-up"></i>
</div>
<!--Top button End-->

@endsection
