import $ from 'jquery'

console.log('hi')

import "./vendors.js"
import "./customs"

var KTAppOptions = {
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
      "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
      "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
    }
  }
}

console.log('dış scope')

import "./core/app"
import "./core/util"
import "./core/base/avatar"
import "./core/base/dialog"
import "./core/base/header"
import "./core/base/menu"
import "./core/base/offcanvas"
import "./core/base/portlet"
import "./core/base/scrolltop"
import "./core/base/toggle"
import "./core/base/wizard"
import "./core/base/datatable/core.datatable"
import "./core/base/datatable/datatable.checkbox"
import "./core/layout/chat"
import "./core/layout/offcanvas-panel"
import "./core/layout/quick-panel"
import "./core/layout/quick-search"
import "./core/layout/demo-panel"

import "./pages/dashboard"

import "./pages/components/base/dropdown"
import "./pages/components/calendar/background-events"
import "./pages/components/calendar/basic"
import "./pages/components/calendar/external-events"
import "./pages/components/calendar/google"
import "./pages/components/calendar/list-view"
import "./pages/components/charts/amcharts/charts"
import "./pages/components/charts/amcharts/maps"
import "./pages/components/charts/amcharts/stock-charts"
import "./pages/components/charts/flotcharts"
import "./pages/components/charts/google-charts"
import "./pages/components/charts/morris-charts"
import "./pages/components/extended/blockui"
import "./pages/components/extended/bootstrap-notify"
import "./pages/components/extended/perfect-scrollbar"
import "./pages/components/extended/sweetalert2"
import "./pages/components/extended/toastr"
import "./pages/components/extended/treeview"
import "./pages/components/maps/google-maps"
import "./pages/components/maps/jqvmap"
import "./pages/components/maps/jvectormap"
import "./pages/components/portlets/draggable"
import "./pages/components/portlets/tools"
import "./pages/components/utils/idle-timer"
import "./pages/components/utils/session-timeout"
