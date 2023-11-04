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
                        <h2><i class="fas fa-list"></i> Terms of Use</h2>
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

                    <h5 style="margin-bottom: 15px;">Introduction</h5>
                    <p>
                        Welcome to TestTalents! The following Terms of Service ("Terms") govern your use of our Services and form a legally binding agreement between you, the Customer, and TestTalents B.V. ("TestTalents," "we," "us," or "our"). Throughout these Terms, both you and TestTalents may be referred to individually as a "Party" and collectively as the "Parties." An "Affiliate" refers to any company or entity, whether a legal person or not, that has direct or indirect control over, is controlled by, or is under joint control with a particular person. For the purpose of this definition, "control" means either (a) having direct or indirect ownership of over 50% of the ownership, or (b) possessing the power to direct or influence the management and policies of such company or entity, in the absence of such ownership interest.
                    </p>
                    <p>
                        By using or accessing our Services, registering for a TestTalents account, or making a purchase, you agree to be bound by these Terms. If you do not agree with these Terms, please refrain from using our Services or creating a TestTalents account. If you are using the Services on behalf of an entity, you confirm that you have the authority to bind that entity to these Terms. Furthermore, you warrant to TestTalents that you have the necessary authority, unless that entity has a separate paid contract with TestTalents, in which case the separate paid contract will govern your use of the Services.
                    </p>
                    <p>
                        In these Terms, the "Agreement" collectively refers to these Terms, the Data Processing Agreement, the applicable Service Level Agreement ("SLA"), other instructions and policies ("Documentation") available on our website ("Website"), and any relevant ordering documents ("Order Form," as defined below).
                    </p>

                    <h5 style="margin-top: 35px; margin-bottom: 15px;">1. Grant of access and use</h5>
                    <ul style="list-style: none">
                        <li class="mb-3">
                            1.1. Provided that the Agreement's terms and conditions, including the payment of applicable fees, are adhered to, TestTalents allows you to access and use the Services under a limited, personal, non-exclusive, non-sublicensable, non-transferable, and non-assignable license. This license is granted solely for the purpose of your internal business operations.
                        </li>
                        <li class="mb-3">
                            1.2. The Services' access and usage are extended to a specific number of individuals, referred to as "Candidates," who have been duly authorized by you as the Customer in accordance with the rights outlined in the Agreement and as specified in the Order Form.
                        </li>
                        <li class="mb-3">
                            1.3. If approved in writing by TestTalents, your Affiliates may also use the Services without requiring a separate Order Form. To enable their access, you can provide your Affiliates with login credentials. It is essential to note that your Affiliates' usage is subject to the terms of the Agreement, and you hold direct responsibility for their access and use of the Services. In these Terms, any reference to "you" includes your Affiliates.
                        </li>
                    </ul>


                    <h5 style="margin-top: 35px; margin-bottom: 15px;">2. The Services</h5>
                    <ul style="list-style: none">
                        <li class="mb-3">
                            2.1. The Services offered by TestTalents encompass all its products and services. These Services are categorized into two types: (a) those that the Customer has ordered through an applicable ordering document (such as the Website) with specified pricing and commercial terms (referred to as "Order Form"); or (b) products and services that you, as the Customer, utilize. It is crucial to note that the Services are intended solely for commercial use and are not meant for personal or private individual use.
                        </li>
                        <li class="mb-3">
                            2.2. TestTalents is committed to providing the Services in strict adherence to the following: (a) the terms stated in the Agreement; (b) compliance with applicable laws and regulations; and (c) adherence to the Information Security Measures.
                        </li>
                        <li class="mb-3">
                            2.3. TestTalents retains the right to utilize its Affiliates in delivering the Services, either in full or in part, as governed by these Terms and relevant Order Form(s). In such cases, TestTalents assumes complete responsibility for any Services or their components provided by its Affiliates.
                        </li>
                    </ul>


                    <h5 style="margin-top: 35px; margin-bottom: 15px;">3. Your Account</h5>
                    <ul style="list-style: none">
                        <li class="mb-3">
                            3.1. In order to access our Services, it is necessary to create an account. To create an account, you must have the legal authority to represent the company or business that intends to use our Services. Additionally, on behalf of the Customer, you must review and accept these Terms. During the account creation process, you will be asked to provide your email address and set a password. Throughout your usage of the Services, it is your responsibility to provide accurate, complete, and current information. Failure to do so will be considered a violation of the Terms, and it may lead to the termination of your account on our platform.
                        </li>
                        <li class="mb-3">
                            3.2. You are accountable for maintaining the confidentiality of the password used to access the Services and for all activities conducted under your account. You must refrain from sharing your password with any third party.
                        </li>
                        <li class="mb-3">
                            3.3. If you become aware of any security breach or unauthorized use of your account, you must notify us immediately. It is your duty to prevent unauthorized access to or use of the Services through your account. In the event of any unauthorized access or use, please promptly inform TestTalents. Please be aware that TestTalents cannot be held liable for any losses or damages arising from the unauthorized use of your account.
                        </li>
                    </ul>


                    <h5 style="margin-top: 35px; margin-bottom: 15px;">4. User rights and responsibilities</h5>
                    <ul style="list-style: none">
                        <li class="mb-3">
                            4.1. When utilizing the Services, you agree to adhere to these Terms, as well as any applicable Documentation, Order Form(s), and relevant laws.
                        </li>
                        <li class="mb-3">
                            4.2. You are solely responsible for all activities performed under your account while using the Services. This includes any actions taken by Candidates using Customer Applications that you provide, such as applications, web domains, devices, and communication channels, whether owned or controlled by you or third parties.
                        </li>
                        <li class="mb-3">
                            4.3. Prohibited actions include: (a) duplicating any part of the Services or documentation, except for internal use; (b) attempting to reverse engineer, decompile, translate, modify, or derive the source code of the Services; (c) using the Services in violation of any applicable laws or regulations, and not transferring, exporting, or re-exporting them unlawfully; (d) developing software or services similar to or competing with the Services derived from them; (e) attempting to bypass or breach security measures or using automated means to access the Services; (f) removing or obscuring any identification, proprietary, or restrictive rights markings or notices from the Services; (g) uploading, transmitting, or providing unlawful or harmful information or materials through the Services, including any violation of applicable laws or public morality, or containing harmful computer code; or (h) aiding or assisting any third parties in engaging in the aforementioned actions.
                        </li>
                        <li class="mb-3">
                            4.4. Unless explicitly allowed under the Agreement, you may not lease, (re)sell, (sub)license, assign, distribute, publish, transfer, or make the Services available to third parties, except Candidates.
                        </li>
                        <li class="mb-3">
                            4.5. The Services are intended only for Candidates who are at least sixteen (16) years old.
                        </li>
                        <li class="mb-3">
                            4.6. Should you, any Candidates, or any other authorized user violate the aforementioned restrictions or pose a potential violation, TestTalents reserves the right to take action without prior consultation. This may include disabling the account of relevant Candidates or your access to the Services. You will be held liable for any damages arising from your violation of these restrictions when using the Services through your account. TestTalents may also report any criminal offenses directly related to your violation of these restrictions, and it shall not be held liable for any resulting damages.
                        </li>
                    </ul>


                    <h5 style="margin-top: 35px; margin-bottom: 15px;">5. Account suspension</h5>
                    <ul style="list-style: none">
                        <li class="mb-3">
                            5.1. TestTalents retains the right to promptly and without prior notice limit, suspend, or remove access to your account and the Services if, based on our reasonable judgment, any of the following circumstances occur: (a) Your use of the Services or the use of Candidates is found to be unlawful, unauthorized, or involving fraudulent activities; (b) You or Candidates are in material breach of any provision within the Agreement; (c) Your use of the Services significantly jeopardizes the security, availability, or integrity of the Services or our ability to cater to other customers; (d) Your provision or utilization of the Services violates applicable laws or regulations; (e) The account information you provided is found to be inaccurate or incomplete; or (f) You fail to fulfill your payment obligations as specified in the Agreement.
                        </li>
                        <li class="mb-3">
                            5.2. In the event of account suspension by TestTalents due to actions or omissions in accordance with this Article 5 or Article 8 (Fees and Payment Terms), we shall not be liable for any damages, losses (including data loss or profit loss), or any other consequences incurred by you. Additionally, you shall remain accountable for any Fees (as defined below) applicable during the suspension period.
                        </li>
                    </ul>


                    <h5 style="margin-top: 35px; margin-bottom: 15px;">6. Maintenance and Downtime, Modifications</h5>
                    <ul style="list-style: none">
                        <li class="mb-3">
                            6.1. At times, the availability of the Services may be temporarily affected due to various reasons, including (a) scheduled or unscheduled maintenance, modifications, or upgrades; (b) hardware failures or issues with third-party providers; (c) measures taken to mitigate or prevent threats or attacks on the Services or related networks and systems; or (d) compliance with legal or regulatory requirements. We will make reasonable efforts to provide you with advance notice of any scheduled service outages.
                        </li>
                        <li class="mb-3">
                            6.2. Unless explicitly specified in an Order Form, the SLA, or the Website, TestTalents shall not be held responsible for any damages, losses (including data loss or profit loss), or other consequences resulting from the unavailability of the Services or the failure to give prior notice of such unavailability.
                        </li>
                        <li class="mb-3">
                            6.3. We reserve the right to periodically make changes to the features and functioning of the Services. In such cases, we will make reasonable efforts to inform you accordingly. Rest assured that any changes made to the Services will not significantly diminish their overall features or functionality. Your continued use of the Services after being informed of the changes will be considered as your acceptance of the modified terms. If you do not agree with the changes, you must immediately discontinue the use of the Services. If applicable legislation requires us to provide specific notice of such changes, we will notify you as per Section 15 (Amendments).
                        </li>
                    </ul>

                    <h5 style="margin-top: 35px; margin-bottom: 15px;">7. Free Plan and Beta Products</h5>
                    <ul style="list-style: none">
                        <li class="mb-3">
                            7.1. As part of our Services, we may invite you to participate in testing new or additional products or features that are not yet available to all customers ("Beta Products") or allow you to access certain aspects of our Services without any charge ("Free Plan Products").
                        </li>
                        <li class="mb-3">
                            7.2. It is important to understand that Beta Products and Free Plan Products are provided for a limited evaluation period and may contain errors.
                        </li>
                        <li class="mb-3">
                            7.3. For Free Plan Products, we offer you the opportunity to use the Services on a trial basis at no cost, until either (a) the free trial period ends, or (b) you decide to subscribe to any of the Services.
                        </li>
                        <li class="mb-3">
                            7.4. Please be aware that Beta Products and Free Plan Products are provided on an "AS IS" basis, without any warranties, whether express, implied, statutory, or otherwise. TestTalents expressly disclaims all implied warranties, including but not limited to merchantability, non-infringement, and fitness for a particular purpose, concerning Beta Products and Free Plan Products.
                        </li>
                        <li class="mb-3">
                            7.5. TestTalents is under no obligation to provide Beta Products and Free Plan Products to any specific customer or our general customer base. We retain the right to terminate or discontinue any Beta Product or Free Plan Product at any time without prior notice.
                        </li>
                    </ul>


                    <h5 style="margin-top: 35px; margin-bottom: 15px;">8. Fees and Payment Terms</h5>
                    <ul style="list-style: none">
                        <li class="mb-3">
                            8.1. As a TestTalents user, you are responsible for paying all applicable fees as specified in the pricing section or in line with the rates published on the TestTalents website, unless otherwise mutually agreed upon in writing through the Order Form ("Fees").
                        </li>
                        <li class="mb-3">
                            8.2. Our Services operate on a subscription basis, with billing done in advance on a recurring and periodic schedule known as the "Billing Cycle." The Billing Cycle can be monthly or annual, depending on the subscription plan you choose, as indicated in the Order Form or on the TestTalents website.
                        </li>
                        <li class="mb-3">
                            8.3. Once paid, all Fees and taxes are non-refundable, and payment obligations are non-cancelable. Unless stated otherwise in the applicable Order Form(s) and subject to Section 8.9 (payment disputes), you must pay the Fees according to the following applicable payment method: (a) If you decide to use a credit card or PayPal for payment, you confirm that you have the authorization to use these payment methods, and all Fees can be charged to the respective account without any issues. (b) If you prefer invoices and are approved by TestTalents, you will receive invoices at the frequency stated in the Order Form, and you must settle the Fees within twenty (20) days of the invoice date.
                        </li>
                        <li class="mb-3">
                            8.4. For seamless billing, you must provide accurate and complete billing information, including full name, address, state, zip code, country, telephone number, and a valid VAT or applicable tax registration number. By providing payment information, you authorize TestTalents to charge all incurred Fees to the selected payment instrument.
                        </li>
                        <li class="mb-3">
                            8.5. The usage of our Services may have specific limitations, as outlined in the Order Form or TestTalents Documentation ("Usage Limitations"). If your usage surpasses these limits, you will be charged additional fees known as "Overages," as listed in the pricing section of the order form or on the TestTalents website. Overages will be billed in accordance with the specified Billing Cycles defined in this Section 8 (Fees and Payment Terms).
                        </li>
                        <li class="mb-3">
                            8.6. All Fees, Overages, and other amounts payable by you under the Agreement exclude taxes, duties, levies, and similar assessments, as well as any transaction costs or bank transfer fees. You are responsible for paying all applicable sales, use, excise taxes, and any other similar taxes, duties, and charges imposed by any governmental or regulatory authority on amounts payable by you under the Agreement, excluding corporate income taxes on TestTalents' income.
                        </li>
                        <li class="mb-3">
                            8.7. If you are determined to be non-exempt from any taxes by the relevant taxing authorities, and TestTalents is obligated to pay these taxes, we reserve the right to invoice you for such taxes, along with any applicable penalties or interest. The Fees will not be reduced due to any taxes and/or fees you owe related to your purchase of the Services.
                        </li>
                        <li class="mb-3">
                            8.8. Failure to make timely payments may result in additional consequences, including the assessment of interest at a rate of 1.5% per month on the past due amount or the maximum rate allowed under applicable law. You will also be responsible for reimbursing TestTalents for all costs incurred in collecting late payments, including attorneys' fees, court costs, and collection agency fees. If payment issues persist for more than thirty (30) days after written notice, we may suspend the Services without incurring any liability to you or any other party.
                        </li>
                        <li class="mb-3">
                            8.9. Should you dispute any invoice for Fees, you must notify TestTalents in writing within ten (10) days from the date of the respective invoice. Failure to do so will be considered as acceptance of the invoice, and your right to dispute it will be forfeited. All undisputed fees remain due according to the agreed payment schedule.
                        </li>
                        <li class="mb-3">
                            8.10. All amounts payable to TestTalents under the Agreement must be paid in full without any setoff, recoupment, counterclaim, deduction, debit, or withholding for any reason.
                        </li>
                        <li class="mb-3">
                            8.11. TestTalents reserves the right to increase the Fees annually for any contract year after the first Term, starting from the Renewal Term. If you do not agree to the modified Fees, you have the option to terminate the Agreement before the changes take effect. Otherwise, your continued use of the Services after the Fee modification will be considered as your acceptance and agreement to pay the revised Fees.
                        </li>
                    </ul>


                    <h5 style="margin-top: 35px; margin-bottom: 15px;">9. Intellectual Property and Data</h5>
                    <ul style="list-style: none">
                        <li class="mb-3">
                            9.1. By using the Services provided by TestTalents, you acknowledge and agree that all rights in and to the software, Documentation, related software applications, and any associated materials or intellectual property, including updates and improvements, belong to TestTalents and its licensors. You do not acquire any ownership rights or titles to the Services or their components, including test content, algorithms, and profiling.
                        </li>
                        <li class="mb-3">
                            9.2. Modifying, translating, decompiling, reverse engineering, disassembling, or attempting to access the source code of the Services is strictly prohibited. Additionally, you must not alter or remove any proprietary or copyright notices, trademarks, or logos of TestTalents present in the Services.
                        </li>
                        <li class="mb-3">
                            9.3. Any data originating from a candidate or provided as input via the Services belongs exclusively to the candidate (referred to as "Candidate Data").
                        </li>
                        <li class="mb-3">
                            9.4. Any data or input originating from you, including custom test questions you upload as part of using the Services, and the materials generated using such data, remain the exclusive property of yours, not TestTalents (collectively referred to as "Customer Data"). However, please note that Candidate Data is not included in Customer Data.
                        </li>
                        <li class="mb-3">
                            9.5. Data derived from using the Services, excluding Customer Data, and any de-identified or anonymized aggregated data, are the exclusive property of TestTalents (referred to as "TestTalents Data"). You are granted a limited, personal, non-exclusive, non-sublicensable, non-transferable, and non-assignable license to access and use TestTalents Data and the results derived from Candidate Data solely for your use of the Services, as per the terms of the Agreement.
                        </li>
                        <li class="mb-3">
                            9.6. You grant TestTalents and its authorized Affiliates the right to use and process Customer Data to the extent necessary for providing the Services, in accordance with the terms of the Data Processing Agreement, which is incorporated into these Terms. By agreeing to these Terms, you also agree to the terms of the Data Processing Agreement.
                        </li>
                    </ul>


                    <h5 style="margin-top: 35px; margin-bottom: 15px;">10.	Representations, Warranties, and Disclaimer</h5>
                    <ul style="list-style: none">
                        <li class="mb-3">
                            10.1. Both parties agree to adhere to all relevant laws, rules, and regulations while performing their obligations under the Agreement.
                        </li>
                        <li class="mb-3">
                            10.2. Each party represents and assures that they have the proper authorization to enter into the Agreement and fulfill their responsibilities, including providing the necessary licenses.
                        </li>
                        <li class="mb-3">
                            10.3. Customer guarantees that they have obtained all necessary permissions and consents to share Customer Data with TestTalents, complying with the terms of the Agreement.
                        </li>
                        <li class="mb-3">
                            10.4. Customer warrants that they will use the Services lawfully and in accordance with these Terms. They will not employ the Services to evaluate candidates for illegal, unsafe, offensive, discriminatory, or inappropriate positions, nor will they use the Services to solicit discriminatory information from candidates.
                        </li>
                        <li class="mb-3">
                            10.5. TestTalents assures that the Services will substantially align with the relevant Documentation and will not contain or transmit harmful elements like viruses or malware. TestTalents also commits to holding the necessary licenses and permissions to perform under the Agreement and promises to cooperate with Customer on all matters related to the Services. In case of any non-conformity, Customer shall promptly notify TestTalents, and the sole remedy for any breach of these warranties shall be for TestTalents to either rectify the issue or, if not feasible, refund the Fees for the affected Services during the relevant period.
                        </li>
                        <li class="mb-3">
                            10.6. Beyond the warranties explicitly provided in Sections 10.1 and 10.5, Customer acknowledges and agrees that the Services are provided "as is" with all their faults and without any other warranties, whether express, implied, or statutory. TestTalents disclaims all other warranties, including but not limited to merchantability, satisfactory quality, fitness for a particular purpose, and accuracy, to the maximum extent allowed by applicable law.
                        </li>
                    </ul>

                    <h5 style="margin-top: 35px; margin-bottom: 15px;">11.	Indemnification</h5>
                    <ul style="list-style: none">
                        <li class="mb-3">
                            11.1. TestTalents will protect, indemnify, and hold Customer free from any damages, fines, penalties, pre-approved settlement amounts, costs, expenses, taxes, and other liabilities (including reasonable attorneys' fees) arising from any unaffiliated third-party claims, actions, demands, suits, or proceedings made or brought against Customer, its Affiliates, and their respective officers, directors, and employees. This protection applies when the use of the Services in accordance with the Agreement is alleged to infringe upon the copyright, registered trademark, issued patent, or other intellectual property rights of such third party ("Infringement Claim"). TestTalents will respond to written demands and may either modify the Services to eliminate infringement or terminate the infringing Services and refund any applicable fees in the event of an Infringement Claim.
                        </li>
                        <li class="mb-3">
                            11.2. The indemnity obligation will not apply to Infringement Claims resulting from or connected to: (a) Customer's violation of the Agreement while using the Services; (b) combining the Services with other applications, products, or services where the Services alone would not cause infringement; or (c) the use of Beta Products and Free Plan Products.
                        </li>
                        <li class="mb-3">
                            11.3. Customer will defend, indemnify, and hold TestTalents harmless from all damages, fines, penalties, costs, expenses, taxes, and other liabilities (including reasonable attorneys' fees) incurred or awarded against TestTalents, its Affiliates, officers, directors, and personnel due to claims by unaffiliated third parties. These claims may arise from (a) breaches of Customer's obligations under the Agreement; (b) failure to obtain necessary licenses or permissions, regulatory certifications, or approvals related to technology or data provided by Customer, including Customer Data; (c) non-compliance with obligations, violating applicable laws, including data privacy laws; (d) infringement or misappropriation of third-party intellectual property rights; or (e) breaches of confidentiality.
                        </li>
                        <li class="mb-3">
                            11.4. The obligation to provide indemnification is subject to Customer fulfilling certain conditions, including (i) promptly notifying TestTalents of any claim requiring indemnification; (ii) allowing TestTalents to control the defense and settlement of the claim, with the understanding that TestTalents will not settle in a way that admits fault or imposes restrictions on Customer without prior written consent, which cannot be unreasonably withheld; and (iii) providing full cooperation to TestTalents during the defense and settlement process.
                        </li>
                        <li class="mb-3">
                            11.5. This Section 11 (Indemnification) outlines the sole liability of the indemnifying Party and the exclusive remedy for the indemnified Party in relation to any third-party claims.
                        </li>
                    </ul>


                    <h5 style="margin-top: 35px; margin-bottom: 15px;">12. Limitation of Liability</h5>
                    <ul style="list-style: none">
                        <li class="mb-3">
                            12.1. To the fullest extent allowed by applicable law, the total liability of TestTalents and Customer to each other or any third party for any direct loss, damages, costs, or expenses, whether arising from strict liability, negligence, contract, or any other legal basis related to this Agreement, shall not exceed the total fees paid or payable by Customer to TestTalents during the twelve-month period prior to the initial event giving rise to a claim.
                        </li>
                        <li class="mb-3">
                            12.2. Neither Party shall be held liable to the other for any consequential or indirect damages, including but not limited to loss of sales, profits, or data, incidental, special, punitive, or contingent damages of any kind, regardless of whether such damages arise from contract, tort (including negligence), strict liability, warranty, or any other legal theory, even if the party was aware or should have been aware of the possibility of such damages.
                        </li>
                        <li class="mb-3">
                            12.3. TestTalents shall not be liable for Beta Products and Free Plan Products, nor for any damage, destruction, or loss of data or documents (including Customer Data) resulting from the use of the Services.
                        </li>
                        <li class="mb-3">
                            12.4. The limitations of liability mentioned above do not apply to: (a) Customer's breach of Section 4 (User Rights and Responsibilities); (b) Customer's breach of Section 8 (Fees and Payment Terms); or (c) the obligations under Section 11 (Indemnification).
                        </li>
                    </ul>

                    <h5 style="margin-top: 35px; margin-bottom: 15px;">13. Confidentiality</h5>
                    <ul style="list-style: none">
                        <li class="mb-3">
                            13.1. Under this Agreement, both TestTalents and Customer may gain access to or be exposed to non-public information of the other party, which includes software, product plans, pricing, marketing and sales data, customer lists, proprietary knowledge, or trade secrets. This information, whether explicitly labeled as confidential or reasonably understood to be confidential, including Customer Data, is collectively referred to as "Confidential Information."
                        </li>
                        <li class="mb-3">
                            13.2. Confidential Information may only be shared with the receiving party's personnel, such as employees, agents, and authorized subcontractors, on a "need-to-know" basis for the purpose of fulfilling this Agreement. However, such personnel must have agreed in writing to maintain confidentiality at least to the same extent as stated here. Both parties commit to taking reasonable precautions to protect the confidentiality of each other's Confidential Information, using a level of care no less than what they would apply to safeguard their own similar information.
                        </li>
                        <li class="mb-3">
                            13.3. The obligations of confidentiality do not extend to information that: (a) the receiving party already knew before receiving it from the disclosing party or became publicly known without any fault on the receiving party's part; or (b) the receiving party lawfully received from a third party without any obligation of confidentiality. In the event that a receiving party is legally compelled by a court or government agency to disclose Confidential Information, the receiving party shall give reasonable advance notice to the disclosing party to allow the disclosing party to seek an appropriate protective order or similar remedy.
                        </li>
                    </ul>


                    <h5 style="margin-top: 35px; margin-bottom: 15px;">14. Term and Termination</h5>
                    <ul style="list-style: none">
                        <li class="mb-3">
                            14.1. This Agreement, along with these Terms, takes effect upon acceptance or the date specified in the Order Form and remains valid until the expiration or termination of all Order Forms or Services used by Customer on the Website, as entered into under these Terms.
                        </li>
                        <li class="mb-3">
                            14.2. Your initial subscription duration is indicated when the Services are activated through the Website or in the applicable Order Form ("Initial Term"). Unless stated otherwise on the Website or in the Order Form, your Subscription will automatically renew for additional successive periods of the same duration as the Initial Term (each, a "Renewal Term," together with the Initial Term, the "Term") unless either you or TestTalents cancel it. If you do not wish to renew, you can terminate the renewal of the Agreement through the Website or by contacting the help center before the last day of the Term. Your continued use of the Service constitutes your acceptance and agreement to the Renewal Term.
                        </li>
                        <li class="mb-3">
                            14.3. The fee for any Renewal Term will be based on the then-current list price applicable on the Website for the renewed Services, unless a different renewal pricing is specified in the Order Form.
                        </li>
                        <li class="mb-3">
                            14.4. Either Party may terminate the Agreement or any Order Form (in whole or in part) by providing the other Party with at least ten (10) days' prior written notice if the other Party materially breaches any provision of this Agreement. If the breaching Party fails to remedy the material breach within a ten (10) day period following the notice of default, the non-breaching Party may terminate this Agreement effective at the end of the ten (10) day period, regardless of any other provision in this Agreement. In case of a material breach by Customer, TestTalents may, in addition to termination, suspend certain Services, close Customer's accounts, and/or prevent Customer from creating new accounts.
                        </li>
                        <li class="mb-3">
                            14.5. Termination of the Agreement or Order Form does not release Customer from any payment obligation for the Fees payable before the effective date of termination.
                        </li>
                        <li class="mb-3">
                            14.6. Either Party may immediately terminate this Agreement by written notice in the event the other Party becomes insolvent, generally unable to pay its debts as they become due, makes an assignment for the benefit of its creditors, or seeks relief under any bankruptcy, insolvency, or liquidation proceedings.
                        </li>
                        <li class="mb-3">
                            14.7. Upon expiration or termination of the Agreement: (a) TestTalents will invoice Customer for any accrued but unbilled amounts, and Customer shall promptly pay any outstanding and unpaid amounts, including any accrued but unbilled amounts owed under the Agreement; (b) Customer must immediately cease all use of the Services and return or eliminate any components thereof, including returning or destroying any copies of the Documentation, notes, and other materials related to the Services and any TestTalents Data; (c) TestTalents will suspend access to the Services, and Customer will no longer have access to TestTalents' platform, including its historic assessments; and (d) TestTalents will delete all Customer Data, Customer Confidential Information, and any other material, equipment, or information proprietary to Customer within sixty (60) days after the effective date of expiration or termination unless retention is required by applicable law or necessary to resolve a legal claim.
                        </li>
                        <li class="mb-3">
                            14.8. The following sections and paragraphs will remain in effect after the expiration or termination of this Agreement under Section 14 (Term and Termination): Section 8 (Fees and Payment Terms), Section 9 (Intellectual Property and Data), Section 13 (Confidentiality); Section 10.5 (Disclaimer), Section 11 (Indemnification), Section 12 (Limitation of Liability), Section 16 (General), as well as the Data Processing Agreement.
                        </li>
                    </ul>


                    <h5 style="margin-top: 35px; margin-bottom: 15px;">15. Amendments</h5>
                    <ul style="list-style: none">
                        <li class="mb-3">
                            15.1. TestTalents has the right to modify these Terms periodically. We will make reasonable efforts to inform you of any significant changes by posting an announcement on the Website or sending an email. To the maximum extent permitted by applicable law, the updated Terms will take immediate effect, and your continued use of the Services following the posting or notice of the changes will signify your acceptance of the revised Terms.
                        </li>
                        <li class="mb-3">
                            15.2. If additional notice is required by applicable law, the changes will automatically apply to your use of the relevant Services upon the expiry of such notice period (unless you terminate during that period) or upon your earlier acceptance of the changes. If applicable law grants you the right to terminate this Agreement upon receipt of such notice, you will not be charged a fee for early termination when exercising that right under applicable law. However, any fees you have already paid are non-refundable, and any outstanding fees will remain due and payable.
                        </li>
                    </ul>


                    <h5 style="margin-top: 35px; margin-bottom: 15px;">16. Miscellaneous</h5>
                    <ul style="list-style: none">
                        <li class="mb-3">
                            16.1. Compliance with Law Assurances. Both TestTalents and Customer guarantee their adherence to all applicable anti-corruption, anti-money laundering, sanctions, export controls, and other international trade laws, regulations, and governmental orders of the European Union, the United Kingdom, the United States of America, the United Nations, or any other relevant governmental authority. This includes obtaining all necessary licenses and government approvals. If either Party becomes aware of any actual or potential violation of such laws and regulations in connection with the use of the Services, they will promptly notify the other Party in writing and take appropriate actions to rectify or resolve such violations, as requested by the other Party.
                        </li>
                        <li class="mb-3">
                            16.2. No Class Actions. To the maximum extent allowed by applicable law, neither Customer nor TestTalents will have the right to participate in or consolidate claims by or against other customers or pursue any claim as a representative of a class action or in a private attorney general capacity.
                        </li>
                        <li class="mb-3">
                            16.3. US Government Terms. The Services, including any related software and technology, are provided solely in accordance with these Terms for United States government end use. If you (or any users of your Customer Application) are an agency, department, or other entity of the United States government, the use, duplication, reproduction, release, modification, disclosure, or transfer of the Services, or any related documentation, is restricted by these Terms. All other use is prohibited, and no other rights beyond those provided in these Terms are conferred.
                        </li>
                        <li class="mb-3">
                            16.4. Independent Contractors. The Parties acknowledge that they are independent contractors. This Agreement does not create an association, trust, partnership, joint venture, or any similar legal relationship between TestTalents and Customer, nor does it impose a trust, partnership, or fiduciary duty, obligation, or liability on or with respect to such entities. Neither Party has the authority to act or create obligations on behalf of the other Party, except as specified in the Agreement.
                        </li>
                        <li class="mb-3">
                            16.5. Force Majeure. Neither Party shall be held liable to the other for any failure to perform any of its obligations (except payment obligations) under the Agreement during any period in which such performance is delayed by circumstances beyond its reasonable control, such as fire, flood, war, embargo, strike, riot, terrorism, epidemic, or pandemic, or the intervention of any governmental authority (a "Force Majeure"). In such an event, the delayed Party must promptly provide the other Party with written notice of the Force Majeure. The delayed Party's time for performance will be excused for the duration of the Force Majeure. However, if the Force Majeure event lasts longer than 90 days, then the other Party may immediately terminate the Agreement, without any liability, either in whole or in part, by giving written notice to the delayed Party.
                        </li>
                        <li class="mb-3">
                            16.6. Transferability and Subcontracting. Customer may not assign or transfer any part of their rights or obligations under this Agreement without the prior written consent of TestTalents, except in the case of a merger, acquisition, or sale of a majority of assets. TestTalents has the right to freely assign all or part of its rights and obligations under the Agreement or to utilize the services of third parties by subcontracting. Subject to the above, the Agreement shall be binding upon and inure to the benefit of the parties and their respective successors and permitted assigns.
                        </li>
                        <li class="mb-3">
                            16.7. Entire Agreement. The Agreement constitutes the complete understanding between Customer and TestTalents regarding its subject matter, supersedes all prior oral and written agreements, and overrides any general terms and conditions of Customer.
                        </li>
                        <li class="mb-3">
                            16.8. Severability. If any provision of the Agreement is found to be void or unenforceable, such provision will be stricken or modified only to the extent necessary to comply with the law, and the remaining provisions of the Agreement will remain in full force and effect.
                        </li>
                        <li class="mb-3">
                            16.9. Notices. Any notice, request, demand, or other communication to be provided under this Agreement shall be in writing and sent to the email addresses provided by each Party or at such other address as a Party may designate by written notice to the other Party.
                        </li>
                        <li class="mb-3">
                            16.10. Headings. The section headings in this Agreement are inserted for convenience of reference only and shall not affect the meaning or interpretation of the Agreement.
                        </li>
                        <li class="mb-3">
                            16.11. Publicity. Customer grants TestTalents the right to use their name, logo, and a description of their use case to refer to them on TestTalents' website, customer lists, or marketing or promotional materials, subject to Customer's standard trademark usage guidelines expressly provided to TestTalents.
                        </li>
                        <li class="mb-3">
                            16.12. Execution. This Agreement may be executed in one or more counterparts, each of which shall be deemed an original, but all of which together shall constitute one and the same instrument. Each Party agrees that this Agreement and any other documents to be delivered in connection herewith may be electronically signed, and any electronic signatures appearing on this Agreement or such other documents are the same as handwritten signatures for the purposes of validity, enforceability, and admissibility.
                        </li>
                    </ul>


                    <h5 style="margin-top: 35px; margin-bottom: 15px;">17. Governing law</h5>
                    <ul style="list-style: none">
                        <li class="mb-3">
                            17.1. The Agreement, along with these Terms, will be subject to the laws of Bangladesh. The United Nations Convention on Contracts for the International Sale of Goods is specifically not applicable.
                        </li>
                        <li class="mb-3">
                            17.2. Both Parties mutually agree that any dispute arising from or related to the Agreement will be exclusively addressed in the appropriate courts located in Dhaka, Bangladesh.
                        </li>
                    </ul>

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
