<?php

use Illuminate\Support\Facades\Route;

Route::get('/','FrontendController@index');

// Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:cache');
    // Artisan::call('key:generate');
    return "Cleared!";
});

Route::get('/get/started', function () {
    return redirect()->back();
});

Route::get('/home', 'HomeController@index')->name('home');
Route::post('ckeditor/upload', 'CkeditorController@upload')->name('ckeditor.upload');
Route::post('filemanager/upload', 'CkeditorController@upload')->name('ckeditor.upload');

Route::group(['middleware' => ['auth', 'verified']], function () {
    //have to login and email verified

    Route::get('/add/question/page','QuestionBankController@addQuestionPage');
    Route::post('/create/new/question','QuestionBankController@createNewQuestion');
    Route::get('/view/all/questions','QuestionBankController@viewAllQuestion');
    Route::get('/get/data/of/question/{slug}','QuestionBankController@getQuestionData');
    Route::get('/delete/question/{slug}','QuestionBankController@deleteQuestion');
    Route::post('/update/question','QuestionBankController@updateQuestion');
    Route::get('/search/question','QuestionBankController@searchQuestion');
    Route::get('/search/question/for/add/to/test','QuestionBankController@searchQuestionForAddToTest');
    Route::get('autocompleteSearchProgrammingLanguage','QuestionBankController@searchProgrammingLanguage');

    Route::get('/add/test/page','TestController@addTestFirstPage');
    Route::post('/create/new/test/first','TestController@createNewTestFirst');
    Route::get('/add/question/to/test','TestController@addQuestionToTest');
    Route::post('/create/test/second','TestController@createTestSecond');
    Route::get('/get/all/pl','TestController@getAllPl');
    Route::post('/create/story/based/test','TestController@createStoryBasedTest');
    Route::get('/view/all/tests','TestController@viewAllTests');
    Route::get('/get/data/of/test/{slug}','TestController@getDataOfTest');

    Route::get('/search/test','TestController@searchTest');
    Route::get('/search/test/to/add/with/assesment','TestController@searchTestForAssesment');
    Route::post('/update/test','TestController@updateTest');
    Route::get('/delete/test/{slug}','TestController@deleteTest');

    Route::get('create/assesment/firststep','AssesmentController@createAssesmentFirstStep');
    Route::get('/autocompleteSearchJobRole','AssesmentController@searchJobRole');
    Route::post('save/assesment/firststep','AssesmentController@saveAssesmentFirstStep');
    Route::get('create/assesment/secondstep','AssesmentController@createAssesmentSecondStep');
    Route::post('save/assesment/secondstep','AssesmentController@saveAssesmentSecondStep');
    Route::get('/create/assesment/thirdstep','AssesmentController@createAssesmentThirdStep');
    Route::get('/add/custom/question/to/assesment','AssesmentController@addCustomQuestionToAssesment');
    Route::post('save/custom/question/to/assesment','AssesmentController@saveCustomQuestionToAssesment');
    Route::post('save/assesment/thirdstep','AssesmentController@saveAssesmentThirdStep');
    Route::get('/create/assesment/laststep','AssesmentController@createAssesmentLastStep');
    Route::post('/save/assesment/laststep','AssesmentController@saveAssesmentLastStep');
    Route::post('/send/link/via/email','AssesmentController@sendLinkInEmail');
    Route::post('/create/assesment/link','AssesmentController@createAssesmentLink');
    Route::get('/softDelete/assessment/{slug}','AssesmentController@softDeleteAssesment');

    Route::get('see/candidates/{slug}','CandidateController@seeAllCandidates');
    Route::get('see/candidates/{slug}/{webcam_filter}/{mic_filter}/{screen_filter}','CandidateController@seeAllCandidatesFiltered');

    Route::get('/candidate/marks/{slug}','CandidateController@giveMarks');
    Route::get('/candidate/result/{slug}','CandidateController@viewResult');
    Route::post('/save/marks','CandidateController@saveMarks');
    Route::get('/print/result/{slug}','CandidateController@printResult');
    Route::get('get/candidate/data/{slug}','CandidateController@getCandidateInfo');
    Route::post('/create/meeting/send/email','CandidateController@createMeetingLink');
    Route::get('/get/zoom/meeting/data/{slug}','CandidateController@getMeetingInfo');
    Route::post('/evaluator/invitation/send','CandidateController@sendInvitationForEvaluation');
    Route::get('/remove/evaluator/{slug}','CandidateController@removeEvaluator');

    Route::get('/my/profile','ProfileController@showMyProfile');
    Route::post('/save/profile','ProfileController@saveProfile');

    Route::get('/plan/billing','RechargeController@billingPage');
    // Route::post('/save/recharge/info','RechargeController@saveRechargeInfo');
    // Route::get('/denied/recharge/request/{id}','RechargeController@deniedRechargeReq');
    // Route::get('/get/data/of/recharge/{id}','RechargeController@getRechargeInfo');
    // Route::post('/approve/recharge/request','RechargeController@approveRechargeRequest');

    Route::post('/send/email/requesting/testimonial','CandidateTestimonialController@sendEmailRequestingTestimonial');


    // payment routes //You need declear your success & fail route in "app\Middleware\VerifyCsrfToken.php"
    Route::get('checkout/pricing/pakckage/{package}','PaymentController@checkoutPackage')->name('CheckoutPackage');
    Route::get('seach/countries','PaymentController@seachCountries')->name('SeachCountries');
    Route::post('payment','PaymentController@payment')->name('payment');
    Route::post('success', 'PaymentController@success')->name('success');
    Route::post('fail', 'PaymentController@fail')->name('fail');
    Route::get('cancel', 'PaymentControllerfail@cancel')->name('cancel');

    Route::post('submit/quotation','PaymentController@submitQuotation')->name('SubmitQuotation');
    Route::get('view/custom/quotations', 'HomeController@viewAllQuotation')->name('ViewAllQuotation');
    Route::get('cancel/quotation/{slug}', 'HomeController@cancelQuotation')->name('CancelQuotation');
    Route::get('get/quotation/info/{slug}', 'HomeController@getQuotationInfo')->name('GetQuotationInfo');
    Route::post('update/quotation', 'HomeController@updateQuotation')->name('UpdateQuotation');

});

Route::get('/take/assesment/{slug}/{email}/{candidateSlug}','ClientController@takeAssesment');
Route::post('get/started','ClientController@startAssesment');
Route::get('/next/test/{assesment_slug}/{candidate_slug}/{test_running_now}','ClientController@nextTest');
Route::get('/finish/test/{assesment_slug}/{candidate_slug}','ClientController@finishTest');

Route::post('/test/answer/submit/{start}','CandidateController@testAnswerSubmit');
Route::post('/upload/audio','CandidateController@uploadAudio');
Route::post('/update/used/time','CandidateController@updateUsedTimeOfLastQuetion');

// forntend routes
Route::get('/product/tour','FrontendController@productTour');
Route::get('/pricing','FrontendController@pricing');
Route::get('/test/bank','FrontendController@testBank');
Route::get('/get/test/info/{slug}','FrontendController@getDataOfTest');
Route::post('/send/email/for/support','FrontendController@requestForSupport');
Route::post('/send/email/for/contact','FrontendController@requestForContact');
Route::get('/about/us','FrontendController@aboutUs');
Route::get('/contact/us','FrontendController@contactUs');
Route::get('/career','FrontendController@careerPage');
Route::get('/policy','FrontendController@privacyPolicy');
Route::get('/terms','FrontendController@termsOfUse');
Route::post('/compile/code','FrontendController@compilerCode');
Route::post('/fullscreen/status/change','FrontendController@fullScreenStatusChange');
Route::post('/mouse/status/change','FrontendController@mouseStatusChange');
Route::get('/search/test/public','FrontendController@searchTest');

Route::get('/submit/testimonial/{slug}/{candidate_slug}','CandidateTestimonialController@submitTestimonialPage');
Route::post('submit/testimonial','CandidateTestimonialController@submitTestimonial');

// Route::get('zoom/meeting/test','AssesmentController@zoomMeeting');
Route::get('zoom/meeting/info/{id}','CandidateController@getZoomMeetingDetails');
Route::get('delete/zoom/meeting/{id}','CandidateController@deleteZoomMeeting');




