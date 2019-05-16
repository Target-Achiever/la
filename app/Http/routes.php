<?php
use Illuminate\Support\Facades\Input;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/




//---------------------social login - fb
Route::get('fbauth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('fbauth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');
//-------------------------------------end
Route::get('/','HomeController@index')->middleware('user','revalidate');//user role

Route::auth();
Route::post('custom-login', 'Auth\AuthController@custom_login');
//-------------------------------------------------------------------------------providre group
Route::group(['namespace' => 'Prescriber', 'prefix' => 'provider', 'middleware' => ['provider','revalidate']], function(){

    Route::get('/home', 'PrescriberController@index');

    Route::resource('/services', 'ManageServices');
    Route::post('/services/{id}', 'ManageServices@update');

    Route::resource('/gallery', 'ProviderGalleryController');

    Route::resource('/gallery/store', 'ProviderGalleryController@store');

    Route::get('/notification', 'PrescriberController@notification');

    Route::post('/image-crop', 'PrescriberController@image_crop');

    Route::get('/notification_count', 'PrescriberController@notificationCount');

    Route::get('/home_graphs_content', 'PrescriberController@graphsContent');

    Route::get('/notification_ajax/{noti_id}/{noti_type}', 'PrescriberController@notification_ajax');

    // Route::get('/appointment_result/{app_id}/{id}/{notiId}', 'PrescriberController@appointment_result');
    Route::get('/appointment_result/{app_id}/{id}', 'PrescriberController@appointment_result');

    Route::get('/remove_notification/{noty_id}', 'PrescriberController@remove_notification');

    Route::get('/appointments','PrescriberController@appointments');//appointment history

    Route::get('/feedback','PrescriberController@feedback');//feedback history

    Route::post('/load_feedback','PrescriberController@loadFeedback');//load_feedback history

    Route::get('/services-settings', 'PrescriberController@services_settings');//returning to view

    Route::POST('/save_services_settings', 'PrescriberController@save_services_settings');//create/update service settings

    Route::get('prescription-services', 'PrescriptionServicesController@index');

    Route::get('set_service_availability/{set}/{user}', 'PrescriptionServicesController@set_service_availability');//ajax call

    Route::get('prescription-request/{provider}', 'PrescriptionServicesController@prescription_request');

    Route::post('prescription_service/book', 'PrescriptionServicesController@book_prescription_service');

    Route::resource('/policies', 'ProviderPolicyController');

    Route::get('/policies/refund/{refund_id}', 'ProviderPolicyController@refund');

    Route::get('/policies_modal/{type}', 'ProviderPolicyController@ProviderPolicyModal');

    Route::get('/become-a-provider', 'PrescriberController@becomeProvider');

    Route::get('/become_a_provider_backend', 'PrescriberController@becomeProviderBackend');

    Route::POST('/become_a_provider_backend_save', 'PrescriberController@saveProviderBackend');

    Route::post('/save_become_a_provider', 'PrescriberController@saveProvider');

    Route::resource('/advertisement', 'AdvertisementController@index');

    Route::resource('/advertisement/create', 'AdvertisementController@create');

    Route::post('advertisement/store', 'AdvertisementController@store');

    Route::delete('advertisement/destroy/{id}', 'AdvertisementController@destroy');

    Route::get('advertisement/edit/{id}','AdvertisementController@edit');

    Route::patch('advertisement/update/{id}','AdvertisementController@update');

    Route::post('advertisement/get_available_time_slot','AdvertisementController@search');

    Route::post('advertisement-payment/{advertisementid}','AdPaymentController@advertisement_payment')->middleware('adpayment');

    Route::resource('bank-account','BankAccountController');

    Route::get('remove-stripe-bank-account/{userid}','BankAccountController@remove_stripe_bank_account');

    Route::post("instant-appointment","PrescriberController@instant_appointment");

    Route::get("payment-history","PrescriberController@payment_history");

    Route::get("appointment_view/{appid}","PrescriberController@appointment_view");

    Route::post("check_service_offer","PrescriberController@check_service_offer");

    Route::post("advertisement_amount","AdvertisementController@advertisement_amount");

    Route::post("prescription_service","ManageServices@prescription_service");


});
//------------------

//-------------------------------------------------------------------------------------admin/provder group
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['admin','revalidate']], function(){

    Route::get('/profile', 'SuperAdminController@profile');
    Route::post('save_profile', 'SuperAdminController@save_profile');

    Route::get('/home', 'SuperAdminController@index');
    Route::get('/search_by_provider', 'SuperAdminController@search');
    Route::resource('/services', 'ManageServices');
    Route::get('/admin_setting', 'SuperAdminController@adminSetting');
    Route::get('/save_setting/{type}', 'SuperAdminController@saveSetting');
    /* About */
    Route::resource('/about', 'AboutController@index');
    Route::resource('/about/create', 'AboutController@create');
    Route::post('/about/store', 'AboutController@store');
    Route::get('/about/edit/{id}', 'AboutController@edit');
    Route::patch('/about/update/{id}', 'AboutController@update');
    /* Blog */
    Route::resource('/blog', 'BlogController@index');
    Route::resource('/blog/create', 'BlogController@create');
    Route::post('/blog/store', 'BlogController@store');
    Route::get('/blog/edit/{id}', 'BlogController@edit');
    Route::get('/blog/destroy/{id}', 'BlogController@destroy');
    Route::patch('/blog/update/{id}', 'BlogController@update');
    /* Home Screen */
    Route::resource('/manage_home', 'ManageHomeController');
    Route::post('/manage_home/store', 'ManageHomeController@store');
    Route::post('/manage_home/update/{id}', 'ManageHomeController@update');
    Route::delete('/manage_home/destroy/{des_id}', 'ManageHomeController@destroy');
    Route::post('/image-crop', 'ManageHomeController@image_crop');

    /* Professional */
    Route::resource('/professional', 'ProfessionalController@index');
    Route::resource('/professional/create', 'ProfessionalController@create');
    Route::post('/professional/store', 'ProfessionalController@store');
    Route::get('/professional/edit/{id}', 'ProfessionalController@edit');
    Route::patch('/professional/update/{id}', 'ProfessionalController@update');


    /* provider */
    Route::resource('/providers', 'ManageProviders');
    Route::resource('/pending_providers', 'ManageProviders@pendingProviders');
    Route::resource('/provider_search', 'ManageProviders@search');
    Route::resource('/pending_provider_search', 'ManageProviders@pendingSearch');

    Route::get('/pending_profile/{pending}', 'ManageProviders@pending');
    Route::get('/approve', 'ManageProviders@approve');
    Route::get('/provider_profile/{userid}', 'ManageProviders@profile');

    Route::get('/deactivate', 'ManageProviders@deactivate');
    Route::delete('/delete', 'ManageProviders@delete');
    Route::get('/active', 'ManageProviders@active');
    Route::get('/reject', 'ManageProviders@reject');

    /* policies */
    Route::resource('/policies', 'ProviderPoliciesController');

    /* notification */
    Route::resource('/notification', 'SuperAdminController@notification');
    Route::get('/notification_count', 'SuperAdminController@notificationCount');
    // Route::resource('/users_appointment', 'SuperAdminController@userAppointment');
    // Route::resource('/provider_appointment', 'SuperAdminController@providerAppointment');
    Route::get('/appointment_history', 'SuperAdminController@appointment_history');
    Route::resource('/payment_history', 'SuperAdminController@paymentHistory');
    Route::get('/notification_ajax/{noti_id}/{noti_type}', 'SuperAdminController@notificationAjax');

    /* users */
    Route::resource('/users', 'ManageUsers');
    Route::get('/view/{id}', 'ManageUsers@view');
    Route::get('/destroy', 'ManageUsers@destroy');
    Route::post('/search','ManageUsers@search');

    /* Gain */
    Route::resource('gain','GainController');
    Route::post('gain/store','GainController@store');
    Route::post('gain/{id}/update','GainController@update');

    /* disclaimer */
    Route::get('/disclaimer','DisclaimerController@index');
    Route::get('/edit/{id}','DisclaimerController@index');
    Route::post('/save','DisclaimerController@disclaimer_save');
    Route::patch('/update/{id}','DisclaimerController@update');

    Route::get('/feedbacks','ManageFeedbacksController@feedbacks');
    Route::get('/view_user_feedback/{id}','ManageFeedbacksController@view_user_feedback');
    Route::get('/change_feedback_status/{feedbackid}/{status}','ManageFeedbacksController@change_feedback_status');
    Route::get('/remove_feedback/{feedbackid}','ManageFeedbacksController@remove_feedback');

    Route::get('/advertisements','ManageAdvertisementsController@advertisements');
    Route::get('/advertisements/setting','ManageAdvertisementsController@setting');
    Route::get('/advertisements/{ad}','ManageAdvertisementsController@advertisement_view');
    Route::get('/advertisements_amount','ManageAdvertisementsController@advertisementsAmount');
    Route::get('/advertisements_amount/destroy/{id}','ManageAdvertisementsController@destroy');
    Route::get('/advertisements_days','ManageAdvertisementsController@advertisementsDays');
    Route::get('/advertisements_weeks','ManageAdvertisementsController@advertisementsWeeks');
    Route::get('/advertisements_update/{id}','ManageAdvertisementsController@advertisementsUpdate');
    Route::post('/advertisements/store','ManageAdvertisementsController@store');
    Route::get('/advertisements/change_ad_status/{ad}/{status}','ManageAdvertisementsController@change_ad_status');

    Route::post('get_home_header_text','SuperAdminController@get_home_header_text');
    Route::post('home_header_text','SuperAdminController@home_header_text');

    Route::get("business-data","SuperAdminController@business_data");

    Route::get('appointment_payment','SuperAdminController@appointment_payment');

    Route::get('advertisement_payment','SuperAdminController@advertisement_payment');

    Route::get('/chart_users_flow','SuperAdminController@chart_users_flow');
    //---seo
        Route::get('/seo','SuperAdminController@seo_index');

       Route::post('/seo','SuperAdminController@seo_settings');

       Route::get('/seo/{id}','SuperAdminController@seo_settings_update');

        Route::patch('/seo/{id}','SuperAdminController@seo_settings_update');

        Route::post('/seo_page','SuperAdminController@seo_page');

        Route::post('/seo_page_delete','SuperAdminController@seo_page_delete');

        Route::post('/seo_web_view','SuperAdminController@seo_web_view');

        Route::post('/seo_topic','SuperAdminController@seo_topic');


});
//-------------------------------------------------------------------------------------get methods

Route::group(['middleware' => ['user','revalidate']], function(){

    Route::get('/my-account', 'HomeController@user_account');//user role

    Route::get('/book-an-appointment/{id}', 'AppointmentController@book_an_appointment');//user role
    
});    

Route::get('/home', 'HomeController@index')->middleware('user');//user role

Route::get('/about-us', 'HomeController@aboutUs')->middleware('user');//user role

Route::get('/blog', 'HomeController@blog')->middleware('user');//user role

Route::get('/services', 'HomeController@services')->middleware('user');//user role

Route::get('/search', 'HomeController@search')->middleware('user');

// Route::get('/my-account', 'HomeController@user_account')->middleware('user');//user role

// Route::get('/book-an-appointment/{id}', 'AppointmentController@book_an_appointment')->middleware('user');//user role

Route::post('/subscribe', 'HomeController@SubScribe');

Route::post('ajax_search', 'HomeController@ajax_search');

Route::post('/get-search-result', 'HomeController@get_search_result');

Route::get('/services_list', 'HomeController@ServicesList');

Route::get('/{services_id}/services_read_content', 'HomeController@ServicesReadContent');

Route::post('/list-providers-services', 'HomeController@list_providers_services');//search fn home page


Route::get('/provider-overview/{provider}', 'HomeController@provider_overview');//user role


Route::get('get_available_time_slots/{date}/{service}/{provider}', 'AppointmentController@get_available_time_slots');

Route::get('get-appointment-list/{user}', 'HomeController@get_appointment_list');

Route::get('load_modal/{type}', 'HomeController@load_modal');

Route::get('appointment-details/{appid}/{userid}', 'HomeController@get_appointment_details');

Route::get('cancel_appointment/{appid}', 'HomeController@cancelAppointment');

Route::POST('user_account_profile/save', 'HomeController@user_account_profile_save');

Route::get('/notification_ajax/{noti_id}/{noti_type}', 'HomeController@notification_ajax');

Route::get('/remove_notification/{noty_id}', 'HomeController@remove_notification');//user notification

Route::get('/user-activation/{token}','CommonController@activateUser');

Route::get('/user_buss_status/{id}','CommonController@activateUserStatus');


Route::post('/feedback', 'HomeController@user_feedback');

Route::get('/terms', 'HomeController@terms');

Route::get('/privacy-policy', 'HomeController@privacy_policy');

Route::post('/load_more_feedback', 'HomeController@loadFeedback')->middleware('user');//user role

Route::post('/user_feedback_save', 'HomeController@user_feedback_save');

Route::post('appointment-payment/{appointmentid}','PaymentCheckoutController@appointment_payment')->middleware('payment');

Route::get('cancel-appointment/{appointmentid}','PaymentCheckoutController@cancel_appointment')->middleware('payment');

Route::get('book-service/{serviceid}', "HomeController@list_service_providers");

Route::post('predefined_services_list', "HomeController@predefined_services_list");

Route::post('service_multiselect_ajax', "HomeController@service_multiselect_ajax");

Route::post('remove_combo/{comboid}', 'HomeController@remove_combo');
//------------------------------------------------------------------------------------post methods

Route::post('/set-appointment-id', 'HomeController@set_appointment_id');

Route::POST('/appointment/book','AppointmentController@book_service');

Route::get('password-reset',function(){

    return view('auth.passwords.email');
});

Route::POST('password/email','Auth\PasswordController@password_email');

Route::get('blog-single/{blog}', "HomeController@blog_single_page")->middleware('user');

Route::get('/downloadF/{file_path}/{ext}', 'CommonController@getDownload');

Route::get('sitemap/','SitemapController@index');

//------------------------------------------------------------------------------------ajax call
Route::post('/get-provider-services', 'HomeController@get_provider_services');
//-----------------------------------------------

//------------------------------------------test routes

Route::get('/query', 'CommonController@update_table');