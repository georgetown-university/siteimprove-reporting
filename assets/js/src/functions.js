// Click event for the "Get current data" button.
$('#getCurrentData').click(function() {
  $(this).attr('disabled', 'disabled').html('Fetching current issue data');

  $.ajax({
   url: 'actions/get_current_issues.php',
   success: function(data) {
     $('#getCurrentData').removeClass('btn-primary').addClass('btn-secondary').html('Issue data is up-to-date!');
   }
  });
});

//
$('#selectSite').change(function() {
  let site = this.value;

  // Clear out any old charts
  $('#a_issues').html('');
  $('#aa_issues').html('');
  $('#aaa_issues').html('');

  // Make sure charts will display
  $('.chart, .pages').removeClass('hide');

  // Generate charts
  $.ajax({
   url: 'actions/get_site_issues.php',
   datatype: 'json',
   data: {
     site: site
   },
   success: function(data) {
     var dataObj = JSON.parse(data);
     $('.pages span').html(dataObj.pages);

     siChart.create(dataObj, 'a_issues');
     siChart.create(dataObj, 'aa_issues');
     siChart.create(dataObj, 'aaa_issues');
   }
  });
});
