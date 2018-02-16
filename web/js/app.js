function init_charts1(data) {
  console.log(data);
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
          data: data
        }]
      }
    });
  }
}

function init_charts2(data) {
  console.log(data);
  if ($("#mybarChart").length) {
    var f = document.getElementById("mybarChart");
    new Chart(f, {
      type: "bar",
      data: {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [{
          label: "% profit per time period",
          backgroundColor: "#26B99A",
          data: data
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


// $(document).ready(function () {
// $.ajax({url: "", success: function(result){
//     // $("#div1").html(result);
// }});
// });

// $(document).ready(function () {
// $.ajax({url: "", success: function(result){
//     // $("#div1").html(result);

// }});
// });

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
  var market_value = [];
  var compound_interest;
  var interest_array = [];
  $.ajax({
    url: '/analyser/calculate_pl.php',
    type: 'GET',
    success: function (response) {
      //Do something here...
      var res = JSON.parse(response);
      market_value = res.market_value;
      interest_array = res.interest_value;
      compound_interest = res.compound_interest;
      $('#compound-interest').text(parseInt(compound_interest * 100));
      init_charts1(market_value);
      init_charts2(interest_array);
      console.log(JSON.parse(response));
    }
  });

});