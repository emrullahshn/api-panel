"use strict";

// Class definition
var KTAppChat = function () {
	var chatAsideEl;
	var chatContentEl;

	// Private functions
	var initAside = function () {
		// Mobile offcanvas for mobile mode
		var offcanvas = new KTOffcanvas(chatAsideEl, {
            overlay: true,
            baseClass: 'kt-app__aside',
            closeBy: 'kt_chat_aside_close',
            toggleBy: 'kt_chat_aside_mobile_toggle'
        });

		// User listing
		var userListEl = KTUtil.find(chatAsideEl, '.kt-scroll');
		if (!userListEl) {
			return;
		}

		// Initialize perfect scrollbar(see:  https://github.com/utatti/perfect-scrollbar)
		KTUtil.scrollInit(userListEl, {
			mobileNativeScroll: true,  // enable native scroll for mobile
			desktopNativeScroll: false, // disable native scroll and use custom scroll for desktop
			resetHeightOnDestroy: true,  // reset css height on scroll feature destroyed
			handleWindowResize: true, // recalculate hight on window resize
			rememberPosition: true, // remember scroll position in cookie
			height: 1000
		});
	}

	return {
		// public functions
		init: function() {
			// elements
			chatAsideEl = KTUtil.getByID('kt_chat_aside');

			// init aside and user list
			initAside();

			// init inline chat example
			KTChat.setup(KTUtil.getByID('kt_chat_content'));

			// trigger click to show popup modal chat on page load
			if (KTUtil.getByID('kt_app_chat_launch_btn')) {
				setTimeout(function() {
					KTUtil.getByID('kt_app_chat_launch_btn').click();
				}, 1000);
			}
		}
	};
}();

KTUtil.ready(function() {
	KTAppChat.init();
});
