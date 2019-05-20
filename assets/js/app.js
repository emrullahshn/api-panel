console.log('hi')

const KTAppOptions = {
  "colors": {
    "state": {
      "brand": "#22b9ff",
      "light": "#ffffff",
      "dark": "#282a3c",
      "primary": "#5867dd",
      "success": "#34bfa3",
      "info": "#36a3f7",
      "warning": "#ffb822",
      "danger": "#fd3995"
    },
    "base": {
      "label": [ "#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466" ],
      "shape": [ "#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a" ]
    }
  }
}

global.KTAppOptions = KTAppOptions

require('jquery')
require('./vendors.js')

require('./core/util')
require('./core/app')
require('./core/base/avatar')
require('./core/base/dialog')
require('./core/base/header')
require('./core/base/menu')
require('./core/base/offcanvas')
require('./core/base/portlet')
require('./core/base/scrolltop')
require('./core/base/toggle')
require('./core/base/wizard')
require('./core/base/datatable/core.datatable')
require('./core/base/datatable/datatable.checkbox')
require('./core/layout/chat')
require('./core/layout/offcanvas-panel')
require('./core/layout/quick-panel')
require('./core/layout/quick-search')
require('./core/layout/demo-panel')

require('./pages/components/calendar/background-events')
require('./pages/components/calendar/basic')
require('./pages/components/calendar/external-events')
require('./pages/components/calendar/google')
require('./pages/components/calendar/list-view')
require('./pages/components/charts/amcharts/charts')
require('./pages/components/charts/amcharts/maps')
require('./pages/components/charts/amcharts/stock-charts')
require('./pages/components/charts/flotcharts')
require('./pages/components/charts/google-charts')
require('./pages/components/charts/morris-charts')
require('./pages/components/extended/blockui')
require('./pages/components/extended/bootstrap-notify')
require('./pages/components/extended/perfect-scrollbar')
require('./pages/components/extended/sweetalert2')
require('./pages/components/extended/toastr')
require('./pages/components/extended/treeview')
require('./pages/components/maps/google-maps')
require('./pages/components/maps/jqvmap')
require('./pages/components/maps/jvectormap')
require('./pages/components/portlets/draggable')
require('./pages/components/portlets/tools')
require('./pages/components/utils/idle-timer')
require('./pages/components/utils/session-timeout')
