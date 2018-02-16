function init_charts() {
    if ($("#lineChart").length) {
      var f = document.getElementById("lineChart");
      new Chart(f, {
        type: "line",
        data: {
          labels: ["January", "February", "March", "April", "May", "June", "July"],
          datasets: [{
            label: "My First dataset",
            backgroundColor: "rgba(38, 185, 154, 0.31)",
            borderColor: "rgba(38, 185, 154, 0.7)",
            pointBorderColor: "rgba(38, 185, 154, 0.7)",
            pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
            pointHoverBackgroundColor: "#fff",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointBorderWidth: 1,
            data: [31, 74, 6, 39, 20, 85, 7]
          }]
        }
      });
    }
    if ($("#mybarChart").length) {
      var f = document.getElementById("mybarChart");
      new Chart(f, {
        type: "bar",
        data: {
          labels: ["January", "February", "March", "April", "May", "June", "July"],
          datasets: [{
            label: "# of Votes",
            backgroundColor: "#26B99A",
            data: [51, 30, 40, 28, 92, 50, 45]
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: !0
              }
            }]
          }
        }
      })
    }
  
  }

  function init_DataTables() {
  if (console.log("run_datatables"), "undefined" != typeof $.fn.DataTable) {
      console.log("init_DataTables");
      var a = function () {
          $("#datatable-buttons").length && $("#datatable-buttons").DataTable({
              dom: "Blfrtip",
              buttons: [{
                  extend: "copy",
                  className: "btn-sm"
              }, {
                  extend: "csv",
                  className: "btn-sm"
              }, {
                  extend: "excel",
                  className: "btn-sm"
              }, {
                  extend: "pdfHtml5",
                  className: "btn-sm"
              }, {
                  extend: "print",
                  className: "btn-sm"
              }],
              responsive: !0
          })
      };
      TableManageButtons = function () {
          "use strict";
          return {
              init: function () {
                  a()
              }
          }
      }(), $("#datatable").dataTable(), $("#datatable-keytable").DataTable({
          keys: !0
      }), $("#datatable-responsive").DataTable(), $("#datatable-scroller").DataTable({
          ajax: "js/datatables/json/scroller-demo.json",
          deferRender: !0,
          scrollY: 380,
          scrollCollapse: !0,
          scroller: !0
      }), $("#datatable-fixed-header").DataTable({
          fixedHeader: !0
      });
      var b = $("#datatable-checkbox");
      b.dataTable({
          order: [
              [1, "asc"]
          ],
          columnDefs: [{
              orderable: !1,
              targets: [0]
          }]
      }), b.on("draw.dt", function () {
          $("checkbox input").iCheck({
              checkboxClass: "icheckbox_flat-green"
          })
      }), TableManageButtons.init()
  }
}

$(document).ready(function () {
$.ajax({url: "", success: function(result){
    // $("#div1").html(result);
}});
});

$(document).ready(function () {
$.ajax({url: "", success: function(result){
    // $("#div1").html(result);
}});
});

$(document).ready(function () {
$.ajax({url: "", success: function(result){
    // $("#div1").html(result);
}});
  });

 $(document).ready(function () {
    init_charts();
    init_DataTables();
  });