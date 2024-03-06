// sidebarModule.js

export const initSidebar = () => {
    const $subsidebarsBtns = $(".subsidebar-btn");
    const $subsidebars = $(".subsidebar");
    const $sidebar = $(".sidebar");
    const $openSidebarButton = $('.open-sidebar');
    const $dashboardSidebar = $('.dashboard-sidebar');

    $subsidebarsBtns.on("click", function () {
        handleSubsidebarClick($(this));
    });

    initDashboardSidebar($openSidebarButton, $dashboardSidebar);
    initDashboardSidebarUserDetail();
};

const handleSubsidebarClick = ($button) => {
    const subsidebarId = $button.data("subsidebar");
    const $subsidebar = $("#" + subsidebarId);
    const $sidebar = $(".sidebar");

    $subsidebars.removeClass("show");

    if ($button.hasClass("return-btn")) {
        $button.removeClass("return-btn");
        $subsidebar.removeClass("show");
        $sidebar.removeClass("subsi-active");
    } else {
        $button.addClass("return-btn");
        $subsidebar.addClass("show");
        $sidebar.addClass("subsi-active");
    }
};

const initDashboardSidebar = ($openButton, $dashboardSidebar) => {
    if ($openButton.length && $dashboardSidebar.length) {
        $openButton.on('click', function () {
            toggleDashboardSidebar($dashboardSidebar);
        });
    }
};

const initDashboardSidebarUserDetail = () => {
    var $openButton = $('.leitlearn_dashboard_sidebar_open_user_detail_open');
    var $userDetail = $('.leitlearn_dashboard_sidebar_open_user_detail_displayed');

    $openButton.on('click', function () {
        $userDetail.toggleClass('show');
    });
};

const toggleDashboardSidebar = ($dashboardSidebar) => {
    if ($dashboardSidebar.hasClass('hidden')) {
        $dashboardSidebar.css('marginLeft', '0');
        $dashboardSidebar.removeClass('hidden');
    } else {
        $dashboardSidebar.css('marginLeft', '-100%');
        $dashboardSidebar.addClass('hidden');
    }
};