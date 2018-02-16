function init_charts1() {
    if ($("#lineChart").length) {
      var f = document.getElementById("lineChart");
      new Chart(f, {
        type: "line",
        data: {
          labels: ["January", "February", "March", "April", "May", "June", "July"],
          datasets: [{
            label: "Market value",
            backgroundColor: "rgba(38, 185, 154, 0.31)",
            borderColor: "rgba(38, 185, 154, 0.7)",
            pointBorderColor: "rgba(38, 185, 154, 0.7)",
            pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
            pointHoverBackgroundColor: "#fff",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointBorderWidth: 1,
            data: [31, 74, 6, 39, 20, 500, 7]
          }]
        }
      });
    }
}
   function init_charts2() {
    if ($("#mybarChart").length) {
      var f = document.getElementById("mybarChart");
      new Chart(f, {
        type: "bar",
        data: {
          labels: ["January", "February", "March", "April", "May", "June", "July"],
          datasets: [{
            label: "% profit per time period",
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

// $(document).ready(function () {
// $.ajax({url: "", success: function(result){
//     // $("#div1").html(result);

//     // console.log($(".financial-table tbody tr td"));
// }});

// for (let index = 0; index < 3; index++) {
//     var table_row = document.createElement("tr");
//     $(".financial-table tbody").append(table_row);
//     for (let j = 0; j < 7; j++) {
//         var table_col = document.createElement("td");
//         console.log($(".financial-table tbody tr").append(table_col).text("sunil"));
//     }
// }


//   });

 $(document).ready(function () {
    init_charts1();
    init_charts2();
  });