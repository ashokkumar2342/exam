<?php

use App\Http\Controllers\Admin\reportGenerateBarcode;
//registration start
Route::prefix('resitration')->group(function () {
    Route::get('form', 'AccountController@firststep')->name('student.resitration.firststep');
     Route::post('form', 'AccountController@studentStore')->name('student.resitration.firststep.store');
     Route::get('verification/{id}', 'AccountController@verification')->name('student.resitration.verification');
     Route::post('mobile-verify', 'AccountController@verifyMobile')->name('student.resitration.verifyMobile');
     Route::post('email-verify', 'AccountController@verifyEmail')->name('student.resitration.verifyEmail');
     Route::get('resend-otp/{id?}/{otp_type}', 'AccountController@resendOTP')->name('student.resitration.resend.otp');
     Route::get('resitration-form', 'AccountController@resitrationForm')->name('student.resitration.resitrationForm'); 
 Route::get('resitration-form1', 'AccountController@resitrationForm')->name('student.resitration.resitrationForm'); 
});
//registration end 
Route::get('/', 'Auth\LoginController@index')->name('admin.home');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('admin.login'); 
Route::get('admin-password/reset', 'Auth\ForgetPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('passwordreset/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::get('logout', 'Auth\LoginController@logout')->name('admin.logout.get');
Route::post('login', 'Auth\LoginController@login');
Route::get('forget-password', 'Auth\LoginController@forgetPassword')->name('admin.forget.password');
Route::post('forget-password-send-link', 'Auth\LoginController@forgetPasswordSendLink')->name('admin.forget.password.send.link');
Route::post('reset-password', 'Auth\LoginController@resetPassword')->name('admin.reset.password');
Route::get('refreshcaptcha', 'Auth\LoginController@refreshCaptcha')->name('admin.refresh.captcha');
Route::group(['middleware' => 'admin'], function() {
	Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard'); 
	Route::get('show-details', 'DashboardController@showStudentDetails')->name('admin.student.show.details');
	Route::get('registration-show-details', 'DashboardController@showStudentRegistrationDetails')->name('admin.student.Registration.details');
	Route::get('token', 'DashboardController@passportTokenCreate')->name('admin.token');
	Route::get('profile', 'DashboardController@proFile')->name('admin.profile');
	Route::get('profile-show', 'DashboardController@proFileShow')->name('admin.profile.show');
	Route::get('profile-show/{profile_pic}', 'DashboardController@proFilePhotoShow')->name('admin.profile.photo.show'); 
	Route::post('profile-update', 'DashboardController@profileUpdate')->name('admin.profile.update');
	Route::post('password-change', 'DashboardController@passwordChange')->name('admin.password.change');
	Route::get('profile-photo', 'DashboardController@profilePhoto')->name('admin.profile.photo');
	Route::post('upload-photo', 'DashboardController@profilePhotoUpload')->name('admin.profile.photo.upload');
	Route::get('photo-refrash', 'DashboardController@profilePhotoRefrash')->name('admin.profile.photo.refrash');
	//---------------account-----------------------------------------	
	Route::prefix('account')->group(function () {
	    Route::get('form', 'AccountController@form')->name('admin.account.form');
	    Route::post('store', 'AccountController@store')->name('admin.account.post');
		Route::get('list', 'AccountController@index')->name('admin.account.list');
		Route::post('list-user-generate', 'AccountController@listUserGenerate')->name('admin.account.list.user.generate');
		Route::get('access', 'AccountController@access')->name('admin.account.access');
		Route::get('hot-menu', 'AccountController@accessHotMenu')->name('admin.account.access.hotmenu');
		Route::get('menuTable', 'AccountController@menuTable')->name('admin.account.menuTable');
		Route::get('access/hotmenu', 'AccountController@accessHotMenuShow')->name('admin.account.access.hotmenuTable');
		Route::post('access-store', 'AccountController@accessStore')->name('admin.userAccess.add');
		Route::post('access-hot-menu-store', 'AccountController@accessHotMenuStore')->name('admin.userAccess.hotMenuAdd');
		Route::get('edit/{account}', 'AccountController@edit')->name('admin.account.edit');
		Route::post('update/{account}', 'AccountController@update')->name('admin.account.edit.post');
		Route::get('delete/{account}', 'AccountController@destroy')->name('admin.account.delete');
		Route::get('status/{account}', 'AccountController@status')->name('admin.account.status');	 
		Route::get('r--status/{account}', 'AccountController@rstatus')->name('admin.account.r_status');	 
		Route::get('w-status/{account}', 'AccountController@wstatus')->name('admin.account.w_status');	 
		Route::get('d-status/{account}', 'AccountController@dstatus')->name('admin.account.d_status');
		Route::get('minu/{account}', 'AccountController@minu')->name('admin.account.minu');				
		Route::get('role', 'AccountController@role')->name('admin.account.role');				
		Route::get('role-menu', 'AccountController@roleMenuTable')->name('admin.account.roleMenuTable'); 
		Route::post('role-menu-store', 'AccountController@roleMenuStore')->name('admin.roleAccess.subMenu');
		Route::get('role-quick-menu-view', 'AccountController@quickView')->name('admin.roleAccess.quick.view');
		Route::get('defult-role-menu-show', 'AccountController@defultRoleMenuShow')->name('admin.account.role.default.menu');
		Route::post('default-role-quick-menu-store', 'AccountController@defaultRoleQuickStore')->name('admin.roleAccess.quick.role.menu.store');
		Route::get('class-access', 'AccountController@classAccess')->name('admin.account.classAccess'); 
		Route::get('class-all', 'AccountController@classAllSelect')->name('admin.account.classAllSelect'); 
		Route::get('reset-password', 'AccountController@resetPassWord')->name('admin.account.reset.password'); 
		Route::post('reset-password-change', 'AccountController@resetPassWordChange')->name('admin.account.reset.password.change'); 
		Route::get('menu-ordering', 'AccountController@menuOrdering')->name('admin.account.menu.ordering'); 
		Route::get('menu-ordering-store', 'AccountController@menuOrderingStore')->name('admin.account.menu.ordering.store'); 
		Route::get('submenu-ordering-store', 'AccountController@subMenuOrderingStore')->name('admin.account.submenu.ordering.store'); 
		Route::get('menu-filter/{id}', 'AccountController@menuFilter')->name('admin.account.menu.filte'); 
		Route::post('menu-report', 'AccountController@menuReport')->name('admin.account.menu.report'); 
		Route::get('user-menu-assign-report/{id}', 'AccountController@defaultUserMenuAssignReport')->name('admin.account.user.menu.assign.report'); 
		Route::post('default-user-role-report-generate/{id}', 'AccountController@defaultUserRolrReportGenerate')->name('admin.account.default.user.role.report.generate'); 
		Route::get('class-user-assign-report-generate/{user_id}', 'AccountController@ClassUserAssignReportGenerate')->name('admin.account.class.user.assign.report.generate'); 
		
						
		// Route::get('status/{minu}', 'AccountController@minustatus')->name('admin.minu.status'); 
	});
	Route::prefix('user-report')->group(function () {
		    Route::get('/', 'UserReportController@index')->name('admin.user.report');
		    Route::get('report-type-filter', 'UserReportController@reportTypeFilter')->name('admin.user.report.type.filter');
		    Route::post('filter', 'UserReportController@filter')->name('admin.user.report.filter');
		    
		     
		});
	//---------------master-----------------------------------------	
	Route::prefix('master-minu')->group(function () {
		Route::prefix('academic-year')->group(function () {
		    Route::get('list', 'AcademicYearController@index')->name('admin.academicYear.list');
		    Route::post('store', 'AcademicYearController@store')->name('admin.academicYear.store');
		    Route::get('edit/{id?}', 'AcademicYearController@edit')->name('admin.academicYear.edit');
		    Route::get('default-value/{id}', 'AcademicYearController@defaultValue')->name('admin.academicYear.default.value');
		    Route::get('pdf-generate', 'AcademicYearController@pdfGenerate')->name('admin.academicYear.pdf.generate');
		    Route::post('update/{id?}', 'AcademicYearController@update')->name('admin.academicYear.update');
		    Route::get('delete/{id}', 'AcademicYearController@destroy')->name('admin.academicYear.delete');
		    Route::get('document-type', 'DocumentTypeController@index')->name('admin.document.type');
		    Route::post('document-store', 'DocumentTypeController@store')->name('admin.document.store');
		    Route::get('document-edit/{id?}', 'DocumentTypeController@edit')->name('admin.document.type.edit');
		    Route::post('document-update/{id?}', 'DocumentTypeController@update')->name('admin.document.type.update');
		    Route::get('document-delete/{id}', 'DocumentTypeController@destroy')->name('admin.document.type.delete');
		    Route::get('report', 'DocumentTypeController@report')->name('admin.document.type.report');
		     
		});
		Route::prefix('payment-mode')->group(function () {
		    Route::get('list', 'PaymentModeController@index')->name('admin.paymentMode.list');
		    Route::post('store', 'PaymentModeController@store')->name('admin.paymentMode.store');
		    Route::get('edit/{id?}', 'PaymentModeController@edit')->name('admin.paymentMode.edit');
		    Route::post('update/{id?}', 'PaymentModeController@update')->name('admin.paymentMode.update');
		    Route::get('delete/{id}', 'PaymentModeController@destroy')->name('admin.paymentMode.delete');
		    Route::get('pdf-generate', 'PaymentModeController@pdfGenerate')->name('admin.paymentMode.pdf.generate');
		     
		});
	 
	     
	});
		//---------------minu-----------------------------------------	
	Route::prefix('minu')->group(function () {
	    
		Route::get('status/{minu}', 'MinuController@status')->name('admin.minu.status');	 
		Route::get('r--status/{minu}', 'MinuController@rstatus')->name('admin.minu.r_status');	 
		Route::get('w-status/{minu}', 'MinuController@wstatus')->name('admin.minu.w_status');	 
		Route::get('d-status/{minu}', 'MinuController@dstatus')->name('admin.minu.d_status');
		Route::get('minu/{minu}', 'MinuController@minu')->name('admin.minu.minu');
		Route::post('menu-permission-check', 'MinuController@menuPermissionCheck')->name('admin.account.menu.permission.check'); 	 
	});
	//---------------Class create----------------------------------------
	Route::group(['prefix' => 'class'], function() {
	    Route::get('/', 'ClassTypeController@index')->name('admin.class.list');
	    Route::get('search', 'ClassTypeController@search')->name('admin.class.search');
	    Route::post('add', 'ClassTypeController@store')->name('admin.class.add');
	    Route::get('edit/{id?}', 'ClassTypeController@edit')->name('admin.class.edit');
	    Route::post('update/{id?}', 'ClassTypeController@update')->name('admin.class.update');
	    Route::get('{classType}/delete', 'ClassTypeController@destroy')->name('admin.class.delete');
	    Route::get('pdf-generate', 'ClassTypeController@pdfGenerate')->name('admin.class.pdf.generate');
	});
		//---------------Section Type create----------------------------------------
	Route::group(['prefix' => 'section'], function() {
	    Route::get('/', 'SectionTypeController@index')->name('admin.section.list');
	    Route::get('select', 'SectionTypeController@selectList')->name('admin.section.selectList');
	    Route::get('search', 'SectionTypeController@search')->name('admin.section.search');
	    Route::post('add', 'SectionTypeController@store')->name('admin.sectionType.add');
	    Route::get('edit/{id?}', 'SectionTypeController@edit')->name('admin.section.edit');
	    Route::post('update/{id?}', 'SectionTypeController@update')->name('admin.section.update');
	    Route::get('{sectionType}/delete', 'SectionTypeController@destroy')->name('admin.section.delete');
	    Route::get('pdf-generate', 'SectionTypeController@pdfGenerate')->name('admin.section.pdf.generate');

	});
	// ---------------Section with class----------------------------------------
	Route::group(['prefix' => 'manage-section'], function() {
	    Route::get('/', 'SectionController@index')->name('admin.manageSection.list');
	    Route::get('search', 'SectionController@search')->name('admin.manageSection.search');
	    Route::get('search2', 'SectionController@search2')->name('admin.manageSection.search2');
	    Route::post('add', 'SectionController@store')->name('admin.section.add');
	    Route::get('{manageSectionEdit}/edit', 'SectionController@edit')->name('admin.manageSection.edit');
	    Route::post('{manageSection}/update', 'SectionController@update')->name('admin.manageSection.update');
	    Route::get('{manageSection}/delete', 'SectionController@destroy')->name('admin.manageSection.delete');
	    Route::get('selectBoxSection', 'SectionController@sectionSelectBox')->name('admin.section.selectBox');        
	    Route::get('class-section-pdf', 'SectionController@classSectionPDF')->name('admin.section.class.section.pdf');        
	});
		// ---------------User with class----------------------------------------
	Route::group(['prefix' => 'user-class'], function() {
	    Route::get('/', 'AccountController@userClass')->name('admin.userClass.list');	   
	    Route::post('add', 'AccountController@userClassStore')->name('admin.userClass.add');	        
	});
	 
	//---------------Student--------------------------------------------------------------------
	
	 

	 		// ---------------Suject Type----------------------------------------
	 	Route::group(['prefix' => 'subject-type'], function() {
	 	    Route::get('/', 'SubjectTypeController@index')->name('admin.subjectType.list');	
	 	   // Route::get('search', 'SubjectTypeController@search')->name('admin.subject.search');
	 	   Route::post('SubjectType-add', 'SubjectTypeController@store')->name('admin.subjectType.add');
	 	   Route::get('{subjectType}/edit', 'SubjectTypeController@edit')->name('admin.subjectType.edit');
	 	   Route::post('{subjectType}/update', 'SubjectTypeController@update')->name('admin.subjectType.update');
	 	   Route::delete('{subjectType}/delete', 'SubjectTypeController@destroy')->name('admin.subjectType.delete');
	 	   Route::get('pdf-generate', 'SubjectTypeController@pdfGenerate')->name('admin.subjectType.pdf.generate');
	         
	 	}); 
  
	 	// ---------------Subject----------------------------------------
	 	Route::group(['prefix' => 'subject'], function() {
	 	    Route::get('/', 'SubjectController@index')->name('admin.subject.manageSubject');
	 	    Route::get('search', 'SubjectController@search')->name('admin.subject.search');
	 	    Route::post('add', 'SubjectController@store')->name('admin.subject.add');
	 	    Route::get('{manageSubjectEdit}/edit', 'SubjectController@edit')->name('admin.manageSubject.edit');
	 	    Route::post('{manageSubject}/update', 'SubjectController@update')->name('admin.manageSubject.update');
	 	    Route::get('{manageSubject}/delete', 'SubjectController@destroy')->name('admin.manageSubject.delete');        
	 	    Route::post('class-subject-pdf', 'SubjectController@classSubjectPDF')->name('admin.manageSubject.pdf.generate');        
	 	});
	 
	 Route::group(['prefix' => 'activity'], function() {
	     Route::get('/', 'ActivityController@index')->name('admin.activity.list');
	     Route::get('delete/{activity}', 'ActivityController@destroy')->name('admin.activity.delete');
         
	 }); 
		Route::group(['prefix' => 'exam'], function() {	
			  //------------------------- Exam Test ---------------------------------
			Route::group(['prefix' => 'class-test'], function() {
			    Route::get('/', 'Exam\ClassTestController@index')->name('admin.exam.test');	 	
			    Route::get('add-form', 'Exam\ClassTestController@addForm')->name('admin.exam.test.add.form');	 	
			    Route::get('edit-form/{id?}', 'Exam\ClassTestController@editForm')->name('admin.exam.test.edit.form');	 	
			    Route::post('store/{id?}', 'Exam\ClassTestController@store')->name('admin.exam.classtest.store');	 	
			    Route::get('class-section-subject', 'Exam\ClassTestController@classSectionSubject')->name('admin.exam.classtest.class.section.subject'); 
			    Route::post('table-show', 'Exam\ClassTestController@tableShow')->name('admin.exam.classtest.table.show'); 
			    Route::get('delete/{id}', 'Exam\ClassTestController@destroy')->name('admin.exam.classtest.delete'); 
			    Route::get('download-syllabus/{path}', 'Exam\ClassTestController@downloadSyllabus')->name('admin.exam.classtest.download.syllabus');	 	
			    Route::get('add-marks/{id}', 'Exam\ClassTestController@addMarks')->name('admin.exam.classtest.add.marks'); 
			    Route::get('attendance-import/{classtest_id}', 'Exam\ClassTestController@attendenceImport')->name('admin.exam.classtest.attendance.import'); 
			    Route::get('marks-verify/{classtest_id}', 'Exam\ClassTestController@marksVerify')->name('admin.exam.classtest.marks.verify'); 
			    Route::get('send-sms-test/{classtest_id}', 'Exam\ClassTestController@sendSmsTest')->name('admin.exam.classtest.sens.sms.test'); 
			    Route::get('test-date-wise-send-sms', 'Exam\ClassTestController@testDateWiseSendSMS')->name('admin.exam.classtest.test.date.wise.send.sms'); 
			    Route::post('test-date-wise-send-sms-show', 'Exam\ClassTestController@testDateWiseSendSMSShow')->name('admin.exam.classtest.test.date.wise.send.sms.show'); 
			 });
		});
			
 		 Route::group(['prefix' => 'notification'], function() {       
         	Route::get('next-page','Notification\NotificationController@nextPage')->name('notification.next.page'); 
         	Route::get('show-notification','Notification\NotificationController@showNotification')->name('notification.show.notification'); 
         	Route::get('mark-all','Notification\NotificationController@markAll')->name('notification.mark.all'); 
         	Route::get('clear-all','Notification\NotificationController@clearAll')->name('notification.clear.all'); 
         	Route::get('clear/{id}','Notification\NotificationController@noficationClear')->name('notification.clear'); 
         	Route::get('read/{id}','Notification\NotificationController@readStatus')->name('notification.read.status'); 	 
 		});  		
 		 Route::group(['prefix' => 'DifficultyLevel'], function() {       
         	Route::get('/','Exam\DifficultyLevelController@index')->name('admin.exam.DifficultyLevel');
         	Route::post('store/{id?}','Exam\DifficultyLevelController@store')->name('admin.exam.DifficultyLevel.store');
         	Route::get('edit/{id?}','Exam\DifficultyLevelController@edit')->name('admin.exam.DifficultyLevel.edit');
         	 
         	     
 		});
 		 Route::group(['prefix' => 'QuestionType'], function() {       
         	Route::get('/','Exam\QuestionTypeController@index')->name('admin.exam.QuestionType');
         	Route::post('store/{id?}','Exam\QuestionTypeController@store')->name('admin.exam.QuestionType.store');
         	Route::get('edit/{id}','Exam\QuestionTypeController@edit')->name('admin.exam.QuestionType.edit');
         	     
 		});
 		Route::group(['prefix' => 'question'], function() {       
         	Route::get('add','Exam\QuestionController@questionForm')->name('admin.question.add');
         	Route::post('store','Exam\QuestionController@questionStore')->name('admin.question.store');
         	Route::get('topic-add-form','Exam\QuestionController@topicForm')->name('admin.topic.list');    
         	Route::get('topic-select-box','Exam\QuestionController@topicSelectBox')->name('admin.topic.select.box');
         	Route::get('question-type','Exam\QuestionController@questionType')->name('admin.question.type');    
         	Route::post('topic-add','Exam\QuestionController@storeTopic')->name('admin.topic.add');    
 		});   
            
            
           

            

});